<?php

use Faker\Generator as Faker;
use App\Rooms;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use App\City;
use App\User;
use App\Country;

$factory->define(Rooms::class, function (Faker $faker) {
    $onezero = ['No', 'Yes'];
    $name = $faker->name;
    return [
        'country_id' => Country::inRandomOrder()->first()->id,
        'user_id' => User::inRandomOrder()->first()->id,
        'city_id' => City::inRandomOrder()->first()->id,
        'name' => $name,
        'area' => $faker->streetName,
        'room_type' => rand(1, 4),
        'price' => rand(10, 100),
        'address' => $faker->address,
        'lat_location' => rand(1, 150) . "." . rand(1, 56466),
        'lng_location' => rand(1, 150) . "." . rand(1, 56463),
        'short_description' => $faker->realText(70),
        'long_description' => $faker->realText(350),
        'slug' => SlugService::createSlug(Rooms::class, 'slug', $name),
        'parking' => $onezero[rand(0, 1)],
        'wifi' => $onezero[rand(0, 1)],
        'pet_friendly' => $onezero[rand(0, 1)],
    ];
});
