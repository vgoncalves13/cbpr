<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DependenteDeleteInfoRequest extends FormRequest
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
            'documento_comprovante' => 'required|file|max:20480|mimes:pdf,doc,docx,jpeg,png,tif,jpg',
            'data_solicitacao' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute é obrigatório',
            'documento_comprovante.mimes' => 'A :attribute deve ser umdocumento válido, PDF, Documento do Word ou imagem.',
            'documento_comprovante.max' => 'O tamanho máximo do arquivo é de até 20MB'
        ];
    }
}
