<?php

namespace App\Http\Controllers\Kevler;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Response,View,Input,Auth,Session,Validator,File,Hash;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Crypt;
use DB;
use App\Models\Broker;
use App\Models\User;
use App\Models\Log;

class BrokersController extends Controller
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



    public function index(Request $request)
    {
$sort = $request->sort;
        $sort = explode('|', $sort);
        $sortBy = $sort[0];
        $sortDirection = $sort[1];
        $perPage = $request->per_page;
        $search = $request->filter;
		
         $query = Broker::orderBy('id', 'DESC');
        if ($search) {
            $like = "%{$search}%";
            $query = $query->where('name', 'LIKE', $like)
			->orWhere('username','LIKE',$like)
			->orWhere('broker_code','LIKE',$like);
        }
     return $query->paginate($perPage);

    }
	
	
	 public function GetBroker()
    {
$databroker = Broker::select('broker_code')->get();
$cek = DB::connection('sqlsrv')
 ->table('ListBrokerCode')
 ->select('CLEARING_CODE','BROKER_NAME')
 ->whereNotIn('CLEARING_CODE',$databroker)
 ->get();
      return response()->json($cek);
    }



public function store(Request $request)
    {
		$valid = $this->validate($request, [
        'broker_code' => 'required|unique:broker,broker_code',
        'username' => 'required|without_spaces|max:100|unique:broker,username',
        'name' => 'required|max:255',
        'password' => 'required|max:255'
    ]);
if (!$valid)
    {
	 $masuk = array(
        'broker_code' =>Input::get('broker_code'),
        'username' => Input::get('username'),
        'name' => Input::get('name'),
        'password' => Hash::make(Input::get('password')),
        'activation_key' => 'false');
Log::create(['email' => Auth::guard('kevler')->user()->email, 'table_action'=>'broker' ,'action' => 'CREATE', 'data' => json_encode($masuk)]);
Broker::create($masuk);	
return response()->json('success');		
	}
	else
	{
		return response()->json('error', $valid); 
	}
    }

        public function destroy($id)
    {
$cek = Broker::findOrFail($id);
		  if(!$cek)
 {
return response()->json('error');
 }
 else
 {
Log::create(['email' => Auth::guard('kevler')->user()->email, 'table_action'=>'broker' ,'action' => 'DELETE', 'data' => json_encode($cek)]);
Broker::where('id',$id)->delete();
return response()->json('success');
 }
    }


	
	
public function update(Request $request,$id)
    {
	$cek = Broker::findOrFail($id);
		  if(!$cek)
 {
return response()->json('error');
 }
 else
 {
if(!Input::get('broker_code'))
{
if(!Input::get('password'))
{
$valid = $this->validate($request, [
        'username' => 'required|max:100|unique:broker,username,'.$id
    ]);	
		 $edit = array(
        'username' => Input::get('username'));
}
else
{
$valid = $this->validate($request, [
        'username' => 'required|without_spaces|max:100|unique:broker,username,'.$id,
        'password' => 'required|max:255'
    ]);	
		 $edit = array(
        'username' => Input::get('username'),
        'password' => Hash::make(Input::get('password')),
        'activation_key' => 'false');
}
if (!$valid)
    {
Log::create(['email' => Auth::guard('kevler')->user()->email, 'table_action'=>'broker' ,'action' => 'UPDATE', 'data' => json_encode($edit)]);
Broker::where("id",$id)->update($edit);	
return response()->json('success');		
	}
	else
	{
		return response()->json('error', $valid); 
	}
}
else
{
if(!Input::get('password'))
{
$valid = $this->validate($request, [
		'broker_code' => 'required|unique:broker,broker_code,'.$id,
        'username' => 'required|without_spaces|max:100|unique:broker,username,'.$id,
        'name' => 'required|max:255',
    ]);	
		 $edit = array(
        'broker_code' =>Input::get('broker_code'),
        'username' => Input::get('username'),
        'name' => Input::get('name'));
}
else
{
$valid = $this->validate($request, [
        'broker_code' => 'required|unique:broker,broker_code,'.$id,
        'username' => 'required|without_spaces|max:100|unique:broker,username,'.$id,
		'name' => 'required|max:255',
        'password' => 'required|max:255'
    ]);	
		 $edit = array(
        'broker_code' =>Input::get('broker_code'),
        'username' => Input::get('username'),
        'name' => Input::get('name'),
        'password' => Hash::make(Input::get('password')),
        'activation_key' => 'false');
}
	if (!$valid)
    {
Log::create(['email' => Auth::guard('kevler')->user()->email, 'table_action'=>'broker' ,'action' => 'UPDATE', 'data' => json_encode($edit)]);
Broker::where("id",$id)->update($edit);	
return response()->json('success');		
	}
	else
	{
		return response()->json('error', $valid); 
	}
}
 }	 
    }






}
