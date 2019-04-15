<?php
/**
 * Created by PhpStorm.
 * User: yuanjianyu
 * Date: 2019/4/15
 * Time: 19:27
 */

namespace A2htray\GDBMozart\Logic\Params;


interface ParamValidate
{
    public function validate();
    public function getErrors();
}
