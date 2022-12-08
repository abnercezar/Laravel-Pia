<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreIrmaRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|min:2|max:191',
            'cpf' => 'required|max:14',
            'comuns' => 'required|array',
            'comuns.*' => 'exists:comuns,id',
            'contatos' => 'required|array',
            'contatos.*.descricao' => 'required|min:2|max:191',
        ];
    }
}
