<?php


namespace App\Services;


use App\Models\Article;
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
        $article = Article::all()->each->append('histories_count')->sortBy('histories_count')->last();

        $this->result['Самая непостоянная статья, которую меняли чаще всего'] = [
            'Путь' => route('articles.show', ['article' => $article]),
            'Название статьи' => $article->title,
        ];
    }

    private function hasMaxCommentsOfArticle()
    {
        $article = Article::all()->each->append('comments_count')->sortBy('comments_count')->last();

        $this->result['Самая обсуждаемая статья'] = [
            'Путь' => route('articles.show', ['article' => $article]),
            'Название статьи' => $article->title,
        ];
    }
}
