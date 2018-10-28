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

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model)
        {
            $last = Campaign::orderBy('id', 'desc')->first();
            $model->attributes['order'] = $last->id * 10 + 10;
        });
    }

    public static function createPath()
    {
        return Auth::user() && Auth::user()->role_id === 1
            ? route('admin.campaigns.create')
            : route('user.campaigns.create');
    }

    public static function baseRules() {
        return [
            'name' => 'required|string|max:255',
            //TODO: Should we use word count validation or is 50 symbol limit sufficient
            'target_audience' => 'required|string|max:50',
            'details' => 'required|string|max:1000',
        ];
    }

    public static function updateRules() {
        return array_merge(Campaign::baseRules(), [
            'category' => 'required|exists:campaign_categories,id',
            'required_funding' => 'required|numeric',
            //Coming from base rules
            //'details' => 'required|string|max:1000',
            //TODO: Conditionally add required rule here if campaign have no image
            'featured-image' => 'image|mimes:jpeg,png,jpg,gif',
            'ethereum_address' => 'nullable|string|max:255',
            'importance' => 'string|max:3000',
            'video_url' => 'url',
        ]);
    }

    public function author() {
        return $this->belongsTo(User::class);
    }

    public function status() {
        return $this->belongsTo(CampaignStatus::class);
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
