@extends('layouts.app2')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><h1 align="center"> ORDER SIMULATION </h1></div>
                <div class="panel-body">

				
					 <p align="center">
<a href="{{ route('login') }}"><button type="button" class="btn btn-success">USER LOGIN</button></a>
<a href="{{ route('driver.login') }}"><button type="button" class="btn btn-info">DRIVER LOGIN</button></a>
</p>
					 
					 
					
					
					
					
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

