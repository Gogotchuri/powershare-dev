<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Image::class, function (Faker $faker) {

    return [
        'url' => 'https://dummyimage.com/640x480/ddd/888',
        'name' => 'Featured Image'
    ];
});
