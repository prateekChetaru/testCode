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
use App\Mdr_form;
use App\Mdr_answer;
use App\Mdr_question;
use App\Mdr_form_option_choice;
use Storage;


class AdminMachineDirectiveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mdrForm = Mdr_form::where('status','Active')->where('user_configured',0)->orderBy('id','DESC')->paginate(9);

        return view('admin/machine/listMachineDirectives',compact('mdrForm'));
    }

    public function user_configured()
    {
        $mdrForm = Mdr_form::where('status','Active')->where('user_configured',1)->where('user_id',Auth::user()->id)->orderBy('id','DESC')->paginate(9);

        return view('admin/machine/user_configured',compact('mdrForm'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/machine/addMachineDirective');
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


        $tempRow = Mdr_form::where('name',$templateName)
        ->where('status','Active')
        ->first();


        if(!empty($tempRow))
        {          
            $temp = $templateName.'_copy';

            $tempRowCopy = Mdr_form::where('name','LIKE',"%{$temp}%")
            ->where('status','Active')
            ->get();

            if(!empty($tempRowCopy))
            {
                $templateName = $templateName.'_copy_'.(count($tempRowCopy)+(int)1);

            }else{

                $templateName = $templateName.'_copy';
            }

        }


        $form =  new Mdr_form();

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

                $inpt = new Mdr_question();
                
                
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

                    $frmOpt = new Mdr_form_option_choice();

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

        // dd($tempId);
        $templete = Mdr_form::find($tempId);

        $tempInputTypes = Mdr_question::with('option')
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



    return view('admin/machine/makeCopyMachineDirective',compact('templete','tempInputTypes','inputArray'));

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
    //get custom question  from data 
    public function addCustomform()
    {

        $tempId = Input::get('id');

        $templete = Mdr_form::find($tempId);

        $question = Mdr_question::with('option')
        ->where('status','Active')
        ->where('form_id',$tempId)
        ->get();

        return view('admin/machine/addMachineAnswer',compact('templete','question'));
    }

    public function previewForm()
    {
        $tempId = Input::get('tempId');
        $machineId = Input::get('machineId');
        

        $templete = Mdr_form::find($tempId);

        $question = Mdr_question::with('option')
        ->where('status','Active')
        ->where('form_id',$tempId)
        ->get();

        //variable for showing update button in view form
        $showUpdateBtn='';
        if(!empty(Input::get('updateBtn')))
        {
            $showUpdateBtn=1;
        }

        return view('admin/machine/viewMachineDirectiveModal',compact('templete','question','machineId','showUpdateBtn'));
    }

    //insert custom form data  
    public function addAnswers(Request $request)
    {



        $postdata   = Input::all();

        $userId     = Auth::user()->id;

        $formId     = Input::get('formId');

        $texta      = Input::get('texta')?Input::get('texta'):array();
        $textq      = Input::get('textq')?Input::get('textq'):array(); 

        $select     = Input::get('select')?Input::get('select'):array();

        $dateq      = Input::get('dateq')?Input::get('dateq'):array();
        $datea      = Input::get('datea')?Input::get('datea'):array();

        $checkbox   = Input::get('checkbox')?Input::get('checkbox'):array();

        $checkradio = Input::get('checkradio')?Input::get('checkradio'):array();

        $imageq     = Input::get('imageq')?Input::get('imageq'):array();
        $imagea     = Input::get('imagea')?Input::get('imagea'):array(); 

        $textarea   = Input::get('textarea')?Input::get('textarea'):array();
        $textareq   = Input::get('textareq')?Input::get('textareq'):array();

        $machineId = Input::get('machineId')?Input::get('machineId'):0;

        $isMachine = Mdr_answer::where('machine_id',$machineId);

        



        if($isMachine->count()>0)
        {
            Mdr_answer::where('machine_id',$machineId)
            ->delete();

        }


        //insert text inputs        
        if(Count($texta)>0)
        {
            for ($i=0; $i < Count($texta) ; $i++) 
            {
                if(!empty($texta[$i]))
                {
                   $ans = new Mdr_answer();

                   $ans->user_id         = $userId;
                   $ans->machine_id      = $machineId;
                   $ans->answer_text     = str_replace("&nbsp;", '',$texta[$i]);
                   $ans->form_id         = $formId;
                   $ans->question_id     = $textq[$i];
                   $ans->option_choice_id= 0;
                   $ans->status          = 'Active';
                   $ans->created_at      = date('Y-m-d H:i:s');

                   $ans->save();
               }
           }
       }
       //insert checkbox inputs
       if(count($checkbox)>0)
       {
        for ($i=0; $i < count($checkbox) ; $i++) 
        { 
            $checkarray = explode('-', $checkbox[$i]);

            if(!empty($checkarray[1]))
            {
                $ans = new Mdr_answer();

                $ans->user_id         = $userId;
                $ans->machine_id      = $machineId;
                $ans->form_id         = $formId;           
                $ans->question_id     = $checkarray[0];
                $ans->option_choice_id= $checkarray[1];
                $ans->status          = 'Active';
                $ans->created_at      = date('Y-m-d H:i:s');

                $ans->save();
            }

        }

    }
    //insert radio inputs
    if(count($checkradio)>0)
    {
        for($i = 1;$i<=count($checkradio);$i++)
        {
         
            if($checkradio[$i]!='')
            {

                $radioarray = explode('-', $checkradio[$i][0]);
                if(!empty($radioarray[1]))
                {
                    $ans = new Mdr_answer();

                    $ans->user_id         = $userId;
                    $ans->machine_id      = $machineId;
                    $ans->form_id         = $formId;           
                    $ans->question_id     = $radioarray[0];
                    $ans->option_choice_id= $radioarray[1];
                    $ans->status          = 'Active';
                    $ans->created_at      = date('Y-m-d H:i:s');

                    $ans->save();
                }
            }

        }        
    }
           //insert  select input
    if(count($select)>0)
    {
        for ($i=0; $i < count($select) ; $i++) 
        { 
            if($select[$i]!='')
            {
                $dropdownrray = explode('-', $select[$i]);

                if(!empty($dropdownrray[1]))
                {
                    $ans = new Mdr_answer();

                    $ans->user_id          = $userId; 
                    $ans->machine_id       = $machineId;              
                    $ans->form_id          = $formId;
                    $ans->question_id      =  $dropdownrray[0];
                    $ans->option_choice_id = $dropdownrray[1];
                    $ans->status           = 'Active';
                    $ans->created_at       = date('Y-m-d H:i:s');

                    $ans->save();
                }
            }
        }
    }
    //insert date data
    if(count($dateq)>0)
    {
        for ($i=0; $i < count($dateq) ; $i++) 
        { 
            if(!empty($datea[$i]))
            {

                $ans = new Mdr_answer();  

                $ans->user_id          = $userId;  
                $ans->machine_id       = $machineId; 
                $ans->answer_text      = date('Y-m-d H:i:s', strtotime($datea[$i]));            
                $ans->form_id          = $formId;
                $ans->question_id      = $dateq[$i];  
                $ans->option_choice_id = 0;            
                $ans->status           = 'Active';
                $ans->created_at       = date('Y-m-d H:i:s');

                $ans->save();

            }

        }        
    }
//insert image
    if(count($imageq)>0)
    {
      $counter=1;
      for ($i=0; $i < count($imageq) ; $i++) 
      { 
        if($imageq[$i]!='')
        {

         if($request->hasfile('imagea'))
         {
            
            $imageName = 'form_imgs_'.time().$counter.'.'.$request->file('imagea')[$i]->getClientOriginalExtension();
             $destination = public_path('uploads/form_images/');
           $request->file('imagea')[$i]->move($destination, $imageName);
            
            //Storage::putFile('uploads', $request->file('imagea')[$i]);

            //Storage::PutFileAs('public',$request->file('imagea')[$i],$imageName);

            $ans = new Mdr_answer();  

            $ans->user_id          = $userId;
            $ans->machine_id       = $machineId;
            $ans->form_id          = $formId;
            $ans->answer_text      = $imageName;
            $ans->question_id      = $imageq[$i];  
            $ans->option_choice_id = 0;            
            $ans->status           = 'Active';
            $ans->created_at       = date('Y-m-d H:i:s');

            $ans->save();

            $counter++;
            
          

        }
    }
}    
}

if(count($textareq)>0)
{
    for ($i=0; $i < count($textareq) ; $i++) 
    { 
        if(!empty($textarea[$i]))
        {
            $ans = new Mdr_answer();  

            $ans->user_id          = $userId;
            $ans->machine_id       = $machineId;
            $ans->form_id          = $formId;
            $ans->answer_text      = str_replace("&nbsp;", '',$textarea[$i]);
            $ans->question_id      = $textareq[$i];  
            $ans->option_choice_id = 0;            
            $ans->status           = 'Active';
            $ans->created_at       = date('Y-m-d H:i:s');

            $ans->save();
        }  
    }    
}
}

/*update machine directives answers */
public function updateMachineDirectiveAnswers(Request $request)
{

    $postdata = Input::all();

    // print_r($postdata);
    
    $formId     = Input::get('formId');
    $userId     = Auth::user()->id;

    $textAnsId  = Input::get('textq')?Input::get('textq'):array(); 
    $texta      = Input::get('texta')?Input::get('texta'):array();    

    $dateq      = Input::get('dateq')?Input::get('dateq'):array();
    $datea      = Input::get('datea')?Input::get('datea'):array();

    $checkbox   = Input::get('checkbox')?Input::get('checkbox'):array();

    $checkradio = Input::get('checkradio')?Input::get('checkradio'):array();

    $select     = Input::get('select')?Input::get('select'):array();

    $imageq     = Input::get('imageq')?Input::get('imageq'):array();
    $imagea     = Input::get('imagea')?Input::get('imagea'):array(); 

    $textarea   = Input::get('textarea')?Input::get('textarea'):array();
    $textareq   = Input::get('textareq')?Input::get('textareq'):array();

    $machineId = Input::get('machineId')?Input::get('machineId'):0;

        //insert text inputs        
    if(Count($texta)>0)
    {
        for ($i=0; $i < Count($texta) ; $i++) 
        {
            if(!empty($textAnsId[$i]))
            {
                $ans = Mdr_answer::find($textAnsId[$i]);

                $ans->answer_text     = str_replace("&nbsp;", '',$texta[$i]);
                $ans->updated_at      = date('Y-m-d H:i:s');
                $ans->save();
            }
        }
    }
    
    
    //insert checkbox inputs
    if(count($checkbox)>0)
    {
        $checkarray = explode('-', $checkbox[0]);

        
        if(!empty($checkarray[0]))
        {
            Mdr_answer::where('question_id',$checkarray[0])
            ->where('machine_id',$machineId)
            
            ->delete();

        }        

        for ($i=0; $i < count($checkbox) ; $i++) 
        { 
            $checkarray = explode('-', $checkbox[$i]);

            if(!empty($checkarray[1]))
            {

                $ans = new Mdr_answer();

                $ans->user_id         = Auth::user()->id;;
                $ans->machine_id      = $machineId;
                $ans->form_id         = $formId;           
                $ans->question_id     = $checkarray[0];
                $ans->option_choice_id= $checkarray[1];
                $ans->status          = 'Active';
                $ans->created_at      = date('Y-m-d H:i:s');
                $ans->save();
            }
        }
    }

    
    //insert radio inputs
    if(count($checkradio)>0)
    {

       
               


        for($i = 1;$i<=count($checkradio);$i++)
        {

              $radioarray = explode('-', $checkradio[$i][0]);

             if(!empty($radioarray[0]))
        {
            Mdr_answer::where('question_id',$radioarray[0])
            ->where('machine_id',$machineId)
            
            ->delete();

        }
            if($checkradio[$i]!='')
            {

                $radioarray = explode('-', $checkradio[$i][0]);
                if(!empty($radioarray[1]))
                {
                     $ans = new Mdr_answer();

                $ans->user_id         = Auth::user()->id;;
                $ans->machine_id      = $machineId;
                $ans->form_id         = $formId;           
                $ans->question_id     = $radioarray[0];
                $ans->option_choice_id= $radioarray[1];
                $ans->status          = 'Active';
                $ans->created_at      = date('Y-m-d H:i:s');
                $ans->save();
                }
            }

        }        
    }

           //insert  select input
    if(count($select)>0)
    {
        for ($i=0; $i < count($select) ; $i++) 
        { 
            if($select[$i]!='')
            {
                $dropdownrray = explode('-', $select[$i]);

                if(!empty($dropdownrray[1]))
                {
                    $ans = Mdr_answer::find($dropdownrray[0]);

                    $ans->option_choice_id = $dropdownrray[1];                   
                    $ans->updated_at       = date('Y-m-d H:i:s');
                    $ans->save();
                }
            }

        }
    }


    //insert date data
    if(count($dateq)>0)
    {
        for ($i=0; $i < count($dateq) ; $i++) 
        { 
            if(!empty($datea[$i]))
            {

                $ans = Mdr_answer::find($dateq[$i]);  

                $ans->answer_text      = date('Y-m-d H:i:s', strtotime($datea[$i]));            
                $ans->updated_at       = date('Y-m-d H:i:s');
                $ans->save();

            }

        }        
    }

//insert image
//     if(count($imageq)>0)
//     {

//         for ($i=0; $i < count($imageq) ; $i++) 
//         { 
//             if($imageq[$i]!='')
//             {

//              if($request->hasfile('imagea'))
//              {
//                 $counter=1;
//                 foreach($request->file('imagea') as $image)
//                 {               
//                     $imageName   = 'form_imgs_'.time().$counter.'.'.$image->getClientOriginalExtension();
//                     $destination = public_path('uploads/form_images/');
//                     $image->move($destination, $imageName);

//                     $ans = Mdr_answer::find($imageq[$i]);  

//                     $ans->answer_text      = $imageName;                  
//                     $ans->updated_at       = date('Y-m-d H:i:s');
//                     $ans->save();

//                     $counter++;
//                 }          

//             }
//         }
//     }    
// }

      if(count($imageq)>0)
    {
      $counter=1;


      for ($i=0; $i < count($imageq) ; $i++) 
      { 
        if($imageq[$i]!='')
        {


         if($request->hasfile('imagea'))
         {
           
            $imageName = 'form_imgs_'.time().$counter.'.'.$request->file('imagea')[$i]->getClientOriginalExtension();

            

            $destination = public_path('uploads/form_images/');
            $request->file('imagea')[$i]->move($destination, $imageName);

              $ans = Mdr_answer::find($imageq[$i]);  

                    $ans->answer_text      = $imageName;                  
                    $ans->updated_at       = date('Y-m-d H:i:s');
                    $ans->save();

            $counter++;
            
            

        }
    }
}    
}

if(count($textareq)>0)
{
    for ($i=0; $i < count($textareq) ; $i++) 
    { 
        if(!empty($textarea[$i]))
        {
            $ans = Mdr_answer::find($textareq[$i]);  
            
            $ans->answer_text      = str_replace("&nbsp;", '',$textarea[$i]);                  
            $ans->updated_at       = date('Y-m-d H:i:s');
            $ans->save();
        }  
    }    
}


}

//machine and their form 
public function getMachineDirectives()
{

   $users = Mdr_answer::groupBy('machine_id')->get();


//    foreach ($users as $key => $value) {
//     echo $value.'<br>';
// }   

}

/*get pre configure user directive page*/
public function editPreConfigUserDir($id)
{
    $tempId = base64_decode($id);

    $templete = Mdr_form::find($tempId);

    $tempInputTypes = Mdr_question::with('option')
    ->where('status','Active')
    ->where('form_id',$tempId)
    ->get();

    return view('admin/machine/editUserPreConfigMachineDirective',compact('templete','tempInputTypes'));

}

/*edit pre config machine directive option*/
public function editPreConfigUserInputOption($id){

 $id = base64_decode($id);

 $templete = Mdr_form::find($id);

 $tempInputTypes = Mdr_question::where('id',$id)->with('option')->first();

 return view('admin/machine/editUserPreConfigMachineDirectiveOption',compact('templete','tempInputTypes'));

}

/*update machine directives questio*/
public function updateMachineDirQues()
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
        $ans = mdr_question::find($questionId);

        $ans->question_name     = str_replace("&nbsp;", '',$question);
        $ans->updated_at      = date('Y-m-d H:i:s');
        $ans->save();

    }else {

        $ans = Mdr_question::find($questionId);

        $ans->question_name  = str_replace("&nbsp;", '',$question);
        $ans->updated_at     = date('Y-m-d H:i:s');
        $ans->save();

        //update existing options
        for ($i=0; $i <count($optionId); $i++) { 

            $opt = Mdr_form_option_choice::find($optionId[$i]);

            $opt->option_choice_name = str_replace("&nbsp;", '',$option[$i]);
            $opt->updated_at         = date('Y-m-d H:i:s');
            $opt->save();
        }

        //for options

        if(!empty($newOption)){
            for ($i=0; $i <count($newOption) ; $i++) 
            { 
                if(!empty($newOption[$i])){
                    $frmOpt = new Mdr_form_option_choice();

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

/*and new  values in existing user config form*/
public function addNewInputs(Request $request)
{
    $formId = Input::get('formId');

    $insertedId = $formId;

    $json_decode = json_decode(Input::get('formArray'));

    $counter=1;
    foreach ($json_decode as $formValue) 
    {

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
                break;

                case 'textarea':
                $inputTypeId =8;
                break;

                default:
                $inputTypeId =0;
                break;
            }

            $inpt = new Mdr_question();

            $inpt->input_type_id = $inputTypeId;
            $inpt->form_id       = $insertedId;
            $inpt->question_name = str_replace("&nbsp;", '',$formValue->label);
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

                $frmOpt = new Mdr_form_option_choice();

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
/*make copy of machine directive */
public function editMachineDirective($id){

 $tempId = base64_decode($id);

 $templete = Mdr_form::find($tempId);

 $tempInputTypes = Mdr_question::with('option')
 ->where('status','Active')
 ->where('form_id',$tempId)
 ->get();

 return view('admin/machine/editMachineDirective',compact('templete','tempInputTypes'));
}

}
