<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($room_number=1; $room_number<60; $room_number++)
        {
            $floor = null;
            if ($room_number < 10) $floor = 0;
            elseif (10<= $room_number && $room_number < 20)  $floor = 1;
            elseif (20<= $room_number && $room_number < 30)  $floor = 2;
            elseif (30<= $room_number && $room_number < 40)  $floor = 3;
            elseif (40<= $room_number && $room_number < 50)  $floor = 4;
            elseif (50<= $room_number && $room_number < 60)  $floor = 5;
            else  $floor = null;

            DB::table('rooms')->insert([
                'room_number' => $room_number,
                'floor' => $floor,
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas finibus sapien eget placerat fermentum. Morbi quis velit suscipit turpis fermentum convallis id nec lectus.',
                'price_per_night' => rand(120, 500),
                'room_type_id' => 1,
                'bed_type_id' => 1,
                'room_status_id' => 1,
            ]);
        }
    }
}
