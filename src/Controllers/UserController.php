<?php

namespace A2htray\GDBMozart\Controllers;


class UserController extends Controller
{
    public function login()
    {
        return view(PACKAGE_NAME . '::login');
    }
}
