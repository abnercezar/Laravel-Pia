<?php

namespace App\Http\Requests;

use App\Enums\AtendimentoType;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Foundation\Http\FormRequest;

class UpdateAtendimentoRequest extends FormRequest
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
            'tipo' => ['required', new Enum(AtendimentoType::class)],
            'valor' => 'required|float|min:1',
            'irma_id' => 'required|exists:irmas,id'
        ];
    }
}
