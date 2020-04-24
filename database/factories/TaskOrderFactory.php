<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(Model::class, function (Faker $faker) {
    return [
        'flow_id' => null,
        'position' => $faker->numberBetween(1, 99),
        'task_id' => null,
    ];
});
