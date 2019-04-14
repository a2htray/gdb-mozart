<?php

namespace A2htray\GDBMozart\Logic\Auth;

use A2htray\GDBMozart\Models\User;

class CommonLogin implements LoginStrategy
{
    private $username;
    private $password;
    private $user = null;

    public function __construct(string $username, $password)
    {
        $this->username = $username;
        $this->password = $password;
    }

    public function login()
    {
        $this->user = User::where(['email' => $this->username, 'password' => md5($this->password)])->first();
        $this->afterLogin();

        return $this->user;
    }

    public function afterLogin()
    {
        // do nothing
    }
}