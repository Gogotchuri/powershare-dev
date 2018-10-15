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
        \App\Models\Campaign::forceCreate([
            'id' => 1,
            'name' => 'Help Clean the Hill',
            'category_id' => 1,
            'target_audience' => 'The Villagers',
            'details' => 'A small village in South Georgia didn\'t have recycled bins for years, therefore the villagers would gather the garbage and throw it away at the end of the village. This took place for years and the results are as shown in the picture. Most of the garbage already rotted, but a lot of it still remains. Thankfully, now the villagers have put out recycled bins and they no longer have to keep on throwing the garbage out like this, but the place still needs to be cleaned.',
            'author_id' => 1,
            'status_id' => 1,
            'video_url' => null,
            'ethereum_address' => 'LeXUY41u9LXMkox38EHrW5aAAcC8qbodQw',
            'featured_image_id' => 1,
        ]);
    }
}
