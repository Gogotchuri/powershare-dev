<?php

namespace App\Listeners;

use App\Events\CampaignSubmittedEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

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
        //
    }
}
