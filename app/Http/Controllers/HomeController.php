<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Response,View,Input,Auth,Session,Validator,File,Hash;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Crypt;
use DB;
use Carbon\Carbon;
use DateTime;
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
        $this->middleware('auth');
    }


    public function index()
    {
        return view('user.home');
    }

	
	
	// get user profile
    public function get_profile()
    {
      $cek = User::findOrFail(Auth::user()->id);
      return response()->json($cek);
    }
	
	// update user password
    public function q_UpdatePassword(Request $request)
    {

$valid = $this->validate($request, [
        'password' => 'required|max:255',
        'password_confirmation' => 'required|max:255|same:password'
    ]);
if (!$valid)
    {
User::where("id",Auth::user()->id)->update(array('password' => Hash::make($request->password)));

return response()->json(['success'=>'Password Berhasil Dirubah']);

    }
else
    {
 return response()->json('error', $valid);
    }

    }
	
	
	public function item(Request $request)
    {
		$perPage = $request->per_page;
        $query = Item::orderBy('id','DESC');
       
        return $query->paginate($perPage);
    }
	
	public function orderHistoryDetail($id)
    {
		$detail = DB::table('orderstatus')
		->where('orderstatus.order',$id)
		->leftJoin('statusnya', 'orderstatus.status', '=', 'statusnya.id')
		->select('orderstatus.id as id',DB::raw("CONCAT(orderstatus.statusdatetime,' : ',statusnya.description) AS statusnya"))
		->orderBy('orderstatus.id','ASC')->get(); 
       
        return $detail;
    }
	
	
	public function orderHistory(Request $request)
    {
		$dataSet2 = [];
		
		$query = DB::table('ordernya')
		->where('ordernya.user',Auth::user()->id)
		->leftJoin('itemnya', 'ordernya.item', '=', 'itemnya.id')
		->leftJoin('driver', 'ordernya.driver', '=', 'driver.id')
		->select('ordernya.id as id','itemnya.name AS itemname', 'driver.username as drivername')
		->orderBy('ordernya.id','DESC')->get();
foreach ($query as $key) 
{
	$header = ['id'=>$key->id , 'itemname'=>$key->itemname , 'drivername' => $key->drivername ] ;
	$detail = $this->orderHistoryDetail($key->id);
	$dataSet2[] = ['header'=>$header , 'detail' => $detail];
}		
		
		 return response()->json($dataSet2);
		
		
    }
	
		// order
    public function order(Request $request)
    {

$valid = $this->validate($request, [
        'id' => 'required|numeric|not_in:0',
        'sku' => 'required|max:255',
        'name' => 'required|max:255',
        'price' => 'required|numeric|not_in:0',
        'address' => 'required',
    ]);
if (!$valid)
    {
$code =Carbon::now()->format('YmdHis');
$date =Carbon::now()->format('Y-m-d H:i:s');
$masuk = array('address' => $request->address, 'item'=>$request->id , 'user'=>Auth::user()->id,'driver'=>0);

$GetorderLastID = Order::select('id')->orderBy('id', 'desc')->first();
if(!$GetorderLastID )
{
$orderID = 1;
}
else
{
$orderID = $GetorderLastID->id + 1;
}


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



Orderstatus::create(['statusdatetime'=> $date,'order'=>$orderID,'status'=>$statusID]); 

$tableordersatatus = Orderstatus::where('status',$statusID)->orderBy('id','DESC')->get();
	
Order::create(['address' => $request->address, 'item'=>$request->id , 'user'=>Auth::user()->id,'driver'=>0,'orderstatus'=>json_encode($tableordersatatus)]);

$tableorder = Order::where('id',$orderID)->orderBy('id','DESC')->get();
Status::create(['code'=>$code , 'description'=>'Order Created' , 'orderstatuses'=>json_encode($tableorder) , 'orderdrivers'=>'']); 	

$tableuser =  Order::where('user',Auth::user()->id)->orderBy('id','DESC')->get();
$tableitem =  Order::where('item',$request->id)->orderBy('id','DESC')->get();

User::where("id",Auth::user()->id)->update(array('orders'=>$tableuser));
Item::where("id",$request->id)->update(array('orders'=>$tableitem));

	return response()->json(['success'=>'Order Berhasil Dikirimkan']);

    }
else
    {
 return response()->json('error', $valid);
    }

    }
	
}
