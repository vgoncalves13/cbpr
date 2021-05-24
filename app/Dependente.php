<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dependente extends Model
{
    protected $table = 'dependentes';
    protected $fillable = ['dependentes','associado_id','nome_completo','cpf','grau_parentesco','data_nascimento'];

    public function marcacoes()
    {
        return $this->morphMany('App\Marcacao','pacienteable');
    }

    public function associado(){
        return $this->belongsTo('App\Associado');
    }

    public function dependente_delete_info(){
        return $this->hasOne('App\DependenteDeleteInfo','dependente_id','id');
    }

    public function getNomeCompletoAttribute($value)
    {
        return strtoupper($value);
    }
    public function getGrauParentescoAttribute($value)
    {
        return strtoupper($value);
    }
    public function getCpfAttribute($value)
    {
        return strtoupper($value);
    }

}
