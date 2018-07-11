<?php

use Illuminate\Database\Seeder;

class RolesTableDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert(['roleName'=>'Management','created_at'=>'2018-01-29 11:30:43','updated_at'=>'2018-01-29 11:30:43']);
        DB::table('roles')->insert(['roleName'=>'Site-Manager','created_at'=>'2018-01-29 11:30:43','updated_at'=>'2018-01-29 11:30:43']);
        DB::table('roles')->insert(['roleName'=>'General-Staff','created_at'=>'2018-01-29 11:30:43','updated_at'=>'2018-01-29 11:30:43']);
    }
}
