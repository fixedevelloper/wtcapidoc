<?php


namespace App\Http\Controllers\Admin;


use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Customer;
use App\Models\Gateway;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
class SecurityAdminController extends Controller
{
    public function logout(Request $request)
    {        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
    public function adminLogin(Request $request)
    {
        if ($request->method() == "POST") {
            $validator = Validator::make($request->all(), $rules = [
                'email' => ['required', 'email'],
                'password' => 'required',

            ], $messages = [
                'email.required' => 'Email field is required!',
                'password.required' => 'password  is required!',
            ]);
            if ($validator->fails()) {
                notify()->error("Email or password required", 'Request failed', ["Failed loggedIn"]);
                return redirect()->back()
                    ->withErrors($validator)->with(['message' => $messages])
                    ->withInput();
            }
            $credentials = $request->validate([
                'email' => ['required', 'email'],
                'password' => ['required'],
            ]);
            //  Auth::guard('web')->logout();
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
                notify()->success("Authentication successful", 'Request success', ["Success loggedIn"]);
                $request->session()->regenerate();

                    return redirect()->route('admin.dashboard');


            }
            notify()->error("User not found or User not activate", 'Request failed', ["Failed loggedIn"]);
            return redirect()->route('admin.login');
        }

        return view('admin.auth.login', [

        ]);
    }
    public function register(Request $request)
    {
        if ($request->method() == "POST") {
            $validator = Validator::make($request->all(), $rules = [
                'email' => ['required', 'email'],
                'name' => 'required',
                'phone' => 'required',
                'password' => 'required',

            ], $messages = [
                'email.required' => 'Email field is required!',
                'password.required' => 'password  is required!',
                'first_name.required' => 'name  is required!',
                'phone.required' => 'phone  is required!',
            ]);
            if ($validator->fails()) {
                notify()->error($validator->getException(), 'Request failed', ["Failed loggedIn"]);
                return redirect()->back()
                    ->withErrors($validator)->with(['message' => $messages])
                    ->withInput();
            }

            $user=new User();
            $user->name=$request->name;
            $user->email=$request->email;
            $user->password=bcrypt($request->password);
            $user->user_type=User::CUSTOMER_TYPE;
            $user->save();
            $customer=new Customer();
            $customer->phone=$request->phone;
            $customer->wtc_sandbox_private_key='wtc_private_sandbox'.Helper::generatApiKey();
            $customer->wtc_sandbox_secret_key='wtc_secret_sandbox'.Helper::generatApiKey();
            $customer->user_id=$user->id;
            $customer->save();

            notify()->success("User save successfull", 'Request success', ["success loggedIn"]);
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
                notify()->success("Authentication successful", 'Request success', ["Success loggedIn"]);
                $request->session()->regenerate();

                return redirect()->route('sandbox.dashboard');


            }
/*            Helper::send_creation_account([
                'email'=>$user->email,
                'first_name'=>$user->first_name,
                'activate_key'=>$user->unique_number
            ]);*/
            return redirect()->route('admin.dashboard',['putrezasetup'=>$user->unique_number]);
        }
        return view('admin.auth.register');
    }
    public function create_customer_direct(Request $request)
    {
        if ($request->method() == "POST") {
            $validator = Validator::make($request->all(), $rules = [
                'email' => ['required', 'email'],
                'name' => 'required',
                'phone' => 'required',
                'password' => 'required',
                'address' => 'required',

            ], $messages = [
                'email.required' => 'Email field is required!',
                'password.required' => 'password  is required!',
                'first_name.required' => 'name  is required!',
                'phone.required' => 'phone  is required!',
            ]);
            if ($validator->fails()) {
                foreach ($validator->errors()->all() as $error) {
                    notify()->error($error);
                }
                return redirect()->back()
                    ->withErrors($validator)->with(['message' => $messages])
                    ->withInput();
            }

            $user=new User();
            $user->name=$request->name;
            $user->email=$request->email;
            $user->password=bcrypt($request->password);
            $user->user_type=User::CUSTOMER_TYPE;
            $user->save();
            $customer=new Customer();
            $customer->phone=$request->phone;
            $customer->address=$request->address;
            $customer->wtc_sandbox_private_key='wtc_private_sandbox'.Helper::generatApiKey();
            $customer->wtc_sandbox_secret_key='wtc_secret_sandbox'.Helper::generatApiKey();
            $customer->user_id=$user->id;
            $customer->save();

            notify()->success("Customer save successfull", 'Request success', ["success loggedIn"]);
            return redirect()->route('admin.customers');
        }
        return view('admin.add.customerAdd');
    }
    public function create_gateway_manuel(Request $request)
    {
        if ($request->method() == "POST") {
            logger($request->all());
            $validator = Validator::make($request->all(), $rules = [
                'country_id' => 'required',
                'name' => 'required',
                'code' => 'required',
                'gateway' => 'required',

            ], $messages = [
                'email.required' => 'Email field is required!',
                'password.required' => 'password  is required!',
                'first_name.required' => 'name  is required!',
                'phone.required' => 'phone  is required!',
            ]);
            if ($validator->fails()) {
                foreach ($validator->errors()->all() as $error) {
                    notify()->error($error);
                }
                return redirect()->back()
                    ->withErrors($validator)->with(['message' => $messages])
                    ->withInput();
            }

            $gateway=new Gateway();
            $gateway->name=$request->name;
            $gateway->code=$request->code;
            $gateway->type=$request->type;
            $gateway->payer_code=$request->payer_code;
            $gateway->method=$request->gateway;
            $gateway->country_id=$request->country_id;
            $gateway->save();
            notify()->success("Gateway save successfull", 'Request success', ["success loggedIn"]);
            return redirect()->route('admin.gateways');
        }
        return view('admin.add.getewayAdd',[
            'countries'=>Country::all()
        ]);
    }
}
