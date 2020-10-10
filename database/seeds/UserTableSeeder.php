<?php

use Illuminate\Database\Seeder;
use App\Staff;
use App\User;
use App\Guest;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      // admin
    	$user = new User;
    	$user->name = 'Admin Riza';
    	$user->email = 'admin@gmail.com';
    	$user->password = Hash::make('12345678');
    	$user->assignRole('Admin');
    	$user->save();

     	$staff = new Staff;
     	$staff->user_id = $user->id;
     	$staff->gender = 'Female';
        $staff->phone = '0912345678';
        $staff->address = 'Yangon, Myanmar';
     	$staff->save();

  		// reservation staff
     	$user = new User;
    	$user->name = 'Kazuki';
    	$user->email = 'kazuki@gmail.com';
    	$user->password = Hash::make('12345678');
    	$user->assignRole('Reservation Staff');
    	$user->save();

     	$staff = new Staff;
     	$staff->user_id = $user->id;
     	$staff->gender = 'Male';
        $staff->phone = '0112345678';
        $staff->address = 'Tokyo, Japan';
     	$staff->save();

  		// service staff
     	$user = new User;
    	$user->name = 'Hikari';
    	$user->email = 'hikari@gmail.com';
    	$user->password = Hash::make('12345678');
    	$user->assignRole('Service Staff');
    	$user->save();

     	$staff = new Staff;
     	$staff->user_id = $user->id;
     	$staff->gender = 'Female';
        $staff->phone = '0187654321';
        $staff->address = 'Kyoto, Japan';
     	$staff->save();

  		// Restaurant
     	$user = new User;
    	$user->name = 'Aruto';
    	$user->email = 'aruto@gmail.com';
    	$user->password = Hash::make('12345678');
    	$user->assignRole('Kitchen Staff');
    	$user->save();

     	$staff = new Staff;
     	$staff->user_id = $user->id;
     	$staff->gender = 'Male';
        $staff->phone = '0912345678';
        $staff->address = 'Tokyo, Japan';
     	$staff->save();

        // guest 
        $user = new User;
        $user->name = 'Miyuki';
        $user->email = 'miyuki@gmail.com';
        $user->password = Hash::make('12345678');
        $user->assignRole('Guest');
        $user->save();

        $guest = new Guest;
        $guest->user_id = $user->id;
        $guest->staff_id = '2';
        $guest->membertype_id = '1';
        $guest->memberstartdate = '2020-02-02';
        $guest->member_id = '2020-0202-1';
        $guest->phone1 = '0912345678';
        $guest->phone2 = '09443030111';
        $guest->city = 'Yangon';
        $guest->country = 'Myanmar';
        $guest->save();

        // guest 
        $user = new User;
        $user->name = 'Takane';
        $user->email = 'takane@gmail.com';
        $user->password = Hash::make('12345678');
        $user->assignRole('Guest');
        $user->save();

        $guest = new Guest;
        $guest->user_id = $user->id;
        $guest->staff_id = '2';
        $guest->phone1 = '0912345678';
        $guest->city = 'Okinawa';
        $guest->country = 'Japan';
        $guest->save();
    }
}
