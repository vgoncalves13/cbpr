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

Route::middleware(['auth', 'consultorio'])->group(function () {
    Route::resource('associados','AssociadoController');

    Route::get('associados/','AssociadoController@index')->name('associados.index');
    Route::get('/','AssociadoController@index')->name('associados.index');

});

Route::get('show_consultorio/{id}',function ($id) {
    $associado = \App\Associado::find($id)->first();

    return view('associados.show_consultorio')->with('associado',$associado);
})->name('associados.show_consultorio')->middleware('auth');


Route::get('procurar','AssociadoController@procurar')->name('associados.procurar')->middleware('auth');

Route::get('busca/','AssociadoController@busca')->name('associados.busca')->middleware('auth');






Auth::routes();

//Associados
Route::put('associados/foto/{id}','AssociadoController@updateFoto');

Route::get('/home', 'HomeController@index')->name('home');

//Dependentes
Route::get('dependentes/{id}','DependenteController@create')->name('dependentes.create')->middleware('auth');
Route::post('dependentes','DependenteController@store')->name('dependentes.store')->middleware('auth');

//Pagamentos
//Route::resource('pagamentos','PagamentoController')->middleware('auth');
Route::get('pagamentos/{pagamento}','PagamentoController@show')->name('pagamentos.show')->middleware('auth');
Route::get('pagamentos/create/{id}','PagamentoController@create')->name('pagamentos.create')->middleware('auth');
Route::get('pagamentos/edit/{id}','PagamentoController@edit')->name('pagamentos.edit')->middleware('auth');
Route::post('pagamentos/{id}','PagamentoController@store')->name('pagamentos.store')->middleware('auth');
Route::put('pagamentos/{pagamento}','PagamentoController@update')->name('pagamentos.update')->middleware('auth');

//Trocar senha

Route::get('/changePassword','HomeController@showChangePasswordForm');
Route::post('/changePassword','HomeController@changePassword')->name('changePassword');