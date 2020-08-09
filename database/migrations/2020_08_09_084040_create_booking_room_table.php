<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingRoomTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking_room', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('booking_id');
            $table->unsignedBigInteger('room_id');
            $table->text('note')->nullable();
            $table->tinyInteger('extrabed');
            $table->timestamps();

            $table->foreign('booking_id')  
                    ->references('id')
                    ->on('bookings')
                    ->onDelete('cascade');

            $table->foreign('room_id')  
                    ->references('id')
                    ->on('rooms')
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
        Schema::dropIfExists('booking_room');
    }
}
