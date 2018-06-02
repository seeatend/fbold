<?php
namespace Followback\Http\Controllers;

use Followback\SocialAccount;
use Followback\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use SocialBid\FlashService\Facade\Flash;
use SocialBid\Mailers\AuthMailer;
use Sentry;

class UserController extends BaseController {

    public function getBlockedUsers()
    {
        $title = 'Blocked Users';
        $blockedUsers = Sentry::getUser()->blockedUsers()->get();
        //   return view('profile.block-users')->with(compact('blockedUsers','title'));
        return redirect()->route('profile_followback_profile')->with(
            compact('blockedUsers', 'title')
        );
    }

    public function view_all_users()
    {
        return view('view_all_users.index');
    }

    public function getSorted($category = NULL)
    {
        if ($category) {
            $users = DB::table('users')->where('category', $category)->orderBy(
                'username',
                'ASC'
            )->get();
        } else {
            $users = DB::table('users')->orderBy(
                'username',
                'ASC'
            )->paginate(20);
        }
        

		$empty = [];
		
		if(!$users){
            Flash::addSuccess('This tag does not have any results.');
            return redirect()->route('index');
    	} else {
            return view('sort.index')->with('users', $users);
        }
    }

    public function getSortedCategory($type){
        $sorting_category = [
            'musician','radio','tv','dj','model','athlete'
        ];

        if($type == "video"){
            unset($sorting_category[2]);
            unset($sorting_category[3]);
        }elseif ($type == "health"){
            unset($sorting_category[1]);
            unset($sorting_category[4]);
        }

        if ($sorting_category) {
            $users = DB::table('users')->whereIn('category', $sorting_category)->orderBy(
                'username',
                'ASC'
            )->get();
        } else {
            $users = DB::table('users')->orderBy(
                'username',
                'ASC'
            )->paginate(20);
        }


        $empty = [];

        if(!$users){
            Flash::addSuccess('This tag does not have any results.');
            return redirect()->route('index');
        } else {
            return view('sort.index')->with('users', $users)->with('title',$type);
        }

    }

    public function getFollowers($followers)
    {
        $users = DB::table('users_social_accounts')
        	->join('users', 'users.id', '=', 'users_social_accounts.user_id')
        	->where('users_social_accounts.reach', $followers)->orderBy(
            'users_social_accounts.username',
            'ASC'
        )->get();

		$empty = [];
		
		if(!$users){
         Flash::addSuccess('This # does not have any results.');
         return redirect()->route('index');
    	} else {
        return view('followers.index')->with('users', $users);
      }
    }
    public function doChangeName() {
        $user = User::find((int) Input::get('userId'));
        $user->name = Input::get('name');
        $user->save();
        Flash::addSuccess(
            "Your name was successfully updated."
        );
        return redirect()->route('profile_followback_profile');
    }

    public function doChangeEmail()
    {

        $input = Input::all();
        $user_exist = User::find($input['userId']);
        //find by email address
        $email_exists = User::where('email', $input['email'])->first();

        if (!empty($user_exist) && $input['email'] == $user_exist['email'] &&
            $input['email'] == ""
        ) {
            //if($input['email'] == $user_exist['email']) { echo "if"; exit;
            Flash::addSuccess('You did not change your Email!');
            //}
        } else {
            if (!filter_var($input['email'], FILTER_VALIDATE_EMAIL)) {
                Flash::addSuccess('Invalid email format.');
            } else {
                if ($input['email'] == "") {
                    Flash::addSuccess('Email cannot be blank!');
                } else {
                    if (!empty($email_exists)) {
                        Flash::addSuccess('Email is already being used!');
                    } else {
                        DB::table('users')
                            ->where('id', $input['userId'])
                            ->update(
                                array(
                                    'email' => $input['email'],
                                    'email_verified' => 0
                                )
                            );

                        //Update email with new email, Becouse we need to send mail into new email address.
                        $user = Sentry::getUser();
                        $user->email = $input['email'];

                        //Resend Email Confirmation Notification
                        $mailer = new AuthMailer();
                        $mailer->confirmEmail($user);

                        Flash::addSuccess(
                            'Email Updated successfully. Please check your email and verify.'
                        );
                        $this->destroySession();

                    }
                }
            }
        }
        return redirect()->route('profile_followback_profile');
    }

    public function doChangePaypal()
    {

        $input = Input::all();
        $user_exist = User::find($input['userId']);
        //find by email address
        $email_exists = User::where('paypal_email', $input['paypal'])->first();

        if (!empty($user_exist) && $input['paypal'] == $user_exist['paypal_email'] &&
            $input['email'] == ""
        ) {
            //if($input['email'] == $user_exist['email']) { echo "if"; exit;
            Flash::addSuccess('You did not change your Paypal Email!');
            //}
        } else {
            if (!filter_var($input['paypal'], FILTER_VALIDATE_EMAIL)) {
                Flash::addSuccess('Invalid email format.');
            } else {
                if ($input['paypal'] == "") {
                    Flash::addSuccess('Email cannot be blank!');
                } else {
                    if (!empty($email_exists)) {
                        Flash::addSuccess('Email is already being used!');
                    } else {
                        DB::table('users')
                            ->where('id', $input['userId'])
                            ->update(
                                array(
                                    'paypal_email' => $input['paypal'],
                                )
                            );

                        Flash::addSuccess(
                            'Paypal Email Updated successfully.'
                        );
                    }
                }
            }
        }
        return redirect()->route('profile_followback_profile');
    }

    public function doResendConfirmationMail()
    {

        //Update Email verfified status
        DB::table('users')
            ->where('id', Sentry::getUser()->id)
            ->update(
                array(
                    'email_verified' => 0
                )
            );

        //Resend Email Confirmation Notification
        $mailer = new AuthMailer();
        $mailer->confirmEmail(Sentry::getUser());
        Flash::addSuccess('Confirmation Mail has been sent successfully !!');
        return redirect()->route('profile_followback_profile');
    }

    public function doChangeUsername()
    {
        $input = Input::all();
        $user_exist = User::find($input['userId']);
        $username_exists = User::where('username', $input['username'])->first();

        if (!empty($user_exist)) {

            if ($input['username'] == $user_exist['username']) {

                Flash::addSuccess('You did not change your Username!');		

            } else {
            
            	if (!empty($username_exists)) {
                	
                	Flash::addSuccess('Username is already being used!');
					
					} else {
					
               	DB::table('users')
								->where('id', $input['userId'])
								->update(
									 array(
										  'username' => $input['username']
									 )
								);
						 DB::table('users_social_accounts')
								->where('user_id', $input['userId'])
								->where('type', 'followback')
								->update(
									 array(
										  'username' => $input['username']
									 )
						 );
						 
						  Flash::addSuccess('Username Updated successfully !!');
						}
            }
        }
        return redirect()->route('profile_followback_profile');
    }

    public function getSyncAccount($service, $identifier)
    {
        $res = $services = array();
        // get all of the sync account.
        $userId = (new SocialAccount)->where('type', $service)->where(
            'identifier',
            $identifier
        )->pluck('user_id');
        $followbackUsername = DB::table('users')->where('id', $userId)->pluck(
            'username'
        );

        if ($userId > 0 && !((new User)->hasBlockedUser($userId))) {
            $socialAccounts = (new SocialAccount)->where('user_id', $userId)
                ->select('username', 'type', 'is_connected', 'identifier')->get(
                );

            foreach ($socialAccounts as $act) {
                $services[$act->type]['connected'] = $act->is_connected;
                $services[$act->type]['username'] = $act->username;
                $services[$act->type]['identifier'] = $act->identifier;
                $services[$act->type]['image'] = "";
            }
        }

        // setting response.
        $res['user'] = $userId;
        $res['followbackUsername'] = $followbackUsername;
        $res['services'] = $services;
        return Response::json($res);
    }

    public function getMinBidPrice($service, $identifier, $serviceType)
    {
        $res = $services = array();
        $bidType = 'bid';
        $minPrice = '';

        $socialAccount = SocialAccount::with('user', 'user.settings')
            ->byTypeAndId($service, $identifier)
            ->first();
        if (!empty($socialAccount)) {
            $minPrice = $socialAccount->user->settings->getMinimumPriceList(
                $service,
                $serviceType
            );
        }

        return Response::json($minPrice);
    }

    private function getProfileURL($type, $identifier, $username)
    {
        $url = '';
        if ($type) {
            switch ($type) {
                case 'facebook':
                    $url = 'https://facebook.com/' . $identifier;
                    break;
                case 'twitter':
                    $url = 'https://twitter.com/account/redirect_by_id/' .
                        $identifier;
                    break;
                case 'instagram':
                    $url = 'https://instagram.com/' . $username;
                    break;
                case 'vine':
                    $url = 'http://vine.co/' . $username;
                    break;
                case 'youtube':
                    $url = 'http://www.youtube.com/channel/' . $identifier;
                    break;
            }
        }
        return $url;
    }

    public function destroySession()
    {
        Sentry::logout();
        Session::clear();
        session_start();
        session_destroy();
        return redirect()->route('index');
    }

    public function checkUserSocialAcc()
    {
        $input = Input::all();
        if (Request::ajax()) {
            $userName = '';
            $type = $input['type'];
            $id = $input['identifier'];

            // $userId = DB::select("select user_id from users_social_accounts where type='$type' and identifier = '$identifier' Limit 1");
            // if(!empty($userId)) {
            //     $userName = DB::select("select username from users where id = ".$userId[0]->user_id);
            //     $userName = $userName[0]->username;
            // }
            //echo Response::json($username);
            //$userName = DB::select("select username from users where id = ".'$id');

            $userName = DB::table('users')->where('id', $id)->pluck('username');
            echo $userName;
            exit;
            //echo !empty($userName) ? $userName[0]->username : '';
        }
    }

}