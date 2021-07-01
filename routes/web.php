<?php

use App\Http\Controllers\TagsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticlesController;
use App\Http\Controllers\ContactsController;

Route::get('/', [ArticlesController::class, 'index'])->name('home');
Route::resource('/articles', ArticlesController::class)->except(['index']);
Route::get('/articles/tags/{tag}', [TagsController::class, 'index'])->name('articles.tags');
Route::get('/news/tags/{tag}', [TagsController::class, 'index'])->name('news.tags');

Route::resource('/news', \App\Http\Controllers\NewsController::class);

Route::get('/about', function () {
    $title = 'О нас';
    return view('about', compact('title'));
})->name('about');

Route::get('/admin/feedback', [ContactsController::class, 'index'])->name('admin.feedback')->middleware('adminPrivileges');
Route::get('/contacts', [ContactsController::class, 'create'])->name('contacts.create');
Route::post('/contacts', [ContactsController::class, 'store'])->name('contacts.store');
Route::get('/owner/articles', [\App\Http\Controllers\ArticlesOwnerController::class, 'index'])->name('owner.articles');
Route::get('/admin/articles', [\App\Http\Controllers\ArticlesAdminController::class, 'index'])->name('admin.articles');
Route::get('/admin/articles/{article}/edit', [\App\Http\Controllers\ArticlesController::class, 'edit'])->name('admin.articles.edit');
Route::get('/admin/articles/{article}/history', [\App\Http\Controllers\ArticlesController::class, 'history'])->name('admin.articles.history')->middleware('adminPrivileges');

Route::post('/articles/{article}/comments', [\App\Http\Controllers\CommentsController::class, 'storeArticlesComment'])->name('comments.store_articles_comment');
Route::post('/news/{news}/comments', [\App\Http\Controllers\CommentsController::class, 'storeNewsComment'])->name('comments.store_news_comment');

Auth::routes();
