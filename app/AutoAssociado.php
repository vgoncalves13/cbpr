<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AutoAssociado extends Model
{
    protected $table = 'auto_associados';

    protected $fillable = ['serialize_request'];

    protected $dates = ['data_nascimento'];
}
