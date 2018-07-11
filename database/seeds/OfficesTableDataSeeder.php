<?php

use Illuminate\Database\Seeder;

class OfficesTableDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('offices')->insert(['office'=>'Trident Manor','numberOfEmployees'=>'1','numberOfDepartments'=>'1','orgId'=>'1','type'=>'Office','status'=>'Active','created_at'=>'2018-01-29 11:30:43','updated_at'=>'2018-01-29 11:30:43']);
    }
}
