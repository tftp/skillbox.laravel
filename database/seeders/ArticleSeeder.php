<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Tag;
use App\Models\User;
use Database\Factories\TagFactory;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Article::factory()
            ->count(5)
            ->create()
            ->each(function (Article $article) {
                $article->tags()->saveMany(Tag::factory()->count(2)->make());
            });

        Tag::factory()
            ->count(5)
            ->create();

        Article::factory()
            ->count(15)
            ->create()
            ->each( function (Article $article) {
               $article->tags()->saveMany(Tag::all()->random(2));
            });
    }
}
