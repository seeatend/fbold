<?php

namespace SocialBid\BladeExtensions;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\MessageBag;
class BladeExtensionServiceProvider extends ServiceProvider {

		public function boot(){
			require_once 'assets_helpers.php';
			require_once 'form_helpers.php';
		}
		/**
		 * register important classes to L4 container
		 * @return void
		 */
		public function register(){
		}
}