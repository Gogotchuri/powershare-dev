<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public function author() {
        return $this->belongsTo(User::class);
    }

    public function campaign() {
        return $this->belongsTo(Campaign::class);
    }

    public function getAuthorNameAttribute() {
        return $this->author->name;
    }

    public function getCampaignNameAttribute() {
        return $this->campaign->name;
    }
}
