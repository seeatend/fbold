<?php

namespace SocialBid\Filters;

use Sentry, Flash, Redirect;

class UserSearchTypeFilter {

	public function filter($route, $request)
	{
		$userSocialAccountTypes = Sentry::getUser()->getSocialAccountsTypes();

		$searchType = $request->get('type');

		if ( ! in_array($searchType, $userSocialAccountTypes)) {
			Flash::addError("Connect your ".ucfirst($searchType)." account first to search using this type.");
			return Redirect::route('profile_dashboard');
		}
	}
}
