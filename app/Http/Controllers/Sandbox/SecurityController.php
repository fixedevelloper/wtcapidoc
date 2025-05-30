<?php


namespace App\Http\Controllers\Sandbox;


use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
class SecurityController extends Controller
{
    public function logout(Request $request)
    {        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->back();
    }
    public function sandboxLogin(Request $request)
    {
        session(['mode' => 'sandbox']);

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
                    return redirect()->route('sandbox.dashboard');
            }
            notify()->error("User not found or User not activate", 'Request failed', ["Failed loggedIn"]);
            return redirect()->route('sandbox.login');
        }

        return view('sandbox.auth.login', [

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
            return redirect()->route('sandbox.dashboard',['putrezasetup'=>$user->unique_number]);
        }
        return view('sandbox.auth.register');
    }
    public function sandboxAutoLogin(Request $request)
    {

        Auth::guard('web')->logout();

            if (Auth::attempt(['email' => Session::get('auth_email'), 'password' => Session::get('auth_password')], $request->remember)) {
                notify()->success("Authentication successful", 'Request success', ["Success loggedIn"]);
                $request->session()->regenerate();
                return redirect()->route('secure.dashboard');
            }
            notify()->error("User not found or User not activate", 'Request failed', ["Failed loggedIn"]);
            return redirect()->route('secure.login');

    }
}
