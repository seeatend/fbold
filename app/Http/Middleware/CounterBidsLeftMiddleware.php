<?php

namespace Followback\Http\Middleware;

use Closure;
use Followback\ServiceBid;
use SocialBid\FlashService\Facade\Flash;
use DbConfig;

class CounterBidsLeftMiddleware {
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $bidId = $request->route('id');
        $bid = ServiceBid::find($bidId);
        if (!$bid) {
            Flash::addError('Bid not found.');
            return Redirect::route('profile_dashboard');
        } elseif ($bid->counterbids_count >
            DbConfig::get('bidServices.settings.max_counterbids')
        ) {
            Flash::addError(
                'This bid can no longer be countered as limit of counters was reached.'
            );
            return redirect()->back();
        }

        return $next($request);
    }
}
