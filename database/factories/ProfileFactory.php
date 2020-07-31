<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Profile;
use App\User;
use Faker\Generator as Faker;

$factory->define(Profile::class, function (Faker $faker) {
    return [
        'id' => function() {
            return factory(User::class)->create()->id;
        },
        'city' => $faker->city,
        'street' => $faker->streetName,
        'entrance' => $faker->numberBetween(1, 200),
        'apartment' => $faker->numberBetween(1, 200)
    ];
});
