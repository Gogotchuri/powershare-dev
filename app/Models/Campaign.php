<?php

namespace App\Models;

use App\Models\Reference\CampaignStatus;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    protected $with = [
        'status'
    ];

    public function author() {
        return $this->belongsTo(User::class);
    }

    public function status() {
        return $this->belongsTo(CampaignStatus::class);
    }

    public function video() {
        return $this->hasOne(Video::class);
    }

    public function featured_image() {
        return $this->belongsTo(Image::class);
    }

    public function images() {
        return $this->hasMany(Image::class);
    }

    public function comments() {
        return $this->hasMany(Comment::class);
    }

    public function social_links() {
        return $this->hasMany(SocialLink::class);
    }

    public function getIsApprovedAttribute() {
        return $this->status_id == CampaignStatus::APPROVED;
    }

    public function setIsApprovedAttribute($value) {
        $this->status_id = $value ? CampaignStatus::APPROVED : CampaignStatus::DRAFT;
    }

    public function getStatusNameAttribute()
    {
        return CampaignStatus::nameFromId($this->status_id);
    }
}
