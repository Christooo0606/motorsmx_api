<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderItem;

class OrderItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Aquí podrías retornar una lista de todos los elementos de pedido
        $orderItems = OrderItem::all();
        return response()->json($orderItems, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validación de los campos del elemento de pedido
        $request->validate([
            'order_id' => 'required|string|max:255',
            'prod_id' => 'required|string|max:255',
            'qty' => 'required|integer',
            'price' => 'required|numeric',
        ]);

        // Crear un nuevo elemento de pedido con los datos del request
        $orderItem = OrderItem::create($request->all());

        // Retornar el elemento de pedido creado
        return response()->json($orderItem, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Aquí podrías buscar y mostrar un elemento de pedido específico por su ID
        $orderItem = OrderItem::find($id);
        if (!$orderItem) {
            return response()->json(['message' => 'Order Item not found'], 404);
        }
        return response()->json($orderItem, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validación de los campos del elemento de pedido
        $request->validate([
            'order_id' => 'required|string|max:255',
            'prod_id' => 'required|string|max:255',
            'qty' => 'required|integer',
            'price' => 'required|numeric',
        ]);

        // Buscar el elemento de pedido con el ID especificado
        $orderItem = OrderItem::find($id);
        if (!$orderItem) {
            return response()->json(['message' => 'Order Item not found'], 404);
        }
        
        // Actualizar el elemento de pedido con los datos del request
        $orderItem->update($request->all());

        // Retornar el elemento de pedido actualizado
        return response()->json($orderItem, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Buscar el elemento de pedido con el ID especificado
        $orderItem = OrderItem::find($id);
        if (!$orderItem) {
            return response()->json(['message' => 'Order Item not found'], 404);
        }
        
        // Eliminar el elemento de pedido
        $orderItem->delete();

        // Retornar una respuesta de éxito
        return response()->json(null, 204);
    }
}
