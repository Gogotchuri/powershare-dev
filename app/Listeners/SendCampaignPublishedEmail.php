<?php

namespace App\Listeners;

use App\Events\CampaignPublishedEvent;
use App\Mail\CampaignPublished;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

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
     * @param  CampaignPublishedEvent $event
     * @return void
     */
    public function handle(CampaignPublishedEvent $event)
    {
        if($event->campaign->author->notifications_on)
        {
            Mail::to($event->campaign->author)->queue(new CampaignPublished($event->campaign));
        }
    }
}
