<?php
namespace Followback\Http\Controllers;

use Artdarek\OAuth\OAuth;
use Followback\ServiceBid;
use Followback\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Sentry;
use SocialBid\FlashService\Facade\Flash;
use SocialBid\Helpers\Facade\ServicesHelper;
use SocialBid\Mailers\BidMailer;
use SocialBid\Services\BidActionService;
use SocialBid\Services\Forms\Bid\CreateBidForm;
use SocialBid\Services\Payments\PayPal;
use SocialBid\Services\UserSearchByIdService;
use Followback\SocialAccount;

class BidController extends BaseController {

    public function __construct(
        CreateBidForm $createBidForm,
        PayPal $payPal,
        OAuth $oauth,
        UserSearchByIdService $search,
        BidMailer $mailer,
        BidActionService $bidAction
    ) {
        $this->createBidForm = $createBidForm;
        $this->payment = $payPal;
        $this->oauth = $oauth;
        $this->search = $search;
        $this->mailer = $mailer;
        $this->bidAction = $bidAction;
    }

    public function postCreate($username, $service = null, $identifier = null)
    {

        //If service is null then set it as "followback"
        if ($service == null) {
            $service = 'followback';
        }

        if (Session::has('searchIdentifier')) {
            Session::forget('searchIdentifier');
        }

        // for the search images.
        if (Session::has('searchImage')) {
            Session::forget('searchImage');
        }

        if (!isset($_POST['idf']) || empty($_POST['idf'])) {
            return redirect()->back()->with('message', 'Invalid identifier!');
        }

        $image = "";
        if (isset($_POST['img']) && !empty($_POST['img'])) {
            $image = $_POST['img'];
        }

        $identifier = $_POST['idf'];
        Session::put('searchIdentifier', $identifier);
        Session::put('searchImage', $image);

        // return redirect()->route('profile_connect');
        if ($service == 'followback') {
            return redirect()->to('/' . $username);
        }
        return $this->processCreate($username, $service, $identifier, $image);
    }

    //public function getCreate($service, $username, $identifier = null) {
    public function getCreate($username, $service = null, $identifier = null)
    {
        if ($service == null) {
            $service = 'followback';
        }

        if (session()->has('searchIdentifier')) {
            $identifier = Session::get('searchIdentifier');
        }

        $image = "";
        if (session()->has('searchImage')) {
            $image = Session::get('searchImage');
        } 

        // user has typed different
        /* if(!Session::has('searchUsername') || (Session::get('searchUsername') != $username)){
             $identifier = null;
         }*/

        //Get author info by identifier

        if (isset($_GET['idf'])) {
            $identifier = $_GET['idf'];
        }

        if (isset($_GET['img'])) {
            $image = $_GET['img'];
        }

        //If User is followback
        if ($service == 'followback') {
            $user = User::where('username', $username)->first();
            if(!isset($user)){
           		return response()->view('errors.404page', [], 404);
			 		//return view('errors.404page');
            }
                       
            $identifier = $user->id;
            $image = $user->avatar;            
        }
        return $this->processCreate($username, $service, $identifier);
    }

    /**
     * Receive Social Site link and Redirect to "GET" create function
     * @param  integer $username , $service and $identifier.
     * @return Redirect to "GET" create function
     */
    public function redirectFollowbackProfile(
        $username,
        $service = null,
        $identifier = null
    ) {

        if ($service == null) {

            $service = 'followback';
        }

        // for the search identifier.
        if (Session::has('searchIdentifier')) {
            Session::forget('searchIdentifier');
        }

        // for the search images.
        if (Session::has('searchImage')) {
            Session::forget('searchImage');
        }

        if (isset($_GET['idf'])) {
            $identifier = $_GET['idf'];
        }

        if (isset($_GET['img'])) {
            $image = $_GET['img'];
        }

        Session::put('searchIdentifier', $identifier);
        Session::put('searchImage', $image);
        return redirect()->to('/' . $username);

    }

    /**
     * Receive Social Site link and Redirect to "POST" create function
     * @param  integer $username , $service and $identifier.
     * @return Redirect to "POST" create function
     */
    public function redirectOtherSocialProfile(
        $username,
        $service = null,
        $identifier = null
    ) {
        //echo "hare"; exit;
        if ($service == null) {

            $service = 'followback';
        }

        // for the search identifier.
        if (Session::has('searchIdentifier')) {
            Session::forget('searchIdentifier');
        }

        // for the search images.
        if (Session::has('searchImage')) {
            Session::forget('searchImage');
        }

        if (isset($_GET['idf'])) {
            $identifier = $_GET['idf'];
        }

        if (isset($_GET['img'])) {
            $image = $_GET['img'];
        }

        Session::put('searchIdentifier', $identifier);
        Session::put('searchImage', $image);

        //return redirect()->to('/'.$username,$service);
        return redirect()->action(
            'BidController@postCreate',
            array($username, $service)
        );
    }

    /**
     * Get file type based on the extension
     *
     * @param $extension
     * @return bool|string
     */
    private function getFileType($ext)
    {
        $extension = trim(strtolower($ext));
        $img = array('jpg', 'jepg', 'png', 'gif');
        $vid = array('mp4', 'mov', 'mpg', 'flv', 'm4v');

        if (in_array($extension, $img)) {
            return 'image';
        } else {
            if (in_array($extension, $vid)) {
                return 'video';
            }
        }

        return false;
    }

    private function processCreate(
        $username,
        $service,
        $identifier,
        $userImage = ""
    ) {
        $result = array();

        $result = $this->getUserSearchById($service, $identifier, $username);

        $user_exists = DB::select(
            "select * from users_social_accounts where type='$service' and identifier = '$identifier'"
        );

        $is_account_sync = 0;
        //If user sync with any account..
        if (!empty($user_exists)) {
            $is_account_sync = 1;
        }

        $verfied = 0;

        $verified_results = DB::table('verified_users')
            ->where('type', $service)
            ->where('identifier', $identifier)
            ->first();
        if (!empty($verified_results)) {
            $verfied = 1;
        }

        //Check if user linked with any cherity
        $user_exist = DB::table('users_social_accounts')
            ->where('type', $service)
            ->where('identifier', $identifier)
            ->first();

        $charityInfo = array();
        if (!empty($user_exist)) {
            $user_id = $user_exist->user_id;

            //Get charity id related to search user
            $charity_id = DB::table('users_profile_settings')
                ->where('user_id', $user_id)
                ->pluck('charity_id');

            //Get charity logo name
            $charities = Config::get('concharities');
            foreach ($charities as $charity) {
                if ($charity['id'] == $charity_id) {
                    $charityInfo = $charity;
                    break;
                }
            }

        }

        //Check if cookies are set
        $profileFormCookies = array();
        if (Cookie::get('profile_form_cookie') != false) {
            $profileFormCookies = Cookie::get('profile_form_cookie');
        }

        //Set Profile Url
        //if(isset($result['valid']) && !$result['valid']){
        if (isset($result['valid']) && !$result['valid']) {
            $profile_url = '#';

            switch ($service) {
                case 'facebook':
                    $profile_url = 'https://facebook.com/' . $identifier;
                    break;
                case 'twitter':
                    $profile_url = 'https://twitter.com/account/redirect_by_id/' .
                        $identifier;
                    break;
                case 'instagram':
                    $profile_url = 'https://instagram.com/' . $username;
                    break;
                case 'vine':
                    $profile_url = 'http://vine.co/' . $username;
                    break;
                case 'youtube':
                    $profile_url = 'http://www.youtube.com/channel/' .
                        $identifier;
                    break;
            }

            // for the empty data.
            $result['data'] = array(
                'username' => $username,
                'identifier' => $identifier,
                'url' => $profile_url,
                'avatar' => str_replace('_bigger', '', $userImage)
            );
        }
        
        $userSocial = array();
        $userSocial = DB::table('users_social_accounts')->where(
            'user_id',
            $identifier
        )->first();
            

        $serviceTypes = ServicesHelper::getList();

        if (\Sentry::check()) {
            $bidsLeft = (new ServiceBid)->countLeftBidsForSocialAccount(
                $service,
                $identifier
            );
        }

        $userBidPrices = ServicesHelper::forBidCreate($service, $username);
        $fixedCount = ServicesHelper::countFixedPrices($userBidPrices);
        $types = ['bid' => 'Make a bid'];
        if ($fixedCount > 0) {
            $types['fixed'] = 'Fixed';
        }

        return view(
            'bid.create',
            compact(
                'userInfo',
                'serviceTypes',
                'service',
                'types',
                'bidCount',
                'userBidPrices',
                'bidsLeft',
                'result',
                'identifier',
                'verfied',
                'charityInfo',
                'is_account_sync',
                'profile_url',
                'username',
                'profileFormCookies',
                'charityInfo',
                'userSocial'
            )
        );

    }

    public function handleFileUpload()
    {

        $validator = new SocialBid\Services\Forms\Bid\CreateBidForm;
        if ($validator->isValidUpload()) {
            try {
                //upload file and get filepath
                $filePath = (new ServiceBid)->uploadFile(Input::all());
                //pull data from step1 and merge with filepath and save bid
                $input = Session::pull('bid.step1');
                $input['file'] = $filePath;
                $this->storeBid($input);
                return Response::jsonOk(['redirect' => URL::route('checkout')]);
            } catch (Exception $e) {
                return Response::jsonError(
                    'Unexpected error. Try again.' . +s($e)
                );
            }
        }
        return Response::jsonError($validator->getErrors()->first());
    }

    public function getUserSearchById($service, $identifier, $username)
    {

        try {
            $results = $this->search->search($service, $identifier, $username);
            return $results;

        } catch (BadResponseException $e) {
            Flash::addError('Unpexpected error occured. Try again.');
            return redirect()->route('profile_connect');
        }
    }

    public function getUpload()
    {
        return view('bid.upload');
    }

    protected function storeBid($input)
    {

        $bid = (new ServiceBid)->fill($input);
        $bid->bidder_id = Sentry::getUser()->id;
        Session::set('bid.store', $bid);
    }

    public function myBids()
    {
        $title = 'Sent Bids';
        $orderBy = Input::get('order_by') == 'amount' ? 'offer_price' :
            'updated_at';

        $bids = ServiceBid::forCurrentUser()->orderBy($orderBy, 'desc')->get();
        return view(
            'bid.list',
            compact('bids', 'title', 'orderBy')
        );
    }

    public function getBidsForMe()
    {
        $title = 'Received';
        $orderBy = Input::get('order_by') == 'amount' ? 'offer_price' :
            'updated_at';

        $bids = array();
        $has_social_account = DB::table('users_social_accounts')->where(
            'user_id',
            Sentry::getUser()->id
        )->first();

        //If user sync to any social accout only the  find bid for him
        if (!empty($has_social_account)) {
            $bids = Sentry::getUser()->findBidsForMe($orderBy);
        }

        //Check if sender of any bid is deleted by admin then unset that bid
        foreach ($bids as $key => $value) {

            $user = User::find($bids[$key]['bidder_id']);
            if (empty($user)) {
                unset($bids[$key]);
            }
        }
        return view('bid.bidsForMe')->with(compact('bids', 'title', 'orderBy'));
    }

    /**
     * Handles setting bid as completed
     *
     * @return Redirect
     */
    public function getAllBids()
    {
        $title = 'Social tasks';
        $orderBy = Input::get('order_by') == 'amount' ? 'offer_price' :
            'updated_at';

        $bids = array();
        $has_social_account = DB::table('users_social_accounts')->where(
            'user_id',
            Sentry::getUser()->id
        )->first();

        //If user sync to any social accout only the  find bid for him
        if (!empty($has_social_account)) {
            $bids = Sentry::getUser()->findBidsForMe($orderBy);
        }

        $aggregatedBids = [];
        //Manage Sent Bid For current user
        $sent_bids = ServiceBid::forCurrentUser()->get();
        $total_sent_bids = 0.0;
        foreach ($sent_bids as $sent_bid) {
            //$number = floatval(str_replace(',', '.', str_replace('.', '', $sent_bid->offer_price)));
            $number = floatval(str_replace(',', '', $sent_bid->offer_price));
            $total_sent_bids = $total_sent_bids + $number;
        }
        $aggregatedBids['sent_bids'] = $total_sent_bids;

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
        $aggregatedBids['receive_bids'] = $total_receive_bids;
        $aggregatedBids['accepted_bids'] = $total_accept_bids;

        return view(
            'bid.list',
            compact('bids', 'title', 'orderBy', 'aggregatedBids')
        );

        //Check if sender of any bid is deleted by admin then unset that bid
        foreach ($bids as $key => $value) {

            $user = User::find($bids[$key]['bidder_id']);
            if (empty($user)) {
                unset($bids[$key]);
            }
        }
        return view('bid.bidsForMe')->with(compact('bids', 'title', 'orderBy'));
    }

    /**
     * handles setting bid as completed
     * @param  integer $id bid id
     * @return Redirect
     */

    public function getSetAsCompleted($id)
    {
        $bid = Sentry::getUser()->findBidForMeById($id);
        if (!$bid) {
            Flash::addError('Bid not found.');
        } elseif ($bid->status !== ServiceBid::STATUS_ACCEPTED) {
            Flash::addError(
                'Bid can\'t be set as completed as it was not accepted'
            );
        } else {
            $bid->status = ServiceBid::STATUS_COMPLETED;
            $bid->save();
            Event::fire('bid.completed', $bid);
            Flash::addSuccess('Bid set as completed.');
        }
        return redirect()->route('bids_for_me');
    }

    public function getBlockBids($userId)
    {
        $blockedUser = Sentry::getUser()->blockedUsers()->where(
            'target_id',
            $userId
        )->first();
        if (!$blockedUser) {
            Sentry::getUser()->blockedUsers()->attach(['target_id' => $userId]);
        }
        Flash::addSuccess('User successfully added to block list.');
        if (\Request::ajax()) {
            return \Response::json(
                ['success' => true, 'redirect' => 'received'],
                200
            );
        }

        return redirect()->route('bids_for_me');
    }

    public function getUnblockBids($userId)
    {
        $blockedUser = Sentry::getUser()->blockedUsers()->where(
            'target_id',
            $userId
        )->first();
        if ($blockedUser) {
            Sentry::getUser()->blockedUsers()->detach($blockedUser);
        }
        Flash::addSuccess('User successfully unblocked.');
        return redirect()->route('blocked_users');
    }

    public function getAccepted()
    {
        return view('bid.accepted');
    }

    /**
     * handles cancelling a bid
     * @param  integer $id bid id
     * @return Redirect
     */
    public function getCancel($id)
    {

        $bid = Sentry::getUser()->findMyBidById($id);
        if ($bid and $bid->bid_type == 'bid') {

            //if bid status is new then we will void authorization for order payment and fire events etc.
            if ($bid->status == ServiceBid::STATUS_NEW) {
                $order = $bid->orders()->authorized()->first();
                $response = $this->payment->voidAuthorizationForOrder($order);
                if ($response->isValidResponse() and
                    $response->getResponse()->state === 'voided'
                ) {
                    Event::fire('order.voided', $order);
                    Event::fire('bid.cancelled', $bid);
                    Flash::addSuccess('Your bid was cancelled.');
                } else {
                    Flash::addError('Something went wrong. Try again later.');
                }
            } else {
                Flash::addError(
                    'This bid has been already accepted or declined. You can\'t cancel it'
                );
            }
        } else {
            Flash::addError('Bid not found.');
        }
        if (\Request::ajax()) {
            return \Response::json(
                ['success' => true, 'redirect' => 'sent'],
                200
            );
        }

        return Redirect::route('bid_list');
    }

    public function getTaskNotCompleted($id)
    {

        $bid = Sentry::getUser()->findMyBidById($id);
        if ($bid and $bid->bid_type == 'bid') {

            if (in_array(
                $bid->status,
                [
                    ServiceBid::STATUS_ACCEPTED,
                    ServiceBid::STATUS_COUNTERBID_ACCEPTED
                ]
            )) {

                DB::table('service_offer')
                    ->where('id', $bid->id)
                    ->update(
                        array(
                            'is_task_complete' => 0
                        )
                    );

                //Send Success mail to Receiver
                $socialAccount = SocialAccount::with('user', 'user.settings')
                    ->byTypeAndId($bid->service, $bid->identifier)
                    ->first();
                $this->mailer->taskNotCompleted(
                    $socialAccount->user,
                    $bid,
                    Sentry::getUser()
                );

                //Send Warning mail to Receiver
                /*
                  if(isset($socialAccount->user)) {
                    $this->mailer->warningOfBannAccount($bid, Sentry::getUser(), $socialAccount->user);
                	}
                */

                Flash::addSuccess(
                    'Thank you for notifying us about your Task not being completed! Here at Followback we guarantee all task be done for 30 days. We will be looking into your complaint and if it can not be resolved a refund will be issue back to your account.
                    Thank you!'
                );

            } else {
                Flash::addError(
                    'This bid has not been accepted. You can\'t say Task Not Completed.'
                );
            }
        } else {
            Flash::addError('Bid not found.');
        }
        if (\Request::ajax()) {
            return \Response::json(
                ['success' => true, 'redirect' => 'sent'],
                200
            );
        }
        return redirect()->route('bid_list');
    }

    /**
     * handles Task Completed
     * @param  integer $id bid id
     * @return Redirect
     */
    public function getTaskCompleted($id)
    {

        $bid = Sentry::getUser()->findBidForMeById($id);

        if ($bid and $bid->bid_type == 'bid') {

            if (in_array(
                $bid->status,
                [
                    ServiceBid::STATUS_ACCEPTED,
                    ServiceBid::STATUS_COUNTERBID_ACCEPTED
                ]
            )) {

                DB::table('service_offer')
                    ->where('id', $bid->id)
                    ->update(
                        array(
                            'is_task_complete_by_receiver' => 0
                        )
                    );

                //Send Success mail to Sender
                //$this->mailer->taskNotCompleted($bid, Sentry::getUser());

                //Send Warning mail to Receiver
                // $socialAccount = SocialAccount::with('user','user.settings')->byTypeAndId($bid->service, $bid->identifier)->first();
                // if(isset($socialAccount->user)) {
                //     $this->mailer->warningOfBannAccount($bid, Sentry::getUser(), $socialAccount->user);
                // }

                Flash::addSuccess('You have marked that Task is Completed!');

            } else {
                Flash::addError(
                    'This bid has not been accepted. You can\'t say Task Completed.'
                );
            }
        } else {
            Flash::addError('Bid not found.');
        }
        if (\Request::ajax()) {
            return \Response::json(
                ['success' => true, 'redirect' => 'received'],
                200
            );
        }
        return redirect()->route('bids_for_me');
    }

    /**
     * handles accepting a bid
     * @param  integer $id bid id
     * @return Redirect
     */
    public function getAcceptBidForMe($id)
    {
        $bid = Sentry::getUser()->findBidForMeById($id);

        if ($bid and $bid->bid_type == 'bid') {

            //if bid type is bid then we will try to capture the authorization of payment
            //$order = $bid->orders()->first();
            $order = $bid->orders()->orderBy('id', 'desc')->first();
            if ($order) {
                try {
                    //try to capture a payment and if everything went fine then we send an email and stuff

                    // first fulfil the service.
                    //$this->bidAction->fulfilService($bid, Sentry::getUser()->id);
                    //$this->bidAction->fulfilService($bid);

                    // then payment.
                    $this->payment->capturePayment($order);

                    if ($this->payment->isValidResponse()) {
                        if ($this->payment->getResponse()->getState() ==
                            'completed'
                        ) {
                            $order->status = 'completed';
                            $order->save();
                            Event::fire('order.finished', $order);
                            Event::fire('bid.approved', $bid);
                            if (\Request::ajax()) {
                                return \Response::json(
                                    [
                                        'success' => true,
                                        'redirect' => 'bid-accepted'
                                    ],
                                    200
                                );
                            }
                            return redirect()->route('bid_accepted');
                        } else {
                            Flash::addError(
                                'Payment authorization for this bid is pending. Try to accept this bid later.'
                            );
                        }
                    } else {
                        Flash::addError(
                            'Something went wrong. Try again later.'
                        );
                    }
                } catch (\Exception $e) {
                    Flash::addError($e->getMessage());
                }
            } else {
                Flash::addError('Order not found for this bid. Bid cancelled.');
            }
        } else {
            Flash::addError('Bid not found.');
        }

        Event::fire('bid.accepted', $bid);
        if (\Request::ajax()) {
            return \Response::json(
                ['success' => true, 'redirect' => 'received'],
                200
            );
        }
        return redirect()->route('bids_for_me');
    }

    /**
     * handles denying a bid
     * @param  integer $id bid id
     * @return Redirect
     */
    public function getDenyBidForMe($id)
    {
        //in_array($bid->status,[ServiceBid::STATUS_NEW, ServiceBid::STATUS_COUNTERED_BY_CREATOR])
        $bid = Sentry::getUser()->findBidForMeById($id);
        //if($bid and $bid->status == ServiceBid::STATUS_NEW){
        if ($bid and in_array(
                $bid->status,
                [
                    ServiceBid::STATUS_NEW,
                    ServiceBid::STATUS_COUNTERED_BY_CREATOR,
                    ServiceBid::STATUS_COUNTERED_BY_RECEIVER
                ]
            )
        ) {
            //try to void an authorization for order bound to this bid
            $order = $bid->orders()->authorized()->first();
            $response = $this->payment->voidAuthorizationForOrder($order);
            if ($response->isValidResponse() and
                $response->getResponse()->state === 'voided'
            ) {
                Event::fire('order.voided', $order);
                Event::fire('bid.rejected', $bid);
                Flash::addSuccess('Bid denied.');
            } else {
                Flash::addError('Something went wrong. Try again later.');
            }
        } else {
            Flash::addError('Bid not found.');
        }
        if (\Request::ajax()) {
            return \Response::json(
                ['success' => true, 'redirect' => 'received'],
                200
            );
        }

        return redirect()->route('bids_for_me');
    }

    public function getHideBidForMe($id)
    {

        if (Request::ajax()) {
            DB::table('service_offer')
                ->where('id', $id)
                ->update(
                    array(
                        'is_hide' => 0
                    )
                );
            Flash::addSuccess('Bid has been deleted successfully !!');
            return Response::json(
                ['success' => true, 'redirect' => 'received'],
                200
            );
        }
        DB::table('service_offer')
            ->where('id', $id)
            ->update(
                array(
                    'is_hide' => 0
                )
            );
        Flash::addSuccess('Bid has been removed successfully !!');
        return redirect()->route('bids_for_me');
    }

    public function getHideBidForSender($id)
    {

        DB::table('service_offer')
            ->where('id', $id)
            ->update(
                array(
                    'is_hide_sender' => 0
                )
            );
        Flash::addSuccess('Bid has been removed successfully !!');
        if (Request::ajax()) {
            return Response::json(
                ['success' => true, 'redirect' => 'sent'],
                200
            );
        }
        return redirect()->route('bid_list');
    }

    /**
     * Handles first step of bid creation
     *
     * @return $this|\Illuminate\Http\RedirectResponse [type] [description]
     */
    public function postMake()
    {

        $input = Input::all();

        //INSTRUCTIONS

        //follow_back
        if ($input['service_type'] == "follow_back") {
            $input['comment'] = '(1) The name of the website or app to Follow on: ' .
                $input['temp-comment'] . ' (2) The username to ' .
                ucfirst($input['service']) . ': ' . $input['comment'] . '';
        } else {
            if ($input['service_type'] == "like") {
                $input['comment'] = 'The link to Like: ' . $input['comment'];
            } else {
                if ($input['service_type'] == "post_media") {
                    $input['comment'] = '(1) The name of the website or app to post the media on: ' .
                        $input['temp-comment'] .
                        ' (2) The desired text to include with the post: ' .
                        $input['comment'] . '';

                } else {
                    if ($input['service_type'] == "post_text") {
                        $input['comment'] = '(1) The name of the website or app to post the text on: ' .
                            $input['temp-comment'] .
                            ' (2) The desired text to include with the post: ' .
                            $input['comment'] . '';

                    } else {
                        if ($input['service_type'] == "comment") {
                            $input['comment'] = '(1) The URL of the public post to comment on: ' .
                                $input['temp-comment'] .
                                ' (2) The desired comment to include: ' .
                                $input['comment'] . '';

                        } else {
                            if ($input['service_type'] == "others") {
                                $input['comment'] = '' . $input['comment'] . '';

                            }
                        }
                    }
                }
            }
        }

        if (isset($input['temp-comment'])) {

            //$input['comment'] = $input['temp-comment'].' '.$input['comment'];
            //$input['comment'] = $input['service_type'].' '.$input['username'].' '.ucfirst($input['service']).' '.$input['comment'].' for $'.str_replace(',','', $input['offer_price']).' on '.$input['temp-comment'];
            unset($input['temp-comment']);
        }

        if (isset($input['followed_identifier']) &&
            isset($input['followed_type']) && isset($input['follow_user_name'])
        ) {

            $encoded_ouput = array(
                'identifier' => $input['followed_identifier'],
                'type' => $input['followed_type'],
                'username' => $input['follow_user_name'],
                'avatar' => $input['followed_avatar']
            );
            $input['other_information'] = json_encode($encoded_ouput);
            unset($input['followed_identifier']);
            unset($input['followed_type']);
            unset($input['follow_user_name']);
            unset($input['followed_avatar']);
        }

        //Get image path from  temp variable and store in other variable
        $input['file'] = (isset($input['file_temp_name'])) ?
            $input['file_temp_name'] : '';
        unset($input['file_temp_name']);

        if (isset($input['file_temp_zencodeid']) &&
            !empty($input['file_temp_zencodeid'])
        ) {

            $input['zencoder_id'] = $input['file_temp_zencodeid'];
            unset($input['file_temp_zencodeid']);

        }

        //temp field used for login popup
        unset($input['is_login']);
        //Check if user is sending a bid to himself

        $service = $input['service'];
        $identifier = $input['identifier'];

        $user_exists = DB::select(
            "select * from users_social_accounts where type='$service' and identifier = '$identifier'"
        );
        $verfied = 0;
        if (isset($user_exists[0]->identifier) &&
            isset($user_exists[0]->type)
        ) {
            $user_id = $user_exists[0]->user_id;
        }

        //Check if user is sending bod to himself
        if (isset($user_id) && !empty($user_id)) {

            if (Sentry::getUser()->id == $user_id) {
                Flash::addSuccess('You can not send a bid to youself.');
                return redirect()->back();
            }
        }

        //remove commas from offer_price input to  prevent errors when saving bid
        $input['offer_price'] = str_replace(',', '', $input['offer_price']);

        if ($this->createBidForm->isValid($input)) {

            //check if selected bid type should allow uploading a file, if yes then we will save this form data in session then retrieve it later
            //otherwise we will just store the bid with current input

            /*if(ServicesHelper::isUploadable($input['service'], $input['service_type'])){
                Session::set('bid.step1', $input);
                Session::flash('bid.step2', true);
                return redirect()->route('bid_upload', [$input['service'], $input['identifier'], $input['username']]);
            }
            else{
                $this->storeBid($input);
                return redirect()->route('checkout');
            }*/

            $this->storeBid($input);
            return redirect()->route('checkout');
        }
        return redirect()->back()->withInput()->withErrors(
            $this->createBidForm->getErrors()
        );
    }

    /**
     * handles eventual second step of bid creation which is upload of image/video
     * @return Response\JSON
     */
    public function postBidUpload()
    {
        $file = Input::file('file');

        $validator = Validator::make(
            array('file' => $file),
            array(
                'file' => array(
                    'required'
                )
            )
        );

        if (!$validator->fails()) {

            try {

                $extension = $file->getClientOriginalExtension();

                $fileType = $this->getFileType($extension);

                if ($fileType === 'image') {

                    $filePath = (new ServiceBid)->uploadFile(Input::all());
                    echo $filePath;

                } elseif ($fileType === 'video') {

                    $encodedFile = (new ServiceBid)->zendcodeFile($file);
                    //object: id, label, url

                    echo $encodedFile->url . '--id--' . $encodedFile->id;

                    //echo new JsonResponse($encodedFile);

                } else {
                    // mobile uploads

                    $encodedFile = (new ServiceBid)->zendcodeFile($file);
                    //object: id, label, url

                    echo $encodedFile->url . '--id--' . $encodedFile->id;

                }

                exit;

            } catch (Exception $e) {
                //return Response::jsonError('Unexpected error. Try again.');
                echo new JsonResponse('Unexpected error. Try again.');
                die;
            }
        } else {
            //return Response::jsonError($validator->getErrors()->first());
            echo new JsonResponse($validator->getErrors()->first());
            die;
        }

    }

    public function getInstructions(Request $request)
    {

        //Call different view according to input (20 views)
        $input = $request->input();
        $username = $input['username'];
        $html = '';

        //For Instagram
        if ($input['service'] == 'instagram' &&
            $input['serviceType'] == 'follow_back'
        ) {
            $html = view(
                'bid.instructions.instagram.instagramFollowback',
                compact('username')
            )->render();
        } else {
            if ($input['service'] == 'instagram' &&
                $input['serviceType'] == 'like'
            ) {
                $html = view(
                    'bid.instructions.instagram.instagramLike',
                    compact('username')
                )->render();
            } else {
                if ($input['service'] == 'instagram' &&
                    $input['serviceType'] == 'post'
                ) {
                    $html = view(
                        'bid.instructions.instagram.instagramPost',
                        compact('username')
                    )->render();
                }
                // else if($input['service'] == 'instagram' && $input['serviceType'] == 'comment') {
                //     $html = view('bid.instructions.instagram.instagramComment', compact('username'))->render();
                // }
                else {
                    if ($input['service'] == 'instagram' &&
                        $input['serviceType'] == 'comment'
                    ) {
                        $html = view(
                            'bid.instructions.instagram.instagramComment',
                            compact('username')
                        )->render();
                    } else {
                        if ($input['service'] == 'instagram' &&
                            $input['serviceType'] == 'repost'
                        ) {
                            $html = view(
                                'bid.instructions.instagram.instagramRepost',
                                compact('username')
                            )->render();
                        } //For Twitter
                        else {
                            if ($input['service'] == 'twitter' &&
                                $input['serviceType'] == 'follow_back'
                            ) {
                                $html = view(
                                    'bid.instructions.twitter.twitterFollowback',
                                    compact('username')
                                )->render();
                            } else {
                                if ($input['service'] == 'twitter' &&
                                    $input['serviceType'] == 'favorite'
                                ) {
                                    $html = view(
                                        'bid.instructions.twitter.twitterFavourite',
                                        compact('username')
                                    )->render();
                                } else {
                                    if ($input['service'] == 'twitter' &&
                                        $input['serviceType'] == 'tweet'
                                    ) {
                                        $html = view(
                                            'bid.instructions.twitter.twitterTweet',
                                            compact('username')
                                        )->render();
                                    } else {
                                        if ($input['service'] == 'twitter' &&
                                            $input['serviceType'] == 'retweet'
                                        ) {
                                            $html = view(
                                                'bid.instructions.twitter.twitterRetweet',
                                                compact('username')
                                            )->render();
                                        } else {
                                            if ($input['service'] ==
                                                'twitter' &&
                                                $input['serviceType'] == 'reply'
                                            ) {
                                                $html = view(
                                                    'bid.instructions.twitter.twitterReply',
                                                    compact('username')
                                                )->render();
                                            } else {
                                                if ($input['service'] ==
                                                    'twitter' &&
                                                    $input['serviceType'] ==
                                                    'post_media'
                                                ) {
                                                    $html = view(
                                                        'bid.instructions.twitter.twitterPost',
                                                        compact('username')
                                                    )->render();
                                                } //For Youtube
                                                else {
                                                    if ($input['service'] ==
                                                        'youtube' &&
                                                        $input['serviceType'] ==
                                                        'like'
                                                    ) {
                                                        $html = view(
                                                            'bid.instructions.youtube.youtubeLike',
                                                            compact('username')
                                                        )->render();
                                                    } else {
                                                        if ($input['service'] ==
                                                            'youtube' &&
                                                            $input['serviceType'] ==
                                                            'post'
                                                        ) {
                                                            $html = view(
                                                                'bid.instructions.youtube.youtubePost',
                                                                compact(
                                                                    'username'
                                                                )
                                                            )->render();
                                                        } else {
                                                            if ($input['service'] ==
                                                                'youtube' &&
                                                                $input['serviceType'] ==
                                                                'comment'
                                                            ) {
                                                                $html = view(
                                                                    'bid.instructions.youtube.youtubeComment',
                                                                    compact(
                                                                        'username'
                                                                    )
                                                                )->render();
                                                            } //For Vine
                                                            else {
                                                                if ($input['service'] ==
                                                                    'vine' &&
                                                                    $input['serviceType'] ==
                                                                    'follow_back'
                                                                ) {
                                                                    $html = view(
                                                                        'bid.instructions.vine.vineFollowback',
                                                                        compact(
                                                                            'username'
                                                                        )
                                                                    )->render();
                                                                } else {
                                                                    if ($input['service'] ==
                                                                        'vine' &&
                                                                        $input['serviceType'] ==
                                                                        'like'
                                                                    ) {
                                                                        $html = view(
                                                                            'bid.instructions.vine.vineLike',
                                                                            compact(
                                                                                'username'
                                                                            )
                                                                        )->render(
                                                                        );
                                                                    } else {
                                                                        if ($input['service'] ==
                                                                            'vine' &&
                                                                            $input['serviceType'] ==
                                                                            'post'
                                                                        ) {
                                                                            $html = view(
                                                                                'bid.instructions.vine.vinePost',
                                                                                compact(
                                                                                    'username'
                                                                                )
                                                                            )->render(
                                                                            );
                                                                        } else {
                                                                            if ($input['service'] ==
                                                                                'vine' &&
                                                                                $input['serviceType'] ==
                                                                                'comment'
                                                                            ) {
                                                                                $html = view(
                                                                                    'bid.instructions.vine.vineComment',
                                                                                    compact(
                                                                                        'username'
                                                                                    )
                                                                                )->render(
                                                                                );
                                                                            } //For Facebook
                                                                            else {
                                                                                if ($input['service'] ==
                                                                                    'facebook' &&
                                                                                    $input['serviceType'] ==
                                                                                    'like'
                                                                                ) {
                                                                                    $html = view(
                                                                                        'bid.instructions.facebook.facebookLike',
                                                                                        compact(
                                                                                            'username'
                                                                                        )
                                                                                    )->render(
                                                                                    );
                                                                                } else {
                                                                                    if ($input['service'] ==
                                                                                        'facebook' &&
                                                                                        $input['serviceType'] ==
                                                                                        'post'
                                                                                    ) {
                                                                                        $html = view(
                                                                                            'bid.instructions.facebook.facebookPost',
                                                                                            compact(
                                                                                                'username'
                                                                                            )
                                                                                        )->render(
                                                                                        );
                                                                                    } else {
                                                                                        if ($input['service'] ==
                                                                                            'facebook' &&
                                                                                            $input['serviceType'] ==
                                                                                            'share'
                                                                                        ) {
                                                                                            $html = view(
                                                                                                'bid.instructions.facebook.facebookShare',
                                                                                                compact(
                                                                                                    'username'
                                                                                                )
                                                                                            )->render(
                                                                                            );
                                                                                        } //For Followback
                                                                                        else {
                                                                                            if ($input['service'] ==
                                                                                                'followback' &&
                                                                                                $input['serviceType'] ==
                                                                                                'follow_back'
                                                                                            ) {
                                                                                                $html = view(
                                                                                                    'bid.instructions.followback.followbackFollowback',
                                                                                                    compact(
                                                                                                        'username'
                                                                                                    )
                                                                                                )->render(
                                                                                                );
                                                                                            } else {
                                                                                                if ($input['service'] ==
                                                                                                    'followback' &&
                                                                                                    $input['serviceType'] ==
                                                                                                    'like'
                                                                                                ) {
                                                                                                    $html = view(
                                                                                                        'bid.instructions.followback.followbackLike',
                                                                                                        compact(
                                                                                                            'username'
                                                                                                        )
                                                                                                    )->render(
                                                                                                    );
                                                                                                } else {
                                                                                                    if ($input['service'] ==
                                                                                                        'followback' &&
                                                                                                        $input['serviceType'] ==
                                                                                                        'post_media'
                                                                                                    ) {
                                                                                                        $html = view(
                                                                                                            'bid.instructions.followback.followbackPostMedia',
                                                                                                            compact(
                                                                                                                'username'
                                                                                                            )
                                                                                                        )->render(
                                                                                                        );
                                                                                                    } else {
                                                                                                        if ($input['service'] ==
                                                                                                            'followback' &&
                                                                                                            $input['serviceType'] ==
                                                                                                            'others'
                                                                                                        ) {
                                                                                                            $html = view(
                                                                                                                'bid.instructions.followback.followbackOthers',
                                                                                                                compact(
                                                                                                                    'username'
                                                                                                                )
                                                                                                            )->render(
                                                                                                            );
                                                                                                        } else {
                                                                                                            if ($input['service'] ==
                                                                                                                'followback' &&
                                                                                                                $input['serviceType'] ==
                                                                                                                'post_text'
                                                                                                            ) {
                                                                                                                $html = view(
                                                                                                                    'bid.instructions.followback.followbackPost',
                                                                                                                    compact(
                                                                                                                        'username'
                                                                                                                    )
                                                                                                                )->render(
                                                                                                                );
                                                                                                            } else {
                                                                                                                if ($input['service'] ==
                                                                                                                    'followback' &&
                                                                                                                    $input['serviceType'] ==
                                                                                                                    'comment'
                                                                                                                ) {
                                                                                                                    $html = view(
                                                                                                                        'bid.instructions.followback.followbackComment',
                                                                                                                        compact(
                                                                                                                            'username'
                                                                                                                        )
                                                                                                                    )->render(
                                                                                                                    );
                                                                                                                }
                                                                                                            }
                                                                                                        }
                                                                                                    }
                                                                                                }
                                                                                            }
                                                                                        }
                                                                                    }
                                                                                }
                                                                            }
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        echo $html;
        exit;
    }

    public function getEncodeStatus()
    {
        $jobId = Input::get('jobId');

        $status = App::make('SocialBid\FileUpload\Zencoder')
            ->encodeStatus($jobId);

        var_dump($status);
        die;
    }
}
