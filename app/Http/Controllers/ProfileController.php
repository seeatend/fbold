<?php
namespace Followback\Http\Controllers;

use Followback\ServiceBid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Sentry;
use SocialBid\FlashService\Facade\Flash;
use SocialBid\Helpers\ArrayHelper;
use SocialBid\Services\Forms\Profile\ServicesPricesForm;

class ProfileController extends BaseController {

    public function __construct(ServicesPricesForm $servicesPricesForm)
    {
        $this->servicesPricesForm = $servicesPricesForm;
    }

    public function getDashboard()
    {
        return \View::make('profile.dashboard');
    }

    public function getConnect()
    {
        return \View::make('profile.connect');
    }

    public function getReceivingPayments()
    {
        $title = 'Payments';
        $user_id = Sentry::getUser()->id;

        //Manage Accepted Bid For current user
        // $bids['accepted_bids'] = DB::table('service_offer')
        // 	->where('bidder_id', $user_id)
        // 	->where('status',ServiceBid::STATUS_COUNTERED_BY_CREATOR)
        // 	->sum('offer_price');

        //Manage Sent Bid For current user
        $sent_bids = ServiceBid::forCurrentUser()->get();
        $total_sent_bids = 0.0;
        foreach ($sent_bids as $sent_bid) {
            //$number = floatval(str_replace(',', '.', str_replace('.', '', $sent_bid->offer_price)));
            $number = floatval(str_replace(',', '', $sent_bid->offer_price));
            $total_sent_bids = $total_sent_bids + $number;
        }
        $bids['sent_bids'] = $total_sent_bids;

        //Manage Rceieve Bid For current user
        $recieve_bids = Sentry::getUser()->findBidsForMe('offer_price');
        $total_receive_bids = 0.0;
        $total_accept_bids = 0.0;
        foreach ($recieve_bids as $recieve_bid) {
            $numberRec = floatval(
                str_replace(',', '', $recieve_bid->offer_price)
            );
            $total_receive_bids = $total_receive_bids + $numberRec;

            if ($recieve_bid->status == ServiceBid::STATUS_ACCEPTED ||
                $recieve_bid->status == ServiceBid::STATUS_COUNTERBID_ACCEPTED
            ) {

                $numberAcc = floatval(
                    str_replace(',', '', $recieve_bid->offer_price)
                );
                $total_accept_bids = $total_accept_bids + $numberAcc;

            }
        }
        $bids['receive_bids'] = $total_receive_bids;
        $bids['accepted_bids'] = $total_accept_bids;

        return \View::make('profile.payments')->with(compact('bids', 'title'));
    }

    protected function hasFollowbackAccountSetting($user_id)
    {

        return DB::table('users_profile_settings')
            ->where('user_id', $user_id)
            ->first();
        if (!empty($if_user_exist)) {
            //update User Record
            DB::table('users_profile_settings')
                ->where('user_id', $user_id)
                ->update(
                    array('is_public_profile' => $index)
                );
        }
    }

    protected function doFollowbackAccountSetting($user_id)
    {

        //Set Default notification
        $all_status = Config::get('notificationconstants');
        $status = $all_status['as_it_happen'];

        DB::table('users_profile_settings')
            ->insert(
                array(
                    'user_id' => $user_id,
                    'notification_status' => $status
                )
            );

    }

    public function getFollowbackProfile(Request $request)
    {
        $title = 'Profile';
        $user_id = Sentry::getUser()->id;
        $charity_id = $request->input('charity');

        $blockedUsers = Sentry::getUser()->blockedUsers()->get();

        //If user opne this page first time then enter its notificatin info DB
        $user_exist = $this->hasFollowbackAccountSetting($user_id);
        if (empty($user_exist)) {
            //Do setting
            $this->doFollowbackAccountSetting($user_id);
        }

        //$charities = DB::table('charities')->get();
        $userProfile = array();
        $userProfile = DB::table('users_profile_settings')->where(
            'user_id',
            $user_id
        )->first();
        $userSocial = array();
        $userSocial = DB::table('users_social_accounts')->where(
            'user_id',
            $user_id
        )->first();
        $is_public_pofile = DB::table('users_profile_settings')->where(
            'user_id',
            $user_id
        )->pluck('is_public_profile');
        $notifications_status = DB::table('users_profile_settings')->where(
            'user_id',
            $user_id
        )->pluck('notification_status');

        $user_id = Sentry::getUser()->id;

        //Manage Accepted Bid For current user
        // $bids['accepted_bids'] = DB::table('service_offer')
        // 	->where('bidder_id', $user_id)
        // 	->where('status',ServiceBid::STATUS_COUNTERED_BY_CREATOR)
        // 	->sum('offer_price');

        //Manage Sent Bid For current user
        $sent_bids = ServiceBid::forCurrentUser()->get();
        $total_sent_bids = 0.0;
        foreach ($sent_bids as $sent_bid) {
            //$number = floatval(str_replace(',', '.', str_replace('.', '', $sent_bid->offer_price)));
            $number = floatval(str_replace(',', '', $sent_bid->offer_price));
            $total_sent_bids = $total_sent_bids + $number;
        }
        $bids['sent_bids'] = $total_sent_bids;

        //Manage Rceieve Bid For current user
        $recieve_bids = Sentry::getUser()->findBidsForMe('offer_price');
        $total_receive_bids = 0.0;
        $total_accept_bids = 0.0;
        foreach ($recieve_bids as $recieve_bid) {
            $numberRec = floatval(
                str_replace(',', '', $recieve_bid->offer_price)
            );
            $total_receive_bids = $total_receive_bids + $numberRec;

            if ($recieve_bid->status == ServiceBid::STATUS_ACCEPTED ||
                $recieve_bid->status == ServiceBid::STATUS_COUNTERBID_ACCEPTED
            ) {

                $numberAcc = floatval(
                    str_replace(',', '', $recieve_bid->offer_price)
                );
                $total_accept_bids = $total_accept_bids + $numberAcc;

            }
        }
        $bids['receive_bids'] = $total_receive_bids;
        $bids['accepted_bids'] = $total_accept_bids;

        return \View::make('profile.followbackProfile')->with(
            compact(
                'blockedUsers',
                'bids',
                'is_public_pofile',
                'notifications_status',
                'userProfile',
                'title',
                'userSocial'
            )
        );
    }

    public function postUserProfie()
    {
        $user_id = Sentry::getUser()->id;
        $charity_id = Input::get('charity');

        $if_user_exist = DB::table('users_profile_settings')->where(
            'user_id',
            $user_id
        )->first();
        if (!empty($if_user_exist)) {
            //update User Record
            DB::table('users_profile_settings')
                ->where('user_id', $user_id)
                ->update(
                    array('charity_id' => $charity_id)
                );
        } else {
            //Insert New User Record
            DB::table('users_profile_settings')
                ->insert(
                    array(
                        'user_id' => $user_id,
                        'charity_id' => $charity_id
                    )
                );
        }
        //Flash::addSuccess('Profile has been updated successfully!!!');
        Flash::addSuccess('Charity has been updated successfully!!!');
        return redirect()->route('profile_followback_profile');
    }

    public function setCherityLogo($id)
    {
        $charity = DB::table('charities')
            ->where('id', $id)
            ->first();

    }

    public function deletefollowbackProfile($id)
    {

        DB::table('users')
            ->where('id', $id)
            ->update(
                array('is_deleted' => 0)
            );
        Flash::addSuccess('Your account has been successfully.');
        return redirect()->route('profile_followback_profile');
    }

    public function getServicesPrices()
    {
        $title = 'Set My Task Prices';
        $servicesList = ServicesHelper::getListWithConnectFilter();

        // get first service from available ones
        //$userPrices=array();
        //print_r(array_keys($servicesList)[0]);
        $defaultService = count($servicesList) > 1 ?
            array_keys($servicesList)[1] :
            Config::get('otherconstants.MY_PRICE_DEFAULT_SERVICE');

        $userPrices = Sentry::getUser()
            ->getSettings()
            ->present()
            ->servicesPricesForSettings();
        return View::make('profile.servicesPrices')->with(
            compact('servicesList', 'defaultService', 'userPrices', 'title')
        );
    }

    public function postServicesPrices()
    {
        // $services = Input::get('services');
        // $services = Input::get('services');
        $inputs = Input::all();
        $services = $inputs['services'];

        if (isset($inputs['reset']) && $inputs['reset'] == 'reset') {
            $reset_type = $inputs['reset_type'];

            //Reset all input for that field
            foreach ($services[$reset_type] as $pKey => $platform) {

                if (isset($services[$reset_type][$pKey]['type'])) {
                    unset($services[$reset_type][$pKey]['type']);
                    $services[$reset_type][$pKey]['price'] = '';
                }

            }

        }
        // foreach ($services['instagram'] as $key => $value) {
        // 	# code...
        // }

        $services = (new ArrayHelper)->recursiveReplace(',', '', $services);

        // reset type if price is 0
        foreach ($services as $pKey => $platform) {
            foreach ($platform as $skey => $service) {
                if (empty($service['price'])) {
                    //unset($services[$pKey][$skey]['type']);
                    $services[$pKey][$skey]['price'] = '';
                }
            }
        }

        /*
            Store value in temp variable
            set price value null who do not selected type
            then save in database
        */
        $tempService = $services;
        foreach ($tempService as $service => $options) {
            foreach ($options as $type => $settings) {
                if (!empty($settings['price']) and !isset($settings['type'])) {
                    $tempService[$service][$type]['price'] = '';
                }
                //if (!ctype_digit($settings['price'])) {
                if (!is_numeric($settings['price']) || $settings['price'] <
                    Config::get('otherconstants')['MIN_BID_PRICE']
                ) {
                    unset($tempService[$service][$type]['type']);
                    $tempService[$service][$type]['price'] = '';
                }
            }
        }

        $userSettings = Sentry::getUser()->getSettings();
        $userSettings->services_prices = $tempService;
        $userSettings->save();

        //Check validation send error if occur
        if (!$this->servicesPricesForm->isValid($services)) {
            return redirect()->route('profile_services_prices')
                ->withInput()
                ->withErrors($this->servicesPricesForm->getErrors());
        }
        //Flash::addError('There were an errors. Scroll below and fix them.');
        //return redirect()->route('profile_services_prices')->withInput()->withErrors($this->servicesPricesForm->getErrors());
        if (isset($inputs['reset']) && $inputs['reset'] == 'reset') {
            Flash::addSuccess('Prices reset successfully !!');
        } else {
            Flash::addSuccess('Prices updated successfully !!');
        }

        return redirect()->route('profile_services_prices');
    }

    public function resetPriceList()
    {

        // $services = Input::get('services');
        // $services = Input::get('services');

        // $services = (new ArrayHelper)->recursiveReplace(',','',$services);
        // echo '<pre>';
        // print_r($services);
        // exit;

    }

    public function postPaypalEmail()
    {

        $user = Sentry::getUser();
        $user->paypal_email = Input::get('paypal_email');
        if (Input::get('paypal_email') != "") {

            $user->save();

            $request_from = Input::get('receive_paypal_input');
            if ($request_from == 'receive_paypal_email') {
                return redirect()->back()->with(
                    'success_message',
                    'Email saved successfully.'
                );
            } else {
                Flash::addSuccess('Email saved successfully.');
            }
        } else {
            return redirect()->back()->with('error_message', 'Email not saved.');
        }
        return redirect()->back();
    }

    public function displayPublicProfile($id)
    {
        $index = 0;
        $this->setPublicProfile($id, $index);
        return redirect()->route('profile_followback_profile');
    }

    public function hidePublicProfile($id)
    {
        $index = 1;
        $this->setPublicProfile($id, $index);
        return redirect()->route('profile_followback_profile');
    }

    // public function doAsItHappen($id) {
    // 	$all_status = Config::get('notificationconstants');
    // 	$status = $all_status['as_it_happen'];

    // 	$this->setNoticationStatus($id,$status);
    // 	Flash::addSuccess('Notification has been changed !!');
    // 	return redirect()->route('profile_followback_profile');
    // }

    // public function doDailyEmail($id) {
    // 	$all_status = Config::get('notificationconstants');
    // 	$status = $all_status['daily_email'];

    // 	$this->setNoticationStatus($id,$status);
    // 	Flash::addSuccess('Notification has been changed !!');
    // 	return redirect()->route('profile_followback_profile');
    // }

    // public function doNeverEmail($id) {
    // 	$all_status = Config::get('notificationconstants');
    // 	$status = $all_status['never_email_me'];

    // 	$this->setNoticationStatus($id,$status);
    // 	Flash::addSuccess('Notification has been changed !!');
    // 	return redirect()->route('profile_followback_profile');
    // }

    public function setNoticationStatus($user_id, $status)
    {

        $if_user_exist = DB::table('users_profile_settings')->where(
            'user_id',
            $user_id
        )->first();

        if (!empty($if_user_exist)) {
            //update User Record
            DB::table('users_profile_settings')
                ->where('user_id', $user_id)
                ->update(
                    array('notification_status' => $status)
                );
        } else {
            //Insert New User Record
            DB::table('users_profile_settings')
                ->insert(
                    array(
                        'user_id' => $user_id,
                        'notification_status' => $status
                    )
                );
        }

    }

    public function setPublicProfile($user_id, $index)
    {

        $if_user_exist = DB::table('users_profile_settings')->where(
            'user_id',
            $user_id
        )->first();

        if (!empty($if_user_exist)) {
            //update User Record
            DB::table('users_profile_settings')
                ->where('user_id', $user_id)
                ->update(
                    array('is_public_profile' => $index)
                );
        } else {
            //Insert New User Record
            DB::table('users_profile_settings')
                ->insert(
                    array(
                        'user_id' => $user_id,
                        'is_public_profile' => $index
                    )
                );
        }
    }

    public function postChangeNotification()
    {
        $input = Input::all();
        $user_id = Sentry::getUser()->id;

        //Check if user exist
        $user_exist = DB::table('users_profile_settings')->where(
            'user_id',
            $user_id
        )->first();
        if (empty($user_exist)) {
            DB::table('users_profile_settings')
                ->insert(
                    array(
                        'user_id' => $user_id,
                        'notification_status' => $input['notification']
                    )
                );
        } else {
            DB::table('users_profile_settings')
                ->where('user_id', $user_id)
                ->update(
                    array('notification_status' => $input['notification'])
                );
        }

        Flash::addSuccess('Notification updated successfully !!');
        return redirect()->route('profile_followback_profile');
    }

    public function uploadProfilePic(Request $request)
    {
        $rules = [
            'file' => 'required|mimes:jpeg,bmp,png'
        ];
        $this->validate($request, $rules);

        $file = $request->file('file');

        try {
            //upload file and get filepath
            $filePath = (new ServiceBid)->uploadFile($file);
            echo $filePath;
            exit;
        } catch (Exception $e) {
            return response(
                'Unexpected error. Try again.' . $e->getMessage(),
                400
            );
        }

        //        return response($validator->getErrors()->first(), 400);
    }
    // public function uploadAndSaveProfilePic() {

    //        $validator = new SocialBid\Services\Forms\Bid\CreateBidForm;
    //        if($validator->isValidUpload()){
    //            try{
    //                //upload file and get filepath
    //                $filePath = (new ServiceBid)->uploadFile(Input::all());

    //                $userId = Sentry::getUser()->id;
    //                $user = User::find($userId);
    //                $user->avatar = '/bids_images/'.$filePath;
    //                $user->save();
    //                echo $filePath; exit;
    //            }
    //            catch(Exception $e){
    //                return Request::jsonError('Unexpected error. Try again.'.+s($e));
    //            }
    //        }
    //        return Request::jsonError($validator->getErrors()->first());
    // }

    public function postUpdateProfilePic()
    {

        $input = Input::all();
        //$input['file'] = '/bids_images/'.$input['file_temp_name'];
        $input['file'] = $input['file_temp_name'];
        unset($input['file_temp_name']);

        DB::table('users')
            ->where('id', $input['id'])
            ->update(
                array(
                    'avatar' => $input['file']
                )
            );
        Flash::addSuccess('Image updated successfully !!');
        return redirect()->route('profile_followback_profile');
    }
    
	public function updateTwitter()
    {
        $input = Input::all();
        $value = $input['twitter'];
        DB::table('users_social_accounts')
            ->where('user_id', $input['id'])
            ->update(
                array(
                    'twitter' => $value
                )
            );
        Flash::addSuccess('Your profile has been updated.');
        return redirect()->route('profile_followback_profile');
    }
    public function updateFacebook()
    {
        $input = Input::all();
        $value = $input['facebook'];
        DB::table('users_social_accounts')
            ->where('user_id', $input['id'])
            ->update(
                array(
                    'facebook' => $value
                )
            );
        Flash::addSuccess('Your profile has been updated.');
        return redirect()->route('profile_followback_profile');
    }
    public function updateInstagram()
    {
        $input = Input::all();
        $value = $input['instagram'];
        DB::table('users_social_accounts')
            ->where('user_id', $input['id'])
            ->update(
                array(
                    'instagram' => $value
                )
            );
        Flash::addSuccess('Your profile has been updated.');
        return redirect()->route('profile_followback_profile');
    }
    public function updateLinkedin()
    {
        $input = Input::all();
        $value = $input['linkedin'];
        DB::table('users_social_accounts')
            ->where('user_id', $input['id'])
            ->update(
                array(
                    'linkedin' => $value
                )
            );
        Flash::addSuccess('Your profile has been updated.');
        return redirect()->route('profile_followback_profile');
    }
    public function updateGoogleplus()
    {
        $input = Input::all();
        $value = $input['googleplus'];
        DB::table('users_social_accounts')
            ->where('user_id', $input['id'])
            ->update(
                array(
                    'googleplus' => $value
                )
            );
        Flash::addSuccess('Your profile has been updated.');
        return redirect()->route('profile_followback_profile');
    }
    public function updateWeb()
    {
        $input = Input::all();
        $value = $input['web'];
        DB::table('users_social_accounts')
            ->where('user_id', $input['id'])
            ->update(
                array(
                    'web' => $value
                )
            );
        Flash::addSuccess('Your profile has been updated.');
        return redirect()->route('profile_followback_profile');
    }
    public function updateYoutube()
    {
        $input = Input::all();
        $value = $input['youtube'];
        DB::table('users_social_accounts')
            ->where('user_id', $input['id'])
            ->update(
                array(
                    'youtube' => $value
                )
            );
        Flash::addSuccess('Your profile has been updated.');
        return redirect()->route('profile_followback_profile');
    }
    public function updateSoundcloud()
    {
        $input = Input::all();
        $value = $input['soundcloud'];
        DB::table('users_social_accounts')
            ->where('user_id', $input['id'])
            ->update(
                array(
                    'soundcloud' => $value
                )
            );
        Flash::addSuccess('Your profile has been updated.');
        return redirect()->route('profile_followback_profile');
    }
    public function updateAbout()
    {
        $input = Input::all();
        $value = $input['about'];
        DB::table('users_social_accounts')
            ->where('user_id', $input['id'])
            ->update(
                array(
                    'about' => $value
                )
            );
        Flash::addSuccess('Your profile headline has been updated.');
        return redirect()->route('profile_followback_profile');
    }
     public function updateReach()
    {
        $input = Input::all();
        $value = $input['reach'];
        DB::table('users_social_accounts')
            ->where('user_id', $input['id'])
            ->update(
                array(
                    'reach' => $value
                )
            );
        Flash::addSuccess('Your reach information has been updated.');
        return redirect()->route('profile_followback_profile');
    }   
    
    
    
    
    
    
    
    
}