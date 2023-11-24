<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Http\Requests\PedidoRequest;
use Illuminate\Http\Request;

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

    public function store(Request $request)
    {
        try {
            // validar campos en un archivo aparte para reutilizarlo.
            $validate = (new PedidoRequest())->validateField($request);

            if ($validate === true) {

                $pedido = Pedido::create($request->all());
                return response()->json(['pedido' => $pedido], 201);
            } else {
                return response()->json($validate, 406);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage(), 'line' => $e->getLine(), 'type' => get_class($e)], 500);
        }
    }

    public function update(Request $request, Pedido $pedido)
    {
        try {
            // validar campos en un archivo aparte para reutilizarlo.
            $validate = (new PedidoRequest())->validateField($request);

            if ($validate === true) {
                
                $pedido->update($request->all());
                return response()->json($pedido, 200);
            } else {
                return response()->json($validate, 406);
            }
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
