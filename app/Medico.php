<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medico extends Model
{
    protected $fillable = ['nome','crm'];

    public function especialidades()
    {
        return $this->belongsToMany('App\Especialidade','especialidade_medico');
    }
}
