<?php

namespace App\Http\Controllers;

use App\Dependente;
use App\Http\Requests\StoreDependenteRequest;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
use Yajra\DataTables\Facades\DataTables;

class DependenteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dependentes.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     *
     */
    public function create(Request $request,$associado_id)
    {
        //dd($associado_id);
        $quantidade_dependentes = $request->input('quantidade_dependentes');
        return view('dependentes.create')->with(compact('associado_id','quantidade_dependentes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDependenteRequest $request)
    {
        $input = $request->all();

        $dependente_nascimento_carbon = [];
        if (is_array($input['dependentes']['data_nascimento'])) {
            $dependente_nascimento = $input['dependentes']['data_nascimento'];
            foreach (array_filter($dependente_nascimento) as $data => $value) {
                $data = Carbon::now()
                    ->createFromFormat('d/m/Y', $value)
                    ->toDateString();
                $dependente_nascimento_carbon[] = $data;
            }
        }

        $tamanho_array = count(array_filter($request['dependentes']['nome_completo']));
        for ($i = 0; $i < $tamanho_array; $i++) {
            $dependente = new Dependente();
            $dependente->associado_id = $request->associado_id;
            $dependente->nome_completo = $input['dependentes']['nome_completo'][$i];
            $dependente->cpf = $input['dependentes']['cpf'][$i];
            $dependente->grau_parentesco = $input['dependentes']['grau_parentesco'][$i];
            $dependente->data_nascimento = $dependente_nascimento_carbon[$i];
            $dependente->save();
        }
        return redirect()->route('associados.show', ['id' => $request->associado_id])->with(
            'message', 'Dependentes cadastrado com sucesso.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Dependente  $dependente
     * @return \Illuminate\Http\Response
     */
    public function show(Dependente $dependente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Dependente  $dependente
     * @return \Illuminate\Http\Response
     */
    public function edit($dependente_id)
    {
        $dependente = Dependente::with('associado')->where('id','=',$dependente_id)->first();
        return view('dependentes.edit')->with('dependente',$dependente);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Dependente  $dependente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $dependente = Dependente::findOrFail($id);

        $data_nascimento = Carbon::now()
            ->createFromFormat('d/m/Y', $request->input('data_nascimento'))
            ->toDateString();

        $dependente->update(
            [
                'nome_completo' => $request->input('nome_completo'),
                'cpf' => $request->input('cpf'),
                'grau_parentesco' => $request->input('grau_parentesco'),
                'data_nascimento' => $data_nascimento,
            ]
        );

        if ($dependente) {

            return Redirect::back()->with('message', 'Dependente atualizado com sucesso.');
        }
        return Redirect::back()->withErrors(['message', 'Erro ao atualizar']);
    }


    /**
     * Retorna página com campos para serem informados o motivo da deleção do usuários
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function pre_delete($id)
    {
    }

    public function info_delete($id)
    {
        Session::flash('message', 'Dependente removido com sucesso!');
        return url(back());
    }


    /**
     * Deleta o dependente informado
     *
     * @param $id
     * @return bool
     */
    public function destroy($id)
    {
        $depentende = Dependente::find($id);
        if ($depentende->delete()) {
            return true;
        }else {
            return false;
        }
    }

    public function dependentesData()
    {
        $dependente = Dependente::with('associado');

        return DataTables::eloquent($dependente)
            ->addColumn('action', function ($dependente) {
                return '
                <a href="associados/'.$dependente->associado_id.'" class="btn btn-xs btn-flat btn-primary"><i class="fa fa-eye"></i> Exibir</a>
                        ';
            })
            ->addColumn('associado_nome_completo', function ($dependente) {
                return $dependente->associado->nome_completo;
            })
            ->addColumn('associado_status',function ($dependente) {
                if ($dependente->associado->status == 1){
                    return 'ADIMPLENTE';
                }else{
                    return 'INADIMPLENTE';
                }
            })
            ->addColumn('status',function ($dependente) {
                if ($dependente->status == 1){
                    return 'ATIVO';
                }else{
                    return 'DESATIVADO';
                }
            })
            ->make(true);
    }
}
