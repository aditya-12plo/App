<?php

namespace App\Http\Controllers\Kevler\Auth;

use App\Models\Admins;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{


    use RegistersUsers;

public function showRegistrationForm()
    {
        #return view('auth.register');
        return redirect('kevler/login');
    }

    
    protected $redirectTo = '/kevler';


    public function __construct()
    {
        $this->middleware('guest');
    }



    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }



    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }


           protected function guard()
    {
        return Auth::guard('kevler');
    }
}
