<?php

use Faker\Generator as Faker;

$factory->define(App\Project::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence,
        'description' => $faker->paragraph,
        'status' => $faker->randomElement(['planned', 'running', 'on hold', 'finished', 'cancel']),
    ];
});
