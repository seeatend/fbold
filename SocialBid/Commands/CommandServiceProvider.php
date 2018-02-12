<?php

namespace SocialBid\Commands;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\MessageBag;
class CommandServiceProvider extends ServiceProvider {

		public function boot(){
			$this->commands('commands.database.clear');
		}
		/**
		 * register important classes to L4 container
		 * @return void
		 */
		public function register(){
			$this->app->bind('commands.database.clear', 'SocialBid\Commands\ClearDbCommand');
		}
}