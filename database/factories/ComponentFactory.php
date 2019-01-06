<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\Storage::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
    ];
});

$factory->define(App\Component::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'category' => $faker->name,
        'stock' => $faker->numberBetween(0, 1000),
        'stock_flag' => $faker->numberBetween(0, 1),
    ];
});
