<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'title'=>$faker->company(),
        'excerpt'=>$faker->paragraph(2),
        'description'=>$faker->paragraph(5),
        'picture'=>$faker->imageUrl(360, 360, 'animals', true, 'cats', true),
        'category_id'=>rand(1, 20),
    ];
});
