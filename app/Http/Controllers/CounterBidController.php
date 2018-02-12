<?php
namespace Followback\Http\Controllers;

use Braintree_ClientToken;
use Followback\ServiceBid;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Sentry;
use SocialBid\FlashService\Facade\Flash;
use SocialBid\Services\Forms\Bid\CounterBidForm;
use SocialBid\Services\Payments\PayPal;

class CounterBidController extends BaseController {

    public function __construct(
        PayPal $paypal,
        CounterBidForm $counterBidForm
    ) {
        $this->payment = $paypal;
        $this->counterBidForm = $counterBidForm;
    }

    public function getDeny($id)
    {
        $bid = Sentry::getUser()->findMyBidById($id);
        if ($bid) {
            Event::fire('bid.counterbid.denied', $bid);
            Flash::addSuccess('Counterbid was denied.');
        }
        if (\Request::ajax()) {
            return \Response::json(
                ['success' => true, 'redirect' => 'sent'],
                200
            );
        }
        return redirect()->route('bid_list');
    }

    public function getAccept($id)
    {
        $bid = Sentry::getUser()->findMyBidById($id);
        if ($bid) {
            $this->payment->addParamsToReturnUrl(['counterbid_accepted' => 1]);
            $this->payment->preparePaymentForBid($bid);
            if ($this->payment->isValidResponse()) {
                $response = $this->payment->getResponse();
                foreach ($this->payment->getResponse()->getLinks() as $link) {
                    if ($link->getRel() == 'approval_url') {
                        if (\Request::ajax()) {
                            return \Response::json(
                                [
                                    'success' => true,
                                    'sendto' => 'paypal',
                                    'redirect' => $link->getHref()
                                ],
                                200
                            );
                        }
                        return redirect()->away($link->getHref());
                    }
                }
            }
        }
        Flash::addError('Something went wrong. Try again.');
        if (\Request::ajax()) {
            return \Response::json(
                ['success' => true, 'redirect' => 'sent'],
                200
            );
        }
        return redirect()->route('bid_list');
    }

    /**
     * handles the countering of bids
     *
     * @param  integer $id bid id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postCounterByReceiver($id)
    {
        //find bid
        $bid = Sentry::getUser()->findBidForMeById($id);
        $input = Input::all();
        $input['price'] = str_replace(',', '', $input['price']);

        if ($bid and in_array(
                $bid->status,
                [
                    ServiceBid::STATUS_NEW or
                    $bid->status == ServiceBid::STATUS_COUNTERED_BY_CREATOR
                ]
            )
        ) {
            if ($this->counterBidForm->isValidForReceiver($input, $bid)) {
                $order = $bid->orders()->authorized()->first();
                $response = $this->payment->voidAuthorizationForOrder($order);
                if ($response->isValidResponse() and
                    $response->getResponse()->state === 'voided'
                ) {
                    Event::fire('order.voided', $order);
                    Event::fire(
                        'bid.counteredByReceiver',
                        [$bid, $input['price']]
                    );
                    Flash::addSuccess('You placed a counter bid.');
                } else {
                    Flash::addError('Something went wrong. Try again later.');
                }
            } else {
                Flash::addError($this->counterBidForm->getErrors()->first());
            }
            return redirect()->route('bids_for_me');
        } else {
            Flash::addError("Bid not found or could not be processed.");
            return redirect()->route('profile_connect');
        }
    }

    public function postCounterByCreator($id)
    {
        $bid = Sentry::getUser()->bids()->find($id);
        $input = Input::all();
        $input['price'] = str_replace(',', '', $input['price']);

        if ($bid and $bid->status == ServiceBid::STATUS_COUNTERED_BY_RECEIVER) {

            if ($this->counterBidForm->isValidForCreator($input, $bid)) {
                $bid->offer_price = $input['price'];
                //add param so we will know what events should we fire after we finish the process of authorization of this payment
                $this->payment->addParamsToReturnUrl(
                    ['counterbid_countered' => 1]
                );
                $this->payment->prepareAuthorizationForBid($bid);
                if ($this->payment->isValidResponse()) {
                    $response = $this->payment->getResponse();
                    foreach ($this->payment->getResponse()->getLinks(
                    ) as $link) {
                        if ($link->getRel() == 'approval_url') {
                            return redirect()->away($link->getHref());
                        }
                    }
                } else {
                    Flash::addError('Something went wrong. Try again later.');
                }
            } else {
                Flash::addError($this->counterBidForm->getErrors()->first());
            }
            return redirect()->route('bid_list');
        }
    }
}