<?php

/* Developer Note : 
------------------------------------------------------------
Commented out Instagram, Twitter, Vine, Facebook, Youtube to hide API searches
Hiding #network on style.css

*/

namespace SocialBid\Services;
use Guzzle\Http\Client;
use Symfony\Component\DomCrawler\Crawler;
use Sunra\PhpSimple\HtmlDomParser;
use Artdarek\OAuth\OAuth;
use Madcoda\Youtube;
use Config,DB;

class UserSearchService {
	public function __construct(Client $client, Crawler $crawler, OAuth $oauth)
	{
		$this->client = $client;
		$this->crawler = $crawler;
		$this->oauth = $oauth;
	}
	public function search($type, $username, $searchtype)
	{
		return $this->{'search'.ucfirst($type)}($username,$searchtype);
	}

	public function searchById($type, $username, $searchtype)
	{
		return $this->{'search'.ucfirst($type)}($username,$searchtype);
	}

	/**
	 * searches from instagram
	 * @param  string $username query to look for
	 * @throws  Guzzle\Http\Exception\ClientErrorResponseException
	 * @throws  Guzzle\Http\Exception\ServerErrorResponseException
	 * @return array response
	 * 
	 */
	public function searchInstagram($username, $limit = 30) {
/*
		try{
		 	$redis = \Redis::connection();
		     $res = $redis->get('Search.Instagram.' . $username);
		     $data = @json_decode($res, true);
		    
		     if(!empty($data)){
		     	return $data; 
		     }
		}catch(Exception $e){}


		$request =  $this->client->get(\Config::get('services.instagram.baseUrl').'/users/search');
		$request->getQuery()->set('q',$username)->set('count', $limit)->set('client_id',\Config::get('oauth-4-laravel::consumers.Instagram.client_id'));
		$response = $request->send()->json();
		if(count($response['data']) > 0){
			$data = ['valid' => true];
			foreach($response['data'] as $user){
				$data['data'][] = [
					'avatar' => $user['profile_picture'],
					'username' => $user['username'],
					'identifier' => $user['id'],
					'type' => 'instagram',
				];
			}
		}
		else{
			$data = ['valid' => false];
		}

		// caching data.

		$redis->set('Search.Instagram.' . $username, @json_encode($data));


		return $data;
	*/	
	}

	public function searchFacebook($username, $limit = 30)
	{
/*
		try{
		 	$redis = \Redis::connection();
		     $res = $redis->get('Search.Facebook.' . $username);
		     $data = @json_decode($res, true);
		    
		     if(!empty($data)){
		     	return $data;
		     }
		}catch(Exception $e){}

		
		$facebook = $this->oauth->consumer('Facebook');
		$response = json_decode($facebook->request('/search?q='.urlencode($username).'&type=page&limit='.$limit, 'GET', null, array('reqAction'=>'default')));

		if(!empty($response) && count($response->data)> 0){
			$data = ['valid' => true];
			foreach($response->data as $user){
				$data['data'][] = [
				'avatar' => "https://graph.facebook.com/{$user->id}/picture?type=large",
				'username' => $user->name,
				'identifier' => $user->id,
				'type' => 'facebook',
				];
			}
		} else{
			$data = ['valid'=> false];
		} 

		// caching data.

		$redis->set('Search.Facebook.' . $username, @json_encode($data));


		return $data;
*/		
	}

	public function searchTwitter($username, $limit = 30)
	{
/*	

		try{
		 	$redis = \Redis::connection();
		     $res = $redis->get('Search.Twitter.' . $username);
		     $data = @json_decode($res, true);
		    
		     if(!empty($data)){
		     	return $data;
		     }
		}catch(Exception $e){}


		$twitter = $this->oauth->consumer('Twitter');
		$response = json_decode($twitter->request('/users/search.json?q='.urlencode($username).'&count='.$limit, 'GET', null, array('reqAction'=>'default')));

		if(count($response)> 0){
			$data = ['valid' => true];
			foreach($response as $user){
				$data['data'][] = [
				// get original image (bigger)
				'avatar' => isset($user->profile_image_url) ? str_replace('_normal', '', $user->profile_image_url) : null,
				'username' => $user->name,
				'identifier' => $user->id,
				'type' => 'twitter',
				'verified' => '0',
				];
			}
		}else{
			$data = ['valid'=> false];
		}

		// caching data.
		$redis->set('Search.Twitter.' . $username, @json_encode($data));


		return $data;
	
*/	
	}

	public function searchLinkedin($username, $limit = 30)
	{
/*	

		try{
			$redis = \Redis::connection();
		    $res = $redis->get('Search.Linkedin.' . $username);
		    $data = @json_decode($res, true);
		    
		    if(!empty($data)){
		    	return $data;
		    }
		}catch(Exception $e){}


		$linkedin = $this->oauth->consumer('Linkedin');
		$response = json_decode($linkedin->request('/people-search:(people:(id,first-name,last-name),num-results)?keywords=Maksym'));
		if(count($response)> 0){
			$data = ['valid' => true];
			foreach($response as $user){
				$data['data'][] = [
				'avatar' => isset($user->profile_image_url) ? $user->profile_image_url : null,
				'username' => $user->name,
				'identifier' => $user->id,
				'type' => 'linkedin',
				];
			}
		}else{
			$data = ['valid'=> false];
		}

		// caching data.

		$redis->set('Search.Linkedin.' . $username, @json_encode($data));

		return $data;
	
*/	
	}

	public function searchYoutube($username, $limit = 30)
	{
/*	
		 try{
		 	$redis = \Redis::connection();
		     $res = $redis->get('Search.Youtube.' . $username);
		     $data = @json_decode($res, true);
		    
		     if(!empty($data)){
		     	return $data;
		     }
		}catch(Exception $e){}

	    // for initialising data.
    	$youtube = new Youtube(array('key' => Config::get('otherconstants.youtube_key')));

	    $params = array(
            'q' => $username,
            'part' => 'id, snippet',
            'type' => 'channel',
            'maxResults' => $limit
        );  
	    $channels = array();

	    $results  = $youtube->searchAdvanced($params);

	   if(count($results) > 0){

			$data = ['valid' => true];
			if(!empty($results)) {

				foreach($results as $result){
					$data['data'][] = [
						// get original image (bigger)
						'avatar'     => isset($result->snippet->thumbnails->default) ? $result->snippet->thumbnails->default->url : null,
						'username'   => $result->snippet->title,
						'description' => $result->snippet->description,
						'identifier' => $result->snippet->channelId,
						'type' => 'youtube',
					];
				}
			}
		}else{
			$data = ['valid'=> false];
		}

		// caching data.

		$redis->set('Search.Youtube.' . $username, @json_encode($data));

		return $data;

	
*/	}

	public function searchVine($username, $limit = 30) {
/*	

		try{
			$redis = \Redis::connection();
		    $res = $redis->get('Search.Vine.' . $username);
		    $data = @json_decode($res, true);
		    
		    if(!empty($data)){
		    	return $data;
		    }
		}catch(Exception $e){}


		$username = urlencode($username);
		$search_url = 'https://api.vineapp.com/users/search/'.$username . '?size=' . $limit;    //   Search user list by name
		
		
       	$tuCurl = curl_init();
   		curl_setopt($tuCurl, CURLOPT_URL, $search_url);
   		curl_setopt($tuCurl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($tuCurl, CURLOPT_SSL_VERIFYPEER, 0);
   		
   		$res = curl_exec($tuCurl);
   		$json = preg_replace('/:\s*(\-?\d+(\.\d+)?([e|E][\-|\+]\d+)?)/', ': "$1"', $res);
   		$results = json_decode($json);

   		if(count($results) > 0){

			$data = ['valid' => true];
			foreach($results->data->records as $result){
				$data['data'][] = [
					// get original image (bigger)
					'avatar'     => isset($result->avatarUrl) ? $result->avatarUrl : null,
					'username'   => $result->username,
					'identifier' => $result->userId,
					'type' => 'vine',
				];
			}
		} else{
			$data = ['valid'=> false];
		}
		// caching data.

		$redis->set('Search.Vine.' . $username, @json_encode($data));
		return $data;
	
*/	}


	public function searchAll($username)
	{

		// try{
		// 	$redis = \Redis::connection();
		//     $res = $redis->get('Search.All.' . $username);
		//     $data = @json_decode($res, true);
		    
		//     if(!empty($data)){
		//     	return $data;
		//     }
	 //    }catch(Exception $e){}

		$searchServices = Config::get('conservices');
		$res = $row = array();
		$limit = 25;
		$data = array('valid' => false, 'data' => []);

		if(!empty($searchServices)){
			foreach ($searchServices as $srv => $service) {
				$identifier = $service['identifier'];
				$row[$identifier] = $this->{'search'.ucfirst($identifier)}($username, $limit);
			}
		}
		
		// formate input result.
		$index = 0;
		for ($ii=0; $ii < $limit; $ii++) { 
			foreach ($searchServices as $service) {
				$idf = $service['identifier'];

				if($row[$idf]['valid'] && (isset($row[$idf]['data'][$ii]) && !empty($row[$idf]['data'][$ii]))){
					$res[$index++] = $row[$idf]['data'][$ii];
				}
			}
		}

		if(!empty($res)){
			$data['valid'] = 1;
			$data['data'] = $res;
		}
		
		//$redis->set('Search.All.' . $username, @json_encode($data));
		return $data;
	}

	public function searchFollowback($username,$type) {
		
		//$results = DB::select("SELECT * FROM users WHERE REPLACE(username, ' ', '') LIKE REPLACE('%$username%', ' ', '') OR LCASE(category) LIKE LCASE('$username%') OR LCASE(name) LIKE LCASE('$username%') ORDER BY username");
		
		$username = str_replace('#', '',$username);
		
		if(strlen($username) >= 2){
		
		if($type == 'all'){
		
		$results = DB::table('users_social_accounts')
        	->join('users','users.id','=','users_social_accounts.user_id')
        	->where('users.username', 'like', $username.'%')
        	->orWhere('users.category', 'like', '%'.$username.'%')
        	->orWhere('users_social_accounts.about', 'like', '%'.$username.'%')
        	->orWhere('users_social_accounts.reach', 'like', '%'.$username.'%')
         ->orderBy(
            'users_social_accounts.username',
            'ASC'
        )->get();
		
		} else {
		
			$results = DB::table('users_social_accounts')
        	->join('users','users.id','=','users_social_accounts.user_id')
        	->where('users.username', 'like', $username.'%')
        	->orWhere('users.category', 'like', $username.'%')
         ->orderBy(
            'users_social_accounts.username',
            'ASC'
        )->get();
		
		
		}
		
		
 			
	
		if(count($results) > 0){

			$data = ['valid' => true];
			foreach($results as $result){
				if($result->username != "bp@followback.com"){
				$data['data'][] = [
					// get original image (bigger)
					'avatar'     => isset($result->avatar) ? $result->avatar : null,
					'username'   => $result->username,
					'name'   => $result->name,
					'category' => $result->category,					
					'description' => '',
					//'identifier' => (string)$result->userId,
					'identifier' => $result->id,
					'type' => 'followback',
				];
				}
			}
		} else{
			$data = ['valid'=> false];
		}
		
		} else {
		
		$results = DB::select("SELECT * FROM users WHERE REPLACE(username, ' ', '') LIKE REPLACE('$username%', ' ', '') ORDER BY username");
	
		if(count($results) > 0){

			$data = ['valid' => true];
			foreach($results as $result){
				if($result->username != "bp@followback.com"){
				$data['data'][] = [
					// get original image (bigger)
					'avatar'     => isset($result->avatar) ? $result->avatar : null,
					'username'   => $result->username,
					'name'   => $result->name,
					'category' => $result->category,
					'description' => '',
					//'identifier' => (string)$result->userId,
					'identifier' => $result->id,
					'type' => 'followback',
				];
				}
			}
		} else{
			$data = ['valid'=> false];
		}
		
		
		}
		
		return $data;
	}
}