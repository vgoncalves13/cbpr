<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dependente extends Model
{
    protected $table = 'dependentes';
    protected $fillable = ['dependentes','associado_id'];

    public function associado(){
        return $this->belongsTo('App\Associado','dependente_id','id');
    }

    public function dependente_delete_info(){
        return $this->hasOne('App\DependenteDeleteInfo','dependente_id','id');
    }

    public function getNomeDependenteAttribute($value)
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
