<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/books', 'Api\BookController@getAllBooks')->name('books.all')->middleware('auth:api');
Route::get('/books/{book_id}', 'Api\BookController@getSingle')->name('books.single')->middleware('auth:api');
Route::post('/books', 'Api\BookController@createBook')->name('books.create')->middleware('auth:api');
Route::delete('/books/{book_id}', 'Api\BookController@deleteBook')->name('books.delete')->middleware('auth:api');
Route::put('/books/{book_id}', 'Api\BookController@updateBook')->name('books.update')->middleware('auth:api');

Route::get('/contracts', 'Api\ContractController@getAllContracts')->name('contracts.all')->middleware('auth:api');
Route::get('/contracts/{contract_id}', 'Api\ContractController@getContract')->name('contracts.single')->middleware('auth:api');
Route::post('/contracts', 'Api\ContractController@createContract')->name('contracts.create')->middleware('auth:api');
Route::delete('/contracts/{contract_id}', 'Api\ContractController@deleteContract')->name('contracts.delete')->middleware('auth:api');

Route::get('/discounts', 'Api\DiscountController@getAllDiscounts')->name('discounts.all')->middleware('auth:api');
Route::get('/discounts/{discount_id}', 'Api\DiscountController@getDiscount')->name('discounts.single')->middleware('auth:api');
Route::post('/discounts', 'Api\DiscountController@createDiscount')->name('discounts.create')->middleware('auth:api');
Route::delete('/discounts/{discount_id}', 'Api\DiscountController@deleteDiscount')->name('discounts.delete')->middleware('auth:api');
Route::put('/discounts/{discount_id}', 'Api\DiscountController@updateDiscount')->name('discounts.update')->middleware('auth:api');

Route::get('/wallet', 'Api\WalletController@getUserWallet')->middleware('auth:api');

Route::post('/login', 'Api\LoginController@login')->name('auth.login');
Route::post('/logout', 'Api\LoginController@logout')->name('auth.logout')->middleware('auth:api');
Route::post('/register', 'Api\RegisterController@register')->name('auth.register');
