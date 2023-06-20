<?php

/*
 * Developed by Milena Mognon
 */

namespace App\Models\Armas;

use Illuminate\Database\Eloquent\Model;


class Espingarda extends Model
{
    public static function text($arma)
    {
        if ($arma->tipo_arma === "Espingarda Artesanal") {
            $text = self::espingarda_artesanal($arma);
        } else {
            if ($arma->num_canos === "dois") {
                $text = self::espingarda_dois_canos($arma);
            } else {
                $text = self::espingarda($arma);
            }
        }

        $resultado = Shared::funcionamento($arma->funcionamento);
       
        $laudo = array_merge($text, ['resultado' => $resultado]);

        return $laudo;
    }

    

    private static function espingarda_dois_canos($arma)
    {
        
        $serie = Shared::serie($arma->tipo_serie, $arma->num_serie);
        
        
        $corpo = ['serie'=>$serie];
        return ['corpo' => $corpo];
    }

    private static function espingarda($arma)
    {
        
        $serie = Shared::serie($arma->tipo_serie, $arma->num_serie);
        
        $corpo = ['serie'=>$serie];
        return [ 'corpo' => $corpo];
    }
}
