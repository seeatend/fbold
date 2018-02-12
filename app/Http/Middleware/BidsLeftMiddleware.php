<?php

namespace Followback\Http\Middleware;

use Closure;
use Followback\ServiceBid;

class BidsLeftMiddleware {
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $service = $request->route('service');
        $identifier = $request->route('identifier');
        if ((new ServiceBid)->countLeftBidsForSocialAccount(
                $service,
                $identifier
            ) <= 0
        ) {
            Flash::addError(
                'You have reached the limit of bids for this account.'
            );
            return redirect(route('profile_dashboard'));
        }

        return $next($request);
    }
}
