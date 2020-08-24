<?php

use Illuminate\Database\Seeder;

class RoomTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('rooms')->insert(
            ['roomno' => 'AS_001', 'status' => 1, 'roomtype_id' => 1]
        );
        DB::table('rooms')->insert(
            ['roomno' => 'AS_002', 'status' => 1, 'roomtype_id' => 1],
        );
        DB::table('rooms')->insert(
            ['roomno' => 'AS_003', 'status' => 1, 'roomtype_id' => 1],
        );

        DB::table('rooms')->insert(
            ['roomno' => 'AD_001', 'status' => 1, 'roomtype_id' => 2],
        );
        DB::table('rooms')->insert(
            ['roomno' => 'AD_002', 'status' => 1, 'roomtype_id' => 2],
        );
        DB::table('rooms')->insert(
            ['roomno' => 'AD_003', 'status' => 1, 'roomtype_id' => 2],
        );

        DB::table('rooms')->insert(
            ['roomno' => 'AT_001', 'status' => 1, 'roomtype_id' => 3],
        );
        DB::table('rooms')->insert(
            ['roomno' => 'AT_002', 'status' => 1, 'roomtype_id' => 3],
        );

        DB::table('rooms')->insert(
            ['roomno' => 'AQ_001', 'status' => 1, 'roomtype_id' => 4],
        );
        DB::table('rooms')->insert(
            ['roomno' => 'AQ_002', 'status' => 1, 'roomtype_id' => 4],
        );

        DB::table('rooms')->insert(
            ['roomno' => 'AJS_001', 'status' => 1, 'roomtype_id' => 5],
        );
        DB::table('rooms')->insert(
            ['roomno' => 'AJS_002', 'status' => 1, 'roomtype_id' => 5],
        );

        DB::table('rooms')->insert(
            ['roomno' => 'ASS_001', 'status' => 1, 'roomtype_id' => 6],
        );
        DB::table('rooms')->insert(
            ['roomno' => 'ASS_002', 'status' => 1, 'roomtype_id' => 6]
        );
    }
}
