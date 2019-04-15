<?php

namespace A2htray\GDBMozart\Controllers\API;

use A2htray\GDBMozart\Models\User;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LoginAPIController
{
    /**
     * @api {post} /api/login
     * @apiParam {Number} loginType
     * @apiParam {String} username
     * @apiParam {String} email
     * @apiParam {String} password
     *
     * @param Request $request
     * @param Guard $guard
     * @return array
     */
    public function __invoke(Request $request, Guard $guard)
    {
        /**
         * @var User $user
         */
        $user = User::login($request->post());
        if (is_null($user)) {
            return [
                'code' => 10002,
                'message' => 'Please check the account',
            ];
        }
        Log::info('login success', [$user]);

        $user->generateToken();
        $user->generateAPIToken();
        $user->save();

        Log::info('check the guard working', [$guard->validate($request->post())]);
        Log::info('get the auth user, may be', [Auth::user()]);

        return [
            'code' => 200,
            'data' => [
                'name' => $user->name,
                'email' => $user->email,
                'token' => $user->token,
                'apiToken' => $user->api_token,
            ],
        ];
    }
}
