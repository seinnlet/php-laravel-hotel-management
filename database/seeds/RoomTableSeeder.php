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
        $room->roomno = 'AS_001';
        $room->status = 1;
        $room->roomtype_id = 1;
        $room->save();

        $room = new Room;
        $room->roomno = 'AS_002';
        $room->status = 1;
        $room->roomtype_id = 1;
        $room->save();

        $room = new Room;
        $room->roomno = 'AS_003';
        $room->status = 1;
        $room->roomtype_id = 1;
        $room->save();

        
        $room = new Room;
        $room->roomno = 'AD_001';
        $room->status = 1;
        $room->roomtype_id = 2;
        $room->save();

        $room = new Room;
        $room->roomno = 'AD_002';
        $room->status = 1;
        $room->roomtype_id = 2;
        $room->save();

        $room = new Room;
        $room->roomno = 'AD_003';
        $room->status = 1;
        $room->roomtype_id = 2;
        $room->save();

        
        $room = new Room;
        $room->roomno = 'AT_001';
        $room->status = 1;
        $room->roomtype_id = 3;
        $room->save();

        $room = new Room;
        $room->roomno = 'AT_002';
        $room->status = 1;
        $room->roomtype_id = 3;
        $room->save();


        $room = new Room;
        $room->roomno = 'AQ_001';
        $room->status = 1;
        $room->roomtype_id = 4;
        $room->save();

        $room = new Room;
        $room->roomno = 'AQ_002';
        $room->status = 1;
        $room->roomtype_id = 4;
        $room->save();



        $room = new Room;
        $room->roomno = 'AJS_001';
        $room->status = 1;
        $room->roomtype_id = 4;
        $room->save();

        $room = new Room;
        $room->roomno = 'AJS_002';
        $room->status = 1;
        $room->roomtype_id = 4;
        $room->save();


        $room = new Room;
        $room->roomno = 'ASS_001';
        $room->status = 1;
        $room->roomtype_id = 5;
        $room->save();

        $room = new Room;
        $room->roomno = 'ASS_002';
        $room->status = 1;
        $room->roomtype_id = 5;
        $room->save();

        
    }
}
