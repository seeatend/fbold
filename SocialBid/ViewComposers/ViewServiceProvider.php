<?php

namespace SocialBid\ViewComposers;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\MessageBag;
class ViewServiceProvider extends ServiceProvider {

	public function boot(){
		SharedDataService::share();
		$this->app['view']->composer('partials._searchbar', 'SocialBid\ViewComposers\SearchBarComposer');
		$this->app['view']->composer('layouts.partials.frontend._navbar', 'SocialBid\ViewComposers\NavbarComposer');

		// for homepage nav composer.
		$this->app['view']->composer('layouts.partials.homepage._header._nav', 'SocialBid\ViewComposers\NavComposer');

		// for site nav composer for logout.
		$this->app['view']->composer('layouts.partials.simple._header._nav', 'SocialBid\ViewComposers\NavComposer');

		// for homepage nav composer.
		$this->app['view']->composer('layouts.partials.homepage._footer._footer-menus', 'SocialBid\ViewComposers\NavComposer');

		// for most search users.
		$this->app['view']->composer('partials._most-search-users', 'SocialBid\ViewComposers\MostSearchUsersComposer');
	}
	/**
	 * register important classes to L4 container
	 * @return void
	 */
	public function register(){

	}
}