<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Activated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (
            Auth::user()->is_admin == '1' && Auth::user()->status == '1'
            || Auth::user()->is_admin == '0' && Auth::user()->status == '1'
        )
        {
            return $next($request);
        }

        return redirect('/')->with('status', 'Your account is blocked');
    }
}
