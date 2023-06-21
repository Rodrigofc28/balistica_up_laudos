<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Armas_Gdl extends Model
{
    protected $table = 'tabela_pecas_gdl';
    protected $fillable = [
        'tipo_item','lacre_entrada','descricao','quantidade','consumida'
        ,'rep','perito','num_serie','marca','estado_geral','funcionamento',
        'status_serie','calibre_nominal','fabricacao','lacre_saida','modelo',
        'observacao','patrimonio','acabamento','lote','estojo','capacidade','identificacao','status'
    ];
    
    

    
}
