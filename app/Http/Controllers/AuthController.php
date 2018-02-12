<?php
namespace Followback\Http\Controllers;

use Artdarek\OAuth\OAuth;
use Cartalyst\Sentry\Users\LoginRequiredException;
use Cartalyst\Sentry\Users\PasswordRequiredException;
use Cartalyst\Sentry\Users\UserNotFoundException;
use Cartalyst\Sentry\Users\WrongPasswordException;
use Exception;
use Followback\User;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Sentry;
use SocialBid\Exceptions\LoginMethodNotFoundException;
use SocialBid\FlashService\Facade\Flash;
use SocialBid\Helpers\VineProvider;
use SocialBid\Services\ConnectService;
use SocialBid\Services\LoginService;

class AuthController extends BaseController {

    protected $oauth;
    protected $loginService;
    /**
     * this var will hold an action to be made after we get the social account info, for example it may hold connect action
     * which will cause assigning social account to user instead of showing register form
     * @var [type]
     */
    protected $afterAction;

    public function __construct(Oauth $oauth)
    {
        $this->oauth = $oauth;

        $this->loginService = new LoginService($this);
        $this->connectService = new ConnectService($this);
        $this->afterAction = Session::pull('after');
    }

    public function getSocialLogin($type)
    {
        try {

            if (method_exists($this, 'loginWith' . ucfirst($type))) {
                $method = 'loginWith' . ucfirst($type);
                return $this->{$method}();
            }
            throw new LoginMethodNotFoundException;
        } catch (LoginMethodNotFoundException $e) {
            return view('errors.loginMethodNotFound');
        }
    }

    public function loginWithFacebook()
    {
        // get fb service
        $fb = $this->oauth->consumer('Facebook');

        // Send a request with it
        $user = json_decode($fb->request('/me'), true);
        $user['admin'] = json_decode($fb->request('/me/accounts'), true);
        $userPicture = json_decode(
            $fb->request('/me/picture?redirect=false'),
            true
        );
        $user['picture'] = $userPicture['data']['url'];

        return $this->afterAction === 'connect' ?
            $this->connectService->connectWithFacebook($user) :
            $this->loginService->loginWithFacebook($user);
    }


    //Mine
    // public function loginWithYoutube() {
    //     //Session::flush('youtube_user_data');
    //     $user = Session::get('youtube_user_data1');

    //     Session::forget('youtube_user_data1');

    //     return $this->afterAction ==='connect' ? $this->connectService->connectWithYoutube($user[0]) : $this->loginService->loginWithYoutube($user[0]);
    // }
    public function loginWithYoutube()
    {

        $googleService = $this->oauth->consumer('Google');
        // Send a request with it. Please note that XML is the default format.
        $user = json_decode(
            $googleService->request(
                'https://www.googleapis.com/oauth2/v1/userinfo'
            ),
            true
        );

        // get the user channel.
        $channel = json_decode(
            $googleService->request(
                'https://www.googleapis.com/youtube/v3/channels?mine=true&part=id'
            ),
            true
        );

        $user['channel_id'] = (isset($channel['items'][0]['id'])) ?
            $channel['items'][0]['id'] : "";

        return $this->afterAction === 'connect' ?
            $this->connectService->connectWithYoutube($user) :
            $this->loginService->loginWithYoutube($user);
    }

    public function loginWithTwitter()
    {
        // get twitter service
        $twitterService = $this->oauth->consumer('Twitter');
        // Send a request with it

        $user = json_decode(
            $twitterService->request('account/verify_credentials.json'),
            true
        );
        return $this->afterAction === 'connect' ?
            $this->connectService->connectWithTwitter($user) :
            $this->loginService->loginWithTwitter($user);

    }


    // public function loginWithLinkedin() {
    //  $linkedinService = $this->oauth->consumer( 'Linkedin' );

    //        // Send a request with it. Please note that XML is the default format.
    //  $user = json_decode($linkedinService->request('/people/~:(id,first-name,last-name,email-address,picture-url)?format=json'), true);
    //  return $this->afterAction ==='connect' ? $this->connectService->connectWithLinkedin($user) : $this->loginService->loginWithLinkedin($user);
    //    }

    public function loginWithInstagram()
    {
        $instagramService = $this->oauth->consumer('Instagram');
        // Send a request with it. Please note that XML is the default format.
        $user = json_decode($instagramService->request('/users/self'), true);
        return $this->afterAction === 'connect' ?
            $this->connectService->connectWithInstagram($user) :
            $this->loginService->loginWithInstagram($user);
    }

    public function getLogin()
    {
        if (Sentry::check()) {
            return redirect()->route('index');
        }
        return view('auth.login');
    }

    public function postLogin()
    {
        //$input = Input::all();
        $remember = (Input::has('remember')) ? true : false;

        $username = Input::get('email');
        $password = Input::get('password');

        $field = filter_var($username, FILTER_VALIDATE_EMAIL) ? 'email' :
            'username';
        try {

            if (empty($username)) {
                throw new LoginRequiredException();
            }
            if (empty($password)) {
                throw new PasswordRequiredException();
            }

            $user = User::where($field, '=', $username)->first();
            if (empty($user)) {
                throw new UserNotFoundException();
            }

            if (!Hash::check($password, $user->password)) {
                throw new WrongPasswordException();
            }

            // Authenticate the user
            Sentry::login($user, $remember);
            // if(str_contains($input['email'], '@')) {

            //     Config::set('cartalyst/sentry::users.login_attribute', 'email');

            //         Sentry::authenticate([
            //             'email' => $input['email'],
            //             'password' => $input['password']
            //         ],  $remember);
            // } else {

            //     Config::set('cartalyst/sentry::users.login_attribute', 'username');

            //     Sentry::authenticate([
            //         'username' => $input['email'],
            //         'password' => $input['password']
            //     ], $remember);
            // }

            // $user = User::where(Input::get('login_field'), Input::get('login_name'))->first();
            // Sentry::authenticate([
            //     'email' => $input['email'],
            //     'password' => $input['password']
            // ],  $remember);

            // $credentials = array(
            //     'email' => $input['email'],
            //     'password' => $password,
            // );

            //Sentry::authenticate($credentials, $remember);
            // if(Sentry::check() && Sentry::getUser()->email_verified == 0) {
            //     $this->destroySession();

            //     if(Request::ajax())
            //         return \Response::json(['success' => false,'errors' => ['login' => ['Your account is not acivated yet. Please check your E-mail.']], 400]);

            //     Flash::addError('Your account is not acivated yet. Please check your E-mail.');
            //     return redirect()->route('auth_login');

            // }
            if (Request::ajax()) {
                return Response::json(['success' => true], 200);
            }

            Flash::addSuccess('You have been logged in successfully.');
            return redirect()->intended(URL::route('profile_connect'))->withInput(
            );

        } catch (Exception $e) {
            if (Request::ajax()) {
                return \Response::json(
                    [
                        'success' => false,
                        'errors' => ['login' => ['The email/username or password you entered is incorrect.']],
                        400
                    ]
                );
            }

            Flash::addError(
                'The email/username or password you entered is incorrect.'
            );
            return redirect()->route('auth_login');
        }

    }

    public function destroySession()
    {
        Sentry::logout();
        Session::clear();
        session_start();
        session_destroy();
    }

    /* Vine Lgin */
    public function getCustomSocialVineLogin()
    {
        return view('auth.custom_social_login');
        //return view('auth.custom_social_vine_login');

    }

    public function loginWithVine()
    {

        /*
            Authenticate user again from vine custom form and get user info
            This code is run when user click on vine to connect.
            hare the username ll' be auto filled and user need to enter password to authenticate with Vine
        */
        return view('auth.custom_social_vine_login')->with(
            'username',
            Sentry::getUser()->email
        );
    }

    /*
        Function to check authentication from Vine in custom form
        If success then redirect to register
        If fail then redirect to same auth/vine
    */
    public function postVineLogin()
    {

        try {
            $params = Input::All();
            $vine = new VineProvider(
                $params['email'], $params['password']
            ); //Login to Vine

            if ($vine->success) { //If login was succesful

                $user_profile = $vine->self_profile();
                //Check this login is used to connect with vine
                if (isset($params['loginFor']) &&
                    $params['loginFor'] == 'vine'
                ) {

                    return $this->connectService->connectWithVine(
                        $user_profile->data
                    );
                    //return redirect()->intended(URL::route('profile_connect'));
                } else {
                    $user_profile = $vine->self_profile();
                    return $this->loginService->loginWithVine(
                        $user_profile->data
                    );
                }
            } else {
                // if(Request::ajax()) {
                //     return \Response::json(['success' => false,'errors' => ['login' => ['Bad Credentials.']], 400]);
                // }
                return redirect()->route(
                    'social_login_custom_vine_form',
                    array('type' => 'vine')
                )->with(
                    'error-message',
                    'The email/username or password you entered is incorrect.'
                );
            }
        } catch (Exception $e) {

        }
    }

    private function call_vine_api($params, $url)
    {
        try {
            $postdata = http_build_query($params);

            $opts = array(
                'http' =>
                    array(
                        'method' => 'POST',
                        'header' => 'Content-type: application/x-www-form-urlencoded',
                        'content' => $postdata
                    )
            );

            $context = stream_context_create($opts);
            $result = json_decode(file_get_contents($url, false, $context));
            return redirect()->route('register');

        } catch (Exception $e) {
            Flash::addError('You have provided a bad credentials. Try again.');
            return redirect()->route('custom_social_login');
        }
    }

    public function getConnect($type)
    {
        Session::flash('after', 'connect');
        /*
            Check if user alerady connected then update its is_connect status
            otherwise send new request to social site
        */

        if (Sentry::getUser()->firstTimeConnected($type)) {

            //Update is_connected status
            Sentry::getUser()->updateSocialStatus($type);
            Flash::addSuccess(
                "Your " . ucfirst($type) .
                " account has been successfully connected."
            );
            return redirect()->route('profile_connect');
        }
        return redirect()->route('auth_social_login', ['type' => $type]);
    }
    // public function getDisconnect($type)
    // {
    //     Sentry::getUser()->disconnectSocialAccount($type);
    //     Flash::addSuccess('Account disconnected.');
    //     return redirect()->route('profile_connect');
    // }
    public function getAccountReset($type)
    {
        Sentry::getUser()->deleteSocialAccount($type);
        Flash::addSuccess('Account Reset successfully!');
        return redirect()->route('profile_connect');
    }

    public function getDisconnect($type)
    {
        Sentry::getUser()->disconnectSocialAccount($type);
        Flash::addSuccess('Account disconnected.');
        return redirect()->route('profile_connect');
    }

    public function deletefollowbackProfile($id)
    {

        DB::table('users')
            ->where('id', $id)
            ->update(
                array('is_deleted' => 0)
            );
        Flash::addSuccess('Your account has been successfully!');
        return redirect()->route('auth_logout');
    }

    public function getLogout()
    {
        Sentry::logout();
        Session::clear();
        session_start();
        session_destroy();
        return redirect()->route('index');
    }

    public function authSuccess($platform)
    {
        Flash::addSuccess(
            'Authenticated with ' . ucfirst($platform) . ' succesfully'
        );
        $redirect = Session::get('redirect_after_social_login', false);
        return $redirect ? redirect()->to($redirect) :
            redirect()->route('profile_connect');
    }

    public function authFailed($message = null)
    {
        Flash::addError($message);
        return redirect()->route('index');
    }

    public function authInfo($message = null)
    {
        Flash::addInfo($message);
        return redirect()->route('index');
    }

    /**
     * most likely this should be refactored and put in some other class, need to think about better structuring
     * @param  [type] $message [description]
     * @return [type]          [description]
     */
    public function connectFailed($message = null)
    {
        Flash::addError($message);
        return redirect()->route('profile_connect');
    }

    /**
     * most likely this should be refactored and put in some other class, need to think about better structuring
     * @param  [type] $message [description]
     * @return \Illuminate\Http\RedirectResponse
     */
    public function connectSuccess($message = null)
    {
        Flash::addSuccess($message);
        return redirect()->route('profile_connect');
    }

    public function showRegisterForm($socialUser = null)
    {
        return redirect()->route('register')->with('user', $socialUser);
    }

    public function getLoginPopup()
    {
        return view('layouts.partials.homepage._colorbox._logincolorbox');
    }

    public function getRegisterPopup()
    {
        return view(
            'layouts.partials.homepage._colorbox._registercolorbox'
        );
    }

    public function deleteProfileImage($id)
    {

        DB::table('users')
            ->where('id', $id)
            ->update(
                array(
                    'avatar' => Config::get(
                        'otherconstants'
                    )['FOLLOWBACK_DEFAULT_IMAGE']
                )
            );
        Flash::addSuccess('Profile image removed successfully.');
        if (Request::ajax()) {
            return Response::json(
                [
                    'success' => true,
                    'redirect' => '/'
                ],
                200
            );
        }
        return redirect()->back();
    }

    /**
     * Get username using email address
     *
     * @param $email
     */
    public function getUsernameByEmail($email)
    {
        //echo "helloo"; exit;
        // $username = DB::table('users')
        //     ->where('email', $email)
        //     ->pluck('username');

        // $username = ($username) ? $username : '';
    }
}
