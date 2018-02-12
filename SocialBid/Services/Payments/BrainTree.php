<?php
namespace SocialBid\Services\Payments;

use Braintree_Customer;
use Braintree_Transaction;
use Carbon\Carbon;
use Exception;
use Followback\Order;
use Followback\ServiceBid;
use Illuminate\Support\Facades\Session;

class BrainTree {

    /**
     * @var bool
     */
    public $response = false;
    protected $returnUrlParams = [];

    public function addParamsToReturnUrl(array $params)
    {
        $this->returnUrlParams = array_merge($this->returnUrlParams, $params);
    }

    /**
     * Submit the previously authorized bid for settlement
     *
     * @param Order $order
     * @return $this
     * @throws Exception
     */
    public function capturePayment(Order $order)
    {
        try {

            if (Carbon::now()->diffInDays($order->authorized_at) > 29) {
                throw new Exception(
                    'Payment authorization for this bid is expired. Bid was cancelled.'
                );
            }

            $response = Braintree_Transaction::submitForSettlement(
                $order->authorization_id
            );

            if ($response->success) {
                $this->response = $response;

                return $this;
            } else {
                $this->response = false;

                return $this;
            }

        } catch (Exception $e) {
            $order->bid()->first()->delete();
            throw new Exception($e->getMessage());
        }
    }

    public function getResponse()
    {
        return $this->response;
    }

    public function isValidResponse()
    {
        return isset($this->response) && $this->response !== false;
    }

    /**
     * Preauthorize the bid amount and store response id in session
     *
     * @param ServiceBid $bid
     * @param $nonce
     * @return $this
     */
    public function prepareAuthorizationForBid(
        ServiceBid $bid,
        $nonce,
        $token = false
    ) {
        $price = str_replace(",", "", $bid->offer_price);

        if (!$token) {

            $response = Braintree_Transaction::sale(
                [
                    'amount' => $price + 200,
                    'paymentMethodNonce' => $nonce
                ]
            );

        } else {
            $response = Braintree_Transaction::sale(
                [
                    'amount' => $price,
                    'paymentMethodToken' => $nonce
                ]
            );
        }

        if ($response->success) {
            $this->response = $response;
            Session::set('payment.id', $response->transaction->id);
            Session::set('bid.store', $bid);

            return $this;
        } else {
            $this->response = false;

            return $this;
        }
    }

    public function preparePaymentForBid($bid)
    {
        $price = str_replace(",", "", $bid->offer_price);

        $response = Braintree_Transaction::submitForSettlement(
            $bid->orders->first()->transaction_id,
            $price
        );

        if ($response->success) {
            $this->response = $response;
            Session::set('payment.id', $response->transaction->id);
            Session::set('bid.store', $bid);

            return $this;
        } else {
            $this->response = false;

            return $this;
        }

    }

    public function voidAuthorizationForOrder($order)
    {
        $response = Braintree_Transaction::void(
            $order->authorization_id
        );

        if ($response->success) {
            $this->response = $response;

            return $this;
        } else {
            $this->response = false;

            return $this;
        }
    }

}