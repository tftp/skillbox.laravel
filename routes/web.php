<?php

use App\Http\Controllers\TagsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticlesController;
use App\Http\Controllers\ContactsController;

Route::get('/', [ArticlesController::class, 'index']);
Route::resource('/articles', ArticlesController::class)->except(['index']);
Route::get('/articles/tags/{tag}', [TagsController::class, 'index']);

Route::get('/about', function () {
    $title = 'О нас';
    return view('about', compact('title'));
});


Route::get('/admin/feedback', [ContactsController::class, 'index']);
Route::get('/contacts', [ContactsController::class, 'create']);
Route::post('/contacts', [ContactsController::class, 'store']);


