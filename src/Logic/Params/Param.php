<?php

namespace A2htray\GDBMozart\Logic\Params;


use Illuminate\Http\Request;

class Param
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }
}
