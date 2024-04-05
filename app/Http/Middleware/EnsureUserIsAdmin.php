<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureUserIsAdmin
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check() || !Auth::user()->getIsAdminAttribute()) {
            return redirect('/dashboard')->with(['notAdmin' => true]);
        }

        return $next($request);
    }
}
