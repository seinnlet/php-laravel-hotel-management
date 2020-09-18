<?php

use Illuminate\Database\Seeder;
use App\Staff;
use App\User;
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
    	$user->password = Hash::make('staff@hotelriza');
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
    	$user->password = Hash::make('staff@hotelriza');
    	$user->assignRole('Service Staff');
    	$user->save();

     	$staff = new Staff;
     	$staff->user_id = $user->id;
     	$staff->gender = 'Female';
      $staff->phone = '0187654321';
      $staff->address = 'Kyoto, Japan';
     	$staff->save();

  		// chef
     	$user = new User;
    	$user->name = 'Aruto';
    	$user->email = 'aruto@gmail.com';
    	$user->password = Hash::make('staff@hotelriza');
    	$user->assignRole('Chef');
    	$user->save();

     	$staff = new Staff;
     	$staff->user_id = $user->id;
     	$staff->gender = 'Male';
      $staff->phone = '0912345678';
      $staff->address = 'Tokyo, Japan';
     	$staff->save();
    }
}
