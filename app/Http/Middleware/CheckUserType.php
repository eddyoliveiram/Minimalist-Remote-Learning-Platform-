<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckUserType
{
    public function handle($request, Closure $next, $userType)
    {
        if (!Auth::check() || Auth::user()->user_type !== $userType) {
            abort(403, 'Unauthorized');
        }

        return $next($request);
    }
}

