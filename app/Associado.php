<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Associado extends Model
{
    protected $guarded = ['id','dependentes','logradouro','numero','complemento','bairro','cep'];

    protected $dates = ['data_nascimento','dependentes.data_nascimento.*','admissao','created_at','updated_at'];

    protected $dateFormat = 'Y-m-d';

    protected $table = 'associados';

    public function dependente(){
        return $this->hasMany('App\Dependente','associado_id','id');
    }
    public function endereco(){
        return $this->hasOne('App\Endereco','associado_id','id');
    }
}
