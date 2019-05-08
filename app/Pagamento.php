<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pagamento extends Model
{
    use SoftDeletes;

    protected $table = 'pagamentos';

    protected $guarded = ['janeiro','fevereiro','marco','abril','maio','junho','julho','agosto','setembro','outubro','novembro','dezembro'];

    public function associado(){
        return $this->belongsTo('App\Associado','associado_id','id');
    }
}
