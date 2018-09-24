<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use DB;
use Auth;
use Validator;
use Hash;
use Config;
use Image;
use App\Organisation;
use App\User;
use App\Office;
use App\Department;
use App\Machine;
use App\Image_process;
use QrCode;
use App\Mdr_form;
use App\Udr_form;


class AdminMachineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
     echo "machine list";
 }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $organisations = Organisation::where('status','Active')
        ->orderBy('organisation','ASC')->get();

        $mdrForm = Mdr_form::where('status','Active')->orderBy('id','DESC')->get();
        
        $userDirectiveForms = Udr_form::where('status','Active')->orderBy('id','DESC')->get();

        return view('admin/machine/addMachine',compact('organisations','mdrForm','userDirectiveForms'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $postdata = Input::all();

        $mcn = new Machine;

        $mcn->org_id             = Input::get('organisation');  
        $mcn->office_id          = Input::get('office');
        $mcn->machine            = Input::get('machine');
        $mcn->machine_id         = Input::get('machineId');
        $mcn->inductor_id        = json_encode(Input::get('inductor'));
        $mcn->trained_user_id    = json_encode(Input::get('trainedUser'));  
        $mcn->latitude           = Input::get('latitude');
        $mcn->longitude          = Input::get('longitude');    
        // $mcn->machineDirective= Input::get('machineDirective'); 
        $mcn->user_dir_id        = Input::get('userDirective');  
        $mcn->machine_status     = Input::get('machineStatus');         
        $mcn->status             = 'Active';           
        $mcn->created_at         = date('Y-m-d H:i:s');

        $mcn->save();

        $insertedId = $mcn->id;

        //update qr code image
        $qr_img = 'qr_'.time().'.svg';      

        QrCode::generate($insertedId,public_path("uploads/qr_code/$qr_img")); 

        $mcn = Machine::find($insertedId);
        $mcn->qr_code = $qr_img;  
        $mcn->save();

        if($request->hasfile('machineImgs'))
        {
            $counter =1;
            foreach($request->file('machineImgs') as $image)
            {               
                $imageName   = 'machine_'.time().$counter.'.'.$image->getClientOriginalExtension();
                $destination = public_path('uploads/mcn_images/');
                $image->move($destination, $imageName);

                $img = new Image_process;

                $img->image_url     = $imageName;
                $img->image_type    = 'machine';
                $img->for_image_id  = $insertedId;
                $img->status        = 'Active';
                $img->created_at    = date('Y-m-d H:i:s');          

                $img->save();

                $counter++;
            }          
            
        }

        $data = array(
            'machineId'=>$insertedId,
            'message'=>'Added successfully.'
        );
        return $data;

        // return \Redirect::route('machine.create')->with(['message'=>'Machine added successfully.']);

        $orgId = base64_encode(Input::get('organisation'));

        // return \Redirect::route("organisation.edit",['id'=>$orgId])->with(['message'=>'Machine added successfully.']);
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
        $machineId = base64_decode($id);

        $machine = Machine::with('answer.question.form')
        ->where('id',$machineId)->first();

        $organisations = Organisation::where('status','Active')
        ->orderBy('organisation','ASC')->get();

        $offices = Office::where('orgId',$machine->org_id)
        ->where('status','Active')
        ->orderBy('office','ASC')
        ->get();

        $inductors = User::where('organisation_id',$machine->org_id)
        ->where('status','Active')
        ->orderBy('name','ASC')
        ->get();

        $machineImages = Image_process::where('for_image_id',$machineId)
        ->where('status','Active')
        ->get();

        $mdrForm = Mdr_form::where('status','Active')->orderBy('id','DESC')->get();

        $userDirectiveForms = Udr_form::where('status','Active')->orderBy('id','DESC')->get();

        return view('admin/machine/editMachine',compact('machine','organisations','offices','inductors','machineImages','mdrForm','userDirectiveForms'));
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
        $postdata = Input::all();
        // print_r($postdata);
        // dd();

        $machineId = base64_decode($id);

        $mcn = Machine::find($machineId);

        $mcn->org_id             = Input::get('organisation');  
        $mcn->office_id          = Input::get('office');
        $mcn->machine            = Input::get('machine');
        $mcn->machine_id         = Input::get('machineId');
        $mcn->inductor_id        = json_encode(Input::get('inductor'));
        $mcn->trained_user_id    = json_encode(Input::get('trainedUser'));  
        $mcn->latitude           = Input::get('latitude');
        $mcn->longitude          = Input::get('longitude');    
        // $mcn->machineDirective= Input::get('machineDirective'); 
        $mcn->user_dir_id        = Input::get('userDirective');   
        $mcn->machine_status     = Input::get('machineStatus');               
        $mcn->updated_at         = date('Y-m-d H:i:s');        

        $mcn->save();

        $insertedId = $mcn->id;

        if($request->hasfile('machineImgs'))
        {
            $counter =1;
            foreach($request->file('machineImgs') as $image)
            {               
                $imageName   = 'machine_'.time().$counter.'.'.$image->getClientOriginalExtension();
                $destination = public_path('uploads/mcn_images/');
                $image->move($destination, $imageName);

                $img = new Image_process;
                $img->image_url     = $imageName;
                $img->image_type    = 'machine';
                $img->for_image_id  = $insertedId;
                $img->status        = 'Active';
                $img->created_at    = date('Y-m-d H:i:s');        
                $img->save();

                $counter++;
            }     
            
        }

        // return \Redirect::route('machine.create')->with(['message'=>'Machine updated successfully.']);

        $orgId = base64_encode(Input::get('organisation'));

        return \Redirect::route("organisation.edit",['id'=>$orgId])->with(['message'=>'Machine updated successfully.']);
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
