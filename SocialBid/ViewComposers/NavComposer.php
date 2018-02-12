<?php

namespace SocialBid\ViewComposers;

use Followback\Menu;

class NavComposer {


	public function __construct()
	{
		//$this->bid = $bid;
	}
	public function compose($view){
		$view->navLinks = Menu::getList();
	}
}