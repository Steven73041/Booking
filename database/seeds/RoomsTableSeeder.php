<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Rooms;
use App\City;
use App\Country;

class RoomsTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('rooms')->delete();
        $rooms = factory(Rooms::class, 30)->create();
    }
}
