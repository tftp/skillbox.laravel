<?php

namespace App\Providers;

use App\Listeners\SendArcticleCreatedNotification;
use App\Listeners\SendArcticleDeletedNotification;
use App\Listeners\SendArcticleUpdatedNotification;
use App\Services\InformationCollector;
use Illuminate\Pagination\Paginator;
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

        $this->app->singleton(InformationCollector::class, function () {
            return new InformationCollector();
        });

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('layout.sidebar', function ($view) {
            $view->with([
                'articleTagsCloud' => \App\Models\Tag::has('articles')->get(),
                'newsTagsCloud' => \App\Models\Tag::has('news')->get(),
            ]);
        });

        Blade::if('admin', function () {
            if (auth()->user()) {
                return auth()->user()->isAdmin();
            }

            return false;
        });

        Paginator::useBootstrap();
    }
}
