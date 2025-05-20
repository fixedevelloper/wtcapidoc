<?php

namespace App\Http\Middleware;

use App\Models\Customer;
use App\Models\User;
use App\Services\RemoteApiService;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureRemoteApiAvailable
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::user() && (Auth::user()->user_type == User::CUSTOMER_TYPE)) {
            $customer=Customer::query()->firstWhere(['user_id'=>Auth::user()->id]);
            if ($customer->activated){
                return $next($request);
            }
            notify()->error('Your account is banned. Please contact administrator','Access forbidden');
            return  redirect()->route('secure.login');
        }
        notify()->error('Access forbidden','WTC session abort');
        return  redirect()->route('secure.login');

    }
}
