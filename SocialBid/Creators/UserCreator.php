<?php

namespace SocialBid\Creators;
use SocialBid\Services\Forms\Auth\RegisterForm;
use SocialBid\Exceptions\ValidationException;
use SocialBid\Mailers\AuthMailer;
use Sentry, Config;
class UserCreator {
	public function __construct(AuthMailer $mailer)
	{
		$this->mailer = $mailer;
	}

	public function create($input)
	{
		$validator = new RegisterForm;
		if($validator->isValid()){
			$user = Sentry::getEmptyUser();
			$user->email = trim($input['email']);
			$user->username = trim($input['username']);
			$user->password = $input['password'];
			$user->avatar = Config::get('otherconstants')['FOLLOWBACK_DEFAULT_IMAGE'];
			$user->activated = 1;
			$user->save();

			$this->mailer->confirmEmail($user);
			return $user;
		}
		throw new ValidationException('Validation failed.', $validator->getErrors());
	}
}