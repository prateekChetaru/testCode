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
use QrCode;
use App\Organisation;
use App\User;
use App\Office;
use App\Department;
use App\Machine;
use App\Image_process;
use App\Mdr_form;
use App\Udr_form;
use App\Udr_operation_history;


class AdminReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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

    /*get machine report list*/
    public function getMachineReportList()
    {
        $orgId = request()->segment(3);

        $id = base64_decode($orgId);
        
        $machines = Machine::with('answer.question.form','udrForm','machineOperatorUser')
        ->where('org_id',$id)
        ->orderBy('id','DESC')
        ->where('status','Active')
        ->get();

        return view('admin/report/listMachineReports',compact('machines'));
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


        return view('admin/report/listMachineOperationUserReports',compact('machineOperationUser','machine'));

    }
}
