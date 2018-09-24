<?php

use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ordinaryUser = \App\User::where('role_id', '>', '1')->first();
        $sampleCampaign = \App\Models\Campaign::first();

        $someText = 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the 
            industry\'s standard dummy text ever since the';


        for($i = 0; $i < 50; $i++) {
            $comment = new \App\Models\Comment();
            $comment->body = $i . $someText;
            $comment->author_id = $ordinaryUser->id;
            $comment->campaign_id = $sampleCampaign->id;
            $comment->date = \Carbon\Carbon::now();

            $comment->save();
        }
    }
}
