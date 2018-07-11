<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use DB;
use App\Organisation;

class ApiTestController extends Controller
{

	public function insertOrg()
	{
		$postData = Input::all();

		$user = new Organisation;
		
		$user->organisation        = Input::get('org_name');	
		$user->address1            = Input::get('org_add1');
		$user->address2            = Input::get('org_add2')?Input::get('org_add2'):'';
		$user->address3            = Input::get('address3')?Input::get('address3'):'';
		$user->postcode            = 1235;
		$user->industry            = 'IT';
		$user->phone               = 1546867;
		$user->turnover            = 4567879;
		$user->imageURL            = '';
		$user->numberOfEmployees   = 0;
		$user->numberOfOffices     = 4;
		$user->numberOfDepartments = 0;
		$user->status              = 'Active';
		$user->superOrganisation   = 'N';
		$user->created_at          = date('Y-m-d H:i:s');
		
		$user->save();

		$insertedId = $user->id;

		print_r($insertedId);
	}
}
