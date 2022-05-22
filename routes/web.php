<?php

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



Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
