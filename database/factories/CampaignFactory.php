<?php

use App\Models\Reference\CampaignStatus;

use Faker\Generator as Faker;

$factory->define(\App\Models\Campaign::class, function (Faker $faker) {

    $campaignStatuses = [CampaignStatus::DRAFT, CampaignStatus::PROPOSAL, CampaignStatus::APPROVED];

    $actions = [
        'Save',
        'Rescue',
        'Collecting money for',
        'Let\'s help',
        'Why doesn\'t anyone care about',
        'Help',
    ];

    $subjects = [
        'poor children',
        'refugees',
        'disabled elderly',
        'army veterans',
        'unemployed youth',
        'clean air',
        'beautiful mountains',
        'clean energy',
    ];

    $locations = [
        'in Georgia',
        'in Armenia',
        'in Turkey',
        'in the Caucasus region',
        'in The Netherlands',
        'in Europe',
        'in Africa',
        'in the United States of America',
        'on the moon',
    ];

    return [
        'name' => array_random($actions) . ' ' . array_random($subjects) . ' ' . array_random($locations),
        'details' => implode("\n\n", $faker->paragraphs(rand(2,8))),
        'author_id' => \App\User::inRandomOrder()->first()->id,
        'status_id' => array_random($campaignStatuses),
        'video_url' => 'https://www.youtube.com/watch?v=RSDqSjTO9fs',
        'ethereum_address' => '0x7614e80bE7E0C1e5aFce4E8e35627dEEc461d2bD',
        'featured_image_id' => rand(1, 7),
    ];
});
