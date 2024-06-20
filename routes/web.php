<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ObjectEntityController;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/search', [SearchController::class, 'index'])->name('search');


Route::prefix('objects')->group(function () {

    Route::get('/add', [ObjectEntityController::class, 'add'])->name('objects.add');
    Route::post('/{objectId}/remove', [ObjectEntityController::class, 'remove'])->name('objects.remove');
    Route::get('/{objectId}', [ObjectEntityController::class, 'single'])->name('objects.single');
    Route::get('/{categoryId}', [ObjectEntityController::class, 'index'])->name('objects');
});


Route::prefix('favorites')->middleware('auth')->group(function () {
    Route::get('/', [App\Http\Controllers\FavoriteController::class, 'add'])->name('favorites');
    Route::post('/add', [App\Http\Controllers\FavoriteController::class, 'add'])->name('favorites.add');
    Route::post('/remove', [App\Http\Controllers\FavoriteController::class, 'remove'])->name('favorites.remove');
});
