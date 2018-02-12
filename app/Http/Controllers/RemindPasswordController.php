<?php
namespace Followback\Http\Controllers;

use Cartalyst\Sentry\Users\UserNotFoundException;
use Followback\User;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Sentry;
use SocialBid\FlashService\Facade\Flash;
use SocialBid\Mailers\AuthMailer;
use SocialBid\Services\Forms\Auth\RemindPasswordForm;

class RemindPasswordController extends BaseController {

    public function __construct(
        RemindPasswordForm $remindForm,
        AuthMailer $mailer
    ) {
        $this->remindForm = $remindForm;
        $this->mailer = $mailer;
    }

    public function getRemindPassword()
    {
        return view('auth.remindPassword');
    }

    public function getRemindPasswordComplete()
    {
        //if we have a remind_email value in session then we came from remind password form, otherwise we redirect to homepage
        if (Session::has('remind_email')) {
            return view('auth.remindPasswordComplete')->with(
                'email',
                Session::get('remind_email')
            );
        }
        return redirect()->route('index');
    }

    public function getResetPassword()
    {
        $token = Input::get('token');

        try {
            $user = Sentry::findUserByResetPasswordCode($token);
            return view('auth.resetPassword')->with('token', $token);
        } catch (UserNotFoundException $e) {
            return view('errors.resetPasswordTokenNotFound');
        }
    }

    public function postRemindPassword()
    {
        if ($this->remindForm->isValidRemind()) {
            $user = User::where('email', Input::get('email'))->first();
            $this->mailer->remindPassword($user);
            Flash::addSuccess(
                "A link to reset your password has been sent to <b>$user->email</b>."
            );
            return redirect()->route('remind_password');
            //return redirect()->route('remind_password_complete')->with('remind_email', $user->email);
        }
        return redirect()->route('remind_password')->withErrors(
            $this->remindForm->getErrors()
        );
    }

    public function postChangePassword()
    {

        if ($this->remindForm->isValidRemind()) {
            $user = User::where('email', Input::get('email'))->first();
            $this->mailer->remindPassword($user);
            Flash::addSuccess(
                "A link to reset your password has been sent to <b>$user->email</b>."
            );
            return redirect()->route('profile_followback_profile');
        }
        return redirect()->back()->withErrors($this->remindForm->getErrors());
    }

    public function postResetPassword()
    {
        try {
            if (Sentry::check()) {
                $user = Sentry::getUser();
            } else {
                $user = User::where(
                    'reset_password_code',
                    '=',
                    Input::get('token')
                )->first();
            }

            if ($this->remindForm->isValidReset()) {
                $user->password = Input::get('password');
                //$user->is_login_require = 0;
                $user->save();
                Flash::addSuccess('Password successfully updated!');
                if (Sentry::check()) {
                    return redirect()->back();
                } else {
                    return redirect('/');
                }
            }
            Flash::addError($this->remindForm->getError('password'));
            return redirect()->back()->withErrors(
                $this->remindForm->getErrors()
            );
        } catch (UserNotFoundException $e) {
            return redirect()->route('index');
        }
    }
}