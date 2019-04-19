<?php

namespace A2htray\GDBMozart\Logic\Params;


use Illuminate\Support\Facades\Validator;

class UpdateOrDeleteParam extends Param implements ParamValidate
{
    public function validate()
    {
        $validator = Validator::make($this->request->post(), [
            'id' => 'required',
        ], [
            'id.required' => 'The resource does not exist',
        ]);

        if ($validator->fails()) {
            $this->errors = $validator->errors();
            return false;
        }

        return true;
    }
}
