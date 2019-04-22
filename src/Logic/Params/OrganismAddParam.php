<?php

namespace A2htray\GDBMozart\Logic\Params;


use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class OrganismAddParam extends Param implements ParamValidate
{
    public function validate()
    {
        $validator = Validator::make($this->request->post(), [
            'genus' => 'required|string|min:2',
            'specie' => 'required|string|min:2',
            'imageFile' => 'max:500000',
        ]);
//        dd($this->request->method());
        Log::debug('OrganismAddParam', $this->request->post());
        if ($validator->fails()) {
            Log::debug('OrganismAddParam', $this->request->post());
            $this->errors = $validator->errors();
            return false;
        }

        return true;
    }
}
