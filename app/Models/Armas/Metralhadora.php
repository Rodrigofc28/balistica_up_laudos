<?php

/*
 * Developed by Milena Mognon
 */

namespace App\Models\Armas;

use Illuminate\Database\Eloquent\Model;


class Metralhadora extends Model
{
    
    public static function text($arma)
    {
        
        $serie = Shared::serie($arma->tipo_serie, $arma->num_serie);
        
       
        
        $corpo = ['serie'=>$serie];
       
        
        $laudo = ['corpo' => $corpo];

        return $laudo;
    }

}