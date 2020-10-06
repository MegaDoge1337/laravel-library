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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'View\HomeController@index')->name('home');

Route::get('/books', 'View\BookController@list')->name('books.all')->middleware('auth');
Route::get('/books/create', 'View\BookController@create')->name('books.create')->middleware('auth');
Route::post('/books', 'View\BookController@store')->name('books.store')->middleware('auth');
Route::get('/books/{book_id}/edit', 'View\BookController@edit')->name('books.edit')->middleware('auth');
Route::get('/books/{book_id}', 'View\BookController@single')->name('books.single')->middleware('auth');
Route::delete('/books/{book_id}', 'View\BookController@delete')->name('books.delete')->middleware('auth');
Route::put('/books/{book_id}', 'View\BookController@update')->name('books.update')->middleware('auth');

Route::post('/contracts', 'View\ContractController@store')->name('contracts.store')->middleware('auth');
Route::get('/contracts', 'View\ContractController@list')->name('contracts.all')->middleware('auth');
Route::delete('/contracts/{contract_id}', 'View\ContractController@delete')->name('contracts.delete')->middleware('auth');

Route::get('/discounts', 'View\DiscountController@list')->name('discounts.all')->middleware('auth');
Route::get('/discounts/create', 'View\DiscountController@create')->name('discounts.create')->middleware('auth');
Route::post('/discounts', 'View\DiscountController@store')->name('discounts.store')->middleware('auth');
Route::get('/discounts/{discount_id}/edit', 'View\DiscountController@edit')->name('discounts.edit')->middleware('auth');
Route::delete('/discounts/{discount_id}', 'View\DiscountController@delete')->name('discounts.delete')->middleware('auth');
Route::put('/discounts/{discount_id}', 'View\DiscountController@update')->name('discounts.update')->middleware('auth');

Route::get('auth/{provider}', 'Auth\LoginController@redirectToProvider');
Route::get('auth/{provider}/callback', 'Auth\LoginController@handleProviderCallback');
