<?php
namespace Followback\Http\Controllers;

use Cartalyst\Sentry\Users\UserNotFoundException;
use Followback\User;
use Illuminate\Support\Facades\Session;
use Sentry;
use SocialBid\Creators\UserCreator;
use SocialBid\Exceptions\ValidationException;
use SocialBid\FlashService\Facade\Flash;
use Request;
use Illuminate\Support\Facades\Input;

class RegistrationController extends BaseController {

    public function __construct(User $user, UserCreator $creator)
    {
        $this->creator = $creator;
        $this->user = $user;
    }

    /**
     * handle verifying user email
     * @param  string $token token we will evaluate
     * @return Redirect
     */
    public function getConfirmEmail($token)
    {
        try {
            $user = Sentry::findUserByActivationCode($token);
            $user->email_verified = 1;
            $user->save();
            Sentry::login($user);
            Flash::addSuccess('You have successfully activated your account.');
        } catch (UserNotFoundException $e) {
            Flash::addError(
                'User with provided activation code does not exists.'
            );
        }
        return redirect()->route('index');
    }

    public function getIndex()
    {
        if (Sentry::check()) {
            return redirect()->route('profile_connect');
        }
        $socialUser = Session::get('user', null);

        //If user login through any service then display message on register page.
        if (Session::has('user')) {
            Flash::addSuccess(
                'You have now connected through ' . ucfirst($socialUser['type'])
            );
        }
        return view('registration.index')->with(compact('socialUser'));
    }

    /**
     * called as callback after successfully filling registration form
     * @return $this
     */
    public function getRegisterSuccess()
    {
        if (Session::has('user')) {
            return view('registration.registerSuccess')->with(
                'user',
                Session::get('user')
            );
        }
        Flash::addSuccess(
            'A verification email was sent to you from followback.mobi please click on the link to activate your account.'
        );
        return redirect()->route('index');
    }

    /**
     * handle user register form processing
     * @return Redirect
     */
    public function postRegister()
    {
        try {

            if (Request::ajax()) {
                $user = $this->creator->create(\Input::all());
                \Event::fire('user.signup', $user);
                //Flash::addSuccess('You have been logged in successfully!!! Please Verify your email addresss for confirmation');
                return response()->json(
                    ['success' => true, 'user' => $user],
                    200
                );
            }

            $user = $this->creator->create(\Input::all());

            \Event::fire('user.signup', $user);
            return redirect()->route('register_success')->with('user', $user);
        } catch (ValidationException $e) {

            if (Request::ajax()) {
                return response()->json(
                    ['success' => false, 'errors' => $e->getErrors(), 400]
                );
            }
            return redirect()->route('register')->withErrors($e->getErrors());
        }
    }

    /**
     * Save Profile image while Registration After click on NEXT button.
     * @return image name
     */
    public function saveRegProfileImage()
    {

        $input = Input::all();

        $userId = Sentry::getUser()->id;
        $user = User::find($userId);
        $user->avatar = $input['avatar'];
        $user->save();
        return Redirect::to('/');
    }

    /**
     * Upload Profile image while Registration
     * @return image name
     */
    public function uploadRegProfilePic(Request $request)
    {

        $rules = [
            'file' => 'required|mimes:jpeg,bmp,png,image/*'
        ];
        $this->validate($request, $rules);

        $file = $request->file('file');

        try {
            //upload file and get filepath
            $filePath = (new \Followback\ServiceBid)->uploadFile($file);
            echo $filePath;
            exit;
        } catch (Exception $e) {
            return response(
                'Unexpected error. Try again.' . $e->getMessage(),
                400
            );
        }
    }
}