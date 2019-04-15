<?php
/**
 * Created by PhpStorm.
 * User: yuanjianyu
 * Date: 2019/4/15
 * Time: 22:27
 */

namespace A2htray\GDBMozart\Logic\Auth\Guard;


use A2htray\GDBMozart\Logic\Auth\UserProvider;
use A2htray\GDBMozart\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;

class XTokenGuard implements Guard
{

    protected $request;
    protected $provider;
    protected $user;

    public function __construct(UserProvider $userProvider, Request $request)
    {
        $this->request = $request;
        $this->provider = $userProvider;
        $this->user = null;
    }

    /**
     * Determine if the current user is authenticated.
     *
     * @return bool
     */
    public function check()
    {
        return !is_null($this->user());
    }

    /**
     * Determine if the current user is a guest.
     *
     * @return bool
     */
    public function guest()
    {
        return !$this->check();
    }

    /**
     * Get the currently authenticated user.
     *
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function user()
    {
        if (!is_null($this->user)) {
            return $this->user;
        }
        return null;
    }

    /**
     * Get the ID for the currently authenticated user.
     *
     * @return int|null
     */
    public function id()
    {
        return $this->user()->getAuthIdentifier();
    }

    /**
     * Validate a user's credentials.
     *
     * @param  array $credentials
     * @return bool
     */
    public function validate(array $credentials = [])
    {
        $user = User::where(['token' => $this->request->post('x-token')])->first();
        if (is_null($user)) {
            return false;
        }
        $this->user = $user;

        return true;
    }

    /**
     * Set the current user.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable $user
     * @return null
     */
    public function setUser(Authenticatable $user)
    {
        $this->user = $user;
        return $this;
    }
}
