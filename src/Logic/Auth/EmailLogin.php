<?php

namespace A2htray\GDBMozart\Logic\Auth;


use A2htray\GDBMozart\Models\User;

class EmailLogin implements LoginStrategy
{
    private $email;
    private $password;
    private $user = null;

    public function __construct(string $email, string $password)
    {
        $this->email = $email;
        $this->password = $password;
    }

    public function login()
    {
        $this->user = User::where(['email' => $this->email, 'password' => md5($this->password)])->first();
        $this->afterLogin();

        return $this->user;
    }

    public function afterLogin()
    {
        // TODO: Implement afterLogin() method.
    }
}