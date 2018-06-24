<?php

namespace App\Http\Controllers\Driver\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
//Auth Facade
use Illuminate\Support\Facades\Auth;

//Password driver Facade
use Illuminate\Support\Facades\Password;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/driver';



public function showResetForm(Request $request, $token = null)
    {
        return view('driver.auth.passwords.reset')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

      //returns Password pialang of pialang
    public function driver()
    {
        return Password::driver('drivers');
    }

    //returns authentication guard of seller
    protected function guard()
    {
        return Auth::guard('driver');
    }


}
