<?php

namespace App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class CuentaRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    
    public function validateField(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255',
            'email' => 'required|email',
            'telefono' => 'required|string|max:20',
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
