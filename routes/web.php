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

Route::middleware('auth')->group(function (){
    Route::resources([
        'medicos' => 'MedicoController',
        'especialidades' => 'EspecialidadeController'
    ]);
});

Route::get('show_consultorio/{associado_id}',function ($associado_id) {
    $associado = App\Associado::where('id',$associado_id)->first();
    //Mostra os dependentes do associado_id com status 1 = ativo
    $dependentes = App\Dependente::where([['associado_id',$associado_id],['status',1]])->get();

    return view('associados.show_consultorio')->with(compact('associado','dependentes'));
})->name('associados.show_consultorio')->middleware('auth');


Route::get('procurar','AssociadoController@procurar')->name('associados.procurar')->middleware('auth');
Route::get('busca/','AssociadoController@busca')->name('associados.busca')->middleware('auth');
Route::get('exportar_csv','AssociadoController@exportarCsv')->name('exportar_csv')->middleware('auth');



Auth::routes();

//Associados
Route::put('associados/foto/{id}','AssociadoController@updateFoto');
//Rota para ajax da tabela index
Route::get('/associadosData','AssociadoController@associadosData')->name('associados.datatables.data');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('link/associados/{id}','AssociadoController@link')->name('associados.link');
Route::post('link/associados/','AssociadoController@link_save')->name('associados.link_save');
//Rota responsável pelo ajax do select2
Route::get('/associados/load/select2', 'AssociadoController@associado_load_select2');

Route::get('/lista_associados/',function(){
    //$associados = App\Associado::orderBy('nome_completo')->paginate(10);

    return view('associados.resultado_busca');
})->name('associados.lista')->middleware('auth');
Route::get('/criar-username-legado','AssociadoController@CriacaoUsuariosLegado')->name('criar.username.legado');

//Dependentes
Route::get('/dependentesData','DependenteController@dependentesData')->name('dependentes.datatables.data');
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
Route::get('dependentes','DependenteController@index')->name('dependentes.index')->middleware('auth');

//Pagamentos
//Route::resource('pagamentos','PagamentoController')->middleware('auth');
Route::get('pagamentos/{pagamento}','PagamentoController@show')->name('pagamentos.show')->middleware('auth');
Route::get('pagamentos/create/{id}','PagamentoController@create')->name('pagamentos.create')->middleware('auth');
Route::get('pagamentos/edit/{id}','PagamentoController@edit')->name('pagamentos.edit')->middleware('auth');
Route::post('pagamentos/{id}','PagamentoController@store')->name('pagamentos.store')->middleware('auth');
Route::put('pagamentos/{pagamento}','PagamentoController@update')->name('pagamentos.update')->middleware('auth');
Route::delete('pagamentos/destroy/{id}','PagamentoController@destroy')->name('pagamentos.destroy')->middleware('auth');

//Trocar senha

Route::get('/changePassword','HomeController@showChangePasswordForm');
Route::post('/changePassword','HomeController@changePassword')->name('changePassword');

//Marcação
Route::get('/marcacoes','MarcacaoController@index')->name('marcacao.index');
Route::get('/marcacoes/especialidade/{associado_id?}','MarcacaoController@especialidade')->name('marcacao.especialidade');
Route::get('/marcacoes/medico/','MarcacaoController@medico')->name('marcacao.medico');
Route::get('/marcacoes/dias/{medico_id}/{especialidade_id}','MarcacaoController@dias')
    ->name('marcacao.dias');
Route::get('/marcacoes/horarios/{data}','MarcacaoController@horarios')->name('marcacao.horarios');
Route::get('/marcacoes/paciente/}','MarcacaoController@paciente')->name('marcacao.paciente');
Route::post('/marcacoes/','MarcacaoController@store')->name('marcacao.store');