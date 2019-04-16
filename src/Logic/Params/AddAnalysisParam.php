<?php

namespace A2htray\GDBMozart\Logic\Params;


use Illuminate\Support\Facades\Validator;

class AddAnalysisParam extends Param implements ParamValidate
{
    public function validate()
    {
        $validator = Validator::make($this->request->post(), [
            'name' => 'required',
            'program' => 'required',
            'programVersion' => 'required',
            'executedAt' => [
                'required',
                'date',
            ]

        ], [
            'name.required' => 'The name of a analysis is required',
            'program.required' => 'The name of a program is required',
            'programVersion.required' => 'The version of a program is required',
            'executedAt.required' => 'The execute time is required',
            'executedAt.data' => 'The format of execute time is invalid'
        ]);

        if ($validator->failed()) {
            $this->errors = $validator->errors();
            return false;
        }

        return true;
    }
}