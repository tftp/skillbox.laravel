<?php

namespace Database\Seeders;

use App\Models\Image;
use App\Models\News;
use Illuminate\Database\Seeder;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        News::factory()
            ->count(20)
            ->create()
            ->each(function (News $newsItem) {
                $newsItem->image()->save(Image::factory()->make());
            });
    }
}
