<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ChapterController;
use App\Http\Controllers\ComicController;
use App\Http\Controllers\IndexController;
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

// Route client
Route::get('/', [IndexController::class, 'index'])->name('index');
Route::get('/truyen-chu/{slug}', [IndexController::class, 'view_comic'])->name('view_comic');
Route::get('/doc-truyen/{slug}', [IndexController::class, 'read_comic'])->name('read_comic');
Route::get('/the-loai/{slug}', [IndexController::class, 'category'])->name('category');
Route::get('/tag/{tag}', [IndexController::class, 'tag'])->name('tag');
Route::get('/sach-doc', [IndexController::class, 'view_book'])->name('book');
Route::post('/doc-sach-pdf', [IndexController::class, 'fast_view'])->name('fast_view');

Route::post('/tim-kiem', [IndexController::class, 'search'])->name('search');
Route::post('/search_ajax', [IndexController::class, 'search_ajax'])->name('search_ajax');


// route auth dang nhap
Auth::routes([
    'register' => false
]);

// Route admin
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::resource('/category', CategoryController::class);
    Route::resource('/comic', ComicController::class);
    Route::resource('/chapter', ChapterController::class);
    Route::resource('/book', BookController::class);
});
