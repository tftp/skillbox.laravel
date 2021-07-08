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
        $this->result['Общее количество статей'] = [
                'Количество' => Article::count(),
        ];
    }

    private function countNews()
    {
        $this->result['Общее количество новостей'] = [
                'Количество' => News::count(),
        ];
    }

    private function userWithMaxArticles()
    {
        $this->result['ФИО автора, у которого больше всего статей на сайте'] = [
                'ФИО автора' => User::withCount('articles')->orderBy('articles_count', 'desc')->first()->name,
        ];
    }

    private function shortArticle()
    {
        $article = Article::selectRaw('*, length(body) as length_body')->orderBy('length_body')->first();

        $this->result['Самая короткая статья.'] = [
                'Количество символов' => $article->lens_body,
                'Путь' => route('articles.show', ['article' => $article]),
                'Название статьи' => $article->title,
        ];
    }

    private function longArticle()
    {
        $article = Article::selectRaw('*, length(body) as length_body')->orderByDesc('length_body')->first();

        $this->result['Самая длинная статья.'] = [
            'Количество символов' => $article->lens_body,
            'Путь' => route('articles.show', ['article' => $article]),
            'Название статьи' => $article->title,
        ];
    }

    private function averageArticlesOfUsers()
    {
        $usersCount = User::has('articles')->count();
        $articlesCount = Article::count();

        $this->result['Средние количество статей у активных пользователей.'] = [
            'Средние количество статей' => $articlesCount/$usersCount,
        ];
    }

    private function maxHistoriesChangesArticle()
    {
        $article = HistoryArticle::selectRaw('article_id, count(*) as count_articles')->groupBy('article_id')->orderByDesc('count_articles')->first()->article;

        $this->result['Самая непостоянная статья, которую меняли чаще всего'] = [
            'Путь' => route('articles.show', ['article' => $article]),
            'Название статьи' => $article->title,
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

        $this->result['Самая обсуждаемая статья'] = [
            'Путь' => route('articles.show', ['article' => $article]),
            'Название статьи' => $article->title,
        ];
    }
}
