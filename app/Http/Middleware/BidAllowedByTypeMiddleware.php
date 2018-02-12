<?php

namespace Followback\Http\Middleware;

use Closure;
use SocialBid\Helpers\Facade\ServicesHelper;

class BidAllowedByTypeMiddleware {
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $service = $request->input('service');

        $service_type = $request->input('service_type');
        $username = $request->input('username');
        $bidType = $request->input('bid_type');
        $error = false;
        $userPrices = ServicesHelper::getPricesByServiceAndUsername(
            $service,
            $username
        );
        if ($bidType === 'fixed' and
            (!isset($userPrices[$service_type]['type']) or
                $userPrices[$service_type]['type'] === 'bid')
        ) {
            $error = true;
        }
        if ($bidType === 'bid' and
            (isset($userPrices[$service_type]['type']) and
                $userPrices[$service_type]['type'] === 'fixed')
        ) {
            $error = true;
        }
        if ($error) {
            Flash::addError(
                'There was problem with bid type you selected. Try again.'
            );
            return redirect(route('profile_dashboard'));
        }

        return $next($request);
    }
}
