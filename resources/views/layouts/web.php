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
});

/*Admin Authentication*/
Route::get('/admin','Admin\AdminLoginController@index');
Route::post('/admin/login',['as'=>'admin.auth','uses'=>'Admin\AdminLoginController@login']);
Route::post('/admin/logout',['as'=>'admin.logout','uses'=>'Admin\AdminLoginController@logout']);


/*----------FORGOT PASSWORD---------------*/

Route::get('resetPassword/{confirmationCode}', [
	'as' => 'confirmation_path',
	'uses' => 'API\ApiLoginController@resetPassword'
]);
Route::post('updatepassword/{confirmationCode}','API\ApiLoginController@updatePassword');

/*web*/
/*get forgot page*/
Route::get('forgot-password','Admin\AdminLoginController@getForgotPassword');
/*update forgot password*/
Route::post('forgotPassword','Admin\AdminLoginController@forgotPassword');

/*----------FORGOT PASSWORD----------------*/


/*Admin Functionality*/
Route::group(['prefix'=>'admin','middleware'=>['admin']],function ()
{	

	/*ADMIN PROFILE FUNCTIONALITY*/

	/*admin profile*/
	Route::get('profile',['as'=>'admin.profile','uses'=>'Admin\AdminLoginController@getProfile']);
	/*admin profile update*/
	Route::post('profile-update',['as'=>'admin.profile.update','uses'=>'Admin\AdminLoginController@updateProfile']);
	/*admin profile password*/
	Route::get('profile-password-edit','Admin\AdminLoginController@getEditProfilePassword');
	/*admin profile update password*/
	Route::post('profile-password-update','Admin\AdminLoginController@updateProfilePassword');


	/*Dashboard Functionality*/
	Route::get('/admin-dashboard','Admin\AdminDashboardController@index');
	/*get project list*/
	Route::resource('organisation','Admin\AdminOrganisationController');
	
	/*Office functionality*/
	Route::resource('office','Admin\AdminOfficeController');
	/*staff functionality*/
	Route::resource('staff','Admin\AdminStaffController');

	/*Common functionality*/
	Route::post('get-offices','Admin\CommonController@getOffices');
	/*check email is exists in table*/
	Route::post('search-email','Admin\CommonController@getEmail');
	Route::post('get-departments','Admin\CommonController@getDepartments');
	/*get departmets for searched in of departmens*/
	Route::post('get-search-departments','Admin\CommonController@getDepartmentsListForSearch');

	Route::post('get-search-office','Admin\CommonController@getOfficeListForSearch');
	/*get user list of department search user*/
	Route::post('get-search-users','Admin\CommonController@getDepartmentsUserList');
	/*get user list, organisation*/
	Route::post('get-inductor-users','Admin\CommonController@getOrganisationUsers');
	/*get organisation name*/
	Route::post('get-org-name','Admin\CommonController@getOrgName');
	/*check mahcine id already exists*/
	Route::post('get-machine-id','Admin\CommonController@getMachineId');
	/*delete*/
	Route::get('delete/{table}/{id}','Admin\CommonController@deleteUserOption');

	/*Machine Functionality*/
	Route::resource('machine','Admin\AdminMachineController');
	/*Machine Directive Functionality*/
	Route::resource('machine-directive','Admin\AdminMachineDirectiveController');
	/*get add custom form*/
	Route::get('machine-directive-custom-form','Admin\AdminMachineDirectiveController@addCustomform');
	/*insert custom from data */
	Route::post('machine-directive-custom-form-insert','Admin\AdminMachineDirectiveController@addAnswers');

	Route::get('user-configured','Admin\AdminMachineDirectiveController@user_configured')->name('user-configured');
	
	Route::get('preview-form','Admin\AdminMachineDirectiveController@previewForm')->name('previewForm');
	/*update machine directives answers (in edit machine section )*/
	Route::post('update-directive-answers','Admin\AdminMachineDirectiveController@updateMachineDirectiveAnswers')->name('update-directive-answers');
	/*get pre configure user directive page*/
	Route::get('user-pre-directive-edit/{id}','Admin\AdminMachineDirectiveController@editPreConfigUserDir')->name('user-pre-directive-edit');
	/*get pre configure user directive page*/
	Route::get('user-directive-option-edit/{id}','Admin\AdminMachineDirectiveController@editPreConfigUserInputOption')->name('user-directive-option-edit');
	/*get pre configure user directive page*/
	Route::get('directive-option-edit/{id}','Admin\AdminMachineDirectiveController@editPreConfigUserInputOption')->name('directive-option-edit');
	/*edit: Machine Directives multiple values and saved it and each path can updated saparetly*/
	Route::get('machine-directive-edit/{id}','Admin\AdminMachineDirectiveController@editMachineDirective')->name('machine-directive-edit');
	/*update machine directive quetion*/
	Route::post('update-directive-question','Admin\AdminMachineDirectiveController@updateMachineDirQues');
	/*and new  values in existing user config form*/
	Route::post('user-config-add-New-Inputs','Admin\AdminMachineDirectiveController@addNewInputs');
	
	/*Department functionality*/
	Route::resource('department','Admin\AdminDepartmentController');


	/*USER DIRECTIVE FUNCTIONALITY*/

	Route::resource('user-directive','Admin\AdminUserDirectiveController');
	/*edit user directive*/
	Route::get('user-directive-edit/{id}','Admin\AdminUserDirectiveController@editUserDirective')->name('user-directive-edit');
	/*get user directive configured list*/
	Route::get('user-directive-configured','Admin\AdminUserDirectiveController@userConfigured')->name('user-directive-configured');
	/*and new  values in existing user config form*/
	Route::post('user-directive-configured-add-new-inputs','Admin\AdminUserDirectiveController@addNewInputs');
	/*get user directive page of pre-configured*/
	Route::get('user-directive-form-option-edit/{id}','Admin\AdminUserDirectiveController@editPreConfigUserInputOption')->name('user-directive-form-option-edit');
	/*update user directive quetion*/
	Route::post('update-user-directive-question','Admin\AdminUserDirectiveController@updateUserDirQues');
	/*get pre configure user directive page*/
	Route::get('user-directive-pre-config-edit-form/{id}','Admin\AdminUserDirectiveController@editPreConfigUserDir')->name('user-directive-pre-config-edit-form');
	/*get machine user operation list*/
	Route::get('machine-operation-user-list/{id}','Admin\AdminUserDirectiveController@getMachineOperationUserList');
	/*get user directive filled answer form*/
	Route::get('user-directive-preview-ans-form','Admin\AdminUserDirectiveController@getUserDirectiveAnsPreview')->name('getUserDirectiveAnsPreview');

});
