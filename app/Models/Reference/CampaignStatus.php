<?php

namespace App\Models\Reference;

use Illuminate\Database\Eloquent\Model;

class CampaignStatus extends Model
{
    public const DRAFT = 3;
    public const PROPOSAL = 2;
    public const APPROVED = 1;

    protected static $stringRepresentation = [
        self::DRAFT => 'Draft',
        self::PROPOSAL => 'Proposal',
        self::APPROVED => 'Approved'
    ];

    public static function string(int $statusConst) {
        return self::$stringRepresentation[$statusConst];
    }
}
