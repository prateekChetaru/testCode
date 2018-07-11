<?php

use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert(['name'=>'Rajat','surname'=>'Oura','email'=>'rajat@chetaru.com','orgId'=>'1','officeId'=>'1','departmentId'=>'1','password'=>bcrypt('123456'),'superAdmin'=>'Y','status'=>'Active','created_at'=>'2018-01-29 11:30:43','updated_at'=>'2018-01-29 11:30:43']);
        DB::table('admins')->insert(['name'=>'Mayank','surname'=>'Hatwalne','email'=>'mayank@chetaru.com','orgId'=>'1','officeId'=>'1','departmentId'=>'1','password'=>bcrypt('123456'),'superAdmin'=>'N','status'=>'Active','created_at'=>'2018-01-29 11:30:43','updated_at'=>'2018-01-29 11:30:43']);
    }
}
