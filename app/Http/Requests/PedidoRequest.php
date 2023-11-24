<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PedidoRequest
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
   
    public function validateField(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'cuenta_id' => 'required|exists:cuentas,id',
            'producto' => 'required|string|max:255',
            'cantidad' => 'required|integer|min:1',
            'valor' => 'required|numeric|min:0',
            'total' => 'required|numeric|min:0',
        ]);
    
        if ($validator->fails()) {
            return [
                    'success' => false,
                    'message' => $validator->errors()->first(),
                    'error' => $validator->errors(),
                    'status' => 406,
            ];
        }else{
            return true;
        }
    }
}
