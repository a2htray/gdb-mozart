<?php

namespace A2htray\GDBMozart\Logic\Params;


use A2htray\GDBMozart\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class LoginParam extends Param implements ParamValidate
{

    public function __construct(Request $request)
    {
        parent::__construct($request);
    }

    public function getErrors()
    {
        return $this->errors;
    }

    public function validate()
    {
        $validator = Validator::make($this->request->all(), [
            'loginType' => [
                'required',
                Rule::in(User::getLoginTypes())
            ],
            'password' => [
                'required',
                'regex:/^[a-zA-Z0-9]\w{5,17}$/',
            ],
            'username' => [
                'regex:/^[a-zA-Z0-9_-]{5,10}$/',
                'required_without_all:email'
            ],
            'email' => [
                'regex:/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/',
                'required_without_all:username'
            ]
        ], [
            'loginType.required' => 'The type of login action is required',
            'loginType.in' => 'The login action will be either username or email',
            'password.required' => 'The password is required',
            'required_without_all' => 'Either username or email should be provided',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            $this->errors = $errors->get($errors->keys()[0])[0];
            return false;
        }
        return true;
    }
}
