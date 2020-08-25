<?php

use Illuminate\Database\Seeder;
use App\Roomtype;

class RoomTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roomtype = new Roomtype;
        $roomtype->name = 'Single';
        $roomtype->pricepernight = 30;
        $roomtype->description = 'Each room of the hotel commands resplendent views. Free high-speed wireless internet in all rooms.';
        $roomtype->noofpeople = 1;
        $roomtype->noofbed = 1;
        $roomtype->image1 = 'roomtype/singleroom1.jpg';
        $roomtype->image2 = 'roomtype/singleroom2.jpg';
        $roomtype->image3 = 'roomtype/singleroom3.jpg';
        $roomtype->save();


        $roomtype = new Roomtype;
        $roomtype->name = 'Double';
        $roomtype->pricepernight = 40;
        $roomtype->description = 'Each room of the hotel commands resplendent views. Free high-speed wireless internet in all rooms.';
        $roomtype->noofpeople = 2;
        $roomtype->noofbed = 1;
        $roomtype->image1 = 'roomtype/doubleroom1.jpg';
        $roomtype->image2 = 'roomtype/doubleroom2.jpg';
        $roomtype->image3 = 'roomtype/doubleroom3.jpg';
        $roomtype->save();


        $roomtype = new Roomtype;
        $roomtype->name = 'Triple';
        $roomtype->pricepernight = 40;
        $roomtype->description = 'Each room of the hotel commands resplendent views. Free high-speed wireless internet in all rooms.';
        $roomtype->noofpeople = 3;
        $roomtype->noofbed = 2;
        $roomtype->image1 = 'roomtype/tripleroom1.jpg';
        $roomtype->image2 = 'roomtype/tripleroom2.jpg';
        $roomtype->image3 = 'roomtype/tripleroom3.jpg';
        $roomtype->save();


        $roomtype = new Roomtype;
        $roomtype->name = 'Quad';
        $roomtype->pricepernight = 45;
        $roomtype->description = 'Each room of the hotel commands resplendent views. Free high-speed wireless internet in all rooms.';
        $roomtype->noofpeople = 4;
        $roomtype->noofbed = 3;
        $roomtype->image1 = 'roomtype/quadroom1.jpg';
        $roomtype->image2 = 'roomtype/quadroom2.jpg';
        $roomtype->image3 = 'roomtype/quadroom3.jpg';
        $roomtype->save();


        $roomtype = new Roomtype;
        $roomtype->name = 'Junior Suite';
        $roomtype->pricepernight = 100;
        $roomtype->description = 'Suite Rooms provides guests with a classic, elegant bedroom, a sleek and well equipped bathroom plus a living area offering all necessary amenities from which to relax and take in the breathtaking Blue Lake.';
        $roomtype->noofpeople = 2;
        $roomtype->noofbed = 1;
        $roomtype->image1 = 'roomtype/jsuiteroom1.jpg';
        $roomtype->image2 = 'roomtype/jsuiteroom2.jpg';
        $roomtype->image3 = 'roomtype/jsuiteroom3.jpg';
        $roomtype->save();


        $roomtype = new Roomtype;
        $roomtype->name = 'Superior Suite';
        $roomtype->pricepernight = 150;
        $roomtype->description = 'Suite Rooms provides guests with a classic, elegant bedroom, a sleek and well equipped bathroom plus a living area offering all necessary amenities from which to relax and take in the breathtaking Blue Lake.';
        $roomtype->noofpeople = 2;
        $roomtype->noofbed = 1;
        $roomtype->image1 = 'roomtype/ssuiteroom1.jpg';
        $roomtype->image2 = 'roomtype/ssuiteroom2.jpg';
        $roomtype->image3 = 'roomtype/ssuiteroom3.jpg';
        $roomtype->save();

        

    }
}
