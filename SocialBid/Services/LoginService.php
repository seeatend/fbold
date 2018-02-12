<?php
namespace SocialBid\Services;
use User, SocialAccount;
use Sentry;
use Carbon\Carbon;
use Session;
use Illuminate\Support\Str;
use Socialbid\Mailers\AuthMailer;
use Artdarek\OAuth\OAuth;

class LoginService{
	public function __construct($listener)
	{
		$this->listener = $listener;
		$this->oauth = new OAuth();
	}
	public function loginWithFacebook($facebookUser)
	{
		//replace facebook id for the first facebook Page uses is owning
		if(isset($facebookUser['admin']['data'])  and count($facebookUser['admin']['data'])>0){
		 	$facebookUser['id'] = $facebookUser['admin']['data'][0]['id'];
		}

		//first we try to find social account with provided facebook id
		$socialAccount = (new SocialAccount)->byTypeAndId('facebook', $facebookUser['id'])->first();
	
		//if account exists then we will try to fetch user bound to this account
		if($socialAccount){
			return $this->loginAndRedirect($socialAccount);
		}
		$token = $this->getToken('Facebook');
		//create a social user array which we will hold in session until we register an user
		$socialUser = $this->buildSocialUserArray('facebook', $facebookUser['id'], $facebookUser['name'],$facebookUser['picture'],array_get($facebookUser,'email'), $token);

		//save user in session
		$this->socialUserToSession($socialUser);
		//show registration form
		return $this->listener->showRegisterForm($socialUser);
	}
	public function loginWithLinkedIn($linkedinUser)
	{
		$socialAccount = (new SocialAccount)->byTypeAndId('linkedin', $linkedinUser['id'])->first();
		if($socialAccount){
			return $this->loginAndRedirect($socialAccount);
		}

		$token = $this->getToken('Linkedin');
		//create a social user array
		$fullName = $linkedinUser['firstName'].' '.$linkedinUser['lastName'];
		$socialUser = $this->buildSocialUserArray('linkedin', $linkedinUser['id'],$fullName,array_get($linkedinUser,'pictureUrl'),array_get($linkedinUser,'emailAddress'), $token);
		$this->socialUserToSession($socialUser);
		return $this->listener->showRegisterForm($socialUser);
	}
	public function loginWithTwitter($twitterUser)
	{
		
		$socialAccount = (new SocialAccount)->byTypeAndId('twitter', $twitterUser['id'])->first();
	
		if($socialAccount){
			return $this->loginAndRedirect($socialAccount);
		}
		$token = $this->getToken('Twitter');
		$email='';
		$socialUser = $this->buildSocialUserArray('twitter', $twitterUser['id'], $twitterUser['name'],$twitterUser['profile_image_url'],$email,$token);
		$this->socialUserToSession($socialUser);
		return $this->listener->showRegisterForm($socialUser);
	}

	//Mine
	public function loginWithYoutube($youtubeUser) {

		$socialAccount = (new SocialAccount)->byTypeAndId('youtube', $youtubeUser['id'])->first();

		if($socialAccount){
			return $this->loginAndRedirect($socialAccount);
		}

		if($youtubeUser['channel_id'] != ""){
			$youtubeUser['id'] = $youtubeUser['channel_id'];
		}
		$token = $this->getToken('Google');
		$email='';
		$socialUser = $this->buildSocialUserArray('youtube', $youtubeUser['id'], $youtubeUser['name'],$youtubeUser['picture'], $email,$token);
		$this->socialUserToSession($socialUser);
		return $this->listener->showRegisterForm($socialUser);
	}

	public function loginWithVine($vineUser) {

		$socialAccount = (new SocialAccount)->byTypeAndId('vine', $vineUser->userId)->first();
		if($socialAccount){
			return $this->loginAndRedirect($socialAccount);
		}

		//$token = $this->getToken('Vine');
		$token = "";
		$email='';
		$socialUser = $this->buildSocialUserArray('vine', $vineUser->userId, $vineUser->username,$vineUser->avatarUrl,$email, $token);
		$this->socialUserToSession($socialUser);
		return $this->listener->showRegisterForm($socialUser);

		//return $this->loginAndRedirect($socialAccount);	
	}

	/**
	 * handles login with instagram
	 * @param  array $instagramUser data from instagram callback
	 * @return Response
	 */
	public function loginWithInstagram($instagramUser)
	{
		$socialAccount = (new SocialAccount)->byTypeAndId('instagram', $instagramUser['data']['id'])->first();
		if($socialAccount){
			return $this->loginAndRedirect($socialAccount);
		}
		$token = $this->getToken('Instagram');
		$email='';
		$socialUser = $this->buildSocialUserArray('instagram', $instagramUser['data']['id'], $instagramUser['data']['username'], $instagramUser['data']['profile_picture'],$email,$token);
		$this->socialUserToSession($socialUser);
		return $this->listener->showRegisterForm($socialUser);
	}

	/**
	 * saves social user to session for later use during registration process
	 * @param  array $user crucial social user info like id, username and type of his account ie. 'twitter'
	 * @return [type]       [description]
	 */
	protected function socialUserToSession($user)
	{
		Session::set('socialUser', $user);
	}

	/**
	 * helper to effectively build social user array for later store and use during registration
	 * @param  string $type     user type ie. 'twitter' or 'facebook'
	 * @param  string $id       unique identifier
	 * @param  string $username user name
	 * @return array           array with credentials
	 */
	protected function buildSocialUserArray($type, $id, $username, $avatar, $email=null,$token=null)
	{
		return compact('type','id','username','email','avatar','token');
	}
	/**
	 * finds user bound to social account, logs him in and returns listener response
	 * @param  SocialAccount $socialAccount social account model
	 * @return listener event
	 */
	protected function loginAndRedirect($socialAccount)
	{
		$user = $socialAccount->user()->first();
		//if user email is verified then we will login user, otherwise we will send him a email verification email
		Sentry::login($user);
		return $this->listener->authSuccess($socialAccount->type);
	}

	protected function getToken($service) {
		
		$consumeServ = $this->oauth->consumer($service);

		$accessToken = $consumeServ->getStorage()->retrieveAccessToken($service);
		$token = $accessToken->getAccessToken();
		return $token;
		//return $accessToken;
	}	
}