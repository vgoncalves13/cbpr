<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Associado extends Model
{
    protected $guarded = ['id','logradouro','numero','complemento','bairro','cep'];

    protected $dates = ['data_nascimento','admissao','created_at','updated_at'];

    protected $dateFormat = 'Y-m-d H:m:s';

    protected $table = 'associados';

    public function dependente(){
        return $this->hasMany('App\Dependente','associado_id','id');
    }
    public function pagamento(){
        return $this->hasMany('App\Pagamento','associado_id','id');
    }
    public function endereco(){
        return $this->hasOne('App\Endereco','associado_id','id');
    }
}
