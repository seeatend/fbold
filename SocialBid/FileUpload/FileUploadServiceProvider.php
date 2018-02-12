<?php

namespace SocialBid\FileUpload;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\MessageBag;
use Illuminate\Filesystem\Filesystem;
class FileUploadServiceProvider extends ServiceProvider {

		public function boot(){
		}
		/**
		 * register important classes to L4 container
		 * @return void
		 */
		public function register(){

			$this->app->bind('SocialBid\FileUpload\BidFileUpload', function(){
				return new \SocialBid\FileUpload\BidFileUpload(new Filesystem);
			});
		}
}