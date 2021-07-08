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
        $this->result[] = [
            'head' => 'Общее количество статей',
            'rows' => [
                [
                    'description' => 'Количество',
                    'value' => Article::count(),
                ],
            ],
        ];
    }

    private function countNews()
    {
        $this->result[] = [
            'head' => 'Общее количество новостей',
            'rows' => [
                [
                    'description' => 'Количество',
                    'value' => News::count(),
                ],
            ],
        ];
    }

    private function userWithMaxArticles()
    {
        $this->result[] = [
            'head' => 'ФИО автора, у которого больше всего статей на сайте',
            'rows' => [
                [
                    'description' => 'ФИО автора',
                    'value' => User::withCount('articles')->orderBy('articles_count', 'desc')->first()->name,
                ],
            ],
        ];
    }

    private function shortArticle()
    {
        $article = Article::selectRaw('*, length(body) as length_body')->orderBy('length_body')->first();

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
        $article = Article::selectRaw('*, length(body) as length_body')->orderByDesc('length_body')->first();

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
        $usersCount = User::has('articles')->count();
        $articlesCount = Article::count();

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
        $article = HistoryArticle::selectRaw('article_id, count(*) as count_articles')->groupBy('article_id')->orderByDesc('count_articles')->first()->article;

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
        $article_id = Comment::where('commentable_type', Article::class)
            ->selectRaw('commentable_id, count(*) as count_comments')
            ->groupBy('commentable_id')
            ->orderByDesc('count_comments')
            ->first()
            ->commentable_id;

        $article = Article::find($article_id);

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
