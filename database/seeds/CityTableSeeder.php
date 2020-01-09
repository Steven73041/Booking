<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\City;
class CityTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('cities')->delete();
        $cities = [
            ['name' => 'Athens', 'country_id' => '1'],
            ['name' => 'Kiato', 'country_id' => '1'],
            ['name' => 'Thessaloniki', 'country_id' => '1'],
            ['name' => 'Patra', 'country_id' => '1'],
            ['name' => 'Korinthos', 'country_id' => '1'],
            ['name' => 'Madrid', 'country_id' => '2'],
            ['name' => 'Valencia', 'country_id' => '2'],
            ['name' => 'Rome', 'country_id' => '3'],
            ['name' => 'Florentia', 'country_id' => '3'],
            ['name' => 'Berlin', 'country_id' => '4'],
            ['name' => 'Frankfurt', 'country_id' => '4'],
            ['name' => 'Paris', 'country_id' => '5'],
            ['name' => 'Monpelier', 'country_id' => '5'],
        ];
        foreach ($cities as $city) {
            City::create($city);
        }
    }

}
