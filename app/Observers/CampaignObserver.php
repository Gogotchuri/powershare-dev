<?php

namespace App\Observers;

use App\Events\CampaignDraftedEvent;
use App\Events\CampaignPublishedEvent;
use App\Events\CampaignSubmittedEvent;
use App\Models\Campaign;
use App\Models\Reference\CampaignStatus;
use Illuminate\Support\Facades\Log;

class CampaignObserver
{
    public function saved(Campaign $campaign)
    {
        if($campaign->getOriginal('status_id') != $campaign->status_id) {

            // Become draft
            if($campaign->is_draft) {
                event(new CampaignDraftedEvent($campaign));
            }

            // Become proposal
            if($campaign->is_proposal && $campaign->getOriginal('status_id') == CampaignStatus::DRAFT) {
                event(new CampaignSubmittedEvent($campaign));
            }

            // Become public
            if($campaign->is_approved) {
                event(new CampaignPublishedEvent($campaign));
            }
        }
    }
}
