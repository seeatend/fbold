<?php

namespace SocialBid\Helpers;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\MessageBag;
use Illuminate\Foundation\AliasLoader;
class HelpersServiceProvider extends ServiceProvider {

		public function boot(){
			ResponseHelper::registerMacros();
			AliasLoader::getInstance()->alias('ServicesHelper', 'SocialBid\Helpers\Facade\ServicesHelper');
		}
		/**
		 * register important classes to L4 container
		 * @return void
		 */
		public function register(){
			$this->app->bind('serviceshelper', 'SocialBid\Helpers\ServicesHelper');
		}
}