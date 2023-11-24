<?php

namespace App\Http\Controllers;

use App\Models\Cuenta;
use App\Http\Requests\CuentaRequest;

class CuentaController extends Controller
{
    public function index()
    {
        try {
            $cuentas = Cuenta::with('pedidos')->get();
            return response()->json(['cuentas' => $cuentas], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage(), 'line' => $e->getLine(), 'type' => get_class($e)], 500);
        }
    }

    public function store(CuentaRequest $request)
    {
        try {
            $cuenta = Cuenta::create($request->all());
            return response()->json(['cuenta' => $cuenta], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage(), 'line' => $e->getLine(), 'type' => get_class($e)], 500);
        }
    }

    public function update(CuentaRequest $request, Cuenta $cuenta)
    {
        try {
            $cuenta->update($request->all());
            return response()->json($cuenta, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage(), 'line' => $e->getLine(), 'type' => get_class($e)], 500);
        }
    }

    public function destroy(Cuenta $cuenta)
    {
        try {
            $cuenta->delete();
            return response()->json(null, 204);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage(), 'line' => $e->getLine(), 'type' => get_class($e)], 500);
        }
    }
}
