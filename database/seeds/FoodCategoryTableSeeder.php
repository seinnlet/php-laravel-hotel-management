<?php

use Illuminate\Database\Seeder;
use App\Foodcategory;

class FoodCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $foodcategory = new Foodcategory;
        $foodcategory->name = 'Drink';
        $foodcategory->save();

        $foodcategory = new Foodcategory;
        $foodcategory->name = 'Main Dish';
        $foodcategory->save();

        $foodcategory = new Foodcategory;
        $foodcategory->name = 'Side Dish';
        $foodcategory->save();

        $foodcategory = new Foodcategory;
        $foodcategory->name = 'Seafood';
        $foodcategory->save();

        $foodcategory = new Foodcategory;
        $foodcategory->name = 'Dessert';
        $foodcategory->save();
    }
}
