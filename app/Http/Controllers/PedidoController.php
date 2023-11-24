<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedido;

class PedidoController extends Controller
{
    public function index()
    {
        $pedidos = Pedido::with('cuenta')->get();

        return response()->json(['pedidos' => $pedidos], 200);
    }

    public function store(Request $request)
    {
        $pedido = Pedido::create($request->all());

        return response()->json(['pedido' => $pedido], 201);
    }

    public function update(Request $request, Pedido $pedido)
    {
        $pedido->update($request->all());
        return response()->json($pedido, 200);
    }

    public function destroy(Pedido $pedido)
    {
        $pedido->delete();
        return response()->json(null, 204);
    }
}
