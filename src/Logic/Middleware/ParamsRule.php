<?php

namespace A2htray\GDBMozart\Logic\Middleware;

use A2htray\GDBMozart\Logic\Params\Param;
use Closure;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;

class ParamsRule
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $paramName)
    {
        $cls = 'A2htray\GDBMozart\Logic\Params\\' . ucfirst($paramName) . 'Param';
        /**
         * @var Param $param
         */
        $param = new $cls($request);
        if ($param->validate()) {
            Log::debug('ParamsRule', [__FILE__, __LINE__]);
            return $next($request);
        } else {
            return [
                'code' => 10004,
                'message' => Arr::collapse($param->getErrors()->toArray()),
            ];
        }
    }
}
