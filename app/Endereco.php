<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    protected $table = 'enderecos';

    public function associado(){
        return $this->belongsTo('App\Associado','endereco_id','id');
    }
}
