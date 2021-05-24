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
            'foto' => 'nullable|image|file|dimensions:min_width=100,min_height=100',
            'nome_completo' => 'required',
            'nome_mae' => 'required',
            'email' => 'nullable|email',
            'logradouro' => 'required',
            'bairro' => 'required',
            'cep' => 'required',
            'complemento' => 'required',
            'cpf' => 'unique:associados|required',
            'admissao' => 'required',
            'data_nascimento' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute é obrigatório',
            'foto.image' => 'A :attribute deve ser uma imagem válida.',
            'foto.required'  => 'É necessário escolher uma foto 3x4',
            'foto.dimensions' => 'A :attribute não segue os tamanhos mínimos recomendados de 100x100 pixels',
            'email' => ':attribute deve ser um E-mail válido',
            'unique' => ':attribute já foi cadastrado!'
        ];
    }
}
