<?php


namespace App\Http\Controllers\Secure;


use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
class SecuritySecureController extends Controller
{
    public function secureLogin(Request $request)
    {
        session(['mode' => 'secure']);

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

                    return redirect()->route('secure.dashboard');


            }
            notify()->error("User not found or User not activate", 'Request failed', ["Failed loggedIn"]);
            return redirect()->route('secure.login');
        }

        return view('secure.auth.login', [

        ]);
    }
    public function logout(Request $request)
    {

        return  redirect()->route('sandbox.login');
    }
}
