<?php

namespace A2htray\GDBMozart\Models;

use A2htray\GDBMozart\Logic\Auth\CommonLogin;
use A2htray\GDBMozart\Logic\Auth\EmailLogin;
use A2htray\GDBMozart\Logic\Auth\LoginStrategy;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Log;

class User extends Authenticatable
{
    const LOGIN_TYPE_COMMON = 1;
    const LOGIN_TYPE_EMAIL = 2;

    use Notifiable;

    protected $table = 'mozart_user';

    /**
     * @var LoginStrategy
     */
    protected $loginStrategy;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function fetchUserByCredentials(array $credentials)
    {
        if (!isset($credentials['login_type'])) {
            // login type equal 1 means to login by username and password
            $credentials['login_type'] = static::LOGIN_TYPE_COMMON;
        }

        if (!in_array($credentials['login_type'], static::getLoginTypes())) {
            throw new \Exception('Login type must in [' . implode(',', static::getLoginTypes()) .']');
        }

        switch ($credentials['login_type']) {
            case static::LOGIN_TYPE_COMMON:
                $this->loginStrategy = new CommonLogin(
                    $credentials['username'], $credentials['password']
                );
                break;
            case static::LOGIN_TYPE_EMAIL:
                $this->loginStrategy = new EmailLogin(
                    $credentials['email'], $credentials['password']
                );
                break;
        }

        return $this->loginStrategy->login();
    }

    public static function getLoginTypes()
    {
        return [static::LOGIN_TYPE_COMMON, static::LOGIN_TYPE_EMAIL];
    }
}
