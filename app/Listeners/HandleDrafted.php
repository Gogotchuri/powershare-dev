<?php

namespace App\Listeners;

use App\Events\CampaignDraftedEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;

class HandleDrafted
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  CampaignDraftedEvent  $event
     * @return void
     */
    public function handle(CampaignDraftedEvent $event)
    {
        Log::info("Got drafted " . $event->campaign->name);
    }
}
