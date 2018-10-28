<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class CoinhiveUser extends Model
{
    public static function updateFromRaw($attributes)
    {
        $coinhiveUser = new CoinhiveUser;
        $coinhiveUser = $coinhiveUser->findOrCreateByName($attributes->name);

        if ($coinhiveUser->isChanged($attributes)) {
            $coinhiveUser->total = $attributes->total;
            $coinhiveUser->withdrawn = $attributes->withdrawn;
            $coinhiveUser->balance = $attributes->balance;
            $coinhiveUser->save();
        }
    }

    public function findOrCreateByName($name)
    {
        $coinhiveUser = $this->where('name', $name)->first();

        if (!$coinhiveUser) {
            $explosion = explode('-', $name);

            $campaign = Campaign::find($explosion[0]);
            $miner = isset($explosion[1]) ? User::find($explosion[1]) : null;

            $coinhiveUser = new CoinhiveUser;
            $coinhiveUser->name = $name;
            $coinhiveUser->campaign_id = $campaign ? $campaign->id : null;
            $coinhiveUser->user_id = $miner ? $miner->id : null;
            $coinhiveUser->save();
        }

        return $coinhiveUser;
    }

    public function isChanged($attributes)
    {
        return $this->total !== $attributes->total
            || $this->withdrawn !== $attributes->withdrawn
            || $this->balance !== $attributes->balance;
    }

}
