<?php

namespace Followback\Http\Controllers\Admin;
use View, Input, Redirect;
use User, Flash;

use SocialBid\Services\UserSearchService;
use OAuth\OAuth1\Token\StdOAuth1Token;
use Artdarek\OAuth\OAuth;
/*use Guzzle\Http\Client;
use Symfony\Component\DomCrawler\Crawler;
use Sunra\PhpSimple\HtmlDomParser;
use Artdarek\OAuth\OAuth;
use Madcoda\Youtube;*/
use DB;
class MostSearchUserController extends BaseAdminController{

	public function __construct(UserSearchService $search)
	{
		$this->search = $search;
	}
	public function getIndex() {
		$users = DB::table('most_search_users')->orderBy('display_order', 'ASC')->get();
		return View::make('admin.most_search_users_settings.index')->with('users', $users);
	}
	/*public function getMostSearchUser() {

		if(Input::has('q', 'type')){
			try{
				$type = Input::get('type'); $username = Input::get('q');
				//$results = $this->search->search($type, $username);
				$results = $this->search($type, $username);
				return View::make('admin.most_search_users_settings.add')
						->with('results', $results)
						->with('type', $type)
						->with('q', $username);
			}
			catch(BadResponseException $e){
				Flash::addError('Unpexpected error occured. Try again.');
				return Redirect::route('profile_dashboard');
			}
		}
		Flash::addError('Required parameter is missing.');
		return Redirect::route('profile_dashboard');
	}*/

	public function getMostSearchUser() {
		if(Input::has('q', 'type')){
			try{
				$userIdList = \MostSearchUser::getListWith('identifier');
				$type = Input::get('type'); $username = Input::get('q');
				$results = $this->search->search($type, $username);

				return View::make('admin.most_search_users_settings.add')
						->with('results', $results)
						->with('type', $type)
						->with('q', $username)
						->with('userIdList', $userIdList);
			}
			catch(BadResponseException $e){
				Flash::addError('Unpexpected error occured. Try again.');
				return Redirect::route('admin_dashboard');
			}
		}
		Flash::addError('Required parameter is missing.');
		return Redirect::route('admin_dashboard');
	}

	public function postSearchUser() {

		$data = Input::All();
		$res = array(
			'success' => 0,
			'msg' =>''
		);

		//Check if record already exists in database.
		$type = $data['type'];
		$identifier = $data['identifier'];
		$results = DB::select("select * from most_search_users where type = '$type' and identifier = '$identifier' limit 1");
		$resMsg='';
		if(!empty($results)) {
			$res['msg'] = "User Already exist";
		} else {

			$u = new \MostSearchUser();
			$u->name = $data['name'];
			$u->image_url = $data['image'];
	        $u->identifier = $data['identifier'];
	        $u->type = $data['type'];

			if($u->save()){
				$res['success'] = 1;
	            $res['msg'] = 'User Added Successfully !!!';
	        }
	        //if not success
	        else{
	            $res['msg'] = 'Problom Whole adding user';
	        }
	    }
	    return \Response::json($res);
	}


	public function addUser() {
		return View::make('admin.most_search_users_settings.add')
			->with('type', '')
			->with('q', '');
	}

	public function deleteUser($id) {
		$user = \MostSearchUser::find($id);
		$user->delete();
		return Redirect::route('admin_most_search_user_settings_index');
	}

	public function renameUser() {

		$data = Input::All();

		foreach ($data['data'] as $data) {

			$new_user_data = array('name' => $data['name'],'display_order' => $data['display_order']);
		    \MostSearchUser::whereId($data['id'])->update($new_user_data);    //camelCase replaces "=" sign

		}
		return Redirect::route('admin_most_search_user_settings_index')->with('rename_successfully', 'Records has been updated suiccessfully !!'); ;
	}

}



