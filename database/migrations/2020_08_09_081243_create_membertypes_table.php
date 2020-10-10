<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembertypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('membertypes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('earnpoints');
            $table->tinyInteger('level');
            $table->integer('laundrydiscount')->default('0');
            $table->integer('fooddiscount')->default('0');
            $table->text('additionalbenefits')->nullable();
            $table->integer('numberofstays')->default('0');       // for membertype restriction
            $table->integer('numberofnights')->default('0');      // for membertype restriction
            $table->integer('paidamount')->default('0');          // for membertype restriction
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('membertypes');
    }
}
