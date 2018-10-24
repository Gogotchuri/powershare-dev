<?php

namespace App\Observers;

use App\Events\CampaignDraftedEvent;
use App\Events\CampaignPublishedEvent;
use App\Events\CampaignSubmittedEvent;
use App\Models\Campaign;
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
            if($campaign->is_proposal) {
                event(new CampaignSubmittedEvent($campaign));
            }

            // Become public
            if($campaign->is_approved) {
                Log::info('Publishing event');
                event(new CampaignPublishedEvent($campaign));
            }

            // TODO: Add events like CampaignDisapproved
        }
    }
}
