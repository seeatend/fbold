<?php

namespace SocialBid\Handlers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\MessageBag;

class HandlersServiceProvider extends ServiceProvider {

    public function boot()
    {
        $this->app['events']->subscribe('SocialBid\Handlers\UserHandler');
        $this->app['events']->subscribe('SocialBid\Handlers\BidHandler');
        $this->app['events']->subscribe('SocialBid\Handlers\OrderHandler');
    }

    /**
     * register important classes to L4 container
     * @return void
     */
    public function register()
    {
    }
}