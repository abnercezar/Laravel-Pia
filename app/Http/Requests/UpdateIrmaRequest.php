<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateIrmaRequest extends FormRequest
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
            'cpf' => 'required|size:14',
            'comuns' => 'required|array',
            'comuns.*' => 'exists:comuns,id',
            'contatos' => 'required|array:description',
            'contatos.*.description' => 'required|min:2|max:191',
        ];
    }
}
