<?php

namespace SocialBid\Services\Forms\Auth;

use SocialBid\Services\Forms\BaseForm;
class RemindPasswordForm extends BaseForm {
	public function isValidRemind()
	{
		$rules = array(
			'email' => 'required|email|exists:users,email',
		);
		$messages = [
			'email.exists' => 'No account exists with the provided email.'
		];
		return $this->validate($rules, $messages);
	}

	public function isValidReset()
	{

		$rules = [
			'password' => 'required|min:6|max:18|confirmed'
		];
		return $this->validate($rules);
	}
}