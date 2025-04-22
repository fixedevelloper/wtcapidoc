<?php

namespace App\Http\Middleware;

use App\Services\RemoteApiService;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureRemoteSandboxApiAvailable
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $api = app(RemoteApiService::class);
        $token = $api->getToken();

        if ($token) {
            return $next($request);
        }
        notify()->error('Access forbidden','WTC session abort');
        return  redirect()->route('sandbox.login');


    }
}
