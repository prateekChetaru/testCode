<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Session;
use App\Admin;

class AdminLoginController extends Controller
{
    public function index()
    {

        if(!empty(Auth::user()))
        {
            return redirect('admin/admin-dashboard');
        }
        return view('admin/adminLogin');
    }
    
    public function login()
    {
        // $postData = Input::all();

        $email      = Input::get('email');
        $password   = Input::get('password');

        if(Auth::attempt(array('email'=> $email,'password'=> $password,'role_id'=>1,'status'=>'Active')))
        {
            return redirect('admin/admin-dashboard');
        }
        else
        {
            $errors =array('email'=>'These credentials do not match our records.');
            return redirect('/admin')->withErrors($errors);
        }
    }
    
    /*for logout admin user*/
    public function logout(Request $request)
    {
        Auth::logout(); 
        return redirect('/admin'); 
    }  
}
