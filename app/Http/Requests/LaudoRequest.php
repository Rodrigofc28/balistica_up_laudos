<?php

/*
 * Developed by Milena Mognon
 */

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LaudoRequest extends FormRequest
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
            'oficio' => 'nullable',
            'rep' => 'required',
            'data_designacao' => 'required|date_format:"d/m/Y"|after_or_equal:data_solicitacao',
            'data_recebimento' => 'required|date_format:"d/m/Y"|after_or_equal:data_solicitacao',
            'data_solicitacao' => 'required|date_format:"d/m/Y"|before_or_equal:data_designacao',
           'data_ocorrencia'=>'nullable|date_format:"d/m/Y"',
            'secao_id' => 'nullable',
            'cidade_id' => 'nullable',
            'solicitante_id' => 'nullable',
            'perito_id' => 'required',
            'diretor_id' => 'nullable',
            'indiciado' => 'nullable|min:6|max:80',
            'tipo_inquerito' => 'nullable|max:80',
            'inquerito' => 'nullable|max:20',
            'laudoEfetConst'=>'required',
            'nomeIncluir'=>'nullable',
            'material_coletado'=>'nullable',
            'repExameComplementar'=>'nullable',
            
        ];
    }
}
