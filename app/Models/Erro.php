<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Erro extends Model
{
    protected $table = 'erros'; //tabela marcas

    protected $fillable = ['nome', 'erro','solucao']; //campos
}
