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

Route::middleware(['auth', 'consultorio','inadimplente'])->group(function () {

    Route::resources([
        'medicos' => 'MedicoController',
        'especialidades' => 'EspecialidadeController',
        'agendas' => 'AgendaController',
        'associados' => 'AssociadoController'
    ]);

    Route::get('associados/','AssociadoController@index')->name('associados.index');
    Route::get('/','AssociadoController@index')->name('associados.index');

    //Marcação
    Route::delete('/marcacoes/{marcacao}/destroy','MarcacaoController@destroy')->name('marcacao.destroy');
    Route::get('/marcacoes/show/{marcacao}/','MarcacaoController@show')->name('marcacao.show');
    Route::get('/marcacoes','MarcacaoController@index')->name('marcacao.index');
    Route::get('/marcacoes/especialidade/{associado_id?}','MarcacaoController@especialidade')->name('marcacao.especialidade');
    Route::get('/marcacoes/medico/','MarcacaoController@medico')->name('marcacao.medico');
    Route::get('/marcacoes/dias/{medico_id}/{especialidade_id}','MarcacaoController@dias')
        ->name('marcacao.dias');
    Route::get('/marcacoes/horarios/{data}','MarcacaoController@horarios')->name('marcacao.horarios');
    Route::get('/marcacoes/paciente/}','MarcacaoController@paciente')->name('marcacao.paciente');
    Route::post('/marcacoes/','MarcacaoController@store')->name('marcacao.store');
    //Download PDF
    Route::post('marcacoes/download/pdf/{download}', 'MarcacaoController@download_pdf')->name('marcacao.download_pdf');

    Route::get('show_consultorio/{associado_id}',function ($associado_id) {
        $associado = App\Associado::where('id',$associado_id)->first();
        //Mostra os dependentes do associado_id com status 1 = ativo
        $dependentes = App\Dependente::where([['associado_id',$associado_id],['status',1]])->get();

        return view('associados.show_consultorio')->with(compact('associado','dependentes'));
    })->name('associados.show_consultorio');


    Route::get('procurar','AssociadoController@procurar')->name('associados.procurar');
    Route::get('busca/','AssociadoController@busca')->name('associados.busca');
    Route::get('exportar_csv','AssociadoController@exportarCsv')->name('exportar_csv');



//Associados
Route::put('associados/foto/{id}','AssociadoController@updateFoto');
Route::patch('associados/cpf/{associado_id}','AssociadoController@updateCpf')->name('associados.updateCpf');

//Rota para ajax da tabela index
Route::get('/associadosData','AssociadoController@associadosData')->name('associados.datatables.data');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('link/associados/{id}','AssociadoController@link')->name('associados.link');
Route::post('link/associados/','AssociadoController@link_save')->name('associados.link_save');
Route::delete('/link/{associado}/destroy','AssociadoController@destroy_link')->name('associados.destroy_link');
//Rota responsável pelo ajax do select2
Route::get('/associados/load/select2', 'AssociadoController@associado_load_select2');

Route::get('/lista_associados/',function(){
    //$associados = App\Associado::orderBy('nome_completo')->paginate(10);

    return view('associados.resultado_busca');
})->name('associados.lista')->middleware('auth');
//Route::get('/criar-username-legado','AssociadoController@CriacaoUsuariosLegado')->name('criar.username.legado');
Route::put('associados/{associado_id}/updateCellphone','AssociadoController@updateCellphone')->name('associados.update_cellphone');

//Dependentes
Route::get('/dependentesData','DependenteController@dependentesData')->name('dependentes.datatables.data');
Route::get('dependentes/pre_create/{associado_id}', function ($associado_id) {
    return view('dependentes.pre_create')->with('associado_id',$associado_id);
})->name('dependentes.pre_create');

Route::get('dependentes/pre_delete/{dependente_id}',function ($dependente_id){

    $dependente = App\Dependente::findOrFail($dependente_id);
    return view('dependentes.pre_delete')->with('dependente',$dependente);

})->name('dependentes.pre_delete');

Route::post('dependentes/delete/{dependente_id}','DependenteDeleteInfoController@excluir')->name('dependentes_info.excluir');
Route::get('dependentes/restaurar/{dependente_id}','DependenteDeleteInfoController@restaurar')->name('dependentes_info.restaurar');
Route::get('dependentes/delete/info/{associado_id}',function ($associado_id){
        $dependentes = App\Dependente::with('dependente_delete_info')
            ->where('associado_id',$associado_id)
            ->where('status' ,'=','0')
            ->get();
        return view('dependentes_delete_info.index')->with('dependentes',$dependentes);
    }
)->name('dependente_info_delete.show');


Route::get('dependentes/{dependente}/create','DependenteController@create')->name('dependentes.create');
Route::post('dependentes','DependenteController@store')->name('dependentes.store');
Route::get('dependentes/{associado_id}/edit','DependenteController@edit')->name('dependentes.edit');
Route::put('dependentes/{dependente}','DependenteController@update')->name('dependentes.update');
Route::delete('dependentes/{dependente}','DependenteController@destroy')->name('dependentes.destroy');
Route::get('dependentes','DependenteController@index')->name('dependentes.index');

//Pagamentos
Route::get('pagamentos/{pagamento}','PagamentoController@show')->name('pagamentos.show');
Route::get('pagamentos/create/{id}','PagamentoController@create')->name('pagamentos.create');
Route::get('pagamentos/edit/{id}','PagamentoController@edit')->name('pagamentos.edit');
Route::post('pagamentos/{id}','PagamentoController@store')->name('pagamentos.store');
Route::put('pagamentos/{pagamento}','PagamentoController@update')->name('pagamentos.update');
Route::delete('pagamentos/destroy/{id}','PagamentoController@destroy')->name('pagamentos.destroy');

//Trocar senha


Route::post('/changePassword','HomeController@changePassword')->name('changePassword');




//Agendas
Route::post('/agendas/{agenda}','AgendaController@store')->name('agendas.store');

//Auto cadastro
Route::get('auto_cadastro','AutoAssociadoController@index')->name('auto_cadastro.index');
Route::get('auto_cadastro/show/{associado_id}','AutoAssociadoController@show')->name('auto_cadastro.show');
Route::get('auto_cadastro/{associado_id}/approve','AutoAssociadoController@approve')->name('auto_cadastro.approve');
Route::delete('auto_cadastro/{associado_id}/destroy','AutoAssociadoController@destroy')->name('auto_cadastro.destroy');
});
//Auth


Route::get('/changePassword','HomeController@showChangePasswordForm')->middleware('auth');

Route::get('/regularizar_situacao/','AssociadoController@regularizar_situacao')
    ->name('associado.regularizar_situacao')
    ->middleware('auth');

Auth::routes();

//Login Marcar consulta
Route::get('agendar_consulta', 'MarcacaoController@login')->name('marcacao.login');

//Auto cadastro associado
Route::post('auto_cadastro/store','AutoAssociadoController@store')->name('auto_cadastro.store');
Route::get('auto_cadastro/create','AutoAssociadoController@create')->name('auto_cadastro.create');
