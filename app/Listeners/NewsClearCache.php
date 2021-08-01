<?php

namespace App\Listeners;

use App\Events\NewsChanged;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Cache;

class NewsClearCache
{
    public function handle(NewsChanged $event)
    {
        Cache::tags(['news'])->flush();
    }
}
