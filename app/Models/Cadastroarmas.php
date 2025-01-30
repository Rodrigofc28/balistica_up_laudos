<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cadastroarmas extends Model
{
    protected $fillable = [
        'arma_id','tipo_arma', 'marca_id', 'calibre_id', 'origem_id', 'tambor_rebate', 'capacidade_tambor',
        'sistema_percussao', 'tipo_acabamento', 'comprimento_cano',
        'comprimento_total', 'altura', 'quantidade_raias', 'sentido_raias', 
        'cabo', 'funcionamento', 'sistema_funcionamento', 'num_canos', 'disposicao_canos',
        'teclas_gatilho', 'sistema_carregamento', 'sistema_engatilhamento', 'coronha_fuste',
        'chave_abertura', 'tipo_carregador', 'calibre_real', 'bandoleira', 'placas_laterais',
        'cao', 'carregador', 'capacidade_carregador', 'trava_ferrolho', 'trava_gatilho',
        'trava_seguranca', 'retem_carregador', 'carregamento', 'numeracao_montagem', 'modelo','coronha','diametro_cano','telha',
        'sistema_percussao','tipo_tambor','tambor_rebate','sistema_disparo','quantidade_canos'
        ,'imagemCantoSuperior'
    ];
    
    

    
}
