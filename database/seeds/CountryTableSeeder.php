<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Country;
class CountryTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('countries')->delete();
        $countries = [
            ['name' => 'Greece'],
            ['name' => 'Spain'],
            ['name' => 'Italy'],
            ['name' => 'Germany'],
            ['name' => 'France']
        ];
        foreach ($countries as $country) {
            Country::create($country);
        }
    }


}
