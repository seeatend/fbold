<?php

namespace SocialBid\ViewComposers;

use Followback\MostSearchUser;

class MostSearchUsersComposer {
	public function __construct()
	{
		//$this->bid = $bid;
	}
	public function compose($view)
	{
		$view->users = MostSearchUser::getList();
	}
}