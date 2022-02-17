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

    //Constantes intervalo consultas
    const CADA_15_MINUTOS = 15;
    const CADA_30_MINUTOS = 30;
    const CADA_60_MINUTOS = 60;
    const CADA_120_MINUTOS = 120;


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
                    'inicio' => self::INICIO_HORARIO_MANHA,
                    'final' => self::FINAL_HORARIO_MANHA
                ],
                'tarde' => [
                    'inicio' => self::INICIO_HORARIO_TARDE,
                    'final' => self::FINAL_HORARIO_TARDE
                ]
            ],
            'intervalo' => self::CADA_60_MINUTOS
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
        return $dias;
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

    public function getIntervaloJSON(Request $request)
    {
        $intervalo = [];
        $intervalo['intervalo'] = $request->intervalo_consultas;

        $json = json_encode($intervalo, true);

        return $json;
    }

    public function getDiasSemanaJSON(Request $request)
    {
        $dias_semana = [];
        $dias_semana['dias_semana'] = $request->dias_semana;

        $json = json_encode($dias_semana, true);

        return $json;
    }

    public function saveAgendaConfigs(Request $request, Agenda $agenda)
    {
        $horarios = $this->getHorariosJSON($request);
        $periodo = $this->getPeriodoJSON($request);
        $intervalo = $this->getIntervaloJSON($request);
        $dias_semana = $this->getDiasSemanaJSON($request);

        $json_merged =
            array_merge(
                json_decode($horarios, true),
                json_decode($periodo, true),
                json_decode($intervalo, true),
                json_decode($dias_semana, true)
            );

        $agenda->configs = $json_merged;
        $agenda->save();

    }

}
