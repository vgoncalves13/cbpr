<?php

namespace App;

use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Database\Eloquent\Model;
use Laratrust\Contracts\Ownable;

class Marcacao extends Model implements Ownable
{
    public function ownerKey($owner)
    {
        if ($this->pacienteable_type == 'App\Associado'){
            return $this->pacienteable->usuario->id;
        }else{
            return $this->pacienteable->associado->usuario->id;
        }

    }

    protected $table = 'marcacoes';

    protected $fillable = ['horario'];

    protected $dates = ['data_hora_consulta'];

    public function getDiaConsultaAttribute($value)
    {
        Carbon::setLocale('pt');
        $data = Carbon::createFromFormat('Y-m-d',$value);
        return $data->format('d/m/Y');
    }

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
        $periodo = CarbonPeriod::create(Carbon::tomorrow(),Carbon::today()->addDay($quantidade_dias));
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


    public function getSecondsFromTime($time)
    {
        $timeInSeconds = strtotime($time) - strtotime('TODAY');

        return $timeInSeconds;
    }

    public function horasRange($lower = 0, $upper = 86400, $step = 3600, $format = '')
    {
        $times = array();
        if (empty($format)){
            $format = 'H:i';
        }
        foreach (range($lower, $upper, $step) as $increment) {
            $increment = gmdate('H:i', $increment);
            list($hour, $minutes) = explode(':', $increment);
            $date = new \DateTime($hour . ':' . $minutes);
            $times[(string) $increment] = $date->format($format);
        }
        return $times;
    }

}
