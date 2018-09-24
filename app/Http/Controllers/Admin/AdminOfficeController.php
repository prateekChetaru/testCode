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
use Illuminate\Support\Facades\Redirect;

class AdminOfficeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $office = Office::with('organisation')

        ->orderBy('id','DESC')
        ->where('status','Active')->paginate(6);

        $organisations = Organisation::where('status','Active')
        ->orderBy('organisation','ASC')
        ->get();

        return view('admin/office/office',compact('office','organisations'));
       
       
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

        return view('admin/office/addOffice',compact('organisations'));
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

        $ofc = new Office;

        $ofc->office              = Input::get('office');  
        $ofc->numberOfEmployees   = Input::get('noOfEmp');
        $ofc->address1            = Input::get('address1');
        $ofc->address2            = Input::get('address2');     
        $ofc->postcode            = Input::get('zipcode');      
        $ofc->orgId               = Input::get('organisation'); 
        $ofc->country             = Input::get('country');     
        $ofc->state               = Input::get('state');
        $ofc->city                = Input::get('city');
        $ofc->lead_name           = Input::get('lead_name');
        $ofc->lead_email          = Input::get('lead_email');
        $ofc->lead_mobile         = Input::get('lead_mobile');           
        $ofc->status              = 'Active';     
        $ofc->created_at          = date('Y-m-d H:i:s');

        $ofc->save();

        $insertedId = $ofc->id;

        // print_r($insertedId);

        return redirect('admin/office/create')->with(['message'=>'Office added successfully.']);      
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
        $postData = Input::all();

        $officeId = base64_decode($id);

        $office = Office::where('id',$officeId)->first();

        $organisations = Organisation::where('status','Active')
        ->orderBy('organisation','ASC')
        ->get();

        return view('admin/office/editOffice',compact('organisations','office'));
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

        $officeId = base64_decode($id);
        
        $ofc = Office::find($officeId);

        // dd(Input::all());

        $ofc->office              = Input::get('office');  
        $ofc->numberOfEmployees   = Input::get('noOfEmp');
        $ofc->address1            = Input::get('address1');
        $ofc->address2            = Input::get('address2');     
        $ofc->postcode            = Input::get('zipcode');      
        $ofc->orgId               = Input::get('organisation'); 
        $ofc->country             = Input::get('country');     
        $ofc->state               = Input::get('state');
        $ofc->lead_name           = Input::get('lead_name');
        $ofc->lead_email          = Input::get('lead_email');
        $ofc->lead_mobile         = Input::get('lead_mobile');
        $ofc->city                = Input::get('city');         
        $ofc->updated_at          = date('Y-m-d H:i:s');

        $ofc->save();

        $insertedId = $ofc->id;

        return redirect('admin/office/create')->with(['message'=>'Office updated successfully.']);
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
