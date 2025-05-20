<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Customer;
use App\Models\WhiteListIp;
use Illuminate\Http\Request;

class SettingController extends Controller
{

    public function paymentGateway(Request $request,$id)
    {
        return view('admin.settings.mobilGateway', [
            'country'=>Country::query()->find($id)
        ]);
    }
    public function whitelistIp(Request $request)
    {
        if ($request->method()=='POST'){
            $whitelist=new WhiteListIp();
            $whitelist->customer_id=$request->customer_id;
            $whitelist->mode=$request->mode;
            $whitelist->ip=$request->ip;
            $whitelist->save();
            notify('IP whitelist successfull');
            return redirect()->route('admin.whitelistIp');
        }
        return view('admin.settings.whitelist', [
            'whitelists'=>WhiteListIp::query()->latest()->paginate(10),
            'customers'=>Customer::query()->latest()->get()
        ]);
    }
    public function removeWhitelistIp(Request $request,$id)
    {
        $whitelist=WhiteListIp::query()->find($id);
        $whitelist->delete();
        return redirect()->route('admin.whitelistIp');

    }
    public function bannedAccount(Request $request,$id)
    {
        $customer=Customer::query()->find($id);
        if ($customer->activated){
            $customer->activated=false;
        }else{
            $customer->activated=true;
        }
        $customer->save();
        return redirect()->route('admin.customers');

    }
}
