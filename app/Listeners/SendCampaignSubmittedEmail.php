<?php

namespace App\Listeners;

use App\Events\CampaignSubmittedEvent;
use App\Mail\CampaignSubmitted;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendCampaignSubmittedEmail
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
     * @param  CampaignSubmittedEvent  $event
     * @return void
     */
    public function handle(CampaignSubmittedEvent $event)
    {
        if($event->campaign->author->notifications_on) {
            Mail::to($event->campaign->author)->queue(new CampaignSubmitted($event->campaign));
        }
    }
}
