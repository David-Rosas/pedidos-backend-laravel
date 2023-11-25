<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Http\Requests\PedidoRequest;
use Illuminate\Http\Request;
use App\Events\EventPedidos;


class PedidoController extends Controller
{
    /**
     * Method index
     *
     * @return void
     */
    public function index()
    {
        try {
            $pedidos = Pedido::with('cuenta')->get();
            return response()->json(['pedidos' => $pedidos], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage(), 'line' => $e->getLine(), 'type' => get_class($e)], 500);
        }
    }

    /**
     * Method store
     *
     * @param Request $request [explicite description]
     *
     * @return void
     */
    public function store(Request $request)
    {
        try {
            // validar campos en un archivo aparte para reutilizarlo.
            $validate = (new PedidoRequest())->validateField($request);

            if ($validate === true) {

                $pedido = Pedido::create($request->all());
                $data = $pedido->with('cuenta')->find($pedido->id)->toArray();

                broadcast(new EventPedidos($data))->toOthers();

                return response()->json(['pedido' => $pedido], 201);
            } else {
                return response()->json($validate, 406);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage(), 'line' => $e->getLine(), 'type' => get_class($e)], 500);
        }
    }
    /**
     * Method show
     *
     * @param Pedido $pedido [explicite description]
     *
     * @return void
     */
    public function show(Pedido $pedido)
    {
        try {
            return response()->json($pedido, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage(), 'line' => $e->getLine(), 'type' => get_class($e)], 500);
        }
    }

    /**
     * Method update
     *
     * @param Request $request [explicite description]
     * @param Pedido $pedido [explicite description]
     *
     * @return void
     */
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

    /**
     * Method destroy
     *
     * @param Pedido $pedido [explicite description]
     *
     * @return void
     */
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
