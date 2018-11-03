<?php

namespace App\Providers;

use App\Models\Campaign;
use App\Observers\CampaignObserver;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Intervention\Image\ImageManagerStatic;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        //FIXME: Do we still need this?
        // Configure Invention Image
        ImageManagerStatic::configure([
            'driver' => 'imagick'
        ]);

        Campaign::observe(CampaignObserver::class);

        Blade::component('public.partials.modal', 'modal');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
