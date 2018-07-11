<?php

use Illuminate\Database\Seeder;

class DepartmentsTableDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('departments')->insert(['department'=>'Trident Manor','numberOfEmployees'=>'1','officeId'=>'1','orgId'=>'1','created_at'=>'2018-01-29 11:30:43','status'=>'Active','updated_at'=>'2018-01-29 11:30:43']);
    }
}
