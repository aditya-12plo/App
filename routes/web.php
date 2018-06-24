<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('page-not-found',['as' => 'pagenotfound','uses' => 'IndexController@pagenotfound']);

// for change languge
Route::get('langauage/{locale}', function ($locale) {
  if (in_array($locale, \Config::get('app.locales'))) {
    Session::put('locale', $locale);
  }
  return redirect()->back();
});


// user

Auth::routes();

Route::group(['prefix' => 'users'], function () {
Route::get('/', 'HomeController@index');
Route::get('GetProfile', 'HomeController@get_profile');
Route::post('change-password', 'HomeController@q_UpdatePassword');
Route::get('item', 'HomeController@item');
Route::get('order-history', 'HomeController@orderHistory');
Route::post('order', 'HomeController@order');

});




//for driver
Route::group(['prefix' => 'driver', 'namespace' => 'Driver'], function () {
Route::get('/login', 'Auth\LoginController@showLoginForm')->name('driver.login');
Route::post('login', 'Auth\LoginController@login')->name('driver.login');
Route::post('logout', 'Auth\LoginController@logout')->name('driver.logout');


Route::get('/', 'HomeController@index');
Route::get('GetProfile', 'HomeController@get_profile');
Route::post('change-password', 'HomeController@q_UpdatePassword');
Route::post('take-order', 'HomeController@takeOrder');
Route::get('order-list', 'HomeController@GetNewOrder');
Route::get('order-history', 'HomeController@orderHistory');



});


















