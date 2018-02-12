<?php

namespace SocialBid\Mailers;

class AuthMailer extends Mailer {
	public function confirmEmail($user)
	{
		return $this->queueTo($user->email, 'Welcome to FollowBack', 'emails.auth.verifyAccount', array(
				'token' => $user->getActivationCode(),
				'email' => $user->email
			)
		);
	}
	public function remindPassword($user)
	{
		return $this->queueTo($user->email, 'Password Reset', 'emails.auth.resetPassword', ['token' => $user->getResetPasswordCode()]);
	}
}