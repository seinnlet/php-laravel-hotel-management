<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomServiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('room_service', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('room_id');
            $table->unsignedBigInteger('service_id');
            $table->unsignedDecimal('totalcharges', 8, 2);
            $table->integer('totalqty');
            $table->text('note')->nullable();
            $table->string('status', 10)->default('Request');
            $table->timestamps();

            $table->foreign('room_id')  
                    ->references('id')
                    ->on('rooms')
                    ->onDelete('cascade');

            $table->foreign('service_id')  
                    ->references('id')
                    ->on('services')
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
        Schema::dropIfExists('room_service');
    }
}
