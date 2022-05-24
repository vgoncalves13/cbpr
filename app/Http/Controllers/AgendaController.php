<?php

namespace App\Http\Controllers;

use App\Agenda;
use Illuminate\Http\Request;

class AgendaController extends Controller
{
    protected $agenda;

    public function __construct(Agenda $agenda)
    {
        $this->agenda = $agenda;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Agenda  $agenda
     */
    public function store(Request $request, Agenda $agenda)
    {

        $request->validate([
            'inicio_horario_manha' => [
                'required_unless:agenda_periodo_atendimento,tarde'
            ],
            'final_horario_manha' => [
                'required_unless:agenda_periodo_atendimento,tarde'
            ],
            'inicio_horario_tarde' => [
                'required_unless:agenda_periodo_atendimento,manha'
            ],
            'final_horario_tarde' => [
                'required_unless:agenda_periodo_atendimento,manha'
            ],
        ]);

        $this->agenda->saveAgendaConfigs($request, $agenda);
        return redirect(route('agendas.show',$agenda->id))->with('message','Configurações atualizadas com sucesso');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Agenda  $agenda
     */
    public function show(Agenda $agenda)
    {
        return view("agendas.show",compact('agenda'));
    }
}
