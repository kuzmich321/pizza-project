<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Pizza;
use Faker\Generator as Faker;

$factory->define(Pizza::class, function (Faker $faker) {
    return [
        'name' => "by {$faker->name}",
        'description' => $faker->text(30),
        'price' => $faker->numberBetween(50, 100)
    ];
});
