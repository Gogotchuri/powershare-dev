<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(CampaignStatusSeeder::class);
        $this->call(SocialPlatformSeeder::class);
        $this->call(ImageSeeder::class);
        $this->call(CampaignCategorySeeder::class);
        $this->call(CampaignSeeder::class);
        $this->call(CommentSeeder::class);
    }
}
