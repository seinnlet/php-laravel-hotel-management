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
        $this->call([
            RoleTableSeeder::class,
            CountryTableSeeder::class,
            MemberTypeTableSeeder::class,
            UserTableSeeder::class,
            RoomTypeTableSeeder::class,
            RoomTableSeeder::class,
            ServiceTableSeeder::class,
            FoodCategoryTableSeeder::class,
            FoodTableSeeder::class
        ]);
    		
    }
}
