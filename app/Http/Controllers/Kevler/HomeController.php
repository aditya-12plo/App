<?php

namespace App\Http\Controllers\Kevler;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Response,View,Input,Auth,Session,Validator,File,Hash,DB;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Crypt;
use PDF;
use Excel;
use App\Models\Admins;
use App\Models\Log;
use App\Models\Broker;

class HomeController extends Controller
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
        return view('admin.home');
    }

		// get user profile
    public function get_profile()
    {
      $cek = Admins::findOrFail(Auth::guard('kevler')->user()->id);
      return response()->json($cek);
    }

	
	// update name admin profile
    public function q_UpdateName(Request $request)
    {

$valid = $this->validate($request, [
        'name' => 'required|max:255'
    ]);
if (!$valid)
    {
$edit = array('name' => $request->name);
Admins::where("id",Auth::guard('kevler')->user()->id)->update($edit);

return response()->json('success');

    }
else
    {
 return response()->json('error', $valid);
    }

    }
	
	
	
	// update admin update password
    public function q_UpdatePassword(Request $request)
    {

$valid = $this->validate($request, [
        'password' => 'required|max:255',
        'password_confirmation' => 'required|max:255|same:password'
    ]);
if (!$valid)
    {
$edit = array('password' => Hash::make($request->password));
Admins::where("id",Auth::guard('kevler')->user()->id)->update($edit);

return response()->json('success');

    }
else
    {
 return response()->json('error', $valid);
    }

    }
	
	// administrator list
    public function get_administrator(Request $request)
    {
		if(Auth::guard('kevler')->user()->level == 'ADMINISTRATOR')
		{
$sort = $request->sort;
        $sort = explode('|', $sort);
        $sortBy = $sort[0];
        $sortDirection = $sort[1];
        $perPage = $request->per_page;
        $search = $request->filter;
		
         $query = Admins::where('level','NOT LIKE','ADMINISTRATOR')->orderBy('id', 'DESC');
        if ($search) {
            $like = "%{$search}%";
            $query = $query->where('name', 'LIKE', $like)
			->orWhere('email','LIKE',$like);
        }
     return $query->paginate($perPage);		
		}
		else
		{
		return redirect('kevler');	
		}
    }
	
	
	//add new administrator
	public function add_administrator(Request $request)
    {
				if(Auth::guard('kevler')->user()->level == 'ADMINISTRATOR')
		{
$valid = $this->validate($request, [
		'name'	=> 'required|max:255',
        'email' => 'required|email|unique:admins,email',
        'suspend' => 'in:TRUE,FALSE',
        'password' => 'required|max:255'
    ]);
if (!$valid)
    {
 $masuk = array(
		'name' => Input::get('name'),
        'email' => Input::get('email'),
        'password' => Hash::make(Input::get('password')),
		'suspend' => Input::get('suspend'),
        'remember_token' => '',
        'level' => 'KARYAWAN');

Log::create(['email' => Auth::guard('kevler')->user()->email, 'table_action'=>'admins' ,'action' => 'CREATE', 'data' => json_encode($masuk)]);
Admins::create($masuk);

return response()->json('success');
    }
    else
    {
 return response()->json('error', $valid);      
    }
}
		else
		{
		return redirect('kevler');	
		}
    }
	
	
	//update administrator
	public function update_administrator(Request $request, $id)
    {
						if(Auth::guard('kevler')->user()->level == 'ADMINISTRATOR')
		{
		 $cek = Admins::findOrFail($id);
 if(!$cek)
 {
return response()->json('error');
 }
 else
 {
if(Input::get('password') == '')
{
	$valid = $this->validate($request, [
		'name'	=> 'required|max:255',
        'email' => 'required|email|unique:admins,email,'.$id,
        'suspend' => 'in:TRUE,FALSE'
    ]);
}
else
{
	$valid = $this->validate($request, [
		'name'	=> 'required|max:255',
        'email' => 'required|email|unique:admins,email,'.$id,
        'suspend' => 'in:TRUE,FALSE',
        'password' => 'required|max:255'
    ]);
}

if (!$valid)
    {
		if(Input::get('password') == '')
{
	 $edit = array(
		'name' => Input::get('name'),
        'email' => Input::get('email'),
		'suspend' => Input::get('suspend'));
}
else
{
 $edit = array(
		'name' => Input::get('name'),
        'email' => Input::get('email'),
        'password' => Hash::make(Input::get('password')),
		'suspend' => Input::get('suspend'));	
}


Log::create(['email' => Auth::guard('kevler')->user()->email, 'table_action'=>'admins' ,'action' => 'UPDATE', 'data' => json_encode($cek)]);
Admins::where("id",$id)->update($edit);
return response()->json('success');
    }
    else
    {
 return response()->json('error', $valid);      
    }
 }
  }
    else
    {
 return response()->json('error', $valid);      
    }
    }
	
	
	  public function delete_administrator($id)
    {
						if(Auth::guard('kevler')->user()->level == 'ADMINISTRATOR')
		{
  $cek = Admins::findOrFail($id);
 if(!$cek)
 {
return response()->json('error');
 }
        else
        {
Log::create(['email' => Auth::guard('kevler')->user()->email, 'table_action'=>'admins' ,'action' => 'DELETE', 'data' => json_encode($cek)]);
Admins::where('id',$id)->delete();
return response()->json('success');
    }
	  }
    else
    {
 return response()->json('error', $valid);      
    }
        }
		
		
		    public function view_transactions()
    {
		$broker = DB::connection('sqlsrv')
 ->table('ListBrokerCode')
 ->select('CLEARING_CODE','BROKER_NAME')
 ->get();
        return view('admin.download',compact('broker'));
    }
		
		
		public function download(Request $request)
    {
		$from = Input::get('from');
		$to = Input::get('to');
		$broker = Input::get('broker');
		$client = Input::get('client');
		if(!$from && !$to && !$broker && !$client)
		{
	return redirect()->back()->with('error', 'From Masih Kosong');
		}
		else
		{
			if($from && !$to && !$broker && !$client)
			{
				$date = explode ('/', $from);
			$tglMin = $date[2].'-'.$date[1].'-'.$date[0];
		 $data = DB::connection('sqlsrv')->table('DataTransaksiFull')->select('BROKER_CODE', 'COMMODITY_NAME','TRADE_DATE2','TRADE_TIME', 'PRICE' , 'LOT' , 'CA' , 'BS')
		 ->whereDate('TRADE_DATE', '=',$tglMin)
		 ->orderBy('TRADE_DATE','DESC')->get();
			}
			elseif(!$from && $to && !$broker && !$client)
			{
				$date = explode ('/', $to);
			$tglMin = $date[2].'-'.$date[1].'-'.$date[0];
		 $data = DB::connection('sqlsrv')->table('DataTransaksiFull')->select('BROKER_CODE', 'COMMODITY_NAME','TRADE_DATE2','TRADE_TIME', 'PRICE' , 'LOT' , 'CA' , 'BS')
		 ->whereDate('TRADE_DATE', '=',$tglMin)
		 ->orderBy('TRADE_DATE','DESC')->get();
			}
			elseif($from && $to && !$broker && !$client)
			{
			$date = explode ('/', $from);
			$tglMin = $date[2].'-'.$date[1].'-'.$date[0];
			$date2 = explode ('/', $to);
			$tglMax = $date2[2].'-'.$date2[1].'-'.$date2[0];
		 $data = DB::connection('sqlsrv')->table('DataTransaksiFull')->select('BROKER_CODE', 'COMMODITY_NAME','TRADE_DATE2','TRADE_TIME', 'PRICE' , 'LOT' , 'CA' , 'BS')
		 ->whereDate('TRADE_DATE','>=',$tglMin)->whereDate('TRADE_DATE','<=',$tglMax)
		 ->orderBy('TRADE_DATE','DESC')->get();
			}
			elseif($from && !$to && $broker && !$client)
			{
		$date = explode ('/', $from);
			$tglMin = $date[2].'-'.$date[1].'-'.$date[0];
		 $data = DB::connection('sqlsrv')->table('DataTransaksiFull')->select('BROKER_CODE', 'COMMODITY_NAME','TRADE_DATE2','TRADE_TIME', 'PRICE' , 'LOT' , 'CA' , 'BS')
		 ->where('BROKER_CODE', '=',$broker)
		 ->whereDate('TRADE_DATE', '=',$tglMin)
		 ->orderBy('TRADE_DATE','DESC')->get();
			}
			elseif($from && !$to && !$broker && $client)
			{
		$date = explode ('/', $from);
			$tglMin = $date[2].'-'.$date[1].'-'.$date[0];
		 $data = DB::connection('sqlsrv')->table('DataTransaksiFull')->select('BROKER_CODE', 'COMMODITY_NAME','TRADE_DATE2','TRADE_TIME', 'PRICE' , 'LOT' , 'CA' , 'BS')
		 ->where('CA', '=',$client)
		 ->whereDate('TRADE_DATE', '=',$tglMin)
		 ->orderBy('TRADE_DATE','DESC')->get();
			}
			elseif(!$from && $to && $broker && !$client)
			{
$date = explode ('/', $to);
			$tglMin = $date[2].'-'.$date[1].'-'.$date[0];
		 $data = DB::connection('sqlsrv')->table('DataTransaksiFull')->select('BROKER_CODE', 'COMMODITY_NAME','TRADE_DATE2','TRADE_TIME', 'PRICE' , 'LOT' , 'CA' , 'BS')
		 ->where('BROKER_CODE', '=',$broker)
		 ->whereDate('TRADE_DATE', '=',$tglMin)
		 ->orderBy('TRADE_DATE','DESC')->get();
			}
			elseif(!$from && $to && !$broker && $client)
			{
		$date = explode ('/', $to);
			$tglMin = $date[2].'-'.$date[1].'-'.$date[0];
		 $data = DB::connection('sqlsrv')->table('DataTransaksiFull')->select('BROKER_CODE', 'COMMODITY_NAME','TRADE_DATE2','TRADE_TIME', 'PRICE' , 'LOT' , 'CA' , 'BS')
		 ->where('CA', '=',$client)
		 ->whereDate('TRADE_DATE', '=',$tglMin)
		 ->orderBy('TRADE_DATE','DESC')->get();
			}
			elseif(!$from && !$to && $broker && $client)
			{
			$date = explode ('/', $to);
			$tglMin = $date[2].'-'.$date[1].'-'.$date[0];
		 $data = DB::connection('sqlsrv')->table('DataTransaksiFull')->select('BROKER_CODE', 'COMMODITY_NAME','TRADE_DATE2','TRADE_TIME', 'PRICE' , 'LOT' , 'CA' , 'BS')
		 ->where('BROKER_CODE', '=',$broker)
		 ->where('CA', '=',$client)
		 ->orderBy('TRADE_DATE','DESC')->get();
			}
			elseif(!$from && !$to && $broker && !$client)
			{
		 $data = DB::connection('sqlsrv')->table('DataTransaksiFull')->select('BROKER_CODE', 'COMMODITY_NAME','TRADE_DATE2','TRADE_TIME', 'PRICE' , 'LOT' , 'CA' , 'BS')
		 ->where('BROKER_CODE', '=',$broker)
		 ->orderBy('TRADE_DATE','DESC')->get();
			}
			elseif(!$from && !$to && !$broker && $client)
			{
		 $data = DB::connection('sqlsrv')->table('DataTransaksiFull')->select('BROKER_CODE', 'COMMODITY_NAME','TRADE_DATE2','TRADE_TIME', 'PRICE' , 'LOT' , 'CA' , 'BS')
		 ->where('CA', '=',$client)
		 ->orderBy('TRADE_DATE','DESC')->get();
			}
			else
			{
			$date = explode ('/', $from);
			$tglMin = $date[2].'-'.$date[1].'-'.$date[0];
			$date2 = explode ('/', $to);
			$tglMax = $date2[2].'-'.$date2[1].'-'.$date2[0];
		 $data = DB::connection('sqlsrv')->table('DataTransaksiFull')->select('BROKER_CODE', 'COMMODITY_NAME','TRADE_DATE2','TRADE_TIME', 'PRICE' , 'LOT' , 'CA' , 'BS')
		 ->where('BROKER_CODE', '=',$broker)
		 ->where('CA', '=',$client)
		  ->whereDate('TRADE_DATE','>=',$tglMin)->whereDate('TRADE_DATE','<=',$tglMax)
		 ->orderBy('TRADE_DATE','DESC')->get();
			}
			$data2 = array();
foreach ($data as $result) {
   $data2[] = (array)$result;  
}
         return Excel::create('data-transaction', function($excel) use ($data2) {
            $excel->sheet('transaction', function($sheet) use ($data2)
            {
                $sheet->fromArray($data2);
            });
        })->download('xls');

		}
    }

}
