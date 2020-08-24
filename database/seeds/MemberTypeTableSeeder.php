<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MemberTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('membertypes')->insert([
        	'name' => 'Classic Level',
        	'earnpoints' => 3
        ]);
        
        DB::table('membertypes')->insert([
        	'name' => 'Sliver Level',
        	'earnpoints' => 4.5,
        	'laundrydiscount' => 10,
        	'numberofstays' => 3,
        	'numberofnights' => 7,
        	'paidamount' => 2000
        ]);

        DB::table('membertypes')->insert([
        	'name' => 'Gold Level', 
        	'earnpoints' => 5.25,
        	'laundrydiscount' => 15,
        	'fooddiscount' => 5, 
        	'additionalbenefits' => 'Welcome amenities provided during hotel stays',
        	'numberofstays' => 10,
        	'numberofnights' => 25,
        	'paidamount' => 7000
        ]);
        
        DB::table('membertypes')->insert([
        	'name' => 'Platinum Level', 
        	'earnpoints' => 6,
        	'laundrydiscount' => 20,
        	'fooddiscount' => 10, 
        	'additionalbenefits' => 'Free admission for one accompanying guest to the Club Lounge during hotel stays (14 years of age or older. Only at participating hotels.), 15:00 late check-out',
        	'numberofstays' => 20,
        	'numberofnights' => 50,
        	'paidamount' => 15000
        ]);
    }
}
