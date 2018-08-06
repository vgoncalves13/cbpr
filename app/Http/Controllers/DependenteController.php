<?php

namespace App\Http\Controllers;

use App\Dependente;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DependenteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        return view('dependentes.create')->with('associado_id',$id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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

        $tamanho_array = count(array_filter($request['dependentes']['nome_dependente']));
        for ($i = 0; $i < $tamanho_array; $i++) {
            $dependente = new Dependente();
            $dependente->associado_id = $request->associado_id;
            $dependente->nome_dependente = $input['dependentes']['nome_dependente'][$i];
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
    public function edit(Dependente $dependente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Dependente  $dependente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dependente $dependente)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Dependente  $dependente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dependente $dependente)
    {
        //
    }
}
