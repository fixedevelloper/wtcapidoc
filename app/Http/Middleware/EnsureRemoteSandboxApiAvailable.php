<?php

namespace App\Http\Middleware;

use App\Models\Customer;
use App\Models\User;
use App\Services\RemoteApiService;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureRemoteSandboxApiAvailable
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @return Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::user() && (Auth::user()->user_type == User::CUSTOMER_TYPE)) {
            $customer=Customer::query()->firstWhere(['user_id'=>Auth::user()->id]);
            if ($customer->activated){
                return $next($request);
            }
            notify()->error('Your account is banned. Please contact administrator','Access forbidden');
            return  redirect()->route('sandbox.login');
        }
        notify()->error('Access forbidden','WTC session abort');
        return  redirect()->route('sandbox.login');


    }
}
