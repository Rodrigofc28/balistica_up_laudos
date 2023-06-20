<?php

namespace App\Http\Requests\Armas;

use Illuminate\Foundation\Http\FormRequest;

class SubmetralhadoraRequest extends FormRequest
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
            'numero_patrimonio'=>'nullable',
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
            'disposicao_canos' => 'nullable|max: 40',
            'coronha_fuste' => 'required|between:5,30',
            'sistema_disparo'=>'required',
            'num_lacre' => 'nullable',
            'quantidade_raias' => 'required|integer|min:0|max:30',
            'sentido_raias' => 'required|between:5,30',
            'telha'=>'nullable',
            'num_canos'=>'required',
            'sistema_funcionamento'=>'required'
            
        ];
    }
}
