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

Route::get('/books', 'View\BookController@getAllBooks')->name('books.all')->middleware('auth');
Route::get('/books/create', 'View\BookController@createBook')->name('books.create')->middleware('auth');
Route::post('/books', 'View\BookController@storeBook')->name('books.store')->middleware('auth');
Route::get('/books/{book_id}/edit', 'View\BookController@editBook')->name('books.edit')->middleware('auth');
Route::get('/books/{book_id}', 'View\BookController@getBook')->name('books.single')->middleware('auth');
Route::delete('/books/{book_id}', 'View\BookController@deleteBook')->name('books.delete')->middleware('auth');
Route::put('/books/{book_id}', 'View\BookController@updateBook')->name('books.update')->middleware('auth');

Route::post('/contracts', 'View\ContractController@storeContract')->name('contracts.store')->middleware('auth');
Route::get('/contracts', 'View\ContractController@getUserContracts')->name('contracts.all')->middleware('auth');
Route::delete('/contracts/{contract_id}', 'View\ContractController@deleteContract')->name('contracts.delete')->middleware('auth');

Route::get('/discounts', 'View\DiscountController@getAllDiscounts')->name('discounts.all')->middleware('auth');
Route::get('/discounts/create', 'View\DiscountController@createDiscount')->name('discounts.create')->middleware('auth');
Route::post('/discounts', 'View\DiscountController@storeDiscount')->name('discounts.store')->middleware('auth');
Route::get('/discounts/{discount_id}/edit', 'View\DiscountController@editDiscount')->name('discounts.edit')->middleware('auth');
Route::delete('/discounts/{discount_id}', 'View\DiscountController@deleteDiscount')->name('discounts.delete')->middleware('auth');
Route::put('/discounts/{discount_id}', 'View\DiscountController@updateDiscount')->name('discounts.update')->middleware('auth');

Route::get('/wallet', 'View\WalletController@getUserWallet')->name('wallet.user')->middleware('auth');
Route::post('/wallet', 'View\WalletController@makeUserPayment')->name('wallet.payment')->middleware('auth');

Route::get('auth/{provider}', 'Auth\LoginController@redirectToProvider');
Route::get('auth/{provider}/callback', 'Auth\LoginController@handleProviderCallback');

Route::get('/error', 'View\ErrorController@showErrorMessage')->name('error.show');

Route::fallback(function () {
    return redirect('/error')->with('error','404: Page not found');
});
