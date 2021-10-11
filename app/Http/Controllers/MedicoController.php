<?php

namespace App\Http\Controllers;

use App\Agenda;
use App\Especialidade;
use App\Http\Requests\MedicoStoreRequest;
use App\Medico;
use App\User;
use Illuminate\Http\Request;

class MedicoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $medicos = Medico::all();
        return view('medicos.index')->with(compact('medicos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $especialidades = Especialidade::all(['id','nome']);
        return view('medicos.create')->with(compact('especialidades'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(MedicoStoreRequest $request)
    {
        $agenda = new Agenda();

        $medico = Medico::create($request->all());
        $medico->agenda()->save($agenda);
        $user = User::create([
            'username' => $request->crm,
            'password' => bcrypt(substr($request->crm,0,6))
        ]);
        $medico->especialidades()->attach($request->especialidades);


        return redirect("medicos")->with('message', 'Médico cadastrado com sucesso.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Medico  $medico
     * @return \Illuminate\Http\Response
     */
    public function show(Medico $medico)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Medico  $medico
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $medico = Medico::findOrFail($id);
        $especialidades = Especialidade::all(['id','nome']);
        return view('medicos.edit')->with(compact('medico','especialidades'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Medico  $medico
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $medico = Medico::findOrFail($id);
        $medico->update($request->all());
        $medico->especialidades()->sync($request->especialidades);

        return redirect(route('medicos.index'))->with('message', 'Médico atualizado com sucesso.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Medico  $medico
     * @return \Illuminate\Http\Response
     */
    public function destroy(Medico $medico)
    {
        //
    }
}
