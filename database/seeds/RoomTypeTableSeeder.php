<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoomTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roomtypes')->insert([
        	'name' => 'Single',
        	'pricepernight' => 30,
        	'description' => 'Each room of the hotel commands resplendent views. Free high-speed wireless internet in all rooms.',
        	'noofpeople' => 1,
        	'noofbed' => 1,
        	'image1' => 'roomtype/singleroom1.jpg',
        	'image2' => 'roomtype/singleroom2.jpg',
        	'image3' => 'roomtype/singleroom3.jpg'
        ]);

        DB::table('roomtypes')->insert([
        	'name' => 'Double',
        	'pricepernight' => 40,
        	'description' => 'Each room of the hotel commands resplendent views. Free high-speed wireless internet in all rooms.',
        	'noofpeople' => 2,
        	'noofbed' => 1,
        	'image1' => 'roomtype/doubleroom1.jpg',
        	'image2' => 'roomtype/doubleroom2.jpg',
        	'image3' => 'roomtype/doubleroom3.jpg'
        ]);

        DB::table('roomtypes')->insert([
        	'name' => 'Triple',
        	'pricepernight' => 40,
        	'description' => 'Each room of the hotel commands resplendent views. Free high-speed wireless internet in all rooms.',
        	'noofpeople' => 3,
        	'noofbed' => 2,
        	'image1' => 'roomtype/tripleroom1.jpg',
        	'image2' => 'roomtype/tripleroom2.jpg',
        	'image3' => 'roomtype/tripleroom3.jpg'
        ]);

        DB::table('roomtypes')->insert([
        	'name' => 'Quad',
        	'pricepernight' => 45,
        	'description' => 'Each room of the hotel commands resplendent views. Free high-speed wireless internet in all rooms.',
        	'noofpeople' => 4,
        	'noofbed' => 3,
        	'image1' => 'roomtype/quadroom1.jpg',
        	'image2' => 'roomtype/quadroom2.jpg',
        	'image3' => 'roomtype/quadroom3.jpg'
        ]);

        DB::table('roomtypes')->insert([
        	'name' => 'Junior Suite',
        	'pricepernight' => 100,
        	'description' => 'Suite Rooms provides guests with a classic, elegant bedroom, a sleek and well equipped bathroom plus a living area offering all necessary amenities from which to relax and take in the breathtaking Blue Lake.',
        	'noofpeople' => 2,
        	'noofbed' => 1,
        	'image1' => 'roomtype/jsuiteroom1.jpg',
        	'image2' => 'roomtype/jsuiteroom2.jpg',
        	'image3' => 'roomtype/jsuiteroom3.jpg'
        ]);

        DB::table('roomtypes')->insert([
        	'name' => 'Superior Suite',
        	'pricepernight' => 150,
        	'description' => 'Suite Rooms provides guests with a classic, elegant bedroom, a sleek and well equipped bathroom plus a living area offering all necessary amenities from which to relax and take in the breathtaking Blue Lake.',
        	'noofpeople' => 2,
        	'noofbed' => 1,
        	'image1' => 'roomtype/ssuiteroom1.jpg',
        	'image2' => 'roomtype/ssuiteroom2.jpg',
        	'image3' => 'roomtype/ssuiteroom3.jpg'
        ]);
    }
}
