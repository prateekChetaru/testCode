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
	return view('layouts.comingsoon');
	// return view('welcome');
	// echo "test";
});

/*Admin Authentication*/
Route::get('/admin','Admin\AdminLoginController@index');
Route::post('/admin/login',['as'=>'admin.auth','uses'=>'Admin\AdminLoginController@login']);
Route::post('/admin/logout',['as'=>'admin.logout','uses'=>'Admin\AdminLoginController@logout']);

/*Admin Functionality*/
Route::group(['prefix'=>'admin','middleware'=>['admin']],function ()
{
	/*Dashboard Functionality*/
	Route::get('/admin-dashboard','Admin\AdminDashboardController@index');
	/*get project list*/
	Route::resource('organisation','Admin\AdminOrganisationController');
	/*check email is exists in table*/
	Route::post('search-email','Admin\CommonController@getEmail');

});
