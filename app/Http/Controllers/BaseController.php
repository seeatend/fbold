<?php
namespace Followback\Http\Controllers;

use Cartalyst\Sentry\Sentry;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class BaseController extends Controller {

	public function __construct() {

	}
	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = view($this->layout);
		}

		$totalReceieveCount=0;
		if(Sentry::check()) {
			$user_id = Sentry::getUser()->id;
			$query = "select * from users_social_accounts where user_id=".$user_id;
			$notification = DB::select("select * from users_social_accounts where user_id=".$user_id);
			if(!empty($notification)) {

				foreach ($notification as $key => $value) {

					$type[$key] = $notification[$key]->type;
					$identifier[$key] = $notification[$key]->identifier;

				}

				/*
					Fetch bubble count for receiver and,
					also exclude those countcheck whose user has been deleted.
				*/
				$allUserId = DB::table('users')->lists('id');
				$totalReceieveCount = DB::table('service_offer')
					->where('identifier', $user_id)
					->orWhere('bidder_id', $user_id)
					->where('status', 0)
					->orWhere('status', 4)
					->where('is_hide', 1)
					->count();
			}
		}
        \View::share('totalReceieveCount', $totalReceieveCount);

	}

	public function countBubble() {

		$result['totalReceieveCount']=0;
		$result['username']='';
		$result['avatar']='';
		if(request()->ajax()) {


			if(Sentry::check()) {
				$user_id = Sentry::getUser()->id;

				//Get username
				$username = DB::table('users')->where('id', $user_id)->pluck('username');
				$result['username'] = (strlen($username) > 15) ? substr($username,0,15).'...' : $username;
				$result['avatar']= DB::table('users')->where('id', $user_id)->pluck('avatar');
				$query = "select * from users_social_accounts where user_id=".$user_id;
				$notification = DB::select("select * from users_social_accounts where user_id=".$user_id);
				if(!empty($notification)) {

					foreach ($notification as $key => $value) {

						$type[$key] = $notification[$key]->type;
						$identifier[$key] = $notification[$key]->identifier;

					}

					/*
						Fetch bubble count for receiver and,
						also exclude those countcheck whose user has been deleted.
					*/
					$allUserId = DB::table('users')->lists('id');
					$result['totalReceieveCount'] = DB::table('service_offer')
						->where('identifier', $user_id)
						->orWhere('bidder_id', $user_id)
						->where('status', 0)
						->orWhere('status', 4)
						->where('is_hide', 1)
						->count();
				}
			}
			return response()->json($result);
        }
	}
	public function debug($data) {
		echo '<pre>';
		print_r($data);
		echo '</pre>';
	}
	public function destroySession() {
        Sentry::logout();
        Session::clear();
        session_start();
        session_destroy();
    }
}
