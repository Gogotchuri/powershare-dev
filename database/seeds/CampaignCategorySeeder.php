<?php

use Illuminate\Database\Seeder;

class CampaignCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cats = [
            ['Save the Planet', 'planet.png'],
            ['Seed a Business', 'rocket.png'],
            ['Change Lives', 'smile.png'],
        ];

        foreach ($cats as $cat) {
            $ico_path = base_path('database/seeds/raw/' . $cat[1]);

            $category = new \App\Models\Reference\CampaignCategory();
            $category->name = $cat[0];
            $category->icon = file_get_contents($ico_path);
            $category->save();
        }
    }
}
