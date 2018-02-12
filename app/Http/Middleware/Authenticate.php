<?php

namespace Followback\Http\Middleware;

use Cartalyst\Sentry\Sentry;
use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Cookie;

class Authenticate {
    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * Create a new filter instance.
     *
     * @param Sentry $auth
     */
    public function __construct(Sentry $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param null|string $permission Permission to check for
     * @return mixed
     */
    public function handle($request, Closure $next, $permission = null)
    {
        if (!$this->auth->check()) {

            $is_redirect = array('is_redirect' => '1');
            $inputs = array_merge($request->input(), $is_redirect);
            Cookie::queue('profile_form_cookie', $inputs, 1000);

            if ($request->ajax()) {

                return response('Unauthorized.', 401);

            } else {

                return redirect()->guest('login');

            }

        }

        if ($permission === 'admin') {
            if (!$this->auth->getUser()->hasAccess('admin')) {
                $is_redirect = array('is_redirect' => '1');
                $inputs = array_merge($request->input(), $is_redirect);
                Cookie::queue('profile_form_cookie', $inputs, 1000);

                if ($request->ajax()) {

                    return response('Unauthorized.', 401);

                } else {

                    return redirect()->guest('login');

                }
            }
        }

        return $next($request);
    }
}
