<?php

use Illuminate\Database\Seeder;

class CampaignSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $campaigns = factory(App\Models\Campaign::class, 50)->create()->each(function ($campaign) {
            $campaign->comments()->saveMany(factory(App\Models\Comment::class, rand(1,5))->make());
        });
    }
}
