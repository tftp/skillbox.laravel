<?php

namespace App\Providers;

use App\Listeners\SendArcticleCreatedNotification;
use App\Listeners\SendArcticleDeletedNotification;
use App\Listeners\SendArcticleUpdatedNotification;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use App\Services\PushallService;
use App\Services\TagsSynchronizer;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(TagsSynchronizer::class, function () {
            return new TagsSynchronizer();
        });

        $this->app->singleton(PushallService::class, function () {
            return new PushallService(config('pushall.uri') , config('pushall.id'), config('pushall.key'));
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

        Blade::if('admin', function () {
            if (auth()->user()) {
                return auth()->user()->isAdmin();
            }

            return false;
        });
    }
}
