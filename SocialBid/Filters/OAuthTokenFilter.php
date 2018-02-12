<?php

namespace SocialBid\Filters;

use Artdarek\OAuth\OAuth;
use View, Redirect, Flash, Session, Input;
use OAuth2\OAuth2;
use OAuth2\Token_Access;
use OAuth2\Exception as OAuth2_Exception;
/**
 * this filter makes sure that access code will be available in controller,
 * if there is no specific code in request then we will first redirect
 * user to specific social provider to obtain code then we can move on to controller
 */

class OAuthTokenFilter {

	protected $request;
	protected $oauth;
	protected $callback_url;

	public function __construct(OAuth $oauth)
	{
		$this->oauth = $oauth;
	}

	public function filter($route, $request)
	{
		$this->request = $request;

		Session::keep('after');

		$loginType = $route->getParameter('type') !== null ? $route->getParameter('type') :$request->get('type');

		$this->callback_url = \URL::route('auth_social_login', $loginType);

		$input = $request->all();

		switch ($loginType) {
			case 'facebook':
				return $this->processFacebook($input);
			break;
			case 'twitter':
				return $this->processTwitter($input);
			break;
			case 'linkedin':
				return $this->processLinkedin($input);
			break;
			case 'instagram':
				return $this->processInstagram($input);
			break;
			case 'youtube':
				return $this->processYouTube($input);
			break;
			case 'vine':
				return $this->processVine($input);
			break;
			default:
				return View::make('errors.loginMethodNotFound');
		}
	}

	protected function processFacebook($input)
	{
		//get consumer
		$fb = $this->oauth->consumer('Facebook', $this->callback_url);
		try {
			$response = $fb->request('/me', 'GET', null, array('reqAction' => 'newToken'));
			
			if(isset($response->error) and $response->error->type =='OAuthException') {
				throw new \Exception;
			}
		}
		catch (\Exception $e){
			//if code is not set then we will redirect, otherwiste we will request access token and go further
			if( ! isset($input['code'])) {
				if(isset($input['error'])) {
					return $this->returnError('You have denied the Facebook authentication request. Try again.');
				}

				$url = $fb->getAuthorizationUri();
				return Redirect::to((string) $url);
			}
			else {
				$fb->requestAccessToken($input['code']);
			}
		}
	}

	protected function processTwitter($input) {
		// just like the facebook, get the consumer, try to get data from endpoint,
		// if anything fails we will try to either
		// redirect to login page or request access token from input and move forward

		$twitter = $this->oauth->consumer('Twitter', $this->callback_url);
		try {

			$extHeaders = (isset($input['oauth_token'])) ? array() : array('reqAction' => 'newToken');

			// if token given.
			$response = json_decode( $twitter->request('account/verify_credentials.json', 'GET', null, $extHeaders));
  			
  			if (isset($response->errors) and ($response->errors[0]->code == 215 or $response->errors[0]->code == 89)) {
				throw new \Exception;
			}
		}
		catch (\Exception $e) {

			//if not set then we most likely need to go login
			if ( ! isset($input['oauth_token'])) {
				$consumer = $this->oauth->consumer('Twitter');

				//if we got 'denied' field then user most likely denied login
				if(isset($input['denied'])) {
					return $this->returnError('You rejected Twitter Login. Try again.');
				}

				// extra request needed for oauth1 to request a request token :-)
				$token = $twitter->requestRequestToken();

				$url = $twitter->getAuthorizationUri(['oauth_token' => $token->getRequestToken()]);

				// return to twitter login url
				return Redirect::away((string) $url);
			}
			//if oauth_token is set then we are most likely coming from login page
			// so we get the input and retrieve access token
			else {
				$code = Input::get( 'oauth_token' );
				$oauth_verifier = Input::get( 'oauth_verifier' );

				$token = $twitter->getStorage()->retrieveAccessToken('Twitter');

				// This was a callback request from twitter, get the token
				$twitter->requestAccessToken($code, $oauth_verifier, $token->getRequestTokenSecret());
			}
		}
	}

	protected function processLinkedin($input)
	{	

		$linkedin = $this->oauth->consumer('Linkedin', $this->callback_url);
		try {
			$response = json_decode($linkedin->request('/people/~:(id,first-name,last-name,email-address,picture-url)?format=json'));
			if(isset($response->error) and $response->error->status == 401) throw new \Exception;
		}
		catch (\Exception $e) {
			if ( ! isset($input['code'])) {
				if (isset($input['error'])) {
					return $this->returnError('You have denied the LinkedIn authentication request. Try again.');
				}

				// get linkedinService authorization
				$url = $linkedin->getAuthorizationUri(array('oauth_callback' => $this->request->fullUrl()));

				// return to linkedin login url
				return Redirect::to( (string)$url );
			}
			else {
				$linkedin->requestAccessToken($input['code']);
			}
		}
	}

	protected function processInstagram($input)
	{
		$instagram = $this->oauth->consumer('Instagram', $this->callback_url);
		try {
			$response = json_decode($instagram->request('/users/self', 'GET', null, array('reqAction' => 'newToken')));
			if(isset($response->meta->code) and $response->meta->code==400) throw new \Exception;
		}
		catch (\Exception $e) {
			if ( ! isset($input['code'])) {
				if (isset($input['error'])) {
					return $this->returnError('You have denied the Instagram authentication request. Try again.');
				}

				// get instagram authorization
				$url = $instagram->getAuthorizationUri();

				// return to linkedin login url
				return Redirect::to((string) $url);
			}
			else {
				$instagram->requestAccessToken($input['code']);
			}
		}
	}

	protected function processYoutube($input)
	{
		$google = $this->oauth->consumer('Google', $this->callback_url);

		try {
			$response = json_decode($google->request('https://www.googleapis.com/oauth2/v1/userinfo'), true);

			if(isset($response->meta->code) and $response->meta->code==400) throw new \Exception;
		}
		catch (\Exception $e) {
			if ( ! isset($input['code'])) {
				if (isset($input['error'])) {
					return $this->returnError('You have denied the Youtube authentication request. Try again.');
				}

				// get instagram authorization
				$url = $google->getAuthorizationUri();

				// return to linkedin login url
				return Redirect::to((string) $url);
			}
			else {
				$google->requestAccessToken($input['code']);
			}
		}
	}

	protected function searchUserByIdInstagram($identifier) {
		 $instagram = $this->oauth->consumer('Instagram', $this->callback_url);
        try {
            $response = json_decode($instagram->request('/users/'.$identifier));
           
            if(isset($response->meta->code) and $response->meta->code==400) throw new \Exception;
        }
        catch (\Exception $e) {
            if ( ! isset($input['code'])) {
                if (isset($input['error'])) {
                    return $this->returnError('You have denied the Instagram authentication request. Try again.');
                }

                // get instagram authorization
                $url = $instagram->getAuthorizationUri();

                // return to linkedin login url
                return Redirect::to((string) $url);
            }
            else {
                $instagram->requestAccessToken($input['code']);
            }
        }
	}

	public function processVine($input) {
			
	}
	
	protected function returnError($message)
	{
		Flash::addError($message);
		return Redirect::route('index');
	}

}
