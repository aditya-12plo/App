<?php

namespace App\Http\Controllers\Driver\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use App\Models\driver;


class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;


        public function showLinkRequestForm()
    {
         return redirect('pagenotfound');
    }

        //Password driver for admins Model
    public function driver()
    {
         return Password::driver('drivers');
    }
public function __construct()
    {
        $this->middleware('guest');
    }
public function sendResetLinkEmail(Request $request)
{
    $this->validate($request, ['email' => 'required|email']);
    $user_check = driver::where('email', $request->email)->first();
if(!$user_check)
{
 return back()->with('status', 'These credentials do not match our records.');
}
else
{

    if ($user_check->suspend == 'TRUE') {
        return back()->with('status', 'Your account is not activated. Please activate it first.');
    } else {
        $response = $this->driver()->sendResetLink(
            $request->only('email')
        );

        if ($response === Password::RESET_LINK_SENT) {
            return back()->with('status', trans($response));
        }

        return back()->withErrors(
            ['email' => trans($response)]
        );
    }
    }
} 


}
