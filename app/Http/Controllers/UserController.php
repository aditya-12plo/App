<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;


use Response,View,Input,Auth,Session,Validator,File,Hash;
use App\Http\Requests;
use JWTAuth;
use App\Models\User;
use JWTAuthException;
class UserController extends Controller
{   

    private $user;
    public function __construct(User $user){
        $this->user = $user;
    }
   

    public function login(Request $request){
	
        $credentials = $request->only('username', 'password');
        $token = null;
        try {
           if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json(['success' => false, 'error' => 'These credentials do not match our records.'], 401);
           }
        } catch (JWTAuthException $e) {
            return response()->json(['success' => false, 'error' => 'could_not_create_token'], 500);
        }
        return response()->json(['token'=> $token]);
		
    }
	
	    public function logout(Request $request) {
        $this->validate($request, ['token' => 'required']);
        try {
            JWTAuth::invalidate($request->input('token'));
            return response()->json(['success' => true]);
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json(['success' => false, 'error' => 'Failed to logout, please try again.'], 500);
        }
    }

    public function getAuthUser(Request $request){
        $user = JWTAuth::toUser($request->token);
        return response()->json(['result' => $user]);
    }

}  