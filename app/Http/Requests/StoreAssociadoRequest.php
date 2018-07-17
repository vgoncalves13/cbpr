<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAssociadoRequest extends FormRequest
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
            'foto' => 'image|required|file|dimensions:min_width=100,min_height=200',
            'nome_completo' => 'required',
            'nome_mae' => 'required',
            'email' => 'email|required'
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
