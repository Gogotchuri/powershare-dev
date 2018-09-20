<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SocialPlatform extends Model
{
    public const FACEBOOK = 1;
    public const TWITTER = 2;
    public const LINKEDIN = 3;
    public const OTHER = 4;

    protected static $stringRepresentation = [
        self::FACEBOOK => 'Facebook',
        self::TWITTER => 'Twitter',
        self::LINKEDIN => 'LinkedIn',
        self::OTHER => 'Other'
    ];

    public static function string(int $statusConst) {
        return self::$stringRepresentation[$statusConst];
    }
}
