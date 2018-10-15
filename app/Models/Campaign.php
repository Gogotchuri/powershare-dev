<?php

namespace App\Models;

use App\Models\Reference\CampaignCategory;
use App\Models\Reference\CampaignStatus;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Campaign extends Model
{
    protected $with = [
        'status'
    ];

    public static function createPath()
    {
        return Auth::user() && Auth::user()->role_id === 1
            ? route('admin.campaigns.create')
            : route('user.campaigns.create');
    }

    public static function baseRules() {
        return [
            'name' => 'required|string|max:255',
            'details' => 'required|string',
            'target_audience' => 'string',
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

    public function public_comments()
    {
        return $this->comments()->where('is_public', 1);
    }

    public function social_links() {
        return $this->hasMany(SocialLink::class);
    }

    public function category() {
        return $this->belongsTo(CampaignCategory::class);
    }

    public function members() {
        return $this->hasMany(TeamMember::class);
    }

    public function getIsApprovedAttribute() {
        return $this->status_id == CampaignStatus::APPROVED;
    }

    public function getCategoryIconAttribute() {
        return optional($this->category)->icon;
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

    public function getFeaturedImageThumbnailUrlAttribute()
    {
        return optional($this->featured_image)->thumbnail_url;
    }

    public function getFeaturedImageUrlAttribute()
    {
        return optional($this->featured_image)->url;
    }

    public function getExcerptAttribute(){
        return str_limit($this->details, 13);
    }
}
