<?php

use App\Http\Controllers\Budget\BudgetsController;
use App\Http\Controllers\Budget\CategoriesController;
use App\Http\Controllers\Budget\TransactionsController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\Video\ChannelController;
use Illuminate\Support\Facades\Route;

/* |-------------------------------------------------------------------------- | Web Routes |-------------------------------------------------------------------------- | | Here is where you can register web routes for your application. These | routes are loaded by the RouteServiceProvider within a group which | contains the "web" middleware group. Now create something great! | */

Route::get('/home', [HomeController::class , 'index'])->name('home');

Route::get('/products', [ProductsController::class, 'index']);


Route::put('/cart/{product}', [CartController::class, 'update']);
Route::get('/cart', [CartController::class, 'index']);
Route::post('/orders', [OrdersController::class, 'store']);

// Budget transactions
Route::resource('/budget/transactions', TransactionsController::class, ['except' => ['show']]);
Route::get('/budget/transactions/{category?}', [TransactionsController::class, 'index']);

// categories
Route::resource('/budget/categories', CategoriesController::class, ['except' => ['show']]);
Route::get('/budget/categories/{category?}', [CategoriesController::class, 'index']);
// budgets
Route::resource('/budget/budgets', BudgetsController::class);

// video
//Route::resource('/video/channels', ChannelController::class);
Route::resource('/video/channels', ChannelController::class);


Auth::routes();




// LIVEWIRE STUFF
//Route::get('/test', function() {
//    return view('test');
//});


Route::middleware('auth')->group(function () {    //    Route::get('/video/channel/{channel}/edit', [ChannelController::class, 'edit'])->name('channel.edit');
    Route::get('/video/{channel}/create', [\App\Http\Livewire\Video\CreateVideo::class , '__invoke'])->name('video.create');
    Route::get('/video/{channel}/{video}/edit', [\App\Http\Livewire\Video\EditVideo::class , '__invoke'])->name('video.edit');
    Route::get('/video/{channel}', [\App\Http\Livewire\Video\AllVideos::class , '__invoke'])->name('video.all');

});
