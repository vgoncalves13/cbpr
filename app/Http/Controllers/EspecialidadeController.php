<?php

namespace App\Http\Controllers;

use App\Especialidade;
use App\Http\Requests\EspecialidadeRequest;
use Illuminate\Http\Request;
use Eloquent;
use Illuminate\Database\Eloquent\Model;

class EspecialidadeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $especialidades = Especialidade::all();
        return view('especialidades.index')->with(compact('especialidades'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('especialidades.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     *
     */
    public function store(EspecialidadeRequest $request)
    {
        $especialidade = Especialidade::create($request->all());
        return redirect("especialidades")->with('message', 'Especialidade cadastrada com sucesso.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Especialidade  $especialidade
     * @return \Illuminate\Http\Response
     */
    public function show(Especialidade $especialidade)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Especialidade  $especialidade
     */
    public function edit(Especialidade $especialidade)
    {
        return view('especialidades.edit')->with(compact('especialidade'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Especialidade  $especialidade
     */
    public function update(Request $request, Especialidade $especialidade)
    {
        $especialidade->nome = $request->nome;
        $especialidade->save();
        return redirect("especialidades")->with('message', 'Especialidade atualizada com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Especialidade  $especialidade
     * @return \Illuminate\Http\Response
     */
    public function destroy(Especialidade $especialidade)
    {
        //
    }
}
