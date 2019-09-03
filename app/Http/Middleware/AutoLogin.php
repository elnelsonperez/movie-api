<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;

class AutoLogin
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
        Auth::login(User::all()->first());
        return $next($request);
    }
}
