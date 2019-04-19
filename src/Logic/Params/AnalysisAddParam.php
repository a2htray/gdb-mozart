<?php

namespace A2htray\GDBMozart\Logic\Params;


use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class AnalysisAddParam extends Param implements ParamValidate
{
    public function validate()
    {
        $validator = Validator::make($this->request->post(), [
            'name' => 'required|string|min:6',
            'program' => 'required|string|min:6',
            'programVersion' => 'required|min:3',
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
//        dd($this->request->post());
        Log::debug('AnalysisAddParam', $this->request->post());
        if ($validator->fails()) {
            Log::debug('AnalysisAddParam1', $this->request->post());
            $this->errors = $validator->errors();
            return false;
        }

        return true;
    }
}
