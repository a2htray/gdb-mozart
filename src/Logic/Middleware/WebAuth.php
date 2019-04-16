<?php

namespace A2htray\GDBMozart\Logic\Middleware;

use A2htray\GDBMozart\Models\User;
use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class WebAuth
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
        $username = $request->username;
        $token = $request->get('token', null);
        $tokenInCookie = $request->cookie('token');

        Log::debug('Web auth', [
            $username,
            $token,
            $tokenInCookie,
        ]);

        if ($token != $tokenInCookie) {
            return redirect('login');
        }


        $user = User::where(['name' => $username, 'token' => $token])->first();

        if (is_null($user)) {
            return redirect('login');
        }

        Auth::setUser($user);

        return $next($request);
    }
}
