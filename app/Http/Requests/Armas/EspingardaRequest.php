<?php

/*
 * Developed by Milena Mognon
 */

namespace App\Http\Requests\Armas;

use Illuminate\Foundation\Http\FormRequest;

class EspingardaRequest extends FormRequest
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
            'origem_id' => 'required|integer',
            'laudo_id' => 'required|integer',
            'tipo_serie' => 'required|between:5,40',
            'num_serie' => 'nullable',
            'comprimento_cano' => 'required',
            'comprimento_total' => 'required',
            'sistema_percussao' => 'required|between:5,50',
            'estado_geral' => 'required|between:2,25',
            'funcionamento' => 'required|between:5,25',
            'tipo_acabamento' => 'required|between:5,50',
            'tipo_arma' => 'required|between:5,30',
            'sistema_funcionamento' => 'required|between:5,30',
            'capacidade_carregador' => 'required',
            
            'sistema_disparo'=>'required',
            
            'sistema_carregamento' => 'required|between:5,40',
            'diametro_cano'=>'nullable',
            'coronha_fuste' => 'required|between:5,30',
            
            'tipo_carregador' => 'nullable|max: 40',
            'telha'=>'nullable',
            'numeracao_montagem' => 'nullable|max: 50',
            'num_lacre' => 'nullable',
            'num_canos'=>'required'
        ];
    }
}
