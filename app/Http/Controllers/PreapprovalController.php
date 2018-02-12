<?php
namespace Followback\Http\Controllers;

use SocialBid\Services\Payments\PayPalConfig;
use SocialBid\Services\Payments\PayPal;
use Carbon\Carbon;

class PreapprovalController extends BaseController {
    public function __construct(PayPal $paypal)
    {
        $this->paypal = $paypal;
    }

    public function getPreapproval()
    {
        try {
            $preapprovalKey = $this->paypal->getPreapprovalKey();
            Session::flash('preapprovalKey', $preapprovalKey);
            return View::make('profile.preapproval');
        } catch (\Exception $e) {
            Flash::addError($e->getMessage());
            return Redirect::route('profile_dashboard');
        }
    }

    public function getPreapprovalRedirect()
    {
        if (!Session::has('preapprovalKey')) {
            Flash::addError('Unexpected error.');
            return Redirect::route('profile_dashboard');
        }
        Session::keep('preapprovalKey');
        $preapprovalKey = Session::get('preapprovalKey');
        $url = 'https://www.sandbox.paypal.com/cgi-bin/webscr?cmd=_ap-preapproval&preapprovalkey=' .
            $preapprovalKey;
        $preapprovalKey = (new PreapprovalKey)->fill(
            [
                'preapproval_key' => $preapprovalKey,
                'status' => 0
            ]
        );
        Sentry::getUser()->preapprovalKeys()->save($preapprovalKey);
        return Redirect::away($url);
    }

    public function getPreapprovalCancel()
    {
        Flash::addError(
            'You cancelled your preapproval process. You won\'t be able to use our functionalities'
        );
        return Redirect::route('preapproval');
    }

    public function getPreapprovalAccept()
    {
        return View::make('profile.preapprovalAccept');
    }

    public function postPreapprovalCallback()
    {
        $input = Input::all();
        $preapprovalKey = array_get($input, 'preapproval_key');
        try {
            $preapprovalKey = (new PreapprovalKey)->findByKey(
                $input['preapproval_key']
            );
            //check the status of preapproval callback and take some action based on that
            switch (strtolower($input['status'])) {
                //if status is active then we will get the values from response and save them in database
                case 'active':
                    $preapprovalKey->fill(
                        [
                            'expires_on' => (
                            new Carbon(
                                array_get($input, 'ending_date')
                            )
                            )->format('Y-m-d H:i:s'),
                            'funds_limit_left' => array_get(
                                $input,
                                'max_total_amount_of_all_payments'
                            ),
                            'status' => 1
                        ]
                    );
                    $preapprovalKey->save();
                    Event::fire('preapprovalKey.activated', $preapprovalKey);
                    break;
                //if status is cancelled then we will just delete this key
                case 'cancelled':
                    $preapprovalKey->delete();
                    break;
            }
        } catch (Exception $e) {
            Log::error(
                $e->getMessage() . ' - preapproval key =' . $preapprovalKey
            );
        }

    }
}