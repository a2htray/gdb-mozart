<?php

namespace A2htray\GDBMozart\Logic\Params;


use A2htray\GDBMozart\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class SubmitOboFileParam extends Param implements ParamValidate
{
    private $errors;

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
            'vocabularyName' => [
                'required',
            ],
            'remoteUrl' => [
                'required_without_all:localUrl'
            ],
            'localUrl' => [
                'required_without_all:remoteUrl'
            ]
        ], [
            'vocabularyName.required' => 'The name of vocabulary is required',
            'required_without_all' => 'Either a remote url or a local file path should be provided',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            $this->errors = $errors->get($errors->keys()[0])[0];
            return false;
        }
        return true;
    }
}
