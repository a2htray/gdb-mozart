<?php

namespace A2htray\GDBMozart\Logic\Auth;

use A2htray\GDBMozart\Models\User;
use Illuminate\Support\Facades\Log;

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
        $this->user = User::where(['name' => $this->username, 'password' => md5($this->password)])->first();
        Log::info('login by username', [md5($this->password)]);
        $this->afterLogin();

        return $this->user;
    }

    public function afterLogin()
    {
        // do nothing
    }
}
