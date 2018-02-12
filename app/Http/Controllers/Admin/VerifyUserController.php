<?php
namespace Followback\Http\Controllers\Admin;
use View, Input, Redirect;
use User, Flash;
use SocialBid\Services\UserSearchService;
use OAuth\OAuth1\Token\StdOAuth1Token;
use Artdarek\OAuth\OAuth;
use Followback\VerifyUser;
/*use Guzzle\Http\Client;
use Symfony\Component\DomCrawler\Crawler;
use Sunra\PhpSimple\HtmlDomParser;
use Artdarek\OAuth\OAuth;
use Madcoda\Youtube;*/
use DB;
class VerifyUserController extends BaseAdminController{

	public function __construct(UserSearchService $search)
	{
		$this->search = $search;
	}

	public function getIndex() {
		$users = DB::table('verified_users')->orderBy('id', 'ASC')->get();
		return View::make('admin.verified_users.index')->with('users', $users);
	}

	public function getVerifyUser() {
		if(Input::has('q', 'type')){
			try{
				//$userIdList = \MostSearchUser::getListWith('identifier');
				$userIdList = VerifyUser::getListWith('identifier');
				$type = Input::get('type'); $username = Input::get('q');
				$results = $this->search->search($type, $username,"users");

				return View::make('admin.verified_users.add')
					->with('results', $results)
					->with('type', $type)
					->with('q', $username)
					->with('userIdList', $userIdList);
			}
			catch(BadResponseException $e){
				Flash::addError('Unpexpected error occured. Try again.');
				return Redirect::back();
			}
		}
		Flash::addError('Required parameter is missing.');
		return Redirect::back();
	}

	public function postVerifyUser() {

		$data = Input::All();
		$res = array(
			'success' => 0,
			'msg' =>''
		);

		//Check if record already exists in database.
		$type = $data['type'];
		$identifier = $data['identifier'];
		//results = DB::select("select * from verified_users where type = '$type' and identifier = '$identifier' and is_verified=1 limit 1");
		$results = array();
		$resMsg='';
		if(!empty($results)) {
			$res['msg'] = "User Already exist";
		} else {

			$u = new VerifyUser();
			$u->name = $data['name'];
			$u->image_url = $data['image'];
	        $u->identifier = $data['identifier'];
	        $u->type = $data['type'];
	        $u->is_verified = 1;

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

	public function doVerifyUser($id) {

		DB::table('most_search_users')
	        ->where('id', $id)
	        ->update(array(
	            'is_verified' => 1
        ));

	    Flash::addSuccess('User has been verified successfully.');
	    return Redirect::route('admin_verified_users_index');
	}
	public function removeVerifyUser($id) {

		$user = VerifyUser::find($id);
		$user->delete();

	    Flash::addSuccess('User has been removed successfully.');
	    return Redirect::route('admin_verified_users_index');
	}

	public function addVerifyUser() {
		return View::make('admin.verified_users.add')
			->with('type', '')
			->with('q', '');
	}
}