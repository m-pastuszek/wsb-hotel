<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMealTypeToBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->unsignedInteger('meal_id')->after('booking_status_id');
        });

        Schema::table('meals', function (Blueprint $table) {
            $table->unsignedInteger('id')->change();

        });

        Schema::table('bookings', function (Blueprint $table) {
            $table->foreign('meal_id')->references('id')->on('meals');
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
            $table->dropColumn('meal_id');
            $table->dropForeign(['meal_id']);
        });
    }
}
