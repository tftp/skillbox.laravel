<?php

namespace App\Providers;

use App\Listeners\SendArcticleCreatedNotification;
use App\Listeners\SendArcticleDeletedNotification;
use App\Listeners\SendArcticleUpdatedNotification;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(App\Services\TagsSynchronizer::class, function () {
            return new App\Services\TagsSynchronizer();
        });

        $this->app->when([
            SendArcticleUpdatedNotification::class,
            SendArcticleCreatedNotification::class,
            SendArcticleDeletedNotification::class,
            ])
            ->needs('$adminEmail')
            ->giveConfig('mail.adminEmail');
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('layout.sidebar', function ($view) {
            $view->with('tagsCloud', \App\Models\Tag::has('articles')->get());
        });
    }
}
