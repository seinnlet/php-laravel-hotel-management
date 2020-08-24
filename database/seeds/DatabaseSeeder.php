<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
    		$this->call(RoleTableSeeder::class);
    		$this->call(MemberTypeTableSeeder::class);
    		$this->call(RoomTypeTableSeeder::class);
    		$this->call(RoomTableSeeder::class);
    		$this->call(ServiceTableSeeder::class);
    		$this->call(FoodCategoryTableSeeder::class);
    }
}
