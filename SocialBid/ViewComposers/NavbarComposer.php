<?php

namespace SocialBid\ViewComposers;

use Sentry;
use Followback\ServiceBid;

class NavbarComposer {
    public function __construct(ServiceBid $bid)
    {
        $this->bid = $bid;
    }

    public function compose($view)
    {
        $user = Sentry::getUser();
        if ($user) {
            $pendingBidsCount = Sentry::getUser()->countPendingBidsForMe();
            $view->pendingBidsCount = $pendingBidsCount;
        }
    }
}