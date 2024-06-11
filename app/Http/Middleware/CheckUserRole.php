<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUserRole
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // Check if user is authenticated
        if (Auth::check()) {
            // Get user's role
            $userRole = Auth::user()->role;

            // Check if user's role is not in allowed roles
            if (in_array($userRole, $roles)) {
                return $next($request);
            }
        }

        // Redirect user based on role
        if (Auth::check() && Auth::user()->role === 'user') {
            // Redirect user to unauthorized page or homepage
            return redirect()->route('unauthorized');
        }

        // Redirect guest to login page
        return redirect()->route('login');
    }
}
