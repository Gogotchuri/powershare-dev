<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SocialLink extends Model
{
    public const FACEBOOK = 'FACEBOOK';
    public const TWITTER = 'TWITTER';
    public const LINKEDIN = 'LINKEDIN';
    public const OTHER = 'OTHER';

    public static function platforms() {
        return [
            self::FACEBOOK,
            self::TWITTER,
            self::LINKEDIN,
            self::OTHER,
        ];
    }

    public function platform() {
        return $this->belongsTo(SocialPlatform::class);
    }

    public function getPlatformNameAttribute() {
        return optional($this->platform)->name;
    }
}
