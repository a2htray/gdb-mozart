<?php

namespace A2htray\GDBMozart\Controllers;


use Illuminate\Support\Facades\Cookie;

class UserController extends Controller
{
    public function login()
    {
        return view(PACKAGE_NAME . '::login');
    }

    public function logout()
    {
        return redirect('login')
            ->withCookie(Cookie::forget('token'))
            ->withCookie(Cookie::forget('apiToken'));
    }
}
