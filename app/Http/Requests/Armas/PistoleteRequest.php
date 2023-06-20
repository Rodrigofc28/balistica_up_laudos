<?php

/*
 * Developed by Milena Mognon
 */

namespace App\Http\Requests\Armas;

use Illuminate\Foundation\Http\FormRequest;

class PistoleteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'marca_id' => 'required|integer',
            'calibre_id' => 'nullable|integer',
            'modelo'=>'nullable',
            'origem_id' => 'required|integer',
            'laudo_id' => 'required|integer',
            'tipo_serie' => 'required|between:5,40',
            'num_serie' => 'nullable',
            'comprimento_cano' => 'required',
            'comprimento_total' => 'required',
            'sistema_percussao' => 'required|between:5,100',
            'estado_geral' => 'required|between:2,25',
            'funcionamento' => 'required|between:5,25',
            'tipo_acabamento' => 'required|between:5,30',
            'tipo_arma' => 'required|between:5,30',
            'cabo'=>'required',
            'num_lacre' => 'nullable',
            'diametro_cano'=>'nullable',
            
            'numeracao_montagem'=>'nullable',
            'sistema_carregamento'=>'required',
            
            'sistema_disparo'=>'required',
            'num_canos'=>'required'
            
            
            

        ];
    }
}