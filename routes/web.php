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

Route::get('show_consultorio/{associado_id}',function ($associado_id) {
    $associado = App\Associado::where('id',$associado_id)->first();

    return view('associados.show_consultorio')->with('associado',$associado);
})->name('associados.show_consultorio')->middleware('auth');


Route::get('procurar','AssociadoController@procurar')->name('associados.procurar')->middleware('auth');

Route::get('busca/','AssociadoController@busca')->name('associados.busca')->middleware('auth');






Auth::routes();

//Associados
Route::put('associados/foto/{id}','AssociadoController@updateFoto');

Route::get('/home', 'HomeController@index')->name('home');

//Dependentes

Route::get('dependentes/pre_create/{associado_id}', function ($associado_id) {
    return view('dependentes.pre_create')->with('associado_id',$associado_id);
})->name('dependentes.pre_create')->middleware('auth');

Route::get('dependentes/pre_delete/{dependente_id}',function ($dependente_id){

    $dependente = App\Dependente::findOrFail($dependente_id);
    return view('dependentes.pre_delete')->with('dependente',$dependente);

})->name('dependentes.pre_delete')->middleware('auth');

Route::post('dependentes/delete/{dependente_id}','DependenteDeleteInfoController@excluir')->name('dependentes_info.excluir')->middleware('auth');
Route::get('dependentes/delete/info/{associado_id}',function ($associado_id){
        $dependentes = App\Dependente::with('dependente_delete_info')
            ->where('associado_id',$associado_id)
            ->where('status' ,'=','0')
            ->get();
        return view('dependentes_delete_info.index')->with('dependentes',$dependentes);
    }
)->name('dependente_info_delete.show')->middleware('auth');


Route::get('dependentes/{dependente}/create','DependenteController@create')->name('dependentes.create')->middleware('auth');
Route::post('dependentes','DependenteController@store')->name('dependentes.store')->middleware('auth');
Route::get('dependentes/{associado_id}/edit','DependenteController@edit')->name('dependentes.edit')->middleware('auth');
Route::put('dependentes/{dependente}','DependenteController@update')->name('dependentes.update')->middleware('auth');
Route::delete('dependentes/{dependente}','DependenteController@destroy')->name('dependentes.destroy')->middleware('auth');

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