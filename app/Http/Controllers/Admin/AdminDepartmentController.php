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
use Image;
use App\Organisation;
use App\User;
use App\Office;
use App\Machine;
use App\Department;
use Illuminate\Support\Facades\Redirect;

class AdminDepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departments = Department::with('office.organisation')
        ->where('status','Active')
        ->orderBy('id','DESC')
        ->paginate(6);

        $organisations = Organisation::where('status','Active')
        ->orderBy('organisation','ASC')
        ->get();

        return view('admin/department/departments',compact('departments','organisations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
     $organisations = Organisation::where('status','Active')
     ->orderBy('organisation','ASC')
     ->get();

     return view('admin/department/addDepartment',compact('organisations'));
 }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {           
        $dept = new Department;
         $department = Department::where('department',Input::get('department'))
        ->where('orgId',Input::get('organisation'))
        ->where('officeId',Input::get('office'))
        ->first();
        
        if(empty($department))
        {
        $dept->department          = Input::get('department');  
        $dept->numberOfEmployees   = Input::get('noOfEmp');
        $dept->orgId               = Input::get('organisation');
        $dept->officeId            = Input::get('office');
        $dept->status              = 'Active';
        $dept->lead_name           = Input::get('lead_name');
        $dept->lead_email          = Input::get('lead_email');
        $dept->lead_mobile         = Input::get('lead_mobile');  
        $dept->created_at          = date('Y-m-d H:i:s');

        $dept->save();
        $insertedId = $dept->id;

        //redirect('admin/organisation');
        return \Redirect::route('department.index')->with(['message'=>'Department added successfully.']);
        }
        else
        {
           return \Redirect::route('department.index')->with(['message'=>'Department already exists.']);

       }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
       $deptId = base64_decode($id);

       $organisations = Organisation::where('status','Active')
       ->orderBy('organisation','ASC')
       ->get();

       $department = Department::where('id',$deptId)->first();

       $dept = Department::find($deptId);

       $offices = Office::where('status','Active')
       ->orderBy('office','ASC')
       ->where('orgId',$dept->orgId)
       ->get();

       return view('admin/department/editDepartment',compact('organisations','department','offices'));
   }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $deptId = base64_decode($id);

        $dept = Department::find($deptId);

        $dept->department          = Input::get('department');  
        $dept->numberOfEmployees   = Input::get('noOfEmp');
        $dept->orgId               = Input::get('organisation');
        $dept->officeId            = Input::get('office');
        $dept->status              = 'Active';
        $dept->lead_name           = Input::get('lead_name');
        $dept->lead_email          = Input::get('lead_email');
        $dept->lead_mobile         = Input::get('lead_mobile');  
        $dept->created_at          = date('Y-m-d H:i:s');

        $dept->save();

        return \Redirect::route('department.index')->with(['message'=>'Department updated successfully.']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
