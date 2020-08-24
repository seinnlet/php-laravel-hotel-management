<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('services')->insert([
            'name' => 'Laundry', 'unitcharge' => 2
        ]);

        DB::table('services')->insert([
            'name' => 'Ironing', 'unitcharge' => 2
        ]);

        DB::table('services')->insert([
            'name' => 'Extra Bedding Items', 'unitcharge' => 3
        ]);
    }
}
