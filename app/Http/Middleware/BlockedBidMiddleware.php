<?php

namespace Followback\Http\Middleware;

use Closure;
use Sentry;
use SocialBid\FlashService\Facade\Flash;

class BlockedBidMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $service = $request->route('service');

        if(Sentry::getUser()->isBlockedBySocialIdentifier($service, $request->route('identifier'))){
            Flash::addError('You have been blocked by the user you are trying to bid for.');
            return \Redirect::route('profile_dashboard');
        }

        return $next($request);
    }
}
