<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePhotoRequest extends FormRequest
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
            'foto' => 'image|file|dimensions:min_width=100,min_height=100|required',
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute é obrigatório',
            'foto.dimensions' => 'A :attribute não segue os tamanhos mínimos recomendados de 100x100 pixels',
            'image' => 'O arquivo selecionado deve ser uma imagem!'
        ];
    }
}
