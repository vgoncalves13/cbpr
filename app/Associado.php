<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\True_;

class Associado extends Model
{
    use SoftDeletes;

    const CIVIL = 'CIVIL';
    const PMERJ = 'PMERJ';
    const CBMERJ = 'CBMERJ';
    const PENSIONISTA = 'PENSIONISTA';

    protected $fillable = [
        'matricula_antiga',
        'matricula_nova',
        'admissao',
        'graduacao',
        'classe',
        'nome_completo',
        'nome_mae',
        'nome_pai',
        'naturalidade',
        'estado_civil',
        'data_nascimento',
        'cpf',
        'telefone_trabalho',
        'telefone_casa',
        'telefone_celular',
        'email',
        'observacoes',
        'foto',
        'status'
    ];

    protected $guarded = ['id', 'logradouro', 'numero', 'complemento', 'bairro', 'cep'];

    protected $dates = ['data_nascimento', 'admissao'];

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
    public function criarUsername($cpf)
    {
        $cpf_limpo = $this->limparCpfUsuario($cpf);

        $user = User::create([
            'username' => $cpf_limpo,
            'password' => bcrypt(substr($cpf_limpo,0,6))
        ]);
        $user->attachRole('associado');
        return $user;
    }

    public function isTheOwner($user)
    {
        return $this->user_id === $user->id;
    }

    public function updateCellphone(Request $request, Associado $associado)
    {
        $associado->telefone_celular = $request->telefone_celular;
        $associado->save();
    }

    public function hasCellphone(Associado $associado)
    {
        if ($associado->telefone_celular == null){
            return false;
        }
        return true;
    }

    public static function disableAssociado($associado)
    {
        $associado->status = 0;
        $associado->save();
    }

    public static function enableAssociado($associado)
    {
        $associado->status = 1;
        $associado->save();
    }

    /**
     * @return bool
     * Verifica apenas os associados classe Associado::CIVIL tem pagamento para o mês passado, se não tiver, ele é considerado como não pagante e tem o status 0, ficando inadimplente
     */
    public static function checkAssociadoPayment()
    {
        $associados = Associado::where('classe', Associado::CIVIL)->get();
        foreach ($associados as $associado) {
            if (Pagamento::checkPayment($associado)) {
                self::enableAssociado($associado);
            }else{
                self::disableAssociado($associado);
            }
        }

    }

    /**
     * @return bool
     * Verifica se o CPF é válido
     */
    public static function isValidCpf($cpf)
    {
         // Extrai somente os números
        $cpf = preg_replace( '/[^0-9]/is', '', $cpf );

        // Verifica se foi informado todos os digitos corretamente
        if (strlen($cpf) != 11) {
            return false;
        }

        // Verifica se foi informada uma sequência de digitos repetidos. Ex: 111.111.111-11
        if (preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
        }

        // Faz o calculo para validar o CPF
        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) {
                return false;
            }
        }
        return true;
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
