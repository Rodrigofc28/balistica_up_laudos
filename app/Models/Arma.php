<?php

namespace App\Models;
use App\Models\Armas\Submetralhadora;
use App\Models\Armas\Metralhadora;
use App\Models\Armas\Espingarda;
use App\Models\Armas\Carabina;
use App\Models\Armas\Garrucha;
use App\Models\Armas\Pistola;
use App\Models\Armas\Revolver;
use App\Models\Laudo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Arma extends Model
{
    use SoftDeletes;

    protected $table = 'armas';

    protected $fillable = [
        'tipo_arma', 'marca_id', 'calibre_id', 'origem_id',
        'laudo_id', 'tipo_serie', 'num_serie', 'tambor_rebate', 'capacidade_tambor',
        'sistema_percussao', 'tipo_acabamento', 'estado_geral', 'comprimento_cano',
        'comprimento_total', 'altura', 'quantidade_raias', 'sentido_raias', 'num_lacre',
        'cabo', 'funcionamento', 'sistema_funcionamento', 'num_canos', 'disposicao_canos',
        'teclas_gatilho', 'sistema_carregamento', 'sistema_engatilhamento', 'coronha_fuste',
        'chave_abertura', 'tipo_carregador', 'calibre_real', 'bandoleira', 'placas_laterais',
        'cao', 'carregador', 'capacidade_carregador', 'trava_ferrolho', 'trava_gatilho',
        'trava_seguranca', 'retem_carregador', 'carregamento', 'numeracao_montagem', 'modelo',
        'num_lacre_saida','coronha','diametro_cano','numero_patrimonio','telha',
        'sistema_percussao','salva_cadastro','tipo_tambor','tambor_rebate','sistema_disparo','quantidade_canos'
        ,'rep_materialColetado','origem_coletaPerito','institutoArma','imagemCantoSuperior','imagemCantoInferior',
        'imagemNumSerie','dito_oficio','id_armas_gdl'
    ];

    protected $dates = ['deleted_at'];

    public function laudo()
    {
        return $this->belongsTo(Laudo::class);
    }

    public function marca(){
        return $this->belongsTo(Marca::class)->withTrashed();
    }

    public function calibre(){
        return $this->belongsTo(Calibre::class)->withTrashed();
    }

    public function origem(){
        return $this->belongsTo(Origem::class)->withTrashed();
    }

    public function imagens(){
        return $this->hasMany(Imagem::class);
    }
  
    public static function arma($arma)
    {
        switch ($arma->tipo_arma) {
            case "Revólver":
                return Revolver::text($arma);
                break;
            case "Pistola":
                return Pistola::text($arma);
                break;
            case "Garrucha":
                return Garrucha::text($arma);
                break;
            case "Carabina":
                return Carabina::text($arma);
                break;
            case "Metralhadora":
                return Metralhadora::text($arma);
                break;
            case "Submetralhadora":
                return Submetralhadora::text($arma);
                break;
            case "Espingarda" || "Espingarda Artesanal":
                return Espingarda::text($arma);
                break;
            

        }
    }
}
