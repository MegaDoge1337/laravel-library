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
Route::post('/books', 'Api\BookController@create')->name('books.create')->middleware('auth:api'); // FOR ADMIN
Route::delete('/books/{book_id}', 'Api\BookController@delete')->name('books.delete');

Route::get('/contracts', 'Api\ContractController@list')->name('contracts.all');
Route::get('/contracts/{contract_id}', 'Api\ContractController@single')->name('contracts.single');
Route::post('/contracts', 'Api\ContractController@create')->name('contracts.create');
Route::delete('/contracts/{contract_id}', 'Api\ContractController@delete')->name('contracts.delete');

Route::get('/discounts', 'Api\DiscountController@list')->name('discounts.all');
Route::get('/discounts/{discount_id}', 'Api\DiscountController@single')->name('discounts.single');
Route::post('/discounts', 'Api\DiscountController@create')->name('contracts.create');
Route::delete('/discounts/{discount_id}', 'Api\DiscountController@delete')->name('discounts.delete');
