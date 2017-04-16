<?php

namespace Inayat\Http\Middleware;

use Closure;

class Admin
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
        if (is_null($request->user())) {
            return redirect('/');
        }

        if (!($request->user()->isAdmin())) {
            return redirect('dashboard');
        }

        return $next($request);
    }
}
