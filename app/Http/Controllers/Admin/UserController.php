<?php

namespace Followback\Http\Controllers\Admin;

use View, Input, Redirect;
use \Followback\User, Flash;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use SocialBid\Services\Forms\Auth\RegisterForm;
use SocialBid\Exceptions\ValidationException;
use SocialBid\Services\Forms\Auth\RemindPasswordForm;
use DB, Sentry;

class UserController extends BaseAdminController {
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    protected $searchTypes = ['id' => 'Id', 'email' => 'E-mail',];

    public function getIndex()
    {
        $users = $this->user->with('groups', 'socialAccounts');
        $type = Input::get('type');
        $query = Input::get('query');
        if ($type and $query) {
            $users->where($type, 'LIKE', "%$query%");
        }
        $users = $users->paginate(50);
        return View::make('admin.users.index')
            ->with(compact('users'))
            ->with('searchTypes', $this->searchTypes);

        return View::make('admin.users.index');
    }

    public function getDelete($id)
    {
        try {
            if (\Request::ajax()) {
                $user = User::where('id', $id)->findOrFail($id);
                $user->delete();
                Flash::addSuccess('User has been deleted.');
                return \Response::json(['success' => true], 200);
            }
            $user = User::where('id', $id)->findOrFail($id);
            $user->delete();
            Flash::addSuccess('User has been deleted.');
        } catch (ModelNotFoundException $e) {
            Flash::addError('User not found.');
        }
        return Redirect::route('admin_users_index');
    }

    public function verfiedUser($id)
    {

        //$val = User::where('id' , $id)->select('is_verified');

        $result = DB::select('Select is_verified from users where id=' . $id);
        $val = $result[0]->is_verified;
        //echo '<pre>'; print_r($val[0]->is_verified); exit;
        if ($val == 0) {
            $update_with = 1;
        } else {
            $update_with = 0;
        }

        DB::update(
            "update users set is_verified = $update_with where id = $id"
        );
        return Redirect::route('admin_users_index');
    }

    public function postAdminChangeUsername()
    {
        $input = Input::all();

        $user_exist = User::find($input['userId']);
        //find by email address
        $username_exists = User::where('username', $input['username'])->first();
        $user = DB::table('users_social_accounts')->where('user_id',"=", $input['userId'])->first();
			if($user === null){
				 $time = \Carbon\Carbon::now();
				 DB::table('users_social_accounts')->insert(
    				[
    					'username' => $input['username'],
    					'screen_name' => $input['username'],  
    					'is_connected' => "1", 
    					'user_id' => $input['userId'],
    					'type' => "followback",
    					'identifier' => $input['userId'],
    					'token' => "",
    					'created_at' => $time->toDateTimeString(),
    					'updated_at' => $time->toDateTimeString()
    				]
				 );
				 Flash::addSuccess('Added Social Account');
			
			}


        if (!empty($user_exist) &&
            $input['username'] == $user_exist['username']
        ) {
            Flash::addSuccess('You did not change your Username!');
        } else {
            if (!empty($username_exists)) {
                Flash::addSuccess('Username is already being used!');
            } else {
                DB::table('users')
                    ->where('id', $input['userId'])
                    ->update(
                        array(
                            'username' => $input['username']
                        )
                    );
               
               	DB::table('users_social_accounts')
                    ->where('user_id', $input['userId'])
                    ->where('type', 'followback')
                    ->update(
                        array(
                            'username' => $input['username']
                        )
                    );
               

                //Resend Email Confirmation Notification
                //$mailer = new AuthMailer();
                //$mailer->confirmEmail(Sentry::getUser());

                Flash::addSuccess('Username Updated successfully!');

            }
        }
        return Redirect::route('admin_users_index');
    }

    public function getAdminChangePassword()
    {
        return View::make('admin.users.changePassword');
    }

    public function postAdminChangePassword()
    {
        $input = Input::all();

        $user = Sentry::getUser();
        $rules = array(
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6'
        );

        $validator = \Validator::make($input, $rules);
        if ($validator->fails()) {
            return Redirect::route('do_admin_change_password')->withErrors(
                $validator
            );
        } else {
            if (!\Hash::check(Input::get('old_password'), $user->password)) {
                return Redirect::route('do_admin_change_password')->withErrors(
                    'Your old password does not match'
                );
            } else {
                $user->password = Input::get('password');
                $user->save();
                Flash::addSuccess('Password Updated successfully!');
                return Redirect::route(
                    'do_admin_change_password'
                ); //->withMessage("Password have been changed");
            }
        }
    }

    public function postChangeCategory()
    {
        $input = Input::all();

        $user_exist = User::find($input['userId']);
        //find by email address

        if (!empty($user_exist) && $input['category'] == "") {
            Flash::addSuccess('You did not change the category!');
        } else {
            DB::table('users')
                ->where('id', $input['userId'])
                ->update(
                    array(
                        'category' => $input['category']
                    )
                );

            Flash::addSuccess('Category Updated successfully!');

        }
        return Redirect::route('admin_users_index');
    }

    public function postChangeTags()
    {
        $input = Input::all();

        $user_exist = User::find($input['userId']);
        //find by email address

        if (!empty($user_exist) && $input['tags'] == "") {
            Flash::addSuccess('You did not change the tags!');
        } else {
            DB::table('users')
                ->where('id', $input['userId'])
                ->update(
                    array(
                        'tags' => $input['tags']
                    )
                );

            Flash::addSuccess('Tags Updated successfully!');

        }
        return Redirect::route('admin_users_index');
    }
    
    public function postChangeReach()
    {
        $input = Input::all();

        $user_exist = User::find($input['userId']);
        //find by email address
		  $user = DB::table('users_social_accounts')->where('user_id', $input['userId'])->first();
        if (!empty($user_exist) && $input['reach'] == $user->reach) {
            Flash::addSuccess('You did not change the Reach!');
        } else {
            DB::table('users_social_accounts')
                ->where('user_id', $input['userId'])
                ->update(
                    array(
                        'reach' => $input['reach']
                    )
                );

            Flash::addSuccess('Reach Updated successfully!');

        }
        return Redirect::route('admin_users_index');
    }

    /**
     * Save Profile image while Registration After click on NEXT button.
     * @return image name
     */
    public function saveFollowbackProfileImage()
    {

        $input = Input::all();

        $userId = $input['userId'];
        $user = User::find($userId);
        $user->avatar = $input['avatar'];
        $user->save();
        Flash::addSuccess('Image Updated successfully!');
        return Redirect::route('admin_users_index');
    }


    public function createSocialUrls() {
        $input = Input::all();
        $user_id = $input['user_id'];

        $user = User::where('id', $user_id)->with('socialAccounts')->first();

        if ($user) {
            if ($user->socialAccounts->isEmpty()) {
                $time = \Carbon\Carbon::now();
                 DB::table('users_social_accounts')->insert(
                    [
                        'username' => $user->username,
                        'screen_name' => $user->username,  
                        'is_connected' => "1", 
                        'user_id' => $user->id,
                        'type' => "followback",
                        'identifier' => $user->id,
                        'token' => "",
                        'created_at' => $time->toDateTimeString(),
                        'updated_at' => $time->toDateTimeString()
                    ]
                );
                 $user->load('socialAccounts');
            }

            return view('admin.users.addSocialUrls')->with('user', $user);
        } else {
            Flash::addError('User Not Found.');
            return Redirect::route('admin_users_index');
        }

        
    }

    public function storeSocialUrls() {
        $input = Input::all();
        $user = User::with('socialAccounts')->find($input['user_id']);
        if ($user) {
            $sa = $user->socialAccounts->first();
            if ($sa) {
                $sa->facebook = $input['facebook'];
                $sa->twitter = $input['twitter'];
                $sa->googleplus = $input['google'];
                $sa->soundcloud = $input['soundcloud'];
                $sa->youtube = $input['youtube'];
                $sa->web = $input['web'];
                $sa->instagram = $input['instagram'];
                $sa->linkedin = $input['linkedin'];
                if ($sa->save()) {
                    Flash::addSuccess('Added New Social URLs');
                }
            } else {
                Flash::addError('Can\t Find the "Social Account"');
            }
            
        } else {
            Flash::addError('Error: Can\t Find User.');
        }

        return Redirect::route('admin_users_index');
    }
}