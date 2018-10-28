<?php

namespace App\Console\Commands;

use App\Models\Campaign;
use Illuminate\Console\Command;

class CheckCampaignBalances extends Command
{
    protected $signature = 'campaigns';

    protected $description = 'Updated all realized funds';

    public function handle()
    {
        $campaigns = Campaign::all();

        foreach ($campaigns as $campaign) {
            $campaign->getBalance();
            $campaign->save();
        }
    }
}
