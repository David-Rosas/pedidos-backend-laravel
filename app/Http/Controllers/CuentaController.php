<?php

namespace App\Http\Controllers;
use App\Models\Cuenta;
use Illuminate\Http\Request;

class CuentaController extends Controller
{
    public function index()
    {
        $cuentas = Cuenta::with('pedidos')->get();

        return response()->json(['cuentas' => $cuentas], 200);
    }

    public function store(Request $request)
    {
        $cuenta = Cuenta::create($request->all());

        return response()->json(['cuenta' => $cuenta], 201);
    }

    public function update(Request $request, Cuenta $cuenta)
    {
        $cuenta->update($request->all());
        return response()->json($cuenta, 200);
    }

    public function destroy(Cuenta $cuenta)
    {
        $cuenta->delete();
        return response()->json(null, 204);
    }
}
