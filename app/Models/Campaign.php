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

    public static function baseRules() {
        return [
            'name' => 'required|string|max:255',
            'details' => 'required|string',
            'video_url' => 'url',
            'ethereum_address' => 'nullable|string|max:255',
            'featured_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'featured_images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }

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
        $this->status_id = $value ? CampaignStatus::APPROVED : CampaignStatus::PROPOSAL;
    }

    public function getIsDraftAttribute() {
        return $this->status_id == CampaignStatus::DRAFT;
    }

    public function getIsProposalAttribute() {
        return $this->status_id == CampaignStatus::PROPOSAL;
    }

    public function getStatusNameAttribute()
    {
        return CampaignStatus::nameFromId($this->status_id);
    }

    public function getYoutubeIdAttribute()
    {
        if(!$this->video_url) {
            return null;
        }

        $parts = parse_url($this->video_url);
        parse_str($parts['query'], $query);

        return array_get($query, 'v');
    }
}
