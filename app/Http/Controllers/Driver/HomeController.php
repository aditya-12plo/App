<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Response,View,Input,Auth,Session,Validator,File,Hash;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Crypt;
use DB;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Status;
use App\Models\Orderstatus;
use App\Models\Order;
use App\Models\Driver;
use App\Models\Item;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('driver.auth');
    }

    public function index()
    {
        return view('driver.home');
    }

	// get user profile
    public function get_profile()
    {
      $cek = Driver::findOrFail(Auth::guard('driver')->user()->id);
      return response()->json($cek);
    }
	
	
	
	
	
	// update driver update password
    public function q_UpdatePassword(Request $request)
    {

$valid = $this->validate($request, [
        'password' => 'required|max:191',
        'password_confirmation' => 'required|max:191|same:password'
    ]);
if (!$valid)
    {
$edit = array('password' => Hash::make($request->password));
Driver::where("id",Auth::guard('driver')->user()->id)->update($edit);

return response()->json(['success'=>'Password Berhasil Dirubah']);

    }
else
    {
 return response()->json('error', $valid);
    }

    }
	
	
		public function GetNewOrder(Request $request)
    {
		$perPage = $request->per_page;
        $query = $detail = DB::table('ordernya')
		->where('ordernya.driver','0')
		->leftJoin('itemnya', 'ordernya.item', '=', 'itemnya.id')
		->leftJoin('orderstatus', 'ordernya.id', '=', 'orderstatus.order')
		->leftJoin('statusnya', 'orderstatus.status', '=', 'statusnya.id')
		->select('ordernya.id as id','ordernya.user as userid','itemnya.name as name','ordernya.address as address',DB::raw("CONCAT(orderstatus.statusdatetime,' : ',statusnya.description) AS statusnya"))
		->orderBy('ordernya.id','ASC'); 
       
        return $query->paginate($perPage);
    }
	
	
	
		// take order
    public function takeOrder(Request $request)
    {

$valid = $this->validate($request, [
        'id' => 'required|numeric|not_in:0',
        'stts' => 'required|numeric|not_in:0',
    ]);
if (!$valid)
    {
$code =Carbon::now()->format('YmdHis');
$date =Carbon::now()->format('Y-m-d H:i:s');
$id = $request->id;
$stts = $request->stts;
$userid = $request->userid;
if($stts == '1')
{
	
$cek = Order::where("id",$id)->first();
if($cek->driver == '0')
{
	
$GetstatusLastID = Status::select('id')->orderBy('id', 'desc')->first();
if(!$GetstatusLastID )
{
$statusID =  1;
}
else
{
$statusID = $GetstatusLastID->id + 1;
}


$GetorderstatusLastID = Orderstatus::select('id')->orderBy('id', 'desc')->first();
if(!$GetorderstatusLastID )
{
$orderstatusID = 1;
}
else
{
$orderstatusID = $GetorderstatusLastID->id + 1;
}


	
Orderstatus::create(['statusdatetime'=> $date,'order'=>$id,'status'=>$statusID]); 

$tableordersatatus = Orderstatus::where('status',$statusID)->orderBy('id','DESC')->get();
	
Order::where("id",$id)->update(['driver'=>Auth::guard('driver')->user()->id,'orderstatus'=>json_encode($tableordersatatus)]);



$tableorder = Order::where('id',$id)->orderBy('id','DESC')->get();
Driver::where("id",Auth::guard('driver')->user()->id)->update(array('orders'=>$tableorder));

$orderdriver = Driver::where('id',Auth::guard('driver')->user()->id)->first();
Status::create(['code'=>$code , 'description'=>'Order Taken By Driver' , 'orderstatuses'=>json_encode($tableorder) , 'orderdrivers'=>json_encode($orderdriver)]); 	

$tableuser =  Order::where('user',$userid)->orderBy('id','DESC')->get();
$tableitem =  Order::where('item',$request->id)->orderBy('id','DESC')->get();

User::where("id",$userid)->update(array('orders'=>$tableuser));
Item::where("id",$id)->update(array('orders'=>$tableitem));



	return response()->json(['success'=>'Order Berhasil Diambil']);
}
else
{
	return response()->json(['error'=>'Maaf Order Sudah DIambil Driver Lain']);
}	

}
elseif($stts == '2')
{
	
$GetstatusLastID = Status::select('id')->orderBy('id', 'desc')->first();
if(!$GetstatusLastID )
{
$statusID =  1;
}
else
{
$statusID = $GetstatusLastID->id + 1;
}


$GetorderstatusLastID = Orderstatus::select('id')->orderBy('id', 'desc')->first();
if(!$GetorderstatusLastID )
{
$orderstatusID = 1;
}
else
{
$orderstatusID = $GetorderstatusLastID->id + 1;
}


	
Orderstatus::create(['statusdatetime'=> $date,'order'=>$id,'status'=>$statusID]); 

$tableordersatatus = Orderstatus::where('status',$statusID)->orderBy('id','DESC')->get();
	
Order::where("id",$id)->update(['driver'=>Auth::guard('driver')->user()->id,'orderstatus'=>json_encode($tableordersatatus)]);



$tableorder = Order::where('id',$id)->orderBy('id','DESC')->get();
Driver::where("id",Auth::guard('driver')->user()->id)->update(array('orders'=>$tableorder));

$orderdriver = Driver::where('id',Auth::guard('driver')->user()->id)->first();
Status::create(['code'=>$code , 'description'=>'Order On Delivery' , 'orderstatuses'=>json_encode($tableorder) , 'orderdrivers'=>json_encode($orderdriver)]); 	

$tableuser =  Order::where('user',$userid)->orderBy('id','DESC')->get();
$tableitem =  Order::where('item',$request->id)->orderBy('id','DESC')->get();

User::where("id",$userid)->update(array('orders'=>$tableuser));
Item::where("id",$id)->update(array('orders'=>$tableitem));



	return response()->json(['success'=>'Barang Berhasil Dibawa']);

}
elseif($stts == '3')
{
	
$GetstatusLastID = Status::select('id')->orderBy('id', 'desc')->first();
if(!$GetstatusLastID )
{
$statusID =  1;
}
else
{
$statusID = $GetstatusLastID->id + 1;
}


$GetorderstatusLastID = Orderstatus::select('id')->orderBy('id', 'desc')->first();
if(!$GetorderstatusLastID )
{
$orderstatusID = 1;
}
else
{
$orderstatusID = $GetorderstatusLastID->id + 1;
}


	
Orderstatus::create(['statusdatetime'=> $date,'order'=>$id,'status'=>$statusID]); 

$tableordersatatus = Orderstatus::where('status',$statusID)->orderBy('id','DESC')->get();
	
Order::where("id",$id)->update(['driver'=>Auth::guard('driver')->user()->id,'orderstatus'=>json_encode($tableordersatatus)]);



$tableorder = Order::where('id',$id)->orderBy('id','DESC')->get();
Driver::where("id",Auth::guard('driver')->user()->id)->update(array('orders'=>$tableorder));

$orderdriver = Driver::where('id',Auth::guard('driver')->user()->id)->first();
Status::create(['code'=>$code , 'description'=>'Order Delivered' , 'orderstatuses'=>json_encode($tableorder) , 'orderdrivers'=>json_encode($orderdriver)]); 	

$tableuser =  Order::where('user',$userid)->orderBy('id','DESC')->get();
$tableitem =  Order::where('item',$request->id)->orderBy('id','DESC')->get();

User::where("id",$userid)->update(array('orders'=>$tableuser));
Item::where("id",$id)->update(array('orders'=>$tableitem));



	return response()->json(['success'=>'Barang Berhasil Dikirim']);

}
else
{
	return response()->json('error', 500);
}

    }
else
    {
 return response()->json('error', $valid);
    }

    }
	
	
	
	public function orderHistoryDetail($id)
    {
		$detail = DB::table('orderstatus')
		->where('orderstatus.order',$id)
		->leftJoin('statusnya', 'orderstatus.status', '=', 'statusnya.id')
		->select('orderstatus.id as id','statusnya.description as description',DB::raw("CONCAT(orderstatus.statusdatetime,' : ',statusnya.description) AS statusnya"))
		->orderBy('orderstatus.id','ASC')->get(); 
       
        return $detail;
    }
	
	
	public function orderHistory(Request $request)
    {
		$dataSet2 = [];
		
		$query = DB::table('ordernya')
		->where('ordernya.driver',Auth::guard('driver')->user()->id)
		->leftJoin('itemnya', 'ordernya.item', '=', 'itemnya.id')
		->leftJoin('driver', 'ordernya.driver', '=', 'driver.id')
		->select('ordernya.id as id','ordernya.user as userid','itemnya.name AS itemname', 'ordernya.address as address')
		->orderBy('ordernya.id','DESC')->get();
foreach ($query as $key) 
{
	$header = ['id'=>$key->id , 'userid'=>$key->userid , 'itemname'=>$key->itemname , 'address' => $key->address ] ;
	$detail = $this->orderHistoryDetail($key->id);
	$dataSet2[] = ['header'=>$header , 'detail' => $detail];
}		
		
		 return response()->json($dataSet2);
		
		
    }
	
	
}
