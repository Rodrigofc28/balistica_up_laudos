<?php

/*
 * Developed by Milena Mognon
 */

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MunicaoRequest extends FormRequest
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
            'calibre_id' => 'required|integer',
            'laudo_id' => 'required|integer',
            'tipo_municao' => 'required|between:5,30',
            'projetil' => 'nullable|max:40',
            'estojo' => 'required|max:40',
            'tipo_projetil' => 'nullable',
            'nao_deflagrado' => 'nullable',
            'quantidade' => 'required|integer',
            'funcionamento' => 'required',
            'lacrecartucho'=> 'nullable',
            'observacao'=>'nullable',
            'origem_id'=>'nullable',
            'lacre_saida'=>'nullable',
            'funcionamentoCartucho'=>'nullable',
            'lote'=>'nullable',
            
        ];
    }

    public function messages()
    {
        return [
            'funcionamento.required_if' => 'O campo Tipo de Municão é obrigatório.',
           // 'tipo_projetil.required_unless' => 'O projétil (tipo) é necessário a menos que o tipo da municao seja estojo.',
            //'projetil.required_unless' => 'O projétil é necessário a menos que o tipo da municão seja estojo.',
           // 'estojo.required_unless' => 'O estojo é necessário a menos que o tipo da municão seja projétil.',

        ];
    }
}
