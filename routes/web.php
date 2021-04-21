<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticlesController;
use App\Http\Controllers\ContactsController;

Route::get('/', [ArticlesController::class, 'index']);

Route::get('/about', function () {
    $title = 'О нас';
    return view('about', compact('title'));
});

Route::get('/articles/create', [ArticlesController::class, 'create']);
Route::get('/articles/{article}', [ArticlesController::class, 'show']);

Route::post('/', [ArticlesController::class, 'store']);

Route::get('/admin/feedback', [ContactsController::class, 'index']);
Route::get('/contacts', [ContactsController::class, 'create']);
Route::post('/contacts', [ContactsController::class, 'store']);


