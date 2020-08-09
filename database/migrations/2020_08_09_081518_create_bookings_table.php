<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->date('checkindate');
            $table->date('checkoutdate');
            $table->integer('noofadult');
            $table->integer('noofchildren');
            $table->string('estimatedarrivaltime')->nullable();
            $table->integer('totalcost');
            $table->integer('grandtotal');
            $table->string('status', 20);
            $table->text('note')->nullable();
            $table->unsignedBigInteger('guest_id');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            $table->foreign('user_id')  
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade');

            $table->foreign('guest_id') 
                    ->references('id')
                    ->on('guests')
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
        Schema::dropIfExists('bookings');
    }
}
