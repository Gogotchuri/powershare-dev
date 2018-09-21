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
        $user = \App\User::first();

        $someText = 'This is campaign details';

        for($i = 0; $i < 10; $i++) {
            $campaign = new \App\Models\Campaign();
            $campaign->details = $i . $someText;
            $campaign->author_id = $user->id;
            $campaign->status_id = \App\Models\Reference\CampaignStatus::APPROVED;
            $campaign->save();
        }
    }
}
