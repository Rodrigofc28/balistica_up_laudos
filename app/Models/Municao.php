<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Municao extends Model
{
    

    protected $fillable = ['marca_id', 'origem_id', 'calibre_id', 'laudo_id','dito_oficio', 'estojo',
        'projetil', 'funcionamento', 'quantidade', 'tipo_municao', 'tipo_projetil',
        'nao_deflagrado', 'municao_de','lacrecartucho','observacao','institutoArma',
        'detalharLocalizacao','item',
        'coleta','percutidos','lacre_saida','rep_materialColetado','lote','origem_projetil',
        'origem_coletaPerito','funcionamentoCartucho','qtEficiente','qtIneficiente','up_image','up_image2'];

    protected $table = 'municoes';

    public $timestamps = false;

    protected $dates = ['deleted_at'];

    /* -- Relationships -- */

    /* ->withTrashed() é utilizado para retornar um registro
    *  mesmo que tenha sido deletado.
    * Objetivo é evitar erros quando acessar $arma->marca->nome, por exemplo
    */
    public function marca()
    {
        return $this->belongsTo(Marca::class)->withTrashed();
    }

    public function calibre()
    {
        return $this->belongsTo(Calibre::class)->withTrashed();
    }

    public function laudo()
    {
        return $this->belongsTo(Laudo::class);
    }
    public function imagens(){
        return $this->hasMany(ImagensMunicoes::class);
    }

    /* -- End Relationships -- */
}
