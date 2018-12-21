<?php

use Faker\Generator as Faker;
use Modules\Product\Entities\Tnved;

$factory->define(Tnved::class, function (Faker $faker) {
    return [
      'code' => $faker->randomNumber(5),
      'title' => $faker->sentence(2),
      'active' => 1
    ];
});
