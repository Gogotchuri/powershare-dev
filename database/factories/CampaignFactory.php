<?php

use App\Models\Reference\CampaignStatus;

use Faker\Generator as Faker;

$factory->define(\App\Models\Campaign::class, function (Faker $faker) {

    $campaignStatuses = [CampaignStatus::DRAFT, CampaignStatus::PROPOSAL, CampaignStatus::APPROVED];

    return [
        'name' => $faker->catchPhrase,
        'details' => $faker->realText(),
        'author_id' => \App\User::inRandomOrder()->first()->id,
        'status_id' => array_random($campaignStatuses),
        'video_url' => 'https://www.youtube.com/watch?v=RSDqSjTO9fs',
        'ethereum_address' => '0x7614e80bE7E0C1e5aFce4E8e35627dEEc461d2bD',
    ];
});
