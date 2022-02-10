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

    public function getHorarios($medico_id)
    {
        $horas = array();

        //$medico = Medico::findOrFail(\session()->get('medico_id'));
        $medico = Medico::findOrFail($medico_id);
        $agenda = $medico->agenda;

        if ($agenda['configs']['horarios']['manha']['inicio'] != null){
            $horario_inicio = new Carbon($agenda['configs']['horarios']['manha']['inicio']);
            $horario_final = new Carbon($agenda['configs']['horarios']['manha']['final']);

            $step = $horario_inicio;
            while ($step != $horario_final) {
                $horas[] =  $step->format('H:i');
                $step = $horario_inicio->addMinutes($agenda['configs']['intervalo']);
            }
        }
        if ($agenda['configs']['horarios']['tarde']['inicio'] != null){
            $horario_inicio = new Carbon($agenda['configs']['horarios']['tarde']['inicio']);
            $horario_final = new Carbon($agenda['configs']['horarios']['tarde']['final']);

            $step = $horario_inicio;
            while ($step != $horario_final) {
                $horas[] =  $step->format('H:i');
                $step = $horario_inicio->addMinutes($agenda['configs']['intervalo']);
            }
        }
        return $horas;
    }
}
