<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Auth::routes(['verify' => true]);

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/search', [App\Http\Controllers\SearchController::class, 'index'])->name('search');
Route::post('/favorite/add', [App\Http\Controllers\FavoriteController::class, 'add'])->name('favorite.add');
Route::post('/favorite/remove', [App\Http\Controllers\FavoriteController::class, 'remove'])->name('favorite.remove');
