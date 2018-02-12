<?php
namespace SocialBid\ViewComposers;
use View, Sentry;
class SharedDataService {
	public static function share()
	{
		View::share('user', Sentry::getUser());
	}
}