<?php

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


Route::resource('associados','AssociadoController')->middleware('auth');
Route::get('procurar','AssociadoController@procurar')->name('associados.procurar')->middleware('auth');
Route::get('associados/','AssociadoController@index')->name('associados.index')->middleware('auth');
Route::get('busca/','AssociadoController@busca')->name('associados.busca')->middleware('auth');
Route::get('/','AssociadoController@index')->name('associados.index')->middleware('auth');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
