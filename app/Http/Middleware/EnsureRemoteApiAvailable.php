<?php

namespace App\Http\Middleware;

use App\Services\RemoteApiService;
use Closure;
use Illuminate\Http\Request;

class EnsureRemoteApiAvailable
{
    public function handle(Request $request, Closure $next)
    {
        $api = app(RemoteApiService::class);
        $token = $api->getToken();

        if ($token) {
            return $next($request);
        }
        notify()->error('Access forbidden','WTC session abort');
        return  redirect()->route('secure.login');

    }
}
