<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Outros_balistica extends Model
{
    use SoftDeletes;

    protected $table = 'outros'; //tabela marcas

    protected $fillable = ['descricao_item','laudo_id', 'quantidade','medida','nome','marca','lacre_entrada','lacre_saida','modelo','modeloSalvo','up_image','up_image2']; //campos

    public function laudo()
    {
        return $this->belongsTo(Laudo::class);
    }
    
}