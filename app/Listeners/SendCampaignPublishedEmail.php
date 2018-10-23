<?php

namespace App\Listeners;

use App\Events\CampaignPublished;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;

//TODO: Make this listener queued
class SendCampaignPublishedEmail
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
     * @param  CampaignPublished  $event
     * @return void
     */
    public function handle(CampaignPublished $event)
    {
        Log::info('Campaign published: ' . $event->campaign->name);
    }
}
