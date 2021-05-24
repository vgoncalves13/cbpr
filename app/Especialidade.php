<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Especialidade extends Model
{
    protected $fillable = ['nome'];

    public function medicos()
    {
        return $this->belongsToMany(Medico::class);
    }
}
