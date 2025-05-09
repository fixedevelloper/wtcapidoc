<?php

namespace App\Http\Middleware;

use App\Helpers\api\Helpers;
use App\Helpers\Helper;
use App\Models\WhiteListIp;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RestrictIpAddressSandbox
{
    public function handle(Request $request, Closure $next)
    {
        $whitelistedIps=WhiteListIp::query()->firstWhere(['ip'=>$request->ip(),'mode'=>Helper::TYPESANDBOX]);
        if (is_null($whitelistedIps)) {
            return Helpers::unauthorized([
                'ip'=>$request->ip()
            ],'Access denied. Unauthorized IP address.');
        }

        return $next($request);
    }
}
