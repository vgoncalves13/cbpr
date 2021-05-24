<?php

namespace App;

use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Database\Eloquent\Model;

class Marcacao extends Model
{
    protected $table = 'marcacoes';

    protected $fillable = ['horario'];

    public function pacienteable()
    {
        return $this->morphTo();
    }

    public function medico()
    {
        return $this->belongsTo('App\Medico');
    }

    public function especialidade()
    {
        return $this->belongsTo('App\Especialidade');
    }

    public function getDiasMarcacao($quantidade_dias)
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
    public function getDiasDaSemana($dias)
    {
        $array_dias_semana = [];
        foreach ($dias as $dia){
            $exploded_date = explode('-',$dia);
            $arr = Carbon::create($exploded_date[0],$exploded_date[1],$exploded_date[2]);
            $arr->settings(['formatFunction' => 'translatedFormat']);
            $array_dias_semana[] = $arr;
        }
        return $array_dias_semana;
    }

}
