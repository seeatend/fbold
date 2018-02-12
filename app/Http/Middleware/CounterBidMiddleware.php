<?php

namespace Followback\Http\Middleware;

use Closure;
use Followback\ServiceBid;
use SocialBid\FlashService\Facade\Flash;

class CounterBidMiddleware
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
        $bidId = $request->route('bidId');
        $bid = ServiceBid::find($bidId);
        if(!$bid or $bid->bid_type !=='bid' or !in_array($bid->status,[ServiceBid::STATUS_COUNTERED_BY_CREATOR, ServiceBid::STATUS_COUNTERED_BY_RECEIVER])){
            Flash::addError('Counter actions can not be made on this bid.');
            return redirect()->route('bid_list');
        }

        return $next($request);
    }
}
