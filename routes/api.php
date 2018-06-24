<?php

use Illuminate\Http\Request;



Route::get('coba', 'IndexController@coba');

Route::group(['prefix' => 'clients'], function () {
    Route::post('loginapi', 'UserController@login');
    Route::post('test', 'UserController@test');
    Route::get('logoutapi', 'UserController@logout');
    Route::get('getAuthUser', 'UserController@getAuthUser');
});

