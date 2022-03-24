<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationsToRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rooms', function (Blueprint $table) {
            $table->unsignedInteger('room_type_id')->change();
            $table->foreign('room_type_id')->references('id')->on('room_types');

            $table->unsignedInteger('bed_type_id')->change();
            $table->foreign('bed_type_id')->references('id')->on('room_bed_types');

            $table->unsignedInteger('room_status_id')->change();
            $table->foreign('room_status_id')->references('id')->on('room_statuses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rooms', function (Blueprint $table) {
            //
        });
    }
}
