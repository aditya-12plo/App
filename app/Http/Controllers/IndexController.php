<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Response,View,Input,Auth,Session,Validator,File,Hash,Location;
use Illuminate\Support\Facades\Crypt;
use PDF;
use Excel;
use DB;


use App\Models\Broker;

class IndexController extends Controller
{
    public function __construct()
    {
      
    }

	
	
	
	//if page not found
public function pagenotfound()
{
	$this->data['title'] = 'Indonesia Clearing House (ICH)';
    return view('layouts.error')->with($this->data);
}
	
	//if page not found
public function coba()
{
	return response()->json('ok');
}
	 /*
    public function test2(Request $request)
    {
    $input['useragent'] = $request->server('HTTP_USER_AGENT');
    $input['ip'] = $request->ip();
    $input['location'] = Location::get($request->ip());;

    print_r($input);

    }

	
    public function test()
    {
$query = 'SELECT DISTINCT BROKER_CODE FROM TRADE_REG';
$t = DB::connection('sqlsrv')->select($query);
return response()->json($t);
    }

   
    public function pdf(Request $request)
    {
$customer = Broker::all();
 
    $pdf = PDF::loadView('htmltopdfview',compact('customer'));
 
    return $pdf->stream('admission.pdf');
    }

public function downloadExcel($type)
    {
        $data = Broker::get()->toArray();
        return Excel::create('itsolutionstuff_example', function($excel) use ($data) {
            $excel->sheet('mySheet', function($sheet) use ($data)
            {
                $sheet->fromArray($data);
            });
        })->download($type);
    }
    public function importExcel()
    {
        if(Input::hasFile('import_file')){
            $path = Input::file('import_file')->getRealPath();
            $data = Excel::load($path, function($reader) {
            })->get();
            if(!empty($data) && $data->count()){
                foreach ($data as $key => $value) {
                    $insert[] = ['title' => $value->title, 'description' => $value->description];
                }
                if(!empty($insert)){
                    DB::table('broker')->insert($insert);
                    dd('Insert Record successfully.');
                }
            }
        }
        return back();
    }

*/

    
}
