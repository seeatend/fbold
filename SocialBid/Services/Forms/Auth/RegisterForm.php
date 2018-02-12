<?php

namespace SocialBid\Services\Forms\Auth;

use SocialBid\Services\Forms\BaseForm;
class RegisterForm extends BaseForm {
	public function isValid()
	{
		$rules = array(
			'email' => 'required|email|unique:users,email',
			'username' => 'required|regex:/^[A-Za-z][A-Za-z0-9!@#$%^&*]*$/|unique:users,username',
			'password' => 'required|min:4|max:18'
		);

		// $messages = array(
		// 	'email.unique'    => "Have you forgotten your password ? <a class='forgot-pass-link' href='/remind-password'>Click hare</a> to change.",
		// 	'username.unique' => ":attribute is already being used.",
		// );
		return $this->validate($rules);
	}
}