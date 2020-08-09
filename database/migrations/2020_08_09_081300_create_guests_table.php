<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGuestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guests', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone1', 30);
            $table->string('phone2', 30)->nullable();
            $table->string('city', 50);
            $table->string('country', 50);
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('membertype_id');
            $table->timestamps();

            $table->foreign('user_id')  
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade');

            $table->foreign('membertype_id') 
                    ->references('id')
                    ->on('membertypes')
                    ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('guests');
    }
}
