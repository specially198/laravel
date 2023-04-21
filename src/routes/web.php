<?php

use App\Http\Controllers\BooksController;
use App\Http\Controllers\ReadingHistoriesController;
use App\Http\Controllers\ShopsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\ProfileController as ProfileOfAdminController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // books
    //Route::resource('books', BooksController::class);
    Route::controller(BooksController::class)->name('books.')->group(function() {
        Route::get('books', 'index')->name('index');
        Route::get('books/create', 'create')->name('create');
        Route::post('books', 'store')->name('store');
        Route::get('books/{book}', 'show')->name('show');
        Route::get('books/{book}/edit', 'edit')->name('edit');
        Route::put('books/{book}', 'update')->name('update');
        Route::delete('books/{book}', 'destroy')->name('destroy');
        Route::get('books/download/{book}', 'download')->name('download');
    });

    // reading_histories
    Route::controller(ReadingHistoriesController::class)->name('reading_histories.')->group(function() {
        Route::get('books/{book}/reading-histories/create', 'create')->name('create');
        Route::post('books/{book}/reading-histories', 'store')->name('store');
        Route::get('books/{book}/reading-histories/{reading_history}', 'show')->scopeBindings()->name('show');
        Route::get('books/{book}/reading-histories/{reading_history}/edit', 'edit')->scopeBindings()->name('edit');
        Route::put('books/{book}/reading-histories/{reading_history}', 'update')->name('update');
        Route::delete('books/{book}/reading-histories/{reading_history}', 'destroy')->scopeBindings()->name('destroy');
    });

    // shops
    Route::controller(ShopsController::class)->name('shops.')->group(function() {
        Route::get('shops', 'index')->name('index');
        Route::get('shops/create', 'create')->name('create');
        Route::post('shops/confirm', 'confirm')->name('confirm');
        Route::post('shops/complete', 'store')->name('store');
        Route::get('shops/{shop}', 'show')->name('show');
        Route::get('shops/{shop}/edit', 'edit')->name('edit');
        Route::post('shops/{shop}/edit-confirm', 'updateConfirm')->name('update_confirm');
        Route::put('shops/{shop}/edit-complete', 'update')->name('update');
        Route::delete('shops/{shop}', 'destroy')->name('destroy');
    });
});

require __DIR__.'/auth.php';

Route::prefix('admin')->name('admin.')->group(function(){
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->middleware(['auth:admin', 'verified'])->name('dashboard');

    Route::middleware('auth:admin')->group(function () {
        Route::get('/profile', [ProfileOfAdminController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileOfAdminController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileOfAdminController::class, 'destroy'])->name('profile.destroy');
    });

    require __DIR__.'/admin.php';
});
