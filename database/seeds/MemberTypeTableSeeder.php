<?php

use Illuminate\Database\Seeder;
use App\Membertype;

class MemberTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $membertype = new Membertype;
        $membertype->name = 'Classic Level';
        $membertype->earnpoints = 3;
        $membertype->save();

        $membertype = new Membertype;
        $membertype->name = 'Sliver Level';
        $membertype->earnpoints = 4.5;
        $membertype->laundrydiscount = 10;
        $membertype->numberofstays = 3;
        $membertype->numberofnights = 7;
        $membertype->paidamount = 2000;
        $membertype->save();

        $membertype = new Membertype;
        $membertype->name = 'Gold Level';
        $membertype->earnpoints = 5.25;
        $membertype->laundrydiscount = 15;
        $membertype->fooddiscount = 5;
        $membertype->additionalbenefits = 'Welcome amenities provided during hotel stays';
        $membertype->numberofstays = 10;
        $membertype->numberofnights = 25;
        $membertype->paidamount = 7000;
        $membertype->save();

        $membertype = new Membertype;
        $membertype->name = 'Platinum Level';
        $membertype->earnpoints = 6;
        $membertype->laundrydiscount = 20;
        $membertype->fooddiscount = 10;
        $membertype->additionalbenefits = 'Free admission for one accompanying guest to the Club Lounge during hotel stays (14 years of age or older. Only at participating hotels.), 15:00 late check-out';
        $membertype->numberofstays = 20;
        $membertype->numberofnights = 50;
        $membertype->paidamount = 15000;
        $membertype->save();

    }
}
