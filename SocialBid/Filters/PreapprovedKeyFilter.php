<?php

namespace SocialBid\Filters;

use Sentry, Flash, Redirect;

class PreapprovedKeyFilter {

	public function validKeyExists()
	{
		$preapprovedKey = Sentry::getUser()->preapprovalKeys()->valid()->first();
		if ( ! $preapprovedKey) {
			return Redirect::route('preapproval');
		}
	}

	public function validKeyNotExists()
	{
		$preapprovedKey = Sentry::getUser()->preapprovalKeys()->valid()->first();
		if ($preapprovedKey) {
			return Redirect::route('profile_dashboard');
		}
	}
}
