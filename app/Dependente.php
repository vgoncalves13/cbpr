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
}
