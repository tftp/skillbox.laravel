<?php

use App\Http\Controllers\TagsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticlesController;
use App\Http\Controllers\ContactsController;

Route::get('/', [ArticlesController::class, 'index']);
Route::resource('/articles', ArticlesController::class)->except(['index']);
Route::get('/articles/tags/{tag}', [TagsController::class, 'index'])->name('articles.tags');

Route::get('/about', function () {
    $title = 'О нас';
    return view('about', compact('title'));
});

Route::get('/admin/feedback', [ContactsController::class, 'index'])->middleware('auth');
Route::get('/contacts', [ContactsController::class, 'create']);
Route::post('/contacts', [ContactsController::class, 'store']);
Route::get('/owner/articles', [\App\Http\Controllers\ArticlesOwnerController::class, 'index']);
Route::get('/admin/articles', [\App\Http\Controllers\ArticlesAdminController::class, 'index']);
Route::get('/admin/articles/{article}/edit', [\App\Http\Controllers\ArticlesController::class, 'edit'])->name('admin.articles.edit');

Auth::routes();
