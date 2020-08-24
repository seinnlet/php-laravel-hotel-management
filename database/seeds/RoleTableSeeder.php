<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {		
    	// in staff
        DB::table('roles')->insert([
        	'name' => 'admin', 'guard_name' => 'web'
        ]);
        
        DB::table('roles')->insert([
        	'name' => 'reservation staff', 'guard_name' => 'web'
        ]);

        DB::table('roles')->insert([
        	'name' => 'service staff', 'guard_name' => 'web'
        ]);

        DB::table('roles')->insert([
        	'name' => 'chef', 'guard_name' => 'web'
        ]);

        // in guest
        DB::table('roles')->insert([
        	'name' => 'guest', 'guard_name' => 'web'
        ]);
    }
}
