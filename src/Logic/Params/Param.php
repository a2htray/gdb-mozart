<?php

namespace A2htray\GDBMozart\Logic\Params;


use Illuminate\Http\Request;

class Param implements ParamValidate
{
    protected $errors;
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function getErrors()
    {
        return $this->errors;
    }

    public function validate()
    {
        throw new \Exception('It must be implemented');
    }
}
