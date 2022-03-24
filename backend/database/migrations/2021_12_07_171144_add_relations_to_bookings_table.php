<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationsToBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->unsignedBigInteger('customer_id')->change();
            $table->foreign('customer_id')->references('id')->on('customers');

            $table->unsignedBigInteger('room_id')->change();
            $table->foreign('room_id')->references('id')->on('rooms');

            $table->unsignedInteger('booking_status_id')->change();
            $table->foreign('booking_status_id')->references('id')->on('booking_statuses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bookings', function (Blueprint $table) {
            //
        });
    }
}
