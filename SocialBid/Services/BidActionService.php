<?php
namespace SocialBid\Services;
use Artdarek\OAuth\OAuth;
use Sentry, Flash, Redirect;
use DB;
class BidActionService {
	
	public function __construct(OAuth $oauth)
	{
		$this->oauth = $oauth;
	}

	public function fulfilService($bid, $user_id){
		$service = $bid->service;
		$this->{'fulfil'.ucfirst($service)}($bid, $user_id);
	}
	// fulfil facebook.
	protected function fulfilFacebook($bid){
		
	}

	// fulfil twitter.
	protected function fulfilTwitter($bid){

	}

	protected function isUserConnected($service, $user_id) {
		//$a = Sentry::getUser()->id;
		return DB::table('users_social_accounts')
			->where('type', $service)
			->where('user_id', $user_id)
			->first();
	}

	// fulfil instagram.
	protected function fulfilInstagram($bid, $user_id){
		
		if(isset($bid->other_information) && !empty($bid->other_information)) {

			$info =  json_decode($bid->other_information); 
			$identifier = isset($info->identifier) ? $info->identifier : '';
			$type = isset($info->type) ? $info->type : '';

			// $instagram = $this->oauth->consumer('Instagram');
			// $accessToken = $instagram->getStorage()->retrieveAccessToken('Instagram');
			// $token = $accessToken->getAccessToken();

			//Check if user is connected only then he can accept
            $is_connected = $this->isUserConnected('instagram', $user_id);	       
            if(!$is_connected) { 
            	//Flash::addSuccess('Please connect your account with instagram');
            	return Redirect::route('profile_connect');
            }

            $token = $is_connected->token;
            // If connected then pass token also

			\Instagram::setAccessToken($token);

			switch ($bid->service_type) {
				case 'like':
					\Instagram::setAccessToken($token);
					
					break;
				case 'follow_back':
					$res = \Instagram::modifyRelationship('follow', $identifier);
					break;
				default:
					# code...
					break;
			}
		}
	}

	// fulfil youtube.
	protected function fulfilYoutube($bid){
		
	}

	// fulfil vine.
	protected function fulfilVine($bid){
		
	}
}