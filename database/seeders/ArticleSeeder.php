<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Tag;
use App\Models\User;
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
            ->count(20)
            ->state( new Sequence(
                fn () => ['user_id' => User::all()->random()],
            ))
            ->create()
            ->each(function (Article $article) {
                $article->tags()->saveMany(Tag::all()->random(2));
            });
    }
}
