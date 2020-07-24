<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Models\Post::class, function (Faker $faker) {
    return [
        'title' => $faker->unique()->realText(20, 1),
        'slug' => $faker->unique()->slug(3, 3),
        'description' => $faker->unique()->realText()
    ];
});
