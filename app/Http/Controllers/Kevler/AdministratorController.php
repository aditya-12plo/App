<?php

namespace App\Http\Controllers\Kevler;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Response,View,Input,Auth,Session,Validator,File,Hash;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Crypt;
use DB;
use App\Models\Admins;
use App\Models\Log;

class AdministratorController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('kevler.auth');
    }



    public function index()
    {
		$this->data['title'] = 'User Access';
		$items = Admins::where('level','NOT LIKE','ADMINISTRATOR')->orderBy('id','DESC')->get();
		return view('admin.user',compact('items'))->with($this->data);
    }



public function store(Request $request)
    {
		
	
$valid = $this->validate($request, [
		'name'	=> 'required|max:255',
        'email' => 'required|email|unique:admins,email',
        'password' => 'required|max:255'
    ]);
if (!$valid)
    {
 $masuk = array(
		'name' => Input::get('name'),
        'email' => Input::get('email'),
        'password' => Hash::make(Input::get('password')),
		'suspend' => 'FALSE',
        'remember_token' => '',
        'level' => 'KARYAWAN');

Log::create(['email' => Auth::guard('kevler')->user()->email, 'table_action'=>'admins' ,'action' => 'CREATE', 'data' => json_encode($masuk)]);
$create = Admins::create($masuk);
if(!$create)
{
return redirect('/kevler/administrator')->with('error', 'Connection TimeOut');
}
else
{
return redirect('/kevler/administrator')->with('success', 'Success');
}

    }
    else
    {
return redirect('/kevler/administrator')->with('error', $valid);        
    }

    }

        public function destroy($id)
    {

  $cek = Admins::where('id', Crypt::decryptString($id))->firstOrFail();
 if(!$cek)
 {
return redirect()->back()->with('error', 'Trouble');
 }
        else
        {
Log::create(['email' => Auth::guard('kevler')->user()->email, 'table_action'=>'admins' ,'action' => 'DELETE', 'data' => json_encode($cek)]);
   $delete = Admins::where('id',Crypt::decryptString($id))->delete();
        if(!$delete)
        {
return redirect()->back()->with('error', 'Trouble');
        }
        else
        {
     return redirect('/kevler/administrator')->with('success', 'Success');
        }
    }
        }


 public function show($id)
    {
		
 $cek = Admins::findOrFail(Crypt::decryptString($id));
 if(!$cek)
 {
return redirect()->back()->with('error', 'Trouble');
 }
 else
 {
$this->data['title'] = 'Update Adminstrator';
return view('admin/user_edit',compact('cek'))->with($this->data);
 }
    }
	
	
	
	
public function update(Request $request,$id)
    {
 $cek = Admins::findOrFail(Crypt::decryptString($id));
 if(!$cek)
 {
return redirect()->back()->with('error', 'Trouble');
 }
 else
 {
if(Input::get('password') == '')
	 {
	$valid = $this->validate($request, [
        'name'	=> 'required|max:255',
        'email' => 'required|max:255|email|unique:Admins,email,'.Crypt::decryptString($id),
    ]);	 
	 }
else
 {
	$valid = $this->validate($request, [
        'name'	=> 'required|max:255',
        'email' => 'required|max:255|email5|unique:Admins,email,'.Crypt::decryptString($id),
        'password' => 'required|max:255'
    ]); 
 }

if (!$valid)
{
if(Input::get('password') == '')
	 {
   $edit = array(
        'name' =>Input::get('name'),
        'email' => Input::get('email'));
	 }
else
{
	   $edit = array(
        'name' =>Input::get('name'),
        'email' => Input::get('email'),
        'password' => Hash::make(Input::get('password')));
}			
     Log::create(['email' => Auth::guard('kevler')->user()->email, 'table_action'=>'Admins' ,'action' => 'UPDATE', 'data' => json_encode($cek)]);
   $rubah = Admins::where("id",Crypt::decryptString($id))->update($edit);
   if(!$rubah)
   {
   return redirect()->back()->with('error', 'Connection TimeOut');
   }
   else
   {
    return redirect()->back()->with('success', 'success');
 
   }
}
else
{
 return redirect()->back()->with('error', $valid);     
}
 }
    }






}
