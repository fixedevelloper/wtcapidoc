<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Customer;
use Illuminate\Http\Request;

class SettingController extends Controller
{

    public function paymentGateway(Request $request,$id)
    {
        return view('admin.settings.mobilGateway', [
            'country'=>Country::query()->find($id)
        ]);
    }
}
