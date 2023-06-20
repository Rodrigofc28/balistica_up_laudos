<?php

/*
 * Developed by Milena Mognon
 */

namespace App\Models\Armas;

use Illuminate\Database\Eloquent\Model;


class Garrucha extends Model
{

    private static $calibre, $origem, $quantidade_raias, $tipo_acabamento,
        $serie, $marca, $resultado, $sentido_raias,$modelo,$comprimentoCano,$comprimentoTotal,
        $numeracao_montagem,$altura,$cabo,$tipoArma,$numCano,$sistemaInflamacao,$diametroCano,$sistemaDisparo;

    public static function text($arma)
    {   
        
      
        self::$serie = Shared::serie($arma->tipo_serie, $arma->num_serie);
        self::$resultado = Shared::funcionamento($arma->funcionamento);
        if ($arma->num_canos == "dois") {
            $corpo = self::garrucha_dois_canos($arma);
        } else {
            $corpo = self::garrucha_um_cano($arma);
        }
        
         $laudo = ['corpo' => $corpo, 'resultado' => self::$resultado];

        return $laudo;
    }

    private static function garrucha_dois_canos($arma)
    {
        $lacre_saida= shared::num_lacre_saida($arma->num_lacre_saida);
        $corpo = ['serie'=>self::$serie ] ;
        return $corpo;
    }

    private static function garrucha_um_cano($arma)
    {   
        $cao=shared::cao($arma->cao);
        $lacre_saida= shared::num_lacre_saida($arma->num_lacre_saida);
        $corpo = ['serie'=>self::$serie ] ; 
           
        return $corpo;
    }
}
        
        
        

        

       
    

        
        
        
        
        
        
        
       
    