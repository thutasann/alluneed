<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;


class UserMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // banned or unbanned
        if (Auth::check() && Auth::user()->isban)
        {
            $banned = Auth::user()->isban == "1";
            Auth::logout();

            if ($banned == 1) {
                $message = 'Your account has been Banned. Please contact Administrator.';
            }
            return redirect()->route('login')
                            ->with('status', $message)
                            ->withErrors(['email' => 'Your account has been Banned. Please contact Administrator.']);
        }


        // user online detect
        if (Auth::check())
        {
            $expiresAt = Carbon::now()->addMinutes(1);
            Cache::put('user-is-online' . Auth::user()->id, true, $expiresAt);
        }
        return $next($request);
    }
}
