<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Comment::class, function (Faker $faker) {
    return [
        'author_id' => \App\User::inRandomOrder()->first()->id,
        'body' => $faker->sentences(2, true),
        'is_public' => rand(0,1),
    ];
});
