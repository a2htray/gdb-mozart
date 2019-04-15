<?php

namespace A2htray\GDBMozart\Logic\Auth;

use A2htray\GDBMozart\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\UserProvider as AbstractUserProvider;

class UserProvider implements AbstractUserProvider
{

    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Retrieve a user by their unique identifier.
     *
     * @param  mixed $identifier
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function retrieveById($identifier)
    {
        return User::where(['id' => $identifier])->first();
    }

    /**
     * Retrieve a user by their unique identifier and "remember me" token.
     *
     * @param  mixed $identifier
     * @param  string $token
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function retrieveByToken($identifier, $token)
    {
        return User::where(['id' => $identifier, 'remember_token' => $token])->first();
    }

    /**
     * Update the "remember me" token for the given user in storage.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable $user
     * @param  string $token
     * @return void
     */
    public function updateRememberToken(Authenticatable $user, $token)
    {
        $user->setRememberToken($token);
    }

    /**
     * Retrieve a user by the given credentials.
     *
     * @param  array $credentials
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function retrieveByCredentials(array $credentials)
    {
        if (empty($credentials)) {
            return null;
        }

        $user = $this->user->fetchUserByCredentials($credentials);

        return $user;
    }

    /**
     * Validate a user against the given credentials.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable $user
     * @param  array $credentials
     * @return bool
     */
    public function validateCredentials(Authenticatable $user, array $credentials)
    {
        $identifyMatch = false;

        if ($credentials['login_type'] == User::LOGIN_TYPE_COMMON) {
            $identifyMatch = $user->getAuthIdentifier() == $credentials['username'];
        } else if ($credentials['login_type'] == User::LOGIN_TYPE_COMMON) {
            $identifyMatch = $user->email === $credentials['email'];
        }

        $passwordMatch = $user->getAuthPassword() == $credentials['password'];

        return $identifyMatch && $passwordMatch;
    }
}
