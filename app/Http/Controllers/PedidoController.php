<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Http\Requests\PedidoRequest;

class PedidoController extends Controller
{
    public function index()
    {
        try {
            $pedidos = Pedido::with('cuenta')->get();
            return response()->json(['pedidos' => $pedidos], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage(), 'line' => $e->getLine(), 'type' => get_class($e)], 500);
        }
    }

    public function store(PedidoRequest $request)
    {
        try {
            $pedido = Pedido::create($request->all());

            return response()->json(['pedido' => $pedido], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage(), 'line' => $e->getLine(), 'type' => get_class($e)], 500);
        }
    }

    public function update(PedidoRequest $request, Pedido $pedido)
    {
        try {
            $pedido->update($request->all());
            return response()->json($pedido, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage(), 'line' => $e->getLine(), 'type' => get_class($e)], 500);
        }
    }

    public function destroy(Pedido $pedido)
    {
        try {
            $pedido->delete();
            return response()->json(null, 204);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage(), 'line' => $e->getLine(), 'type' => get_class($e)], 500);
        }
    }
}
