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
        $roomtype->image1 = 'backend/img/roomtype/s1.jpg';
        $roomtype->image2 = 'backend/img/roomtype/s2.jpg';
        $roomtype->image3 = 'backend/img/roomtype/s3.jpg';
        $roomtype->save();


        $roomtype = new Roomtype;
        $roomtype->name = 'Double';
        $roomtype->pricepernight = 40;
        $roomtype->description = 'Each room of the hotel commands resplendent views. Free high-speed wireless internet in all rooms.';
        $roomtype->noofpeople = 2;
        $roomtype->noofbed = 1;
        $roomtype->image1 = 'backend/img/roomtype/d1.jpg';
        $roomtype->image2 = 'backend/img/roomtype/d2.jpg';
        $roomtype->image3 = 'backend/img/roomtype/d3.jpg';
        $roomtype->save();


        $roomtype = new Roomtype;
        $roomtype->name = 'Triple';
        $roomtype->pricepernight = 40;
        $roomtype->description = 'Each room of the hotel commands resplendent views. Free high-speed wireless internet in all rooms.';
        $roomtype->noofpeople = 3;
        $roomtype->noofbed = 2;
        $roomtype->image1 = 'backend/img/roomtype/t1.jpg';
        $roomtype->image2 = 'backend/img/roomtype/t2.jpg';
        $roomtype->image3 = 'backend/img/roomtype/t3.jpg';
        $roomtype->save();


        $roomtype = new Roomtype;
        $roomtype->name = 'Quad';
        $roomtype->pricepernight = 45;
        $roomtype->description = 'Each room of the hotel commands resplendent views. Free high-speed wireless internet in all rooms.';
        $roomtype->noofpeople = 4;
        $roomtype->noofbed = 3;
        $roomtype->image1 = 'backend/img/roomtype/q1.jpg';
        $roomtype->image2 = 'backend/img/roomtype/q2.jpg';
        $roomtype->image3 = 'backend/img/roomtype/q3.jpg';
        $roomtype->save();


        $roomtype = new Roomtype;
        $roomtype->name = 'Junior Suite';
        $roomtype->pricepernight = 100;
        $roomtype->description = 'Suite Rooms provides guests with a classic, elegant bedroom, a sleek and well equipped bathroom plus a living area offering all necessary amenities from which to relax and take in the breathtaking Blue Lake.';
        $roomtype->noofpeople = 2;
        $roomtype->noofbed = 1;
        $roomtype->image1 = 'backend/img/roomtype/js1.jpg';
        $roomtype->image2 = 'backend/img/roomtype/js2.jpg';
        $roomtype->image3 = 'backend/img/roomtype/js3.jpg';
        $roomtype->save();


        $roomtype = new Roomtype;
        $roomtype->name = 'Superior Suite';
        $roomtype->pricepernight = 150;
        $roomtype->description = 'Suite Rooms provides guests with a classic, elegant bedroom, a sleek and well equipped bathroom plus a living area offering all necessary amenities from which to relax and take in the breathtaking Blue Lake.';
        $roomtype->noofpeople = 2;
        $roomtype->noofbed = 1;
        $roomtype->image1 = 'backend/img/roomtype/ss1.jpg';
        $roomtype->image2 = 'backend/img/roomtype/ss2.jpg';
        $roomtype->image3 = 'backend/img/roomtype/ss3.jpg';
        $roomtype->save();

        

    }
}
