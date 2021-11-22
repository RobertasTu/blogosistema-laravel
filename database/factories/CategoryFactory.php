<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Category;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {
    return [
        'title' => $faker->name(),
        'excerpt' => $faker->paragraph(3),
        'description' => $faker->paragraph(6),

    ];
});
