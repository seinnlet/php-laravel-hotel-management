<?php

use Illuminate\Database\Seeder;
use App\Service;

class ServiceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $service = new Service;
        $service->name = 'Laundry';
        $service->unitcharge = 2;
        $service->save();
        
        $service = new Service;
        $service->name = 'Ironing';
        $service->unitcharge = 2;
        $service->save();

        $service = new Service;
        $service->name = 'Extra Bedding Items';
        $service->unitcharge = 5;
        $service->save();

    }
}
