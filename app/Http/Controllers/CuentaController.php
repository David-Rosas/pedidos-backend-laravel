<?php

namespace App\Http\Controllers;

use App\Models\Cuenta;
use Illuminate\Http\Request;
use App\Http\Requests\CuentaRequest;

class CuentaController extends Controller
{    
    /**
     * Method index
     *
     * @return void
     */
    public function index()
    {
        try {
            $cuentas = Cuenta::with('pedidos')->get();
            return response()->json(['cuentas' => $cuentas], 200);
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
            $validate = (new CuentaRequest())->validateField($request);
            if ($validate === true) {
                $cuenta = Cuenta::create($request->all());
                return response()->json(['cuenta' => $cuenta], 201);
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
     * @param Cuenta $cuenta [explicite description]
     *
     * @return void
     */
    public function show(Cuenta $cuenta)
    {
        try {
            $cuentaConPedidos = $cuenta->with('pedidos')->get();
            return response()->json($cuentaConPedidos, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage(), 'line' => $e->getLine(), 'type' => get_class($e)], 500);
        }
    }
    
    /**
     * Method update
     *
     * @param Request $request [explicite description]
     * @param Cuenta $cuenta [explicite description]
     *
     * @return void
     */
    public function update(Request $request, Cuenta $cuenta)
    {
        try {
            // validar campos en un archivo aparte para reutilizarlo.
            $validate = (new CuentaRequest())->validateField($request);
            if ($validate === true) {
                //validar campo segun sea el caso para que no de errores de email unico
                if ($request->has('nombre') && !$request->has('email') && !$request->has('telefono')) {
                    $cuenta->update(['nombre' => $request->input('nombre')]);
                } elseif ($request->has('nombre') && $request->has('email')) {

                    if ($request->input('email') != $cuenta->email) {
                        $cuenta->update($request->only('nombre', 'email'));
                    } else {
                        $cuenta->update(['nombre' => $request->input('nombre')]);
                    }
                } elseif ($request->has('nombre') && $request->has('email') && $request->has('telefono')) {
                    $cuenta->update($request->all());
                }
                $cuenta->update($request->all());
                return response()->json($cuenta, 200);
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
     * @param Cuenta $cuenta [explicite description]
     *
     * @return void
     */
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
