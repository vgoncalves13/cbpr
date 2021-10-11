<?php

namespace App;

use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Agenda extends Model
{
    const INICIO_HORARIO_MANHA = '08:00';
    const FINAL_HORARIO_MANHA = '12:00';
    const INICIO_HORARIO_TARDE = '13:00';
    const FINAL_HORARIO_TARDE = '17:00';


    protected $casts = [
        'configs' => 'array'
    ];

    public function medico()
    {
        return $this->belongsTo(Medico::class);
    }

    public function __construct()
    {
        $arr = [
            'periodo' => 'ambos',
            'horarios' => [
                'manha' => [
                    'inicio' => '08:00',
                    'final' => '12:00'
                ],
                'tarde' => [
                    'inicio' => '13:00',
                    'final' => '17:00'
                ]
            ]
        ];
        $this->configs = $arr;

    }

    public function criarPeriodoDias($quantidade_dias)
    {
        //Periodo 15 dias para ser exibido
        $periodo = CarbonPeriod::create(Carbon::today(),Carbon::today()->addDay($quantidade_dias));
        $dias = [];
        foreach ($periodo as $data){
            if ($data->dayOfWeek != Carbon::SATURDAY && $data->dayOfWeek != Carbon::SUNDAY){
                $dias[] = $data->format('Y-m-d');
            }
        }

        dd($dias);
        return $dias;
    }

    public function getHorarios($periodo, $horarios)
    {

    }

    public function getHorariosJSON(Request $request)
    {
        $horarios = [];
        $horarios['horarios']['manha']['inicio'] = $request->inicio_horario_manha;
        $horarios['horarios']['manha']['final'] = $request->final_horario_manha;
        $horarios['horarios']['tarde']['inicio'] = $request->inicio_horario_tarde;
        $horarios['horarios']['tarde']['final'] = $request->final_horario_tarde;

        $json = json_encode($horarios, true);

        return $json;
    }

    public function getPeriodoJSON(Request $request)
    {
        $periodo = [];
        $periodo['periodo'] = $request->agenda_periodo_atendimento;

        $json = json_encode($periodo, true);

        return $json;
    }

    protected function joinJsons($json_a, $json_b)
    {

        $json_a = json_decode($json_a, true);
        $json_b = json_decode($json_b, true);


        $new_json['horarios'] = $json_a['horarios'];
        $new_json['periodo'] = $json_b['periodo'];

        return $new_json;
    }

    public function saveAgendaConfigs(Request $request, Agenda $agenda)
    {
        $horarios = $this->getHorariosJSON($request, $agenda);
        $periodo = $this->getPeriodoJSON($request, $agenda);

        $json = $this->joinJsons($horarios, $periodo);

        $agenda->configs = $json;
        $agenda->save();

    }

}
