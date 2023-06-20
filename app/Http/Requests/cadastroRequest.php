<?php

/*
 * Developed by Milena Mognon
 */

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CadastroRequest extends FormRequest
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
            'email' => 'required|string|email|max:255|unique:cadastrousuarios',
            'nome' => 'required|min:6',
            'password' => 'required',
            'userGDL' => 'nullable',
            
            'timestamps'=>'date',
            'secao_id'=>'required'
        ];
    }
}