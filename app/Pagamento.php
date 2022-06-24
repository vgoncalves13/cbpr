<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

class Pagamento extends Model
{
    use SoftDeletes;

    protected $table = 'pagamentos';

    protected $guarded = ['janeiro','fevereiro','marco','abril','maio','junho','julho','agosto','setembro','outubro','novembro','dezembro'];

    public function associado(){
        return $this->belongsTo('App\Associado','associado_id','id');
    }

    /*
    * Retorna o nome do mês passado
    * @return string
    */
    public static function getPreviousMonthName() {
        $previousMonthName = Carbon::now()->subMonth()->translatedFormat('F');
        return $previousMonthName;
    }

    /*
    * Verifica se o mês passado é null, ou seja, não foi pago.
    * @return boolean
    */
    public static function checkPayment(Associado $associado) {
        $payment = Pagamento::where('associado_id', $associado->id)->where('ano', Carbon::now()->year)->whereNotNull(self::getPreviousMonthName())->first();
        if($payment) {
            return true;
        }
        return false;
    }
}
