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
        $image->name = "Featured Image";
        $image->url = 'https://cz-public-images-test.s3.amazonaws.com/powershare-5YtTOa2JOVkjdl4GvVqOpx23YMsKug1kjg6Y9j50.png';
        $image->thumbnail_url = 'https://cz-public-images-test.s3.amazonaws.com/powershare-thumbnail-5YtTOa2JOVkjdl4GvVqOpx23YMsKug1kjg6Y9j50.png';
        $image->save();
    }
}
