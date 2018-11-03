<?php

namespace App\Models;

use App\Models\Reference\CampaignCategory;
use App\Models\Reference\CampaignStatus;
use App\Services\CoinHiveAPI;
use App\Services\CoinMarketCapApi;
use App\Services\EtherscanApi;
use App\User;
use Carbon\Carbon;
use GuzzleHttp\Client;
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

        static::creating(function ($model) {
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

    public static function baseRules()
    {
        return [
            'name' => 'required|string|max:255',
            //TODO: Should we use word count validation or is 50 symbol limit sufficient
            'target_audience' => 'required|string|max:50',
            'details' => 'required|string|max:1000',
        ];
    }

    public static function updateRules()
    {
        return array_merge(Campaign::baseRules(), [
            'category' => 'required|exists:campaign_categories,id',
            'initiator' => 'required|string|max:191',
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

    public function author()
    {
        return $this->belongsTo(User::class);
    }

    public function status()
    {
        return $this->belongsTo(CampaignStatus::class);
    }

    public function featured_image()
    {
        return $this->belongsTo(Image::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function public_comments()
    {
        return $this->comments()->where('is_public', 1);
    }

    public function social_links()
    {
        return $this->hasMany(SocialLink::class);
    }

    public function category()
    {
        return $this->belongsTo(CampaignCategory::class);
    }

    public function members()
    {
        return $this->hasMany(TeamMember::class);
    }

    public function coinhiveUsers()
    {
        return $this->hasMany(CoinhiveUser::class);
    }

    public function getIsApprovedAttribute()
    {
        return $this->status_id == CampaignStatus::APPROVED;
    }

    public function getCategoryIconAttribute()
    {
        return optional($this->category)->icon;
    }

    public function setIsApprovedAttribute($value)
    {
        $this->status_id = $value ? CampaignStatus::APPROVED : CampaignStatus::PROPOSAL;
    }

    public function getIsDraftAttribute()
    {
        return $this->status_id == CampaignStatus::DRAFT;
    }

    public function getIsProposalAttribute()
    {
        return $this->status_id == CampaignStatus::PROPOSAL;
    }

    public function getStatusNameAttribute()
    {
        return CampaignStatus::nameFromId($this->status_id);
    }

    public function getYoutubeIdAttribute()
    {
        if (!$this->video_url) {
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

    public function getExcerptAttribute()
    {
        return str_limit($this->details, 13);
    }

    public function getAuthorNameAttribute()
    {
        return optional($this->author)->name;
    }

    public function scopeByContributor($query, $contributor_id) {
        return $query->join('coinhive_users', function ($join) use($contributor_id) {
                $join->on('coinhive_users.campaign_id', '=', 'campaigns.id');
                $join->where('coinhive_users.user_id', '=', $contributor_id);
            })->select('campaigns.*');
    }

    public function getBalance()
    {
        $response = EtherscanApi::getAddressTransactions($this->ethereum_address);

        $incoming = 0;

        if (is_array($response)) {
            foreach ($response as $transaction) {
                if (strtolower($transaction->to) === strtolower($this->ethereum_address)) {
                    $incoming += intVal($transaction->value);
                }
            }
        }

        $ethUSD = AppSetting::get('ETH_PRICE') * $incoming / 10**18;
        $xmrUSD = AppSetting::get('XMR_PRICE') * $this->getHashes() * AppSetting::get('COINHIVE_PAYOUT') / 1000000;

        $this->realized_funding = $ethUSD + $xmrUSD;
        $this->funding_checked_at = Carbon::now()->toDateTimeString();
    }

    public function getHashes()
    {
        $hashes = 0;

        foreach ($this->coinhiveUsers as $user) {
            $hashes += $user->total;
        }

        return $hashes;
    }
}
