<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
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
        // Check if the user is authenticated and an admin
        if (Auth::check() && Auth::user()->is_admin == 1) {
            return $next($request);
        }

        // If not an admin, redirect to a specific page or show an error
        abort(403, 'Unauthorized');
    }
}

