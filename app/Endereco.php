<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    protected $table = 'enderecos';

    protected $fillable = [
        'logradouro',
        'numero',
        'complemento',
        'bairro',
        'cep'
    ];

    public function associado(){
        return $this->belongsTo('App\Associado','endereco_id','id');
    }
    public function getAttribute($key){
        if(array_key_exists($key, $this->attributes))
            return strtoupper($this->attributes[$key]);
        else
            return null;
    }
}
