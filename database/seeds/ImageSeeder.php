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
        for ($i = 0; $i < 7; $i++) {
            $image = new \App\Models\Image();
            $image->name = "Featured Image";
            $image->url = '/img/samples/sample-' . ($i + 1) . '.jpeg';
            $image->save();
        }
    }
}
