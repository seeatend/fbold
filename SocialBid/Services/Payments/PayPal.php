<?php
namespace SocialBid\Services\Payments;

use Carbon\Carbon, Sentry, Exception;
use Config, Session;
use PayPal\Api\Payment;
use PayPal\Api\Authorization;
use PayPal\Api\Capture;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Rest\ApiContext;
use SocialBid\Services\Payments\PayPalConfig;
use PayPal\Auth\OAuthTokenCredential;
use SocialBid\Services\Payments\PaymentFix;
use PayPal\Exception\PPConnectionException;
use DbConfig;

class PayPal {
    protected $response;
    protected $returnUrl;
    protected $returnUrlParams = array();
    protected $cancelUrl;
    protected $cancelUrlParams = array();
    protected $orderId;

    public function __construct()
    {
        $token = new OAuthTokenCredential(
            DbConfig::get('payments.paypal.client_id'),
            DbConfig::get('payments.paypal.secret'),
            PayPalConfig::getConfig()
        );
        $this->context = new ApiContext($token);
        $this->context->setConfig(PayPalConfig::getConfig());

        $this->setReturnUrl(route('payment_paypal_return'))
            ->addParamsToReturnUrl(['success' => 1]);
        $this->setCancelUrl(route('payment_paypal_return'))
            ->addParamsToCancelUrl(['success' => 0]);
    }

    protected function getReturnUrl()
    {
        return count($this->returnUrlParams) > 0 ?
            $this->returnUrl . '?' . http_build_query($this->returnUrlParams) :
            $this->returnUrl;
    }

    public function setReturnUrl($url)
    {
        $this->returnUrl = $url;
        return $this;
    }

    public function addParamsToReturnUrl(array $params)
    {
        $this->returnUrlParams = array_merge($this->returnUrlParams, $params);
    }

    protected function getCancelUrl()
    {
        return count($this->cancelUrlParams) > 0 ?
            $this->cancelUrl . '?' . http_build_query($this->cancelUrlParams) :
            $this->cancelUrl;
    }

    public function setCancelUrl($url)
    {
        $this->cancelUrl = $url;
        return $this;
    }

    public function addParamsToCancelUrl(array $params)
    {
        $this->cancelUrlParams = array_merge($this->cancelUrlParams, $params);
    }

    public function executePayment($input)
    {
        $paymentId = Session::get('payment.id');
        $payment = PaymentFix::get($paymentId, $this->context);
        $execution = new PaymentExecution;
        $execution->setPayerId($input['PayerID']);
        try {
            $this->response = $payment->execute($execution, $this->context);
            return $this;
        } catch (PPConnectionException $e) {
            $this->response = false;
            return $this;
        }
    }

    public function capturePayment($order)
    {
        try {
            $auth = Authorization::get(
                $order->authorization_id,
                $this->context
            );
            if (Carbon::now()->diffInDays($order->authorized_at) > 29) {
                throw new Exception(
                    'Payment authorization for this bid is expired. Bid was cancelled.'
                );
            }

            if (Carbon::now()->diffInDays($order->authorized_at) > 3) {
                try {
                    $auth->setAmount($order->total);
                    $response = $auth->reauthorize($this->context);

                    if ($response->getState() == 'pending') {
                        throw new Exception(
                            'Payment for this bid could not be captured. Bid was cancelled.'
                        );
                    }
                } catch (PPConnectionException $e) {
                    $this->response = false;
                    return $this;
                }
            }

            $amt = new Amount();
            $amt->setCurrency("USD")
                ->setTotal($order->total);

            // Create a capture
            $captureInfo = new Capture();
            $captureInfo->setId($order->authorization_id)
                ->setAmount($amt);

            try {
                $this->response = $auth->capture($captureInfo, $this->context);
            } catch (PPConnectionException $e) {
                $this->response = false;
                return $this;
            }
        } catch (Exception $e) {
            $order->bid()->first()->delete();
            throw new Exception($e->getMessage());
        }
    }

    public function voidAuthorizationForOrder($order)
    {
        try {
            $auth = Authorization::get(
                $order->authorization_id,
                $this->context
            );
            $this->response = $auth->void($this->context);
            return $this;
        } catch (PPConnectionException $e) {
            $this->response = false;
            return $this;
        }
    }

    public function preparePaymentForBid($bid)
    {
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');
        $item = new Item();
        $price = str_replace(",", "", $bid->offer_price);
        $item->setName('Bid')->setCurrency('USD')->setQuantity(1)->setPrice(
            $price
        );
        $itemList = (new ItemList)->setItems([$item]);
        $amount = (new Amount)->setCurrency('USD')->setTotal($price);
        $transaction = (new Transaction)->setAmount($amount)->setItemList(
            $itemList
        )->setDescription('Payment');
        $redirectUrls = (new RedirectUrls)->setReturnUrl($this->getReturnUrl())
            ->setCancelUrl($this->getCancelUrl());
        $payment = (new Payment)->setIntent('sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirectUrls)
            ->setTransactions([$transaction]);
        try {
            $this->response = $payment->create($this->context);
            Session::set('payment.id', $this->response->getId());
            Session::set('bid.store', $bid);
            return $this;
        } catch (PPConnectionException $e) {
            dd($e);
            $this->response = false;
            return $this;
        }
    }

    public function prepareAuthorizationForBid($bid)
    {

        $payer = new Payer();
        $payer->setPaymentMethod('paypal');
        $item = new Item();
        $price = str_replace(",", "", $bid->offer_price);
        $item->setName(
            'Preauthorization for bid. This amount is being preauthorized and you will be charged once your bid is accepted.'
        )->setCurrency('USD')->setQuantity(1)->setPrice($price);
        $itemList = (new ItemList)->setItems([$item]);
        $amount = (new Amount)->setCurrency('USD')->setTotal($price);
        $transaction = (new Transaction)->setAmount($amount)->setItemList(
            $itemList
        )->setDescription('Payment');
        $redirectUrls = (new RedirectUrls)->setReturnUrl($this->getReturnUrl())
            ->setCancelUrl($this->getCancelUrl());
        $payment = (new Payment)->setIntent('authorize')
            ->setPayer($payer)
            ->setRedirectUrls($redirectUrls)
            ->setTransactions([$transaction]);
        try {
            $this->response = $payment->create($this->context);
            Session::set('payment.id', $this->response->getId());
            Session::set('bid.store', $bid);
            return $this;
        } catch (\Exception $e) {
            $this->response = false;
            return $this;
        }
    }

    public function isValidResponse()
    {
        return (isset($this->response) and $this->response !== false) ? true :
            false;
    }

    public function getResponse()
    {
        return $this->response;
    }
}
