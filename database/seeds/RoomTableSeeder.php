<?php

use Illuminate\Database\Seeder;
use App\Room;

class RoomTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $room = new Room;
        $room->roomno = '101';
        $room->status = 1;
        $room->roomtype_id = 1;
        $room->save();

        $room = new Room;
        $room->roomno = '102';
        $room->status = 1;
        $room->roomtype_id = 1;
        $room->save();

        $room = new Room;
        $room->roomno = '201';
        $room->status = 1;
        $room->roomtype_id = 1;
        $room->save();

        
        $room = new Room;
        $room->roomno = '202';
        $room->status = 1;
        $room->roomtype_id = 2;
        $room->save();

        $room = new Room;
        $room->roomno = '203';
        $room->status = 1;
        $room->roomtype_id = 2;
        $room->save();

        $room = new Room;
        $room->roomno = '204';
        $room->status = 1;
        $room->roomtype_id = 2;
        $room->save();

        
        $room = new Room;
        $room->roomno = '301';
        $room->status = 1;
        $room->roomtype_id = 3;
        $room->save();

        $room = new Room;
        $room->roomno = '501';
        $room->status = 1;
        $room->roomtype_id = 3;
        $room->save();


        $room = new Room;
        $room->roomno = '302';
        $room->status = 1;
        $room->roomtype_id = 4;
        $room->save();

        $room = new Room;
        $room->roomno = '502';
        $room->status = 1;
        $room->roomtype_id = 4;
        $room->save();



        $room = new Room;
        $room->roomno = '601';
        $room->status = 1;
        $room->roomtype_id = 4;
        $room->save();

        $room = new Room;
        $room->roomno = '602';
        $room->status = 1;
        $room->roomtype_id = 4;
        $room->save();


        $room = new Room;
        $room->roomno = '701';
        $room->status = 1;
        $room->roomtype_id = 5;
        $room->save();

        $room = new Room;
        $room->roomno = '702';
        $room->status = 1;
        $room->roomtype_id = 5;
        $room->save();

        $room = new Room;
        $room->roomno = '801';
        $room->status = 1;
        $room->roomtype_id = 6;
        $room->save();

        $room = new Room;
        $room->roomno = '901';
        $room->status = 1;
        $room->roomtype_id = 6;
        $room->save();

        
    }
}
