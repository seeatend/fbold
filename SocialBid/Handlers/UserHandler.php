<?php
namespace SocialBid\Handlers;

use Followback\SocialAccount;
use Followback\User;
use Session, Sentry;

class UserHandler {
    public function __construct(User $user, SocialAccount $account)
    {
        $this->user = $user;
        $this->account = $account;
    }

    public function subscribe($events)
    {
        $events->listen(
            'user.signup',
            'SocialBid\Handlers\UserHandler@onSignup'
        );
    }

    public function onSignup($user)
    {
        if (Session::has('socialUser')) {
            $socialUser = Session::pull('socialUser');

            $user->avatar = $socialUser['avatar'];
            //$user->email_verified = 1;
            //$user->is_login_require = 1;
            $user->save();

            $socialAccount = $this->account->newInstance();
            $socialAccount->user_id = $user->id;
            $socialAccount->username = $socialUser['username'];
            $socialAccount->type = $socialUser['type'];
            $socialAccount->identifier = $socialUser['id'];
            $socialAccount->token = $socialUser['token'];
            $socialAccount->save();

            Sentry::login($user);

        } else {

            //$user->avatar = $socialUser['avatar'];
            //$user->is_login_require = 1;
            //$user->save();

            $socialAccount = $this->account->newInstance();
            $socialAccount->user_id = $user->id;
            $socialAccount->username = $user->username;
            $socialAccount->type = 'followback';
            $socialAccount->identifier = $user->id;
            $socialAccount->screen_name = $user->username;
            $socialAccount->token = '';
            $socialAccount->save();

            Sentry::login($user);
        }
    }
}