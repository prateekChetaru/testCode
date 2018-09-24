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
use App\User;
use App\Machine;
use App\Udr_form;
use App\Udr_answer;
use App\Udr_question;
use App\Udr_form_option_choice;
use App\Udr_operation_history;

class AdminUserDirectiveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userDirectives = Udr_form::where('status','Active')
        ->where('user_configured',0)
        ->orderBy('id','DESC')
        ->paginate(9);

        return view('admin/user_dir/listUserDirectives',compact('userDirectives'));
    }

    /*get user directive configured list*/
    public function userConfigured()
    {
        $userConfigure = Udr_form::where('status','Active')
        ->where('user_configured',1)
        ->where('user_id',Auth::user()->id)
        ->orderBy('id','DESC')
        ->paginate(9);

        return view('admin/user_dir/listUserConfigured',compact('userConfigure'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

       return view('admin/user_dir/addUserDirective');
   }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

      $templateName = Input::get('templateName');

      $tempRow = Udr_form::where('name',$templateName)
      ->where('status','Active')
      ->first();


      if(!empty($tempRow))
      {          
        $temp = $templateName.'_copy';

        $tempRowCopy = Udr_form::where('name','LIKE',"%{$temp}%")
        ->where('status','Active')
        ->get();

        if(!empty($tempRowCopy))
        {
            $templateName = $templateName.'_copy_'.(count($tempRowCopy)+(int)1);

        }else{

            $templateName = $templateName.'_copy';
        }

    }


    $form =  new Udr_form();

    $form->name       = $templateName;
    $form->status     = 'Active';
    $form->created_at = date('Y-m-d H:i:s');
    $form->user_id    = Auth::user()->id;
    $form->user_configured = Input::get('user_configured');
    $form->save();

    $insertedId = $form->id;

    $json_decode = json_decode(Input::get('formArray'));

    $counter=1;


    foreach ($json_decode as $formValue) 
    {

        if($insertedId && !empty($formValue->type) && !empty($formValue->label))
        {
             if($formValue->type=="hidden")
            {
               $formValue->label="Hidden"; 
            }
            switch ($formValue->type) 
            { 
                case 'text':
                $inputTypeId =1;
                break;

                case 'checkbox-group':
                $inputTypeId =2;
                break;

                case 'radio-group':
                $inputTypeId =3;
                break;

                case 'select':
                $inputTypeId =4;
                break;                

                case 'date':
                $inputTypeId =5;
                break;

                case 'file':
                $inputTypeId =6;
                break;

                case 'hidden':
                $inputTypeId =7;
                break;

                case 'textarea':
                $inputTypeId =8;
                break;

                default:
                $inputTypeId =0;
                break;
            }

            $inpt = new Udr_question();


            $inpt->input_type_id = $inputTypeId;
            $inpt->form_id       = $insertedId;
            $inpt->question_name = str_replace("&nbsp;", '', $formValue->label);
            $inpt->question_order=$counter;
            $inpt->status        = 'Active';
            $inpt->created_at    = date('Y-m-d H:i:s');
            $inpt->save();

            $inptInsertedId = $inpt->id;

            if($inputTypeId==2 || $inputTypeId==3 ||$inputTypeId==4)
            {
                foreach ($formValue->values as $optValue)
                {

                 switch ($formValue->type) 
                 { 
                    case 'text':
                    $inputTypeId =1;
                    break;

                    case 'checkbox-group':
                    $inputTypeId =2;
                    break;

                    case 'radio-group':
                    $inputTypeId =3;
                    break;

                    case 'select':
                    $inputTypeId =4;
                    break;                

                    case 'date':
                    $inputTypeId =5;
                    break;

                    case 'file':
                    $inputTypeId =6;
                    break;

                    case 'hidden':
                    $inputTypeId =7;
                    break;

                    case 'textarea':
                    $inputTypeId =8;
                    break;

                    default:
                    $inputTypeId =0;
                    break;
                }

                $frmOpt = new Udr_form_option_choice();

                $frmOpt->option_group_id    = $inputTypeId;
                $frmOpt->question_id        = $inptInsertedId;
                $frmOpt->option_choice_name = str_replace("&nbsp;", '',$optValue->label);
                $frmOpt->value              = str_replace("&nbsp;", '',$optValue->value);                      
                $frmOpt->status             = 'Active';
                $frmOpt->created_at         = date('Y-m-d H:i:s');
                $frmOpt->save();                      

            }

        }
    }

    $counter++;
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

       $tempId = base64_decode($id);

       $templete = Udr_form::find($tempId);

       $tempInputTypes = Udr_question::with('option')
       ->where('status','Active')
       ->where('form_id',$tempId)
       ->get();

       return view('admin/user_dir/editUserDirective',compact('templete','tempInputTypes'));

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
        //
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


    /*and new  values in existing user config form*/
    public function addNewInputs(Request $request)
    {
        $formId = Input::get('formId');

        $insertedId = $formId;

        $json_decode = json_decode(Input::get('formArray'));

        $counter=1;
        

        foreach ($json_decode as $formValue) 
        {
            if($formValue->type=="hidden")
            {
               $formValue->label="Hidden"; 
            }

            if($insertedId && !empty($formValue->type) && !empty($formValue->label))
            {

                switch ($formValue->type) 
                { 
                    case 'text':
                    $inputTypeId =1;
                    break;

                    case 'checkbox-group':
                    $inputTypeId =2;
                    break;

                    case 'radio-group':
                    $inputTypeId =3;
                    break;

                    case 'select':
                    $inputTypeId =4;
                    break;                

                    case 'date':
                    $inputTypeId =5;
                    break;

                    case 'file':
                    $inputTypeId =6;
                    break;

                    case 'hidden':
                    $inputTypeId =7;
                     echo "string";
                    break;

                    case 'textarea':
                    
                    $inputTypeId =8;
                    break;

                    default:
                    $inputTypeId =0;
                    break;
                }

                $inpt = new Udr_question();

                $inpt->input_type_id = $inputTypeId;
                $inpt->form_id       = $insertedId;
                $inpt->question_name = str_replace("&nbsp;", '',$formValue->label);
                $inpt->question_order= $counter;
                $inpt->status        = 'Active';
                $inpt->created_at    = date('Y-m-d H:i:s');

                $inpt->save();

                $inptInsertedId = $inpt->id;

                if($inputTypeId==2 || $inputTypeId==3 ||$inputTypeId==4)
                {
                    foreach ($formValue->values as $optValue)
                    {

                       switch ($formValue->type) 
                       { 
                        case 'text':
                        $inputTypeId =1;
                        break;

                        case 'checkbox-group':
                        $inputTypeId =2;
                        break;

                        case 'radio-group':
                        $inputTypeId =3;
                        break;

                        case 'select':
                        $inputTypeId =4;
                        break;                

                        case 'date':
                        $inputTypeId =5;
                        break;

                        case 'file':
                        $inputTypeId =6;
                        break;

                        case 'hidden':
                        $inputTypeId =7;

                        break;

                        case 'textarea':
                        $inputTypeId =8;
                        break;

                        default:
                        $inputTypeId =0;
                        break;
                    }

                    $frmOpt = new Udr_form_option_choice();

                    $frmOpt->option_group_id    = $inputTypeId;
                    $frmOpt->question_id        = $inptInsertedId;
                    $frmOpt->option_choice_name = str_replace("&nbsp;", '',$optValue->label);
                    $frmOpt->value              = str_replace("&nbsp;", '',$optValue->value);                      
                    $frmOpt->status             = 'Active';
                    $frmOpt->created_at         = date('Y-m-d H:i:s');
                    $frmOpt->save();                      

                }

            }
        }

        $counter++;
    }
}

/*make copy of user directive */
public function editUserDirective($id)
{

   $tempId = base64_decode($id);

   // dd($tempId);
   $templete = Udr_form::find($tempId);

   $tempInputTypes = Udr_question::with('option')
   ->where('status','Active')
   ->where('form_id',$tempId)
   ->get();

   $inputArray = array();

   foreach ($tempInputTypes as $value)
   {            

      switch ($value->input_type_id) 
      { 
     //text
        case 1:
        $input = array(
            "type"=>"text",
            "label"=>$value->question_name,
            "className"=>"form-control",
            "name"=>"text-1533210501837",
            "subtype"=>"text"
        );
        break;

                //checkbox
        case 2:
        $checkboxArr = array();

        if(!empty($value->option)){

            foreach ($value->option as $cValue) {
                $result = array(
                    "label"=> $cValue->option_choice_name,
                    "value"=> ""
                );
                array_push($checkboxArr, $result);
            }
        }

        $input =array(
            "type"=> "checkbox-group",
            "label"=> $value->question_name,
            "name"=> "checkbox-group-1533210512386",
            "values"=>$checkboxArr 
        );

        break;
                //radio
        case 3:

        $radioArr = array();

        if(!empty($value->option)){

            foreach ($value->option as $rValue) {
                $result = array(
                    "label"=> $rValue->option_choice_name,
                    "value"=> ""
                );
                array_push($radioArr, $result);
            }
        }

        $input = array(
            "type"=>"radio-group",
            "label"=>$value->question_name,
            "name"=>"radio-group-1533210523122",
            "values"=>$radioArr
        );
        break;
                        //dropdown
        case 4:

        $selectArr = array();

        if(!empty($value->option)){

            foreach ($value->option as $oValue) {
                $result = array(
                    "label"=> $oValue->option_choice_name,
                    "value"=> ""
                );
                array_push($selectArr, $result);
            }
        }

        $input = array(
            "type"=> "select",
            "label"=>$value->question_name,
            "className"=> "form-control",
            "name"=>"select-1533210524090",
            "values"=>$selectArr
        );
        break;                
                                //date
        case 5:
        $input =array(
            "type"=> "date",
            "label"=> $value->question_name,
            "className"=> "form-control",
            "name"=> "date-1533210535490"
        );
        break;
                                //file
        case 6:
        $input = array(
            "type"=> "file",
            "label"=> $value->question_name,
            "className"=> "form-control",
            "name"=> "file-1533210536426",
            "subtype"=> "file");
        break;
                                //hidden
        case 7:
        $input =array(
            "type"=>"hidden",
            "label"=>$value->question_name,
            "className"=>"form-control",
            "name"=>"hidden-1533211168757-preview",
            "subtype"=>"hidden"
        );
        break;
                                //textarea
        case 8:
        $input =array(
            "type"=> "textarea",
            "label"=> $value->question_name,
            "className"=> "form-control",
            "name"=> "textarea-1533210547002",
            "subtype"=> "textarea"
        );
        break;

        default:
        $input ='{}';
        break;

    }

    array_push($inputArray, $input);
}

$inputArray = json_encode($inputArray);

return view('admin/user_dir/makeCopyUserDirective',compact('templete','tempInputTypes','inputArray'));

}

/*edit pre config user directive option*/
public function editPreConfigUserInputOption($id)
{

 $id = base64_decode($id);

 $templete = Udr_form::find($id);

 $tempInputTypes = Udr_question::where('id',$id)->with('option')->first();

 return view('admin/user_dir/editUserPreConfigDirectiveOption',compact('templete','tempInputTypes'));

}

/*update user directives questio*/
public function updateUserDirQues()
{
    $questionId  = Input::get('updateId');

    $inputType   = Input::get('inputType');

    $question    = Input::get('question');

    $option      = Input::get('option')?Input::get('option'):array();

    $optionId    = Input::get('optionId')?Input::get('optionId'):array();

    $newOption   = Input::get('newOption')?Input::get('newOption'):array();

    $inputTypeId = Input::get('inputTypeId')?Input::get('inputTypeId'):0;



    if($inputType==1 || $inputType==5 || $inputType==6 || $inputType==7 || $inputType==8)
    {
        $ans = Udr_question::find($questionId);

        $ans->question_name     = str_replace("&nbsp;", '',$question);
        $ans->updated_at      = date('Y-m-d H:i:s');
        $ans->save();

    }else {

        $ans = Udr_question::find($questionId);

        $ans->question_name  = str_replace("&nbsp;", '',$question);
        $ans->updated_at     = date('Y-m-d H:i:s');
        $ans->save();

        //update existing options
        for ($i=0; $i <count($optionId); $i++) { 

            $opt = Udr_form_option_choice::find($optionId[$i]);

            $opt->option_choice_name = str_replace("&nbsp;", '',$option[$i]);
            $opt->updated_at         = date('Y-m-d H:i:s');
            $opt->save();
        }

        //for options

        if(!empty($newOption)){
            for ($i=0; $i <count($newOption) ; $i++) 
            { 
                if(!empty($newOption[$i])){
                    $frmOpt = new Udr_form_option_choice();

                    $frmOpt->option_group_id    = $inputTypeId;
                    $frmOpt->question_id        = $questionId;
                    $frmOpt->option_choice_name = str_replace("&nbsp;", '',$newOption[$i]);
                    $frmOpt->value              = str_replace("&nbsp;", '',$newOption[$i]);                      
                    $frmOpt->status             = 'Active';
                    $frmOpt->created_at         = date('Y-m-d H:i:s');
                    $frmOpt->save();       
                }
            }
        }

    }

    return back()->withInput(['message'=>'Changes Saved.']);
}

/*get pre configure user directive page*/
public function editPreConfigUserDir($id)
{
    $tempId = base64_decode($id);

    $templete = Udr_form::find($tempId);

    $tempInputTypes = Udr_question::with('option')
    ->where('status','Active')
    ->where('form_id',$tempId)
    ->get();

    return view('admin/user_dir/editUserPreConfigDirective',compact('templete','tempInputTypes'));

}

/*get machine opeartion user list*/
public function getMachineOperationUserList($id)
{
    $id = base64_decode($id);

    $machineOperationUser = Udr_operation_history::with('user')
    ->where('status','Active')
    ->where('machine_id',$id)
    ->orderBy('created_at','DESC')
    ->paginate(10);

    $machine = Machine::find($id);


    return view('admin/machine/listMachineOperationUser',compact('machineOperationUser','machine'));

}

/*get user directive filled answer form*/
public function getUserDirectiveAnsPreview()
{
    $post = Input::all();

    $userId             = Input::get('userId');
    $machineId          = Input::get('machineId');
    $formId             = Input::get('formId');
    $operationHistoryId = Input::get('operationHistoryId');
    
    $templete = Udr_form::find($formId);
      
    $question = Udr_question::with('option')
    ->where('status','Active')
    ->where('form_id',$formId)
    ->get();
    
    return view('admin/machine/viewUserDirectiveAnsModal',compact('templete','question','machineId','userId','formId','operationHistoryId'));
}


}
