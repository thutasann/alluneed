<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{

    public function handle(Request $request, Closure $next)
    {
        if (Auth::user()->role_as == 'admin') {
            return $next($request);
        } else {
            return redirect('/home')->with('status', 'You are not allowed to access the dashboard!');
        }
    }
}
