<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
	return $request->user();
});

/*for user login process*/
// Route::post('userLogin', 'API\ApiLoginController@login');

// Route::group(['middleware' => 'auth:api'], function(){

	
// });

// Route::post('addOrg','API\ApiTestController@insertOrg');


