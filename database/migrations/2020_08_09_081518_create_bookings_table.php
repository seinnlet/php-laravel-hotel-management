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
            $table->string('bookingid', 30);
            
            $table->date('bookstartdate');
            $table->date('bookenddate');
            $table->dateTime('checkindatetime')->nullable();
            $table->dateTime('checkoutdatetime')->nullable();
            $table->integer('duration');
            $table->string('bookingtype', 30);

            $table->integer('noofadult');
            $table->integer('noofchildren');
            
            $table->string('estimatedarrivaltime')->nullable();
            $table->tinyInteger('earlycheckin');
            $table->text('note')->nullable();
            
            $table->integer('totalcost');   // original rooms total cost
            $table->integer('pointsused')->default('0');
            $table->unsignedDecimal('taxamount', 8, 2)->default('0');
            $table->unsignedDecimal('propertydamagecost', 8, 2)->default('0');
            $table->text('notebystaff')->nullable();
            $table->unsignedDecimal('grandtotal', 8, 2)->default('0');  // services + member points
            
            $table->date('canceldate')->nullable();
            $table->string('status', 20);
            $table->unsignedBigInteger('guest_id');
            $table->unsignedBigInteger('staff_id')->nullable();
            $table->timestamps();

            $table->foreign('staff_id')  
                    ->references('id')
                    ->on('staff')
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
