<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PedidoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'cuenta_id' => 'required|exists:cuentas,id',
            'producto' => 'required|string|max:255',
            'cantidad' => 'required|integer|min:1',
            'valor' => 'required|numeric|min:0',
            'total' => 'required|numeric|min:0',
        ];
    }
}
