<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Associado extends Model
{
    use SoftDeletes;

    protected $guarded = ['id', 'logradouro', 'numero', 'complemento', 'bairro', 'cep'];

    protected $dates = ['data_nascimento', 'admissao'];

    protected $dateFormat = 'Y-m-d H:i:s';

    protected $table = 'associados';

    public function marcacoes()
    {
        return $this->morphMany(Marcacao::class,'pacienteable');
    }

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
        return $this->belongsTo(User::class, 'user_id');
    }

    public function parent()
    {
        return $this->belongsTo(self::class,'parent_id');
    }

    // this is a recommended way to declare event handlers
    public static function boot() {
        parent::boot();

        static::deleting(function($associado) { // before delete() method call this
            $associado->dependente()->delete();
            // do the rest of the cleanup...
        });
    }

    public function limparCpfUsuario($cpf)
    {
        $cpf_limpo = preg_replace('/\D/', '', $cpf);
        return $cpf_limpo;
    }
    public function criarUsername($username)
    {
        $user = User::create([
            'username' => $username,
            'password' => bcrypt(substr($username,0,6))
        ]);
        return $user;
    }

    public function isTheOwner($user)
    {
        return $this->user_id === $user->id;
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
