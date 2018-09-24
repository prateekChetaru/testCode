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
use App\Department;
use Illuminate\Support\Facades\Redirect;

class AdminStaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $users = User::with('department.office.organisation')
        ->where('role_id',3)
        ->where('status','Active')
        ->orderBy('id','DESC')
        ->paginate(6);

        $organisations = Organisation::where('status','Active')
        ->orderBy('organisation','ASC')
        ->get();

        return view('admin/staff/listStaff',compact('users','organisations'));
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

     return view('admin/staff/addStaff',compact('organisations'));
 }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $postData = Input::all();

        $user = new User;

        $user->name    			= $postData['fname'];  
        $user->last_name   		= $postData['lname'];
        $user->email   			= $postData['email'];
        $user->phone   			= $postData['phone'];
        $user->password     	= bcrypt($postData['password']);      
        $user->password2    	= base64_encode($postData['password']); 
        $user->organisation_id  = $postData['organisation'];     
        $user->office_id        = $postData['office'];
        $user->department_id    = $postData['department'];
        $user->role_id      	= 3;                 
        $user->status       	= 'Active';     
        $user->created_at   	= date('Y-m-d H:i:s');

        $user->save();

       // $insertedId = $ofc->id;

        // return redirect('admin/staff/create')->with(['message'=>'User added successfully.']); 
        return \Redirect::route('staff.index')->with(['message'=>'User added successfully.']);
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
        $id = base64_decode($id);
        
        $users = User::with('department.office.organisation')->where('id',$id)->first();

        $organisations = Organisation::where('status','Active')
        ->orderBy('organisation','ASC')->get();

        $offices = Office::where('status','Active')
        ->orderBy('office','ASC')
        ->where('orgId',$users->organisation_id)
        ->get();

        $departments = Department::where('status','Active')
        ->orderBy('department','ASC')
        ->where('orgId',$users->organisation_id)
        ->get();

        return view('admin/staff/editStaff',compact('users','organisations','offices','departments'));
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

        $postData = Input::all();

        // dd($postData);

        $id = base64_decode($id);

        $user = User::find($id);
        
        $user->name             = $postData['fname'];  
        $user->last_name        = $postData['lname'];        
        $user->phone            = $postData['phone'];
        $user->password         = bcrypt($postData['password']);      
        $user->password2        = base64_encode($postData['password']); 
        $user->organisation_id  = $postData['organisation'];     
        $user->office_id        = $postData['office'];
        $user->department_id    = $postData['department'];
        $user->updated_at       = date('Y-m-d H:i:s');
        // $user->email            = $postData['email'];

        $user->save();

        // return redirect('admin/staff/create')->with(['message'=>'Updated successfully.']); 

        return \Redirect::route('staff.index')->with(['message'=>'User updated successfully.']);
        
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
