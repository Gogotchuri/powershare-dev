<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    public static const DRAFT = 'DRAFT';
    public static const PROPOSAL = 'PROPOSAL';
    public static const APPROVED = 'APPROVED';

    public static function statuses() {
        return [
            self::DRAFT,
            self::PROPOSAL,
            self::APPROVED,
        ];
    }

    public function video() {
        return $this->hasOne(Video::class);
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
}
