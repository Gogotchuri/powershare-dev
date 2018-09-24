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
        $image = \App\Models\Image::first();

        $someName = 'Sample Campaign';
        $someText = 'This is campaigns details';

        for($i = 0; $i < 1; $i++) {
            $campaign = new \App\Models\Campaign();
            $campaign->name = $i . $someName;
            $campaign->details = $i . $someText;
            $campaign->author_id = $user->id;
            $campaign->status_id = \App\Models\Reference\CampaignStatus::APPROVED;
            $campaign->featured_image_id = $image->id;
            $campaign->save();
        }
    }
}
