<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use DB;
use Mail;
use App\User;
use App\Department;
use App\office;
use App\organisation;
use App\Password_reset;


class ApiLoginController extends Controller
{
      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
      public function login()
      {

        $email          = Input::get('email');
        $password       = Input::get('password');
        $role           = Input::get('role'); 

        $resultArray = array();

        switch ($role) {

          case 3:

          if(Auth::attempt(array('email'=>$email,'password'=>$password,'role_id'=>3,'status'=>'Active')))
          {

           $success = array();

           $userAuth = Auth::user(); 

           $user = User::with('department.office.organisation')
           ->where('role_id',3) 
           ->where('id',$userAuth->id)       
           ->first();

           $result['id']             = $user->id;              
           $result['name']           = $user->name.' '.$user->last_name;
           $resultArray['firstName'] = $user->name;
           $resultArray['lastName']  = $user->last_name;
           $result['email']          = $user->email;
           $result['officeId']       = $user->office_id;
           $result['departmentId']   = $user->department_id;
           $result['organisationId'] = $user->organisation_id;
           $result['role']           = $role;
           $result['organisation']   ='';
           $result['office']  ='';
           $result['department'] =''; 
           $result['organisationLogo']  ='';
           $result['profileImage']    = '';

           if(!empty($user->image_url))
           {
            $result['profileImage']    = url('/public/uploads/user_profile').'/'.$user->image_url;
          }
          
          if(!empty($user->department->office->organisation->organisation))
          {
            $result['organisation']  = ucfirst($user->department->office->organisation->organisation); 
          }
          
          if(!empty($user->department->office->office))
          {
            $result['office'] = ucfirst($user->department->office->office); 
          }
          
          if(!empty($user->department->department))
          {
            $result['department'] = ucfirst($user->department->department); 
          }

          if(!empty($user->department->office->organisation->ImageURL))
          {
            $result['organisationLogo']  = url('/public/uploads/org_images\/'). $user->department->office->organisation->ImageURL;
          }

          $result['token'] = $user->createToken('Bluedata')->accessToken;

          return response()->json(['code'=>200,'status'=>true,'service_name'=>'Login','message'=>'User logged in successfully','data'=>$result]);
        }
        else
        {

          return response()->json(['code'=>400,'status'=>false,'service_name'=>'Login','message'=>'Credential not match','data'=>$resultArray]);
        }

        break;

        default:
        return response()->json(['code'=>400,'status'=>false,'service_name'=>'Login','message'=>'Credential not match','data'=>$resultArray]);
      }
    }

    /*For user logout*/
    public function logout(request $request)
    {

     $test = $request->user('api')->token()->revoke();

     return response()->json(['code'=>200,'status'=>true,'service_name'=>'user-logout','message'=>'successfully logout']);
   }


   /*FORGOT PASSWORD FUNCTIONALITY*/

   /*For Reset Password Mail*/
   public function forgotPassword()
   {

    $email    = Input::get('email')?Input::get('email'):'';

    $result   = User::where('email',$email)->where('role_id',3)->first();

    if(!$result){

      return response()->json(['status'=>false,'message'=>'Email not Found.']);
    }else{

      $token = array('token' => str_random(50),'created_at'=>date('Y-m-d :H-i-s'));

      $count   = DB::table('password_resets')->where('email',$email)->first();

      if($count){

        DB::table('password_resets')->where('email',$email)->update($token);

      }else{

        DB::table('password_resets')->insert(['email' => $result->email, 'token' => $token['token']]);
      }         

      $data  = array('name'=>$result->name ,'passwordLink'=>$token['token']);

      Mail::send('mail', $data, function($message) use($email) 
      {
        $message->from('prateek@chetaru.com', 'Bluedata');
        $message->to($email);
        $message->subject('Reset Password');
      });

      return response()->json(['status'=>true,'message'=>'Mail has been sent. Please Check.']);

    }

  }

  /*To Check Password Link*/
  public function resetPassword()
  {

   $token      = request()->segment(2);

   $result     = Password_reset::where('token',$token)->first();

   if(!$result)
   {

    echo '<p style="text-align: center;background: #eb1c24;color: #fff; font-size: 25px;font-weight: bold; padding: 15px 5px;
    text-align: center;">Invalid Link</p>';

  }else{        

   $time       = $result->created_at;
   $time       = date('Y-m-d H:i',strtotime('+10 minutes',strtotime($time)));
   $checkTime  = date('Y-m-d H:i');

   if($checkTime < $time)
   {

     $data = array('email'=>$result->email,'token'=>'updatepassword/'.$result->token);

     return view('resetPassword',compact('data'));

   }else{

    echo '<p style="text-align: center;background: #eb1c24;color: #fff; font-size: 25px;font-weight: bold; padding: 15px 5px;
    text-align: center;">Invalid Link</p>';
  }

}   
}


/*To update password*/
public function updatePassword()
{

 $token            = request()->segment(2);
 $email            = Input::get('email')?Input::get('email'):'';
 $password         = Input::get('password')?Input::get('password'):'';
 $confirm_password = Input::get('confirm_password')?Input::get('confirm_password'):'';

 $result           = Password_reset::where('token',$token)->where('email',$email)->first();

 $rules = array('email'=>'required','password'=>'required','confirm_password'=>'required|same:password'); 

 if($result)
 {                                             
   $Validator   = Validator::make(Input::all(),$rules);

   if($Validator->fails())
   {

     return redirect()->back()->withErrors($Validator->errors())->withInput(Input::all());

   }else{

    User::where('email', '=', $email)->update(
      ['password'  => str_replace("&nbsp;", '',bcrypt($password)),
      'password2'  => str_replace("&nbsp;", '',base64_encode($password)),
      'updated_at' => date('Y-m-d H:i:s')
    ]);

    // return redirect()->back()->with(['success'=>'Password updated successfully.']);        

    return view('thankyouresetpass')->with(['success'=>'Password updated successfully.']);        
  }

}else{

 echo '<p style="text-align: center;background: #eb1c24;color: #fff; font-size: 25px;font-weight: bold; padding: 15px 5px;
 text-align: center;">Invalid Link</p>';
} 

}

/*update user password with current password*/
public function updatePasswordWithCurrentPassword()
{

  $resultArray = array();

  $currentPassword = Input::get('currentPassword');
  $newPassword     = Input::get('newPassword');
  $id              = Auth::user()->id;
  
  $result = User::where('id',$id)->where('password2',base64_encode($currentPassword))->first();
  
  if(!$result)
  {   
    return response()->json(['code'=>400,'status'=>false,'service_name'=>'update-password-with-current-password','message'=>'Your current password is not correct.','data'=>$resultArray]);
  }

  $obj = User::find($id);

  $obj->password   = bcrypt($newPassword);
  $obj->password2  = base64_encode($newPassword);  
  $obj->updated_at = date('Y-m-d H:i:s'); 
  $obj->save();

  return response()->json(['code'=>200,'status'=>true,'service_name'=>'update-password-with-current-password','message'=>'Password updated successfully.','data'=>$resultArray]);

}


/*update user profile*/
public function updateUserProfile()
{

 $resultArray = array();

 $firstName    = Input::get('firstName');
 $lastName     = Input::get('lastName');
 $contact      = Input::get('contact');
 $profileImage = Input::get('profileImage');
 $id           = Auth::user()->id;

 if($profileImage)
 {
  $image = Input::get('profileImage');
  $image = str_replace('data:image/png;base64,', '', $image);
  $image = str_replace(' ', '+', $image);
  $imageName = 'user_'.time().'.png'; 
  \File::put(public_path('uploads/user_profile/'). $imageName, base64_decode($image));
} 



$obj = User::find($id);

if(!empty($imageName))
{
  $obj->image_url= $imageName;
}

$obj->name      = $firstName;
$obj->last_name = $lastName;
$obj->phone     = $contact;
$obj->save();

/*get user detail*/
$user = User::with('department.office.organisation')->where('id',$id)->first();

if(!empty($user))
{

  $resultArray['id']             = $user->id;              
  $resultArray['name']           = $user->name.' '.$user->last_name;
  $resultArray['firstName']      = $user->name;
  $resultArray['lastName']       = $user->last_name;
  $resultArray['email']          = $user->email;
  $resultArray['officeId']       = $user->office_id;
  $resultArray['departmentId']   = $user->department_id;
  $resultArray['organisationId'] = $user->organisation_id;
  $resultArray['role']           = $user->role_id;
  $resultArray['userContact']    = $user->phone;
  $resultArray['organisation']   ='';
  $resultArray['office']         ='';
  $resultArray['department']     =''; 
  $resultArray['organisationLogo']  ='';
  $resultArray['profileImage']    = '';

  if(!empty($user->image_url))
  {
    $resultArray['profileImage']    = url('/public/uploads/user_profile').'/'.$user->image_url;
  }

  if(!empty($user->department->office->organisation->organisation))
  {
    $resultArray['organisation']  = ucfirst($user->department->office->organisation->organisation); 
  }

  if(!empty($user->department->office->office))
  {
    $resultArray['office'] = ucfirst($user->department->office->office); 
  }

  if(!empty($user->department->department))
  {
    $resultArray['department'] = ucfirst($user->department->department); 
  }

  if(!empty($user->department->office->organisation->ImageURL))
  {
    $resultArray['organisationLogo']  = url('/public/uploads/org_images').'/'. $user->department->office->organisation->ImageURL;
  }

  return response()->json(['code'=>200,'status'=>true,'service_name'=>'update-user-profile','message'=>'Profile updated successfully.','data'=>$resultArray]);

}else{

  return response()->json(['code'=>400,'status'=>true,'service_name'=>'update-user-profile','message'=>'User profile not updated.','data'=>$resultArray]);
}

}

/*get user detail*/
public function getUserProfile()
{
  $resultArray = array();

  $id = Auth::user()->id;

  $user = User::with('department.office.organisation')->where('id',$id)->first();

  if(!empty($user))
  {

    $resultArray['id']             = $user->id;              
    $resultArray['name']           = $user->name.' '.$user->last_name;
    $resultArray['firstName']           = $user->name;
    $resultArray['lastName']            = $user->last_name;
    $resultArray['email']          = $user->email;
    $resultArray['officeId']       = $user->office_id;
    $resultArray['departmentId']   = $user->department_id;
    $resultArray['organisationId'] = $user->organisation_id;
    $resultArray['role']           = $user->role_id;
    $resultArray['userContact']    = $user->phone;
    $resultArray['organisation']   ='';
    $resultArray['office']         ='';
    $resultArray['department']     =''; 
    $resultArray['organisationLogo']  ='';
    $resultArray['profileImage']    = '';

    if(!empty($user->image_url))
    {
      $resultArray['profileImage']    = url('/public/uploads/user_profile').'/'.$user->image_url;
    }

    if(!empty($user->department->office->organisation->organisation))
    {
      $resultArray['organisation']  = ucfirst($user->department->office->organisation->organisation); 
    }

    if(!empty($user->department->office->office))
    {
      $resultArray['office'] = ucfirst($user->department->office->office); 
    }

    if(!empty($user->department->department))
    {
      $resultArray['department'] = ucfirst($user->department->department); 
    }

    if(!empty($user->department->office->organisation->ImageURL))
    {
      $resultArray['organisationLogo']  = url('/public/uploads/org_images').'/'. $user->department->office->organisation->ImageURL;
    }

    return response()->json(['code'=>200,'status'=>true,'service_name'=>'get-user-profile','message'=>'User Profile','data'=>$resultArray]);

  }else{

    return response()->json(['code'=>400,'status'=>true,'service_name'=>'get-user-profile','message'=>'User profile not found.','data'=>$resultArray]);
  }
}

}
