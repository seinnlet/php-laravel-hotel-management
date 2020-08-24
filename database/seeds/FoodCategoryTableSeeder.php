<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FoodCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('foodcategories')->insert([
            'name' => 'Drink'
        ]);
        DB::table('foodcategories')->insert([
            'name' => 'Main Dish'
        ]);
        DB::table('foodcategories')->insert([
            'name' => 'Side Dish'
        ]);
        DB::table('foodcategories')->insert([
            'name' => 'Seafood'
        ]);
        DB::table('foodcategories')->insert([
            'name' => 'Dessert'
        ]);
    }
}
