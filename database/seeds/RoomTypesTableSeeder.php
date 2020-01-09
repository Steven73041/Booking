<?php

use Illuminate\Database\Seeder;
use App\RoomTypes;
use Illuminate\Support\Facades\DB;
class RoomTypesTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('room_types')->delete();
        $room_types = [
            ['id' => 1, 'name' => 'Single Room'],
            ['id' => 2, 'name' => 'Double Room'],
            ['id' => 3, 'name' => 'Triple Room'],
            ['id' => 4, 'name' => 'Fourfold Room']
        ];
        foreach ($room_types as $room_type) {
            RoomTypes::create($room_type);
        }
    }


}
