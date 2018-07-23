<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAssociadoRequest extends FormRequest
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

    public function rules()
    {
        return [
            'nome_completo' => 'required',
            'nome_mae' => 'required',
            'email' => 'email|required',
            'cpf' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute é obrigatório',
            'foto.image' => 'A :attribute deve ser uma imagem válida.',
            'foto.required'  => 'É necessário escolher uma foto 3x4',
            'foto.dimensions' => 'A :attribute não segue os tamanhos mínimos recomendados',
            'email' => ':attribute deve ser um E-mail válido'
        ];
    }
}
