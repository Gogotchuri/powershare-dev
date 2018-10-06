<?php

use App\Models\Campaign;
use Illuminate\Database\Seeder;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $image = new \App\Models\Image();
        $image->name = "Sample Campaign";
        $image->url = 'sample-campaigns.png';
        $image->campaign_id = Campaign::all()->random()->id;
        $image->save();
    }
}
