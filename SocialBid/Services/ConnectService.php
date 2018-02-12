<?php
namespace SocialBid\Services;
use SocialAccount;
use Sentry;
use Artdarek\OAuth\OAuth;
use DB;
class ConnectService{

	
	public function __construct($listener)
	{
		$this->listener = $listener;
		$this->oauth = new OAuth();
	}	

	public function connectWithFacebook($user)
	{
		//replace facebook id for the first facebook Page uses is owning
		if(isset($user['admin']['data'])  and count($user['admin']['data'])>0){
		 	$user['id'] = $user['admin']['data'][0]['id'];
		}

		//check if account with provided type and id exists
		$account = SocialAccount::byTypeAndId('facebook', $user['id'])->first();
		//if this user already exists for some user we will return an error
		if($account) return $this->listener->connectFailed('This account is already connected to some account.');
		
		//Set token when user_social_accounts table		
		$token = $this->getToken('Facebook');

		//Check Avatar
		$this->isAvatarExist($user['picture']);

		//create a new user
		$socialAccount = $this->getStubAccount('facebook');
		$socialAccount->username = $user['name'];
		$socialAccount->identifier = $user['id'];

		$socialAccount->token = $token;
		$socialAccount->save();
		return $this->listener->connectSuccess('Your account has been connected successfully.');
	}

	public function connectWithTwitter($user)
	{

		//check if account with provided type and id exists
		$account = SocialAccount::byTypeAndId('twitter', $user['id'])->first();
		//if this user already exists for some user we will return an error
		if($account) return $this->listener->connectFailed('This account is already connected to some account.');
		
		//Set token when user_social_accounts table		
		$token = $this->getToken('Twitter');

		//Check Avatar
		$this->isAvatarExist($user['profile_image_url']);
		//create a new user
		$socialAccount = $this->getStubAccount('twitter');
		$socialAccount->username = $user['name'];
		$socialAccount->identifier = $user['id'];
		$socialAccount->screen_name = $user['screen_name'];

		$socialAccount->token = $token;
		$socialAccount->save();
		return $this->listener->connectSuccess('Your account has been connected successfully.');
	}

	//Mine
	// public function connectWithYoutube($user)
	// {
	// 	//check if account with provided type and id exists
	// 	$account = SocialAccount::byTypeAndId('youtube', $user['data']['uid'])->first();
	// 	//if this user already exists for some user we will return an error
	// 	if($account) return $this->listener->connectFailed('This account is already connected to some account.');
	// 	//create a new user
	// 	$socialAccount = $this->getStubAccount('youtube');
	// 	$socialAccount->username = $user['data']['name'];
	// 	$socialAccount->identifier = $user['data']['uid'];
	// 	$socialAccount->save();
	// 	return $this->listener->connectSuccess('Your account has been connected successfully.');
	// }
	public function connectWithYoutube($user)
	{
		//check if account with provided type and id exists
		$account = SocialAccount::byTypeAndId('youtube', $user['id'])->first();
		//if this user already exists for some user we will return an error
		if($account) return $this->listener->connectFailed('This account is already connected to some account.');
		
		//Set token when user_social_accounts table		
		$token = $this->getToken('Google');
		
		//Check Avatar
		$this->isAvatarExist($user['picture']);

		//create a new user
		$socialAccount = $this->getStubAccount('youtube');
		$socialAccount->username = $user['name'];
		$socialAccount->identifier = $user['id'];
		
		if($user['channel_id'] != ""){
			$socialAccount->identifier = $user['channel_id'];
		}

		$socialAccount->token = $token;
		$socialAccount->save();
		return $this->listener->connectSuccess('Your account has been connected successfully.');
	}

	public function connectWithVine($user)
	{

		//check if account with provided type and id exists
		$account = SocialAccount::byTypeAndId('vine', $user->userId)->first();

		//if this user already exists for some user we will return an error
		if($account) return $this->listener->connectFailed('This account is already connected to some account.');
		
		//Set token when user_social_accounts table		
		//$token = $this->getToken('Vine');
		$token = '';

		//Check Avatar
		$this->isAvatarExist($user->avatarUrl);

		//create a new user
		$socialAccount = $this->getStubAccount('vine');
		$socialAccount->username = $user->username;
		$socialAccount->identifier = $user->userId;
		$socialAccount->token = $token;
		$socialAccount->save();

		return $this->listener->connectSuccess('Your account has been connected successfully.');
	}
	public function connectWithLinkedin($user)
	{
		//check if account with provided type and id exists
		$account = SocialAccount::byTypeAndId('linkedin', $user['id'])->first();
		//if this user already exists for some user we will return an error
		if($account) return $this->listener->connectFailed('This account is already connected to some account.');
		
		//Set token when user_social_accounts table		
		$token = $this->getToken('Linkedin');

		//Check Avatar
		$this->isAvatarExist($user);

		//create a new user
		$socialAccount = $this->getStubAccount('linkedin');
		$socialAccount->username = $user['firstName'].' '.$user['lastName'];
		$socialAccount->identifier = $user['id'];
		$socialAccount->token = $token;
		$socialAccount->save();
		return $this->listener->connectSuccess('Your account has been connected successfully.');
	}
	public function connectWithInstagram($user)
	{
		//check if account with provided type and id exists
		$account = SocialAccount::byTypeAndId('instagram', $user['data']['id'])->first();
		//if this user already exists for some user we will return an error
		if($account) return $this->listener->connectFailed('This account is already connected to some account.');
		//create a new user
		
		//Set token when user_social_accounts table		
		$token = $this->getToken('Instagram');

		//Check Avatar
		$this->isAvatarExist($user['data']['profile_picture']);
		
		$socialAccount = $this->getStubAccount('instagram');
		$socialAccount->username = $user['data']['username'];
		$socialAccount->identifier = $user['data']['id'];
		$socialAccount->token = $token;
		$socialAccount->save();
		return $this->listener->connectSuccess('Your account has been connected successfully.');
	}
	protected function getStubAccount($type)
	{
		$account = new SocialAccount;
		$account->user_id = Sentry::getUser()->id;
		$account->type = $type;
		return $account;
	}

	protected function getToken($service) {
		
		$consumeServ = $this->oauth->consumer($service);

		$accessToken = $consumeServ->getStorage()->retrieveAccessToken($service);
		$token = $accessToken->getAccessToken();
		return $token;
		//return $accessToken;
	}
	public function isAvatarExist($avatar) {
		//echo '<pre>'; print_r($user)
		$avatar = DB::table('users')
			->where('id', Sentry::getUser()->id)
			->pluck('avatar');
		
		if(!$avatar) {
			DB::table('users')
                ->where('id', Sentry::getUser()->id)
                ->update(array(
                    'avatar' => $avatar
            ));	
		}
	}
}