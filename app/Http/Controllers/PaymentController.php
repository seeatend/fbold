<?php
namespace Followback\Http\Controllers;


use Carbon\Carbon;
use Followback\Order;
use Followback\ServiceBid;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use SocialBid\FlashService\Facade\Flash;
use SocialBid\Services\Payments\PayPal;

class PaymentController extends BaseController {

    /**
     * @var null|string Nonce Braintree API token
     */

    public function __construct(PayPal $paypal)
    {
        $this->paypal = $paypal;

    }

    public function getReturn()
    {
        if (Input::get('success') == 1) {
            $this->paypal->executePayment(Input::all());

            //$response = $this->paypal->getResponse();
            //printf($response);

            if ($this->paypal->isValidResponse()) {
                $response = $this->paypal->getResponse();

                if ($response->state == 'approved') {
                    //get bid from session
                    $bid = Session::get('bid.store');
                    //if there is a create variable in query string then we should save bid before we take any actions since it is not now saved
                    //because we dont want to store a dummy record if user will just close the payment page so bid is created just here
                    $bid->save();
                    //create new order and fill it with data from bid
                    $order = new Order;
                    $order->transaction_id = $response->id;
                    $order->fillFromBid($bid);

                    if ($response->intent == 'sale') {
                        $order->status = 'approved';
                        $order->save();

                        Event::fire('order.finished', $order);

                        $this->fireSuccessPaymentEvents($order);

                        return redirect()->route('confirmation_paid');
                    } elseif ($response->intent == 'authorize') {
                        Event::fire('order.authorized', $order);
                        $order->status = 'authorized';
                        $order->authorization_id = $response->transactions[0]->related_resources[0]->authorization->id;
                        $order->authorized_at = Carbon::now();
                        $order->save();

                        $this->fireSuccessPaymentEvents($order);

                        return redirect()->route('confirmation_authorized');
                    }
                } else {
                    Flash::addError('Payment was rejected. Try to bid again.');
                }

            } else {
                Flash::addError(
                    'Unexpected error. You were not charged, but your bid was not placed. Try again later.'
                );
            }
        } else {
            $this->fireFailturePaymentEvents();
        }
        return redirect()->route('bid_list');
    }

    protected function fireSuccessPaymentEvents($order)
    {
        //if there is a counterbid param then we will send a email for counter offer, otherwise a email for initial offer
        if (Input::get('counterbid_accepted', false)) {
            Event::fire('bid.counterbid.accepted', $order->bid);
        } elseif (Input::get('counterbid_countered', false)) {
            Event::fire('bid.counteredByCreator', $order->bid);
        } elseif ($order->status == 'approved') {
            Event::fire('bid.created', $order->bid);
        } else {
            Event::fire('bid.authorized', $order->bid);
        }
    }

    public function fireFailturePaymentEvents()
    {
        //if bid is not counterbid then we will remove the transaction and bid
        if (!Input::get('counterbid_accepted', false)) {
            Session::forget('bid.store');
            Session::forget('payment.id');
            Flash::addWarning('You have cancelled your bidding.');
        } else {
            Flash::addWarning('You cancelled the process of counterbid.');
        }
    }

    public function getCheckout()
    {
        if (!Session::has('bid.store')) {
            return redirect()->route('profile_dashboard');
        }

        $bid = Session::get('bid.store');
        if ($bid->bid_type == 'fixed') {
            return view('payment.checkoutPay', compact('bid'));
        } else {
            return view('payment.checkoutVerify', compact('bid'));
        }
    }

    public function getMake()
    {
        if (!Session::has('bid.store')) {
            return redirect()->route('profile_dashboard');
        }
        $bid = Session::get('bid.store');
        if ($bid->bid_type == 'fixed') {
            //add a variable to indicate that we are creating a bid
            $this->paypal->addParamsToReturnUrl(['create' => 1]);
            $this->paypal->preparePaymentForBid($bid);
        } else {
            //add a variable to indicate that we are creating a bid
            $this->paypal->addParamsToReturnUrl(['create' => 1]);
            $this->paypal->prepareAuthorizationForBid($bid);
        }
        $response = $this->paypal->getResponse();
        if ($this->paypal->isValidResponse()) {
            foreach ($this->paypal->getResponse()->getLinks() as $link) {
                if ($link->getRel() == 'approval_url') {
                    return redirect()->away($link->getHref());
                }
            }
        }

        Flash::addError('Something went wrong. Try again.');
        return redirect()->route('profile_dashboard');
    }

    public function getConfirmationPaid()
    {
        $bid = Session::get('bid.store');

        return view('payment.confirmationPaid', compact('bid'));
    }

    public function getConfirmationAuthorized()
    {
        $bid = Session::get('bid.store');

        return view('payment.confirmationAuthorized', compact('bid'));
    }
}
