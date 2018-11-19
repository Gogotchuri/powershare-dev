<?php

namespace App\Console\Commands;

use App\Models\CoinhiveUser;
use App\Services\CoinHiveAPI;
use Illuminate\Console\Command;

class CoinhiveUsers extends Command
{
    protected $signature = 'coinhive:users';

    protected $description = 'Sync user balances with coinhive users table';

    public function handle()
    {
        $coinhive = new CoinHiveAPI();
        //FIXME: This will fail if user count goes over 4096.
        $users = $coinhive->getUserList();

        foreach ($users as $user) {
            CoinhiveUser::updateFromRaw($user);
        }
    }
}
