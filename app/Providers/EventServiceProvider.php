<?php

namespace App\Providers;

use App\Events\CampaignPublishedEvent;
use App\Events\CampaignSubmittedEvent;
use App\Listeners\SendCampaignPublishedEmail;
use App\Listeners\SendCampaignSubmittedEmail;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],

        CampaignPublishedEvent::class => [
            SendCampaignPublishedEmail::class,
        ],

        CampaignSubmittedEvent::class => [
            SendCampaignSubmittedEmail::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
