<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Associado extends Model
{
    use SoftDeletes;

    protected $guarded = ['id', 'logradouro', 'numero', 'complemento', 'bairro', 'cep'];

    protected $dates = ['data_nascimento', 'admissao', 'created_at', 'updated_at','deleted_at'];

    protected $dateFormat = 'Y-m-d H:m:s';

    protected $table = 'associados';

    public function dependente()
    {
        return $this->hasMany('App\Dependente', 'associado_id', 'id');
    }

    public function pagamento()
    {
        return $this->hasMany('App\Pagamento', 'associado_id', 'id');
    }

    public function endereco()
    {
        return $this->hasOne('App\Endereco', 'associado_id', 'id');
    }

    public function usuario()
    {
        return $this->hasOne('App\User', 'associado_id', 'id');
    }

    // this is a recommended way to declare event handlers
    public static function boot() {
        parent::boot();

        static::deleting(function($associado) { // before delete() method call this
            $associado->dependente()->delete();
            // do the rest of the cleanup...
        });
    }

    //Accessors

    public function getNomeCompletoAttribute($value)
    {
        return strtoupper($value);
    }

    public function getNomeMaeAttribute($value)
    {
        return strtoupper($value);
    }

    public function getNomePaiAttribute($value)
    {
        return strtoupper($value);
    }

    public function getLogradouroAttribute($value)
    {
        return strtoupper($value);
    }

    public function getBairroAttribute($value)
    {
        return strtoupper($value);
    }

    public function getComplementoAttribute($value)
    {
        return strtoupper($value);
    }

    public function getNaturalidadeAttribute($value)
    {
        return strtoupper($value);
    }

    public function getEstadoCivilAttribute($value)
    {
        return strtoupper($value);
    }

    public function getObservacoesAttribute($value)
    {
        return strtoupper($value);
    }

    public function getEmailAttribute($value)
    {
        return strtoupper($value);
    }

    public function getTipoAttribute($value)
    {
        return strtoupper($value);
    }

    public function getGraduacaoAttribute($value)
    {
        return strtoupper($value);
    }

}
