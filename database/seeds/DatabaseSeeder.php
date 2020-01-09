<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run() {
        $this->call(UserTableSeeder::class);
        $this->call(RoomTypesTableSeeder::class);
        $this->call(CityTableSeeder::class);
        $this->call(CountryTableSeeder::class);
        $this->call(RoomsTableSeeder::class);
        $this->call(PhotosTableSeeder::class);
        $this->call(ReviewsTableSeeder::class);
    }
}
