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
use Illuminate\Support\Facades\Redirect;


class AdminOrganisationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

      $resultArray = array();

      $organisation = Organisation::where('status','Active')
      ->orderBy('id','DESC')  
      ->paginate(6);

      return view('admin/organisation/organisations',compact('organisation'))
      ->with('paginations',$organisation);
    }
    public function show($id){

      $resultArray = array();

      $organisation = Organisation::where('status','Active')
      ->orderBy('id','DESC')  
      ->paginate(6);

      return view('admin/organisation/organisations',compact('organisation'))
      ->with('paginations',$organisation);

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('admin/organisation/addOrganisation');
    }

    public function store(Request $request)
    {
      $inputData = Input::get();

      print_r($inputData);

      die();

      $rules = array(
        'email'=>'unique:users'
      );

      $Validator =  Validator::make(Input::all(),$rules);

      if($Validator->fails())
      {

        return redirect()->back()->withInput(Input::all())->withErrors($Validator->errors());
      }

      if(Input::get('orgLogo'))
      {
        $image       = $request->file('orgLogo');
        $imageName   = 'org_'.time().'.'.$image->getClientOriginalExtension();
        $destination = public_path('uploads/org_images/');
        $image->move($destination, $imageName);
      }
      else
      {
        $imageName = '';
      }

      $org = new Organisation;

      $org->organisation        = Input::get('organisation');  
      $org->industry            = Input::get('industry');
      $org->address1            = Input::get('address1')?Input::get('address1'):'';
      $org->address2            = Input::get('address2')?Input::get('address1'):'';
      $org->address3            = Input::get('address3')?Input::get('address3'):'';
      $org->postcode            = Input::get('zipCode');      
      $org->phone               = Input::get('phone'); 
      $org->country             = Input::get('country');     
      $org->website             = Input::get('website');
      $org->imageURL            = $imageName;
      $org->numberOfEmployees   = 0;
      $org->numberOfOffices     = 0;
      $org->numberOfDepartments = 0;
      $org->status              = 'Active';
      $org->superOrganisation   = 'N';
      $org->created_at          = date('Y-m-d H:i:s');
      
      $org->save();

      $insertedId = $org->id;

      if($insertedId)
      {
        //add admin here
        $user = new User;

        $user->name            = Input::get('fname');  
        $user->last_name       = Input::get('lname');
        $user->status          = 'Active';
        $user->email           = Input::get('email');
        $user->password        = bcrypt(Input::get('password'));
        $user->password2       = base64_encode(Input::get('password'));
        $user->role_id         = 2;
        $user->organisation_id = $insertedId;
        $user->created_at      = date('Y-m-d H:i:s');

        $user->save();

      }

      //redirect('admin/organisation');
      return \Redirect::route('organisation.index');
    }


  }
