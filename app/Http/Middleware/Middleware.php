<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class Middleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
     public function handle(Request $request, Closure $next)
    {
        // Check if user is NOT authenticated
        if (!auth()->guard('admin')->check()) {
            return redirect()->route('login'); // redirect to login
        }

        return $next($request); // user is authenticated, proceed
    }
}
