<?php
namespace SocialBid\FlashService;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\MessageBag;
use Illuminate\Foundation\AliasLoader;
class FlashServiceProvider extends ServiceProvider {

		public function boot(){
			AliasLoader::getInstance()->alias('Flash', 'SocialBid\FlashService\Facade\Flash');
		}
		/**
		 * register important classes to L4 container
		 * @return void
		 */
		public function register(){
			$this->app->bind('flash', 'SocialBid\FlashService\Flash');
		}
}