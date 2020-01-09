<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use App\Reviews;
use App\User;
use App\Rooms;

$factory->define(Reviews::class, function (Faker $faker) {
    return [
        'user_id' => User::inRandomOrder()->first()->id,
        'room_id' => Rooms::inRandomOrder()->first()->id,
        'rate' => rand(0,5),
        'review' => $faker->realText(100),
    ];
});
