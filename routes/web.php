<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Video\ChannelController;
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

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/products', 'ProductsController@index');


Route::put('/cart/{product}', 'CartController@update');
Route::get('/cart', 'CartController@index');
Route::post('/orders', 'OrdersController@store');

// Budget transactions
Route::resource('/budget/transactions', 'Budget\TransactionsController', ['except'=>['show']]);
Route::get('/budget/transactions/{category?}', 'Budget\TransactionsController@index');

// categories
Route::resource('/budget/categories', 'Budget\CategoriesController', ['except'=>['show']]);

// budgets
Route::resource('/budget/budgets', 'Budget\BudgetsController');

// video
Route::resource('/video/channels', ChannelController::class);


Auth::routes();




// LIVEWIRE STUFF
//Route::get('/test', function() {
//    return view('test');
//});


Route::middleware('auth')->group(function(){
    Route::get('/video/channel/{channel}/edit', [ChannelController::class, 'edit'])->name('channel.edit');

});
