<?php

namespace A2htray\GDBMozart\Logic\Middleware;

use A2htray\GDBMozart\Models\User;
use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ApiAuth
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
        $tokenInCookie = $request->cookie('apiToken');

        Log::debug('Api auth', [
            $tokenInCookie,
        ]);


        $user = User::where(['api_token' => $tokenInCookie])->first();

        if (is_null($user)) {
            return [
                'code' => 10003,
                'message' => 'Out of life, Pls login again',
            ];
        }

        Auth::setUser($user);

        return $next($request);
    }
}
