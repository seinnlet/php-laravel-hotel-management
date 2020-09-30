<?php

use Illuminate\Database\Seeder;
use App\Food;

class FoodTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    		// drink
        $food = new Food;
        $food->name = 'Lime Juice';
        $food->unitprice = 3.5;
        $food->image = 'backend/img/menu/drink1.jpg';
        $food->foodcategory_id = 1;
        $food->save();

        $food = new Food;
        $food->name = 'Watermelon Soda Drink';
        $food->unitprice = 4;
        $food->image = 'backend/img/menu/drink2.jpg';
        $food->foodcategory_id = 1;
        $food->save();

        $food = new Food;
        $food->name = 'Strawberry Milk';
        $food->unitprice = 5.5;
        $food->image = 'backend/img/menu/drink3.jpg';
        $food->foodcategory_id = 1;
        $food->save();

        $food = new Food;
        $food->name = 'Coffee';
        $food->unitprice = 5;
        $food->image = 'backend/img/menu/drink4.jpg';
        $food->foodcategory_id = 1;
        $food->save();

        $food = new Food;
        $food->name = 'Traditional Tea';
        $food->unitprice = 3;
        $food->image = 'backend/img/menu/drink5.jpg';
        $food->foodcategory_id = 1;
        $food->save();

        // main dish
        $food = new Food;
        $food->name = 'Lobster Roll';
        $food->unitprice = 10;
        $food->image = 'backend/img/menu/maindish1.jpg';
        $food->foodcategory_id = 2;
        $food->save();

        $food = new Food;
        $food->name = 'Lobster Bisque';
        $food->unitprice = 12;
        $food->image = 'backend/img/menu/maindish2.jpg';
        $food->foodcategory_id = 2;
        $food->save();

        $food = new Food;
        $food->name = 'Tuscan Grilled';
        $food->unitprice = 15;
        $food->image = 'backend/img/menu/maindish3.jpg';
        $food->foodcategory_id = 2;
        $food->save();

        // side dish
        $food = new Food;
        $food->name = 'Greek Salad';
        $food->unitprice = 7.5;
        $food->image = 'backend/img/menu/sidedish1.jpg';
        $food->foodcategory_id = 3;
        $food->save();

        $food = new Food;
        $food->name = 'Spinach Salad';
        $food->unitprice = 8;
        $food->image = 'backend/img/menu/sidedish2.jpg';
        $food->foodcategory_id = 3;
        $food->save();

        $food = new Food;
        $food->name = 'Mozzarella';
        $food->unitprice = 7;
        $food->image = 'backend/img/menu/sidedish3.jpg';
        $food->foodcategory_id = 3;
        $food->save();

        $food = new Food;
        $food->name = 'Caesar';
        $food->unitprice = 6.5;
        $food->image = 'backend/img/menu/sidedish4.jpg';
        $food->foodcategory_id = 3;
        $food->save();

        // sushi 
        $food = new Food;
        $food->name = 'Salmon';
        $food->unitprice = 3.5;
        $food->image = 'backend/img/menu/sushi1.jpg';
        $food->foodcategory_id = 4;
        $food->save();

        $food = new Food;
        $food->name = 'Tuna';
        $food->unitprice = 3;
        $food->image = 'backend/img/menu/sushi2.jpg';
        $food->foodcategory_id = 4;
        $food->save();

        $food = new Food;
        $food->name = 'Rice Roll Sushi';
        $food->unitprice = 4;
        $food->image = 'backend/img/menu/sushi3.jpg';
        $food->foodcategory_id = 4;
        $food->save();

        $food = new Food;
        $food->name = 'Sushi Pack';
        $food->unitprice = 3.5;
        $food->image = 'backend/img/menu/sushi4.jpg';
        $food->foodcategory_id = 4;
        $food->save();

        $food = new Food;
        $food->name = 'Vegetable Sushi Roll';
        $food->unitprice = 3;
        $food->image = 'backend/img/menu/sushi5.jpg';
        $food->foodcategory_id = 4;
        $food->save();

        // dessert
        $food = new Food;
        $food->name = 'Cake';
        $food->unitprice = 25;
        $food->image = 'backend/img/menu/dessert1.jpg';
        $food->foodcategory_id = 5;
        $food->save();

        $food = new Food;
        $food->name = 'Brown Bread';
        $food->unitprice = 4;
        $food->image = 'backend/img/menu/dessert2.jpg';
        $food->foodcategory_id = 5;
        $food->save();

        $food = new Food;
        $food->name = 'Ice-cream Cake';
        $food->unitprice = 7.5;
        $food->image = 'backend/img/menu/dessert3.jpg';
        $food->foodcategory_id = 5;
        $food->save();

        $food = new Food;
        $food->name = 'Ice-cream Cup';
        $food->unitprice = 7;
        $food->image = 'backend/img/menu/dessert4.jpg';
        $food->foodcategory_id = 5;
        $food->save();
    }
}
