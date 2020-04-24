<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\TaskOrder;
use Faker\Generator as Faker;

$factory->define(TaskOrder::class, function (Faker $faker) {
    return [
        'flow_id' => null,
        'position' => $faker->numberBetween(1, 99),
        'task_id' => null,
    ];
});
