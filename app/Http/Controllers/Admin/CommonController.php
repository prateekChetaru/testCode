<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Auth;
use Validator;
use Hash;
use Illuminate\Support\Facades\Input;
use Config;

class CommonController extends Controller
{

  public function addNewDepartment()
  {
    $postData = Input::get();

    $department_name = Input::get('department');
    $orgId = Input::get('orgId') ? Input::get('orgId'):0;

    $department = DB::table('all_department')
    ->where('department',$department_name)
    ->get();


    if (count($department)) {

      $data = array('response'=>'error','message'=>'Department already exists.');
      return $data;

    }
    else
    {

      $insertArray = array(
        'department'=> $department_name,              
        'orgId'=> $orgId,    
        'status'=>'Active', 
        'created_at'=>date('Y-m-d H:i:s')
      );

      $status = DB::table('all_department')->insertGetId($insertArray);

      $data['response'] = 'success';
      $data['message']  = 'Department added successfully';

      $controller = new CommonController();

      $department_array = $controller->callAction('getAllDepartments',array());

      $data['department_array'] = $department_array;

      return $data;

    }


  }


    //get all departments
  public function getAllDepartments()
  {

    $departments = DB::table('all_department')
    ->select('id','department')
    ->where('status','Active')
    ->orderBy('department','asc')
    ->get();

    $departmentArray = array();

    foreach ($departments as $value) {

      $dept_opt = '<option value="'.$value->id.'">'.$value->department.'</option>';

      array_push($departmentArray, $dept_opt);
    }

    return $departmentArray;
  }
    //get custom values list
  public function getCustomDotValues() 
  {

    $dotValues = DB::table('dot_value_list')
    ->select('id','name')
    ->where('status','Active')
    ->orderBy('name','ASC')
    ->get();

    $dotValuesArray = array();

    // $dotValueOpt = '<option value="">Select</option>';

    foreach ($dotValues as $key => $value) {

      $dotValueOpt = '<option value="'.$value->id.'">'.$value->name.'</option>';

      array_push($dotValuesArray, $dotValueOpt);
    }

    return $dotValuesArray;
  }

  /*get office count*/

  public function getOfficeCount($orgId)
  {

   return $office = DB::table('offices')
   ->where('status','Active')
   ->where('orgId',$orgId)
   ->get()
   ->count();


 }

 public function getDepartmentCount($orgId)
 {

  return $departments = DB::table('departments')
  ->where('status','Active')
  ->where('orgId',$orgId)
  ->get()
  ->count();

}
/*check email*/
public function getEmail(){

  $email = Input::get('email');

  
  $user = DB::table('users')
  ->where('email',$email)
  ->first();

  if($user)
  {
    echo true;
  }
  else
  {
    echo false;
  }
}

}
