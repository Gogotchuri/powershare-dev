<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Image::class, function (Faker $faker) {

    return [
        'url' => $faker->imageUrl(640, 480, 'cats'),
        'name' => 'Featured Image'
    ];
});
