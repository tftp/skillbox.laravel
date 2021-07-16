<?php

namespace App\Http\Controllers;

use App\Jobs\CompletedGeneralReport;
use App\Models\Article;
use App\Models\Comment;
use App\Models\News;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function generalReportGet()
    {
        return view('reports.general_report');
    }

    public function generalReportPost(Request $request)
    {
        $data = $request->except('_token');

        if (key_exists('newsCheck', $data)) {
            $data['newsCheck'] = 'Новостей ' . News::count();
        }

        if (key_exists('articlesCheck', $data)) {
            $data['articlesCheck'] = 'Статей ' . Article::count();
        }

        if (key_exists('commentsCheck', $data)) {
            $data['commentsCheck'] = 'Комментариев ' . Comment::count();
        }

        if (key_exists('tagsCheck', $data)) {
            $data['tagsCheck'] = 'Тэгов ' . Tag::count();
        }

        if (key_exists('usersCheck', $data)) {
            $data['usersCheck'] = 'Пользователей ' . User::count();
        }

        CompletedGeneralReport::dispatch($data);

        // А как сделать так, чтобы после запуска отчета выше, происходил редирект, который внизу с сообщением Успеха?
        // Пока что нижний редирект не выполняется
        redirect()->route('reports.general.get')->with('success', 'Данные сформированны');
    }
}
