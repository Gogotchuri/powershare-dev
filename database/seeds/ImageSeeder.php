<?php

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

        $image->save();
    }
}
