<?php

use Illuminate\Database\Seeder;

class OrganisationsTableDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('organisations')->insert(['organisation'=>'Trident Manor','address1'=>'Evans Business Centre,Aycliffe Business Park','address2'=>'Durham Way South, Newton Aycliffe','address3'=>'County Durham','postcode'=>'DL5 6XP','industry'=>'Security','phone'=>'4401913080319','turnover'=>'1','numberOfEmployees'=>'1','numberOfOffices'=>'1','numberOfDepartments'=>'1','status'=>'Active','created_at'=>'2018-01-29 11:30:43','updated_at'=>'2018-01-29 11:30:43']);
    }
}
