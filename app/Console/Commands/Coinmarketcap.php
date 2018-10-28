<?php

namespace App\Console\Commands;

use App\Models\AppSetting;
use Illuminate\Console\Command;

class Coinmarketcap extends Command
{

    protected $signature = 'coinmarketcap';

    protected $description = 'Update prices';

    public function handle()
    {
        AppSetting::updateCurrencies();
    }
}
