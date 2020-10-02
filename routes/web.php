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

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/books', 'BookController@list')->name('books.all')->middleware('auth');
Route::get('/books/create', 'BookController@create')->name('books.create')->middleware('auth');
Route::post('/books', 'BookController@store')->name('books.store')->middleware('auth');
Route::get('/books/{book_id}/edit', 'BookController@edit')->name('books.edit')->middleware('auth');
Route::get('/books/{book_id}', 'BookController@single')->name('books.single')->middleware('auth');
Route::delete('/books/{book_id}', 'BookController@delete')->name('books.delete')->middleware('auth');
Route::put('/books/{book_id}', 'BookController@update')->name('books.update')->middleware('auth');

Route::post('/contracts', 'ContractController@store')->name('contracts.store')->middleware('auth');
Route::get('/contracts', 'ContractController@list')->name('contracts.all')->middleware('auth');
Route::delete('/contracts/{contract_id}', 'ContractController@delete')->name('contracts.delete')->middleware('auth');
