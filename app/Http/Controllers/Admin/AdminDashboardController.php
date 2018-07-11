<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Auth;
use App\Organisation;

class AdminDashboardController extends Controller
{
	public function index()
	{

		$organisations = Organisation::where('status','Active')
		->orderBy('id','DESC')
		->get();

		return view('admin/adminDashboard',compact('organisations'));
	}


}
