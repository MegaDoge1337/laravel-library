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

Route::get('/books', 'Api\BookController@list')->name('books.all')->middleware('auth:api');
Route::get('/books/{book_id}', 'Api\BookController@single')->name('books.single')->middleware('auth:api');
Route::post('/books', 'Api\BookController@create')->name('books.create')->middleware('auth:api');
Route::delete('/books/{book_id}', 'Api\BookController@delete')->name('books.delete')->middleware('auth:api');
Route::put('/books/{book_id}', 'Api\BookController@update')->name('books.update')->middleware('auth:api');

Route::get('/contracts', 'Api\ContractController@list')->name('contracts.all')->middleware('auth:api');
Route::get('/contracts/{contract_id}', 'Api\ContractController@single')->name('contracts.single')->middleware('auth:api');
Route::post('/contracts', 'Api\ContractController@create')->name('contracts.create')->middleware('auth:api');
Route::delete('/contracts/{contract_id}', 'Api\ContractController@delete')->name('contracts.delete')->middleware('auth:api');
Route::put('/contracts/{contract_id}', 'Api\ContractController@update')->name('contracts.update')->middleware('auth:api');

Route::get('/discounts', 'Api\DiscountController@list')->name('discounts.all')->middleware('auth:api');
Route::get('/discounts/{discount_id}', 'Api\DiscountController@single')->name('discounts.single')->middleware('auth:api');
Route::post('/discounts', 'Api\DiscountController@create')->name('discounts.create')->middleware('auth:api');
Route::delete('/discounts/{discount_id}', 'Api\DiscountController@delete')->name('discounts.delete')->middleware('auth:api');
Route::put('/discounts/{discount_id}', 'Api\DiscountController@update')->name('discounts.update')->middleware('auth:api');

Route::post('/login', 'Api\LoginController@login')->name('auth.login');
Route::post('/logout', 'Api\LoginController@logout')->name('auth.logout')->middleware('auth:api');
Route::post('/register', 'Api\RegisterController@register')->name('auth.register');
