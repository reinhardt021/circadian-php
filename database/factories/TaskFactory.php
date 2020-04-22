<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Task;
use Faker\Generator as Faker;

$factory->define(Task::class, function (Faker $faker) {
    return [
        'title' => $faker->name,
        'hours' => $faker->numberBetween(0,24),
        'minutes' => $faker->numberBetween(0,59),
        'seconds' => $faker->numberBetween(0,59),
    ];
});
