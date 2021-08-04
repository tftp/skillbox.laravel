<?php


namespace App\Services;


use App\Models\Article;
use App\Models\Comment;
use App\Models\HistoryArticle;
use App\Models\News;
use App\Models\User;

class InformationCollector
{
    private $result;

    public function collect()
    {
        $this->countArticles();
        $this->countNews();
        $this->userWithMaxArticles();
        $this->shortArticle();
        $this->longArticle();
        $this->averageArticlesOfUsers();
        $this->maxHistoriesChangesArticle();
        $this->hasMaxCommentsOfArticle();

        return $this->result;
    }

    private function countArticles()
    {
        $articlesCount = cache()->tags(['articles'])->remember('collector_articles_count', 3600, function () {
            return Article::count();
        });

        $this->result[] = [
            'head' => 'Общее количество статей',
            'rows' => [
                [
                    'description' => 'Количество',
                    'value' => $articlesCount,
                ],
            ],
        ];
    }

    private function countNews()
    {
        $newsCount = cache()->tags(['news'])->remember('collector_news_count', 3600, function () {
            return News::count();
        });

        $this->result[] = [
            'head' => 'Общее количество новостей',
            'rows' => [
                [
                    'description' => 'Количество',
                    'value' => $newsCount,
                ],
            ],
        ];
    }

    private function userWithMaxArticles()
    {
        $authorMax = cache()->tags(['articles'])->remember('collector_author_articles_max', 3600, function () {
            return User::withCount('articles')->orderBy('articles_count', 'desc')->first()->name;
        });

        $this->result[] = [
            'head' => 'ФИО автора, у которого больше всего статей на сайте',
            'rows' => [
                [
                    'description' => 'ФИО автора',
                    'value' => $authorMax,
                ],
            ],
        ];
    }

    private function shortArticle()
    {
        $article = cache()->tags(['articles'])->remember('collector_article_short', 3600, function () {
            return Article::selectRaw('*, length(body) as length_body')->orderBy('length_body')->first();
        });

        $this->result[] = [
            'head' => 'Самая короткая статья.',
            'rows' => [
                [
                    'description' => 'Количество символов',
                    'value' => $article->lens_body,
                ],
                [
                    'description' => 'Путь',
                    'value' => route('articles.show', ['article' => $article]),
                ],
                [
                    'description' => 'Название статьи',
                    'value' => $article->title,
                ],
            ],
        ];
    }

    private function longArticle()
    {
        $article = cache()->tags(['articles'])->remember('collector_article_long', 3600, function () {
            return Article::selectRaw('*, length(body) as length_body')->orderByDesc('length_body')->first();
        });

        $this->result[] = [
            'head' => 'Самая длинная статья.',
            'rows' => [
                [
                    'description' => 'Количество символов',
                    'value' => $article->lens_body,
                ],
                [
                    'description' => 'Путь',
                    'value' => route('articles.show', ['article' => $article]),
                ],
                [
                    'description' => 'Название статьи',
                    'value' => $article->title,
                ],
            ],
        ];
    }

    private function averageArticlesOfUsers()
    {
        $usersCount = cache()->tags(['articles'])->remember('collector_users_count', 3600, function () {
            return User::has('articles')->count();
        });

        $articlesCount = cache()->tags(['articles'])->remember('collector_articles_count', 3600, function () {
            return Article::count();
        });

        $this->result[] = [
            'head' => 'Средние количество статей у активных пользователей.',
            'rows' => [
                [
                    'description' => 'Средние количество статей',
                    'value' => $articlesCount/$usersCount,
                ],
            ],
        ];
    }

    private function maxHistoriesChangesArticle()
    {
        $article = cache()->tags(['articles'])->remember('collector_article_max_changes_history', 3600, function () {
            return HistoryArticle::selectRaw('article_id, count(*) as count_articles')->groupBy('article_id')->orderByDesc('count_articles')->first()->article;
        });

        $this->result[] = [
            'head' => 'Самая непостоянная статья, которую меняли чаще всего',
            'rows' => [
                [
                    'description' => 'Путь',
                    'value' => route('articles.show', ['article' => $article]),
                ],
                [
                    'description' => 'Название статьи',
                    'value' => $article->title,
                ],
            ],
        ];
    }

    private function hasMaxCommentsOfArticle()
    {
        $article_id = cache()->tags(['comments', 'articles'])->remember('collector_article_id', 3600, function () {
            return Comment::where('commentable_type', Article::class)
                    ->selectRaw('commentable_id, count(*) as count_comments')
                    ->groupBy('commentable_id')
                    ->orderByDesc('count_comments')
                    ->first()
                    ->commentable_id;
        });

        $article = Article::findOrFail($article_id);

        $this->result[] = [
            'head' => 'Самая обсуждаемая статья',
            'rows' => [
                [
                    'description' => 'Путь',
                    'value' => route('articles.show', ['article' => $article]),
                ],
                [
                    'description' => 'Название статьи',
                    'value' => $article->title,
                ],
            ],
        ];
    }
}
