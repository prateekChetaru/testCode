<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use DB;
use App\User;
use App\Department;
use App\Office;
use App\Organisation;
use App\Machine;
use App\Image_process;
use App\Mdr_form;
use App\Mdr_answer;
use App\Mdr_question;
use App\Mdr_input_type;
use App\Mdr_form_option_choice;
use App\Udr_question;
use App\Udr_answer;
use App\Udr_operation_history;


class ApiMachineController extends Controller
{

 public function machineDetail()
 {

    $resultArray = array();

    $machineId = Input::get('id');

    $machine = Machine::with('office.organisation')
    ->where('id',$machineId)
    ->first();  

    if(!empty($machine))
    {
        $inductorIdArray    = json_decode($machine->inductor_id);
        $trainedUserIdArray = json_decode($machine->trained_user_id);

        $resultArray['id']            = $machine->id;
        $resultArray['machine']       = $machine->machine;
        $resultArray['machineId']     = $machine->machine_id;
        $resultArray['officeId']      = $machine->office_id;
        $resultArray['officeName']    = $machine->office->office;
        // $resultArray['inductorId']    = json_decode($machine->inductor_id);
        $resultArray['orgId']         = $machine->org_id;
        $resultArray['orgName']       = $machine->office->organisation->organisation;
        // $resultArray['trainedUserId'] = json_decode($machine->trained_user_id);
        $resultArray['machineStatus'] = $machine->machine_status;
        $resultArray['qrCode']        = url('/public/uploads/qr_code').'/'.$machine->qr_code;
        $resultArray['latitude']      = $machine->latitude;
        $resultArray['longitude']     = $machine->longitude;

        $images = Image_process::where('status','Active')
        ->select('image_url')
        ->where('for_image_id',$machineId)
        ->get();

        $inductorArray = array();

        foreach ($inductorIdArray as $iValue) {

            $inductors = User::where('id',$iValue)
            ->select('id','name','last_name')
            ->first();

            $indChild['inductorName'] = '';
            $indChild['id'] = '';

            if(!empty($inductors)){

                $indChild['id'] = $inductors->id;
                $indChild['inductorName'] = ucfirst($inductors->name) .' '.ucfirst($inductors->last_name);
            }
            array_push($inductorArray, $indChild);         
            
        }

        $resultArray['inductors'] = $inductorArray;


        $trainedUsersArray = array();

        foreach ($trainedUserIdArray as $tValue) {

            $trainedUsers = User::where('id',$tValue)
            ->select('id','name','last_name')
            ->first();

            $trinedUserChild['trainedUserName'] = '';
            $trinedUserChild['id'] = '';

            if(!empty($trainedUsers)){

                $trinedUserChild['id'] = $trainedUsers->id;
                $trinedUserChild['trainedUserName'] = $trainedUsers->name .' '.ucfirst($trainedUsers->last_name);
            }
            array_push($trainedUsersArray, $trinedUserChild);         

        }

        $resultArray['trainedUsers'] = $trainedUsersArray;

        $imageArray = array();
        foreach ($images as $value) {

            $result['image'] = url('/public/uploads/mcn_images\/').$value->image_url;
            array_push($imageArray, $result);
        } 
        
        $resultArray['machineImages'] = $imageArray;
        

        return response()->json(['code'=>200,'status'=>true,'service_name'=>'Machine-Detail','message'=>'Machine detail','data'=>$resultArray]);
    }
    else
    {

        return response()->json(['code'=>400,'status'=>false,'service_name'=>'Machine-Detail','message'=>'Machine detail not found','data'=>$resultArray]);

    }
    
}

/*get machine directive form*/

public function getMachineDirective()
{

    $resultArray = array();

    $machineId = Input::get('machineId');

    $templeteAnswers = Mdr_answer::with('form')
    ->where('status','Active')
    ->where('machine_id',$machineId)->first();
    
    if(empty($templeteAnswers)){

        return response()->json(['code'=>400,'status'=>false,'service_name'=>'Machine-Directive','message'=>'Machine Directive not available.','data'=>$resultArray]);
    }


    

    $resultArray['templateId'] = $templeteAnswers->form->id;
    $resultArray['templateName'] = $templeteAnswers->form->name;

    $MdrQuestion = Mdr_question::with('option')
    ->where('status','Active')
    ->where('form_id',$templeteAnswers->form->id)->get();

    $answerArray = array();

    foreach ($MdrQuestion as $qValue) {

        $MdrAnswers = Mdr_answer::where('status','Active')
        ->where('machine_id',$templeteAnswers->machine_id)
        ->where('question_id',$qValue->id)
        ->first();

        $result['questionId'] = $qValue->id;
        $result['inputTypeId']= $qValue->input_type_id;
        $result['question']   = $qValue->question_name;

        $result['answer']     = '';
        if(!empty($MdrAnswers->answer_text)){
            $result['answer']     = $MdrAnswers->answer_text;
        }

        if($qValue->input_type_id==6)
        {
            $answerImg = (!empty($MdrAnswers->answer_text)?$MdrAnswers->answer_text:'');

            $result['answer']='';

            if(!empty($answerImg))
            {
                $result['answer']  = url('/public/uploads/form_images').'/'.$answerImg;
            }

            
        }
        
        $radioans = Mdr_answer::where('status','Active')
        ->where('machine_id',$templeteAnswers->machine_id)
        ->where('question_id',$qValue->id)->get();

        $optionArray     = array();

        $allOptionsArray = array();

    if($qValue->input_type_id==2){ //checkbox

        foreach ($radioans as  $optValue)
        {
            array_push($optionArray, $optValue['option_choice_id']);
        }


        foreach ($qValue->option as $queOvalue) {

            $opt['optionId'] = $queOvalue->id;
            $opt['optionValue'] = $queOvalue->option_choice_name;

            array_push($allOptionsArray, $opt);
        }


    }else if($qValue->input_type_id==3){ //radio

      foreach ($radioans as  $optValue) 
      {

        array_push($optionArray, $optValue['option_choice_id']);
    }

    foreach ($qValue->option as $queOvalue) {

        $opt['optionId'] = $queOvalue->id;
        $opt['optionValue'] = $queOvalue->option_choice_name;

        array_push($allOptionsArray, $opt);
    }

    }else if($qValue->input_type_id==4){ //select

        foreach ($radioans as  $optValue)
        {
            array_push($optionArray, $optValue['option_choice_id']);
        }

        foreach ($qValue->option as $queOvalue) {

            $opt['optionId'] = $queOvalue->id;
            $opt['optionValue'] = $queOvalue->option_choice_name;

            array_push($allOptionsArray, $opt);
        }
    }

    $result['options']    = $optionArray;
    $result['allOptions'] = $allOptionsArray;
    array_push($answerArray, $result);


}//ques foreach

$resultArray = $answerArray;

return response()->json(['code'=>200,'status'=>true,'service_name'=>'Machine-Directive','message'=>'Machine Directive','data'=>$resultArray]);
}

/*get input type list */
public function getInputTypes()
{

    $resultArray =array();

    $inputTypeIds = Mdr_input_type::select('id AS inputTypeId','name AS InputTypeName')
    ->where('status','Active')->get();


    return response()->json(['code'=>200,'status'=>true,'service_name'=>'Input-Type-List','message'=>'Input type list.','data'=>$inputTypeIds]);

}

/*get user directives form */
public function getUserDirective()
{

    $resultArray = array();

    $machineId   = Input::get('machineId');

    $machine     = Machine::find($machineId);

    if(empty($machine) || empty($machine->user_dir_id))
    {
        return response()->json(['code'=>400,'status'=>false,'service_name'=>'get-user-directive','message'=>'User Directive not Found.','data'=>$resultArray]);
    }
    

    $udrQuestion = Udr_question::with('option')
    ->where('status','Active')
    ->where('form_id',$machine->user_dir_id)->get();

    if(!$udrQuestion->count())
    {
        return response()->json(['code'=>400,'status'=>false,'service_name'=>'get-user-directive','message'=>'User Directive not Found.','data'=>$resultArray]);
    }
    
    foreach ($udrQuestion as $qValue) {

        $result['questionId'] = $qValue->id;
        $result['inputTypeId']= $qValue->input_type_id;
        $result['question']   = $qValue->question_name;

        $allOptionsArray = array();

        if($qValue->input_type_id==2 || $qValue->input_type_id==3 || $qValue->input_type_id==4){ 

            foreach ($qValue->option as $queOvalue)
            {
                $opt['optionId'] = $queOvalue->id;
                $opt['optionValue'] = $queOvalue->option_choice_name;

                array_push($allOptionsArray, $opt);
            }
        }

        $result['allOptions'] = $allOptionsArray;
        array_push($resultArray, $result);
    }

    

    return response()->json(['code'=>200,'status'=>true,'service_name'=>'get-user-directive','message'=>'User Directive','formId'=>$machine->user_dir_id,'data'=>$resultArray]);

}


/*add user directive answers*/
public function addUserDirectiveAnswers(Request $request)
{

    $resultArray = array();

    $machineId = Input::get('machineId');
    $formId    = Input::get('formId');
    $userId    = Auth::user()->id;
    $answers   = Input::get('answers');


    $oprHistory = new Udr_operation_history();

    $oprHistory->user_id      = $userId;
    $oprHistory->machine_id   = $machineId;
    $oprHistory->status       = 'Active';
    $oprHistory->created_at   = date('Y-m-d H:i:s');
    $oprHistory->save();

    $oprHistoryId = $oprHistory->id;

    $count=1;
    foreach ($answers as $value) 
    {

     if($value['inputTypeId']==2 || $value['inputTypeId']==3 || $value['inputTypeId']==4)
     {

        foreach ($value['option'] as $option)
        {

            $ans = new Udr_answer();

            $ans->operation_history_id = $oprHistoryId;
            $ans->user_id         = $userId;
            $ans->machine_id      = $machineId;     
            $ans->form_id         = $formId;
            $ans->question_id     = $value['questionId'];
            $ans->option_choice_id= $option;
            $ans->status          = 'Active';
            $ans->created_at      = date('Y-m-d H:i:s');
            $ans->save();

        }

    }else{

        $ans = new Udr_answer();

        $ans->operation_history_id = $oprHistoryId;
        $ans->user_id         = $userId;
        $ans->machine_id      = $machineId;     
        $ans->form_id         = $formId;
        $ans->answer_text     = $value['answer'];
        $ans->question_id     = $value['questionId'];
        $ans->option_choice_id= 0;
        $ans->status          = 'Active';
        $ans->created_at      = date('Y-m-d H:i:s');
        $ans->save();

    }

}


return response()->json(['code'=>200,'status'=>true,'service_name'=>'add-user-directive-answers','message'=>'User directive answers added successfully.','data'=>$resultArray]);


}  

/*add file */
public function addUserDirectiveFile(Request $request)
{
    $postData = Input::all();
    $resultArray =array();
    
    $url ='';
    $fileName ='';

    if(!empty($postData['file']))
    {             
        $image           = $request->file('file');
        $fileName        = 'user_ans_'.time().'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('/uploads/form_images/');
        $status          = $image->move($destinationPath, $fileName);
        $url = url('public/uploads/form_images/').'/'.$fileName;
    }

    return response()->json(['code'=>200,'status'=>true,'service_name'=>'add-user-directive-file','message'=>'','fileUrl'=>$url,'answer'=>$fileName,'data'=>$resultArray]);


}

/*get machine opeartion user list*/
public function getMachineOperationUserList()
{
    $machineId = Input::get('machineId');
    $userId    = Auth::user()->id;

    $machineOperationUser = Udr_operation_history::with('user')
    ->where('status','Active')
    ->where('machine_id',$machineId)
    ->where('user_id',$userId)
    ->orderBy('created_at','DESC')
    ->get();
    $result1 = array();
    foreach ($machineOperationUser as $value) {

        $machine = Machine::find($machineId);
        $resultArray['id'] = $value->id;  
        $resultArray['formId'] = $machine->user_dir_id;
        $resultArray['machineId'] = $machineId;
        $resultArray['machineName'] = $machine->machine;
        $resultArray['userId'] = $userId;
        $resultArray['userName'] = $value->user->name." ".$value->user->last_name;
        $resultArray['operationDate'] = date("Y-m-d H:i:s", strtotime($value->created_at));
        

        $UdrQuestion = Udr_question::with('option')
        ->where('status','Active')
        ->where('form_id', $machine->user_dir_id)->get();

        $answerArray = array();

        foreach ($UdrQuestion as $qValue) {

            $UdrAnswers = Udr_answer::where('status','Active')
            ->where('machine_id',$machineId)
            ->where('question_id',$qValue->id)
            ->where('user_id',$userId)
            ->where('form_id',$machine->user_dir_id)
            ->where('operation_history_id',$value->id)
            ->first();

            $result['questionId'] = $qValue->id;
            $result['inputTypeId']= $qValue->input_type_id;
            $result['question']   = $qValue->question_name;
            $result['answer']     = '';

            if(!empty($UdrAnswers->answer_text)){
                $result['answer']     = $UdrAnswers->answer_text;
            }

            if($qValue->input_type_id==6)
            {
                $answerImg = (!empty($UdrAnswers->answer_text)?$UdrAnswers->answer_text:'');

                $result['answer']='';

                if(!empty($answerImg))
                {
                    $result['answer']  = url('/public/uploads/form_images').'/'.$answerImg;
                }


            }

            $radioans = Udr_answer::where('status','Active')
            ->where('machine_id',$machineId)
            ->where('question_id',$qValue->id)
            ->where('user_id',$userId)
            ->where('form_id',$machine->user_dir_id)
            ->where('operation_history_id',$value->id)
            ->get();

            $optionArray     = array();

            $allOptionsArray = array();

            if($qValue->input_type_id==2){ //checkbox

                foreach ($radioans as  $optValue)
                {
                    array_push($optionArray, $optValue['option_choice_id']);
                }


                foreach ($qValue->option as $queOvalue) {

                    $opt['optionId'] = $queOvalue->id;
                    $opt['optionValue'] = $queOvalue->option_choice_name;

                    array_push($allOptionsArray, $opt);
                }


            }else if($qValue->input_type_id==3){ //radio

              foreach ($radioans as  $optValue) 
              {

                array_push($optionArray, $optValue['option_choice_id']);
            }

            foreach ($qValue->option as $queOvalue) {

                $opt['optionId'] = $queOvalue->id;
                $opt['optionValue'] = $queOvalue->option_choice_name;

                array_push($allOptionsArray, $opt);
            }

    }else if($qValue->input_type_id==4){ //select

        foreach ($radioans as  $optValue)
        {
            array_push($optionArray, $optValue['option_choice_id']);
        }

        foreach ($qValue->option as $queOvalue) {

            $opt['optionId'] = $queOvalue->id;
            $opt['optionValue'] = $queOvalue->option_choice_name;

            array_push($allOptionsArray, $opt);
        }
    }

    $result['options']    = $optionArray;
    $result['allOptions'] = $allOptionsArray;
    array_push($answerArray, $result);


}//ques foreach

$resultArray['form'] = $answerArray;

array_push($result1, $resultArray);

}


return response()->json(['code'=>200,'status'=>true,'service_name'=>'machine-operation-user-list','message'=>'Success','data'=>$result1]);



}


/*get operation history of user */
public function opertaionHistory()
{
   // $machineId = Input::get('machineId');
    $userId    = Auth::user()->id;

    $machineOperationUser = Udr_operation_history::with('user')
    ->where('status','Active')
    
    ->where('user_id',$userId)
    ->orderBy('created_at','DESC')
    ->get();
    

    $result1 = array();
    foreach ($machineOperationUser as $value) {

        $machine = Machine::find($value->machine_id);
        $machineId = $machine->id;
        $resultArray['id'] = $value->id;  
        $resultArray['formId'] = $machine->user_dir_id;
        $resultArray['machineId'] = $machineId;
        $resultArray['machineName'] = $machine->machine;
        $resultArray['userId'] = $userId;
        $resultArray['userName'] = $value->user->name." ".$value->user->last_name;
        $resultArray['operationDate'] = date("Y-m-d H:i:s", strtotime($value->created_at));
        

        $UdrQuestion = Udr_question::with('option')
        ->where('status','Active')
        ->where('form_id', $machine->user_dir_id)->get();

        $answerArray = array();

        foreach ($UdrQuestion as $qValue) {

            $UdrAnswers = Udr_answer::where('status','Active')
            ->where('machine_id',$machineId)
            ->where('question_id',$qValue->id)
            ->where('user_id',$userId)
            ->where('form_id',$machine->user_dir_id)
            ->where('operation_history_id',$value->id)
            ->first();

            $result['questionId'] = $qValue->id;
            $result['inputTypeId']= $qValue->input_type_id;
            $result['question']   = $qValue->question_name;
            $result['answer']     = '';

            if(!empty($UdrAnswers->answer_text)){
                $result['answer']     = $UdrAnswers->answer_text;
            }

            if($qValue->input_type_id==6)
            {
                $answerImg = (!empty($UdrAnswers->answer_text)?$UdrAnswers->answer_text:'');

                $result['answer']='';

                if(!empty($answerImg))
                {
                    $result['answer']  = url('/public/uploads/form_images').'/'.$answerImg;
                }


            }

            $radioans = Udr_answer::where('status','Active')
            ->where('machine_id',$machineId)
            ->where('question_id',$qValue->id)
            ->where('user_id',$userId)
            ->where('form_id',$machine->user_dir_id)
            ->where('operation_history_id',$value->id)
            ->get();

            $optionArray     = array();

            $allOptionsArray = array();

            if($qValue->input_type_id==2){ //checkbox

                foreach ($radioans as  $optValue)
                {
                    array_push($optionArray, $optValue['option_choice_id']);
                }


                foreach ($qValue->option as $queOvalue) {

                    $opt['optionId'] = $queOvalue->id;
                    $opt['optionValue'] = $queOvalue->option_choice_name;

                    array_push($allOptionsArray, $opt);
                }


            }else if($qValue->input_type_id==3){ //radio

              foreach ($radioans as  $optValue) 
              {

                array_push($optionArray, $optValue['option_choice_id']);
            }

            foreach ($qValue->option as $queOvalue) {

                $opt['optionId'] = $queOvalue->id;
                $opt['optionValue'] = $queOvalue->option_choice_name;

                array_push($allOptionsArray, $opt);
            }

    }else if($qValue->input_type_id==4){ //select

        foreach ($radioans as  $optValue)
        {
            array_push($optionArray, $optValue['option_choice_id']);
        }

        foreach ($qValue->option as $queOvalue) {

            $opt['optionId'] = $queOvalue->id;
            $opt['optionValue'] = $queOvalue->option_choice_name;

            array_push($allOptionsArray, $opt);
        }
    }

    $result['options']    = $optionArray;
    $result['allOptions'] = $allOptionsArray;
    array_push($answerArray, $result);


}//ques foreach

$resultArray['form'] = $answerArray;

array_push($result1, $resultArray);

}


return response()->json(['code'=>200,'status'=>true,'service_name'=>'machine-operation-user-list','message'=>'Success','data'=>$result1]);



}



}
