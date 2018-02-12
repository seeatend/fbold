<?php

namespace Followback\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * @var array
     */
    protected $middleware = [
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
        \Followback\Http\Middleware\EncryptCookies::class,
        \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
        \Illuminate\Session\Middleware\StartSession::class,
        \Illuminate\View\Middleware\ShareErrorsFromSession::class,
        \Followback\Http\Middleware\VerifyCsrfToken::class,
    ];

    /**
     * The application's route middleware.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => \Followback\Http\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'guest' => \Followback\Http\Middleware\RedirectIfAuthenticated::class,
        'blockedBid' => \Followback\Http\Middleware\BlockedBidMiddleware::class,
        'bidsLeft' => \Followback\Http\Middleware\BidsLeftMiddleware::class,
        'bidAllowedByType' => \Followback\Http\Middleware\BidAllowedByTypeMiddleware::class,
        'counterBidsLeft' => \Followback\Http\Middleware\CounterBidsLeftMiddleware::class,
        'counterBid' => \Followback\Http\Middleware\CounterBidMiddleware::class,
    ];
}
