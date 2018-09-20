<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DependenteDeleteInfo extends Model
{
    protected $table = 'dependentes_delete_info';
    protected $guarded = ['documento'];


    public function dependente(){
        return $this->belongsTo('App\Dependente','dependente_id','id');
    }
}
