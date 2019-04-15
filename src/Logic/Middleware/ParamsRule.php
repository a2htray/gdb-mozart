<?php

namespace A2htray\GDBMozart\Logic\Middleware;

use Closure;
use Illuminate\Support\Facades\App;

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
        $params = new $cls($request);

        if ($params->validate()) {
            return $next($request);
        } else {
            return [
                'code' => 10004,
                'message' => $params->getErrors(),
            ];
        }
    }
}
