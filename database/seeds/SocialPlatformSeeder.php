<?php

use Illuminate\Database\Seeder;

use \App\Models\SocialPlatform;

class SocialPlatformSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $platforms = [
            SocialPlatform::FACEBOOK,
            SocialPlatform::TWITTER,
            SocialPlatform::LINKEDIN,
            SocialPlatform::OTHER,
        ];

        foreach ($platforms as $platformId) {
            $projectStatus = new SocialPlatform();
            $projectStatus->id = $platformId;
            $projectStatus->name = SocialPlatform::string($platformId);
            $projectStatus->save();
        }
    }
}
