<?php

namespace App\Models\Reference;

use Illuminate\Database\Eloquent\Model;

class CampaignCategory extends Model
{
    public function getIconBase64Attribute()
    {
        return $this->icon !== null ? base64_encode($this->icon) : null;
    }
}
