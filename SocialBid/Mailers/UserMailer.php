<?php

namespace SocialBid\Mailers;

class UserMailer extends Mailer {
	public function preapprovedKeyActivated($user)
	{
		return $this->queueTo($user->email, 'Preapproved Key Activated', 'emails.user.preapprovedKeyActivated');
	}
}