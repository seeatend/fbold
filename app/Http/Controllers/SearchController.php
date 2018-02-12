<?php
namespace Followback\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Route;
use SocialBid\FlashService\Facade\Flash;
use SocialBid\Services\UserSearchService;
use OAuth\OAuth1\Token\StdOAuth1Token;
use Artdarek\OAuth\OAuth;

class SearchController extends BaseController {
    public function __construct(UserSearchService $search)
    {
        $this->search = $search;

        if (Route::is('search_users')) {
            Session::set('redirect_after_social_login', Request::fullUrl());
        }
        $this->beforeFilter('user_search_type', ['only' => ['getSearch']]);
        $this->beforeFilter('oauth_token', ['only' => ['getSearch']]);

    }

    public function getSearch()
    {

        if (Input::has('q', 'type')) {
            try {
                $type = Input::get('type');
                $username = Input::get('q');
                $results = $this->search->search($type, $username);

                // for ajax request.
                if (Request::ajax()) {
                    return Response::json($results);
                }

                return view('search.userResults')->with(
                    'results',
                    $results
                )->with('type', $type);
            } catch (BadResponseException $e) {
                Flash::addError('Unpexpected error occured. Try again.');
                return redirect()->route('profile_dashboard');
            }
        }
        Flash::addError('Required parameter is missing.');
        return redirect()->route('profile_dashboard');
    }

    public function getSocialSearch()
    {

        if (Input::has('q', 'type')) {
            try {
                $type = Input::get('type');
                $username = Input::get('q');
                $searchtype = Input::get('searchtype');

                $results = $this->search->search($type, $username, $searchtype);

                //Check if user is already verfied
                $results = $this->isVerifiedUser($results);

                //Exclude those Users who set their Public Profile hidden
                $results = $this->excludePublicProfileHiddenUser($results);

                /*if (Request::ajax()) {
                    return Response::json($results);
                }*/

                return view('search.userResults')->with(
                    'results',
                    $results
                )->with('type', $type);
            } catch (BadResponseException $e) {
                Flash::addError('Unpexpected error occured. Try again.');
                return redirect()->route('profile_dashboard');
            }
        }
        Flash::addError('Required parameter is missing.');
        return redirect()->route('profile_dashboard');

    }

    public function excludePublicProfileHiddenUser($data)
    {

        $res = array();
        $results = array();
        if (isset($data['data']) && !empty($data['data'])) {
            $results = $data['data'];
            foreach ($results as $key => $value) {

                $type = $value['type'];
                $identifier = $value['identifier'];

                //Check if any record from searched data exist in users_social_accounts table
                $res = DB::table('users_social_accounts')
                    ->where('type', $type)
                    ->where('identifier', $identifier)
                    ->first();

                //If user exists in users_social_accounts table
                // Check if his public display profile is on from users_profile_settings
                // If not on(i.e 1) then unset this record from result
                if (!empty($res)) {

                    $user_id = $res->user_id;
                    $user_settings = DB::table('users_profile_settings')
                        ->where('user_id', $user_id)
                        ->first();

                    if (!empty($user_settings) &&
                        $user_settings->is_public_profile == 1
                    ) {
                        unset($results[$key]);
                        // $data['valid'] = '';
                    }
                    break;
                }
            }
        }

        $data['data'] = $results;
        return $data;
    }

    public function isVerifiedUser($results)
    {
        //$results['valid'] = 1;
        if (isset($results['data']) && !empty($results['data'])) {
            $data = $results['data'];
            foreach ($results['data'] as $key => $value) {
                # code...
                $service = $value['type'];
                $identifier = $value['identifier'];
                $user_exists = DB::select(
                    "select * from verified_users where type='$service' and identifier = '$identifier' and is_verified =1"
                );

                if (isset($user_exists[0]->identifier) &&
                    isset($user_exists[0]->type)
                ) {

                    // $id = $user_exists[0]->user_id;
                    // $is_verified = DB::select("Select is_verified from users where id = $id");
                    // $results['data'][$key]['verified'] =  $is_verified[0]->is_verified;
                    $results['data'][$key]['verified'] = 1;
                }
            }
        }
        return $results;
    }
}