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
        $roomtype->name = 'Single Room';
        $roomtype->pricepernight = 30;
        $roomtype->description = '<p>Each room of the hotel commands resplendent views. </p><ul><li>Free high-speed wireless internet in all rooms.</li><li>Complimentary use of our Fitness Center (including swimming pool)</li><li>Includes Breakfast</li></ul><p><b>Other Room Amenities</b>: Work desk, LED flat TV, Air con, Kettle, Hairdryer, Smoke alarm in room, complimentary coffee/tea</p>';
        $roomtype->noofpeople = 1;
        $roomtype->noofbed = 1;
        $roomtype->image1 = 'backend/img/roomtype/s1.jpg';
        $roomtype->image2 = 'backend/img/roomtype/s2.jpg';
        $roomtype->image3 = 'backend/img/roomtype/s3.jpg';
        $roomtype->save();


        $roomtype = new Roomtype;
        $roomtype->name = 'Double Room';
        $roomtype->pricepernight = 40;
        $roomtype->description = '<p>All double rooms provide luxurious guest experience with a breathtaking view of Yangon City.&nbsp;</p><ul><li><span style="font-size: 14.4px;">Free high-speed wireless internet in all rooms.</span></li><li><span style="font-size: 14.4px;">Complimentary use of our Fitness Center (including swimming pool)</span><br></li><li><span style="font-size: 14.4px;">Includes buffet breakfast</span></li><li><span style="font-size: 14.4px;">Complimentary in room refreshment bar</span></li><li><span style="font-size: 14.4px;">Daily housekeeping services</span></li><li><span style="font-size: 14.4px;">Marbel Bathroom with rain shower</span></li></ul><p><span style="font-size: 14.4px;"><b>Other Room Amenities</b>: Work desk, LED flat TV, Air con, Kettle, Hairdryer, Bathrobes &amp; slippers, Smoke alarm in room, complimentary coffee/tea</span><br></p>';
        $roomtype->noofpeople = 2;
        $roomtype->noofbed = 1;
        $roomtype->image1 = 'backend/img/roomtype/d1.jpg';
        $roomtype->image2 = 'backend/img/roomtype/d2.jpg';
        $roomtype->image3 = 'backend/img/roomtype/d3.jpg';
        $roomtype->save();


        $roomtype = new Roomtype;
        $roomtype->name = 'Triple Room';
        $roomtype->pricepernight = 40;
        $roomtype->description = '<p>All triple rooms offer breathtaking night views to enjoy with your friends or family.&nbsp;</p><ul><li>Free high-speed wireless internet in all rooms.</li><li>Complimentary use of our Fitness Center (including swimming pool)<br></li><li>Includes buffet breakfast</li><li>Complimentary in room refreshment bar</li><li>Daily housekeeping services</li><li>Marbel Bathroom with rain shower</li><li>Iron &amp; Iron board, upon request</li></ul><p><b>Other Room&nbsp;Amenities</b>: Work desk, LED flat TV, Air con, Kettle, Hairdryer,&nbsp;<span style="color: rgb(12, 11, 9); font-family: &quot;Open Sans&quot;, sans-serif; font-size: 0.9rem;">Bathrobes &amp; slippers,&nbsp;</span><span style="font-size: 0.9rem;">Smoke alarm in room, complimentary coffee/tea</span></p>';
        $roomtype->noofpeople = 3;
        $roomtype->noofbed = 2;
        $roomtype->image1 = 'backend/img/roomtype/t1.jpg';
        $roomtype->image2 = 'backend/img/roomtype/t2.jpg';
        $roomtype->image3 = 'backend/img/roomtype/t3.jpg';
        $roomtype->save();


        $roomtype = new Roomtype;
        $roomtype->name = 'King Size Room';
        $roomtype->pricepernight = 45;
        $roomtype->description = '<p>All King Size Rooms offer stunning night views of the city. Also, with a spacious living room and dining area, this rooms will make you feel like your home.</p><ul><li>Free high-speed wireless internet in all rooms.</li><li>Complimentary use of our Fitness Center (including swimming pool)<br></li><li>Includes buffet breakfast</li><li>Complimentary in room refreshment bar</li><li>Daily housekeeping services</li><li>Marbel Bathroom with rain shower</li><li>Iron &amp; Iron board, upon request</li><li>Living room with dining area</li></ul><p><span style="font-weight: bolder; color: rgb(12, 11, 9); font-family: &quot;Open Sans&quot;, sans-serif;">Other Room&nbsp;Amenities</span><span style="color: rgb(12, 11, 9); font-family: &quot;Open Sans&quot;, sans-serif;">: Work desk, LED flat TV, Air con, Kettle, Hairdryer,&nbsp;</span><span style="color: rgb(12, 11, 9); font-family: &quot;Open Sans&quot;, sans-serif; font-size: 0.9rem;">Bathrobes &amp; slippers,&nbsp;</span><span style="color: rgb(12, 11, 9); font-family: &quot;Open Sans&quot;, sans-serif; font-size: 0.9rem;">Smoke alarm in room, complimentary coffee/tea</span><br></p>';
        $roomtype->noofpeople = 4;
        $roomtype->noofbed = 3;
        $roomtype->image1 = 'backend/img/roomtype/q1.jpg';
        $roomtype->image2 = 'backend/img/roomtype/q2.jpg';
        $roomtype->image3 = 'backend/img/roomtype/q3.jpg';
        $roomtype->save();


        $roomtype = new Roomtype;
        $roomtype->name = 'Junior Suite';
        $roomtype->pricepernight = 100;
        $roomtype->description = '<p>Suite Rooms provides guests with a classic, elegant bedroom, a sleek and well equipped bathroom plus a living area offering all necessary amenities from which to relax and take in the breathtaking Blue Lake.</p><ul style="color: rgb(12, 11, 9); font-family: &quot;Open Sans&quot;, sans-serif;"><li>Complimentary high speed wireless internet and cable and ports for wired internet</li><li>Complimentary use of our Fitness Center (including swimming pool)<br></li><li>Includes buffet breakfast</li><li>Complimentary in room refreshment bar</li><li>Daily housekeeping services</li><li>Marbel Bathroom with bath tub and separate rain shower</li><li>Iron &amp; Iron board, upon request</li><li>In-room snacks</li></ul><p><span style="color: rgb(12, 11, 9); font-family: &quot;Open Sans&quot;, sans-serif; font-weight: bolder;">Other Room&nbsp;Amenities</span><span style="color: rgb(12, 11, 9); font-family: &quot;Open Sans&quot;, sans-serif;">: Work desk, LED flat TV, DVD player, Air con, Kettle, Hairdryer,&nbsp;</span><span style="color: rgb(12, 11, 9); font-family: &quot;Open Sans&quot;, sans-serif; font-size: 0.9rem;">Bathrobes &amp; slippers,&nbsp;</span><span style="color: rgb(12, 11, 9); font-family: &quot;Open Sans&quot;, sans-serif; font-size: 0.9rem;">Smoke alarm in room, complimentary coffee/tea</span><br></p>';
        $roomtype->noofpeople = 2;
        $roomtype->noofbed = 1;
        $roomtype->image1 = 'backend/img/roomtype/js1.jpg';
        $roomtype->image2 = 'backend/img/roomtype/js2.jpg';
        $roomtype->image3 = 'backend/img/roomtype/js3.jpg';
        $roomtype->save();


        $roomtype = new Roomtype;
        $roomtype->name = 'Superior Suite';
        $roomtype->pricepernight = 150;
        $roomtype->description = '<p>Suite Rooms provides guests with a classic, elegant bedroom, a sleek and well equipped bathroom plus a living area offering all necessary amenities from which to relax and take in the breathtaking Blue Lake.</p><p>This rooms are the best choice for Business purpose travellers.</p><ul style="color: rgb(12, 11, 9); font-family: &quot;Open Sans&quot;, sans-serif;"><li>Complimentary high speed wireless internet and cable and ports for wired internet</li><li>Luxurious double bed</li><li>Complimentary use of our Fitness Center (including swimming pool)<br></li><li>Includes buffet breakfast</li><li>Complimentary in room refreshment bar</li><li>Daily housekeeping services</li><li>Marbel Bathroom with bath tub and separate rain shower</li><li>Iron &amp; Iron board, upon request</li><li>In-room snacks</li></ul><p><span style="color: rgb(12, 11, 9); font-family: &quot;Open Sans&quot;, sans-serif; font-weight: bolder;">Other Room&nbsp;Amenities</span><span style="color: rgb(12, 11, 9); font-family: &quot;Open Sans&quot;, sans-serif;">: Work desk, LED flat TV with premium channels, DVD player, Air con, Kettle, Hairdryer and Makeup Mirror,&nbsp;</span><span style="color: rgb(12, 11, 9); font-family: &quot;Open Sans&quot;, sans-serif; font-size: 0.9rem;">Bathrobes &amp; slippers, Branded bathroom amenities,&nbsp;</span><span style="color: rgb(12, 11, 9); font-family: &quot;Open Sans&quot;, sans-serif; font-size: 0.9rem;">Smoke alarm in room, complimentary coffee/tea, in-room electronic safe</span><br></p>';
        $roomtype->noofpeople = 2;
        $roomtype->noofbed = 1;
        $roomtype->image1 = 'backend/img/roomtype/ss1.jpg';
        $roomtype->image2 = 'backend/img/roomtype/ss2.jpg';
        $roomtype->image3 = 'backend/img/roomtype/ss3.jpg';
        $roomtype->save();

        

    }
}
