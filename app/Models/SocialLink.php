<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SocialLink extends Model
{
    public static const FACEBOOK = 'FACEBOOK';
    public static const TWITTER = 'TWITTER';
    public static const LINKEDIN = 'LINKEDIN';
    public static const OTHER = 'OTHER';

    public static function platforms() {
        return [
            self::FACEBOOK,
            self::TWITTER,
            self::LINKEDIN,
            self::OTHER,
        ];
    }
}
