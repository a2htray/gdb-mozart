<?php

namespace A2htray\GDBMozart\Models;

use A2htray\GDBMozart\Logic\Auth\CommonLogin;
use A2htray\GDBMozart\Logic\Auth\EmailLogin;
use A2htray\GDBMozart\Logic\Auth\LoginStrategy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class User extends Model implements AuthenticatableContract
{
    use Notifiable;

    const LOGIN_TYPE_COMMON = 1;
    const LOGIN_TYPE_EMAIL = 2;

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

    public static function login(array $credentials)
    {
        $user = new User();
        return $user->fetchUserByCredentials($credentials);
    }

    public function fetchUserByCredentials(array $credentials)
    {
        if (!isset($credentials['loginType'])) {
            // login type equal 1 means to login by username and password
            $credentials['loginType'] = static::LOGIN_TYPE_COMMON;
        }

        if (!in_array($credentials['loginType'], static::getLoginTypes())) {
            throw new \Exception('Login type must in [' . implode(',', static::getLoginTypes()) .']');
        }

        switch ($credentials['loginType']) {
            case static::LOGIN_TYPE_COMMON:
                Log::info('login by username', $credentials);
                $this->loginStrategy = new CommonLogin(
                    $credentials['username'], $credentials['password']
                );
                break;
            case static::LOGIN_TYPE_EMAIL:
                Log::info('login by email', $credentials);
                $this->loginStrategy = new EmailLogin(
                    $credentials['email'], $credentials['password']
                );
                break;
        }

        return $this->loginStrategy->login();
    }

    public function generateToken() {
        $this->token = md5(Str::random(6));
    }

    public function generateAPIToken()
    {
        $this->api_token = md5(Str::random(6));
    }

    public static function getLoginTypes()
    {
        return [static::LOGIN_TYPE_COMMON, static::LOGIN_TYPE_EMAIL];
    }

    /**
     * Get the name of the unique identifier for the user.
     *
     * @return string
     */
    public function getAuthIdentifierName()
    {
        return $this->primaryKey;
    }

    /**
     * Get the unique identifier for the user.
     *
     * @return mixed
     */
    public function getAuthIdentifier()
    {
        return $this->{$this->getAuthIdentifierName()};
    }

    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->password;
    }

    /**
     * Get the token value for the "remember me" session.
     *
     * @return string
     */
    public function getRememberToken()
    {
        return $this->{$this->getRememberTokenName()};
    }

    /**
     * Set the token value for the "remember me" session.
     *
     * @param  string $value
     * @return void
     */
    public function setRememberToken($value)
    {
        $this->{$this->getRememberTokenName()} = $value;
    }

    /**
     * Get the column name for the "remember me" token.
     *
     * @return string
     */
    public function getRememberTokenName()
    {
        return 'remember_token';
    }
}
