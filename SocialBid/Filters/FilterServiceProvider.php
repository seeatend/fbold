<?php
namespace SocialBid\Filters;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\MessageBag;
use Illuminate\Foundation\AliasLoader;
class FilterServiceProvider extends ServiceProvider {

		public function boot(){
			$this->app['router']->filter('oauth_token', 'SocialBid\Filters\OAuthTokenFilter');
			$this->app['router']->filter('user_search_type', 'SocialBid\Filters\UserSearchTypeFilter');
			$this->app['router']->filter('preapproved_key_exists', 'SocialBid\Filters\PreapprovedKeyFilter@validKeyExists');
			$this->app['router']->filter('preapproved_key_not_exists', 'SocialBid\Filters\PreapprovedKeyFilter@validKeyNotExists');
		}
		/**
		 * register important classes to L4 container
		 * @return void
		 */
		public function register(){
		}
}