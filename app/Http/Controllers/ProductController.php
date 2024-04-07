<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Obtener todos los productos
        $products = Product::all();
        
        // Retornar una respuesta JSON con los productos
        return response()->json(['data' => $products], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validar los campos del producto
        $validatedData = $request->validate([
            'cate_id' => 'required|integer',
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'small_description' => 'required|string',
            'description' => 'required|string',
            'original_price' => 'required|string|max:255',
            'selling_price' => 'required|string|max:255',
            'image' => 'required|string|max:255',
            'qty' => 'required|string|max:255',
            'tax' => 'required|string|max:255',
            'status' => 'required|integer',
            'trending' => 'required|integer',
            'meta_title' => 'required|string',
            'meta_keyword' => 'required|string',
            'meta_description' => 'required|string',
        ]);

        // Crear un nuevo producto con los datos validados
        $product = Product::create($validatedData);

        // Retornar una respuesta JSON con el producto creado
        return response()->json(['data' => $product], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Buscar el producto por su ID
        $product = Product::find($id);

        // Verificar si el producto existe
        if (!$product) {
            // Retornar una respuesta JSON con un mensaje de error si el producto no se encuentra
            return response()->json(['error' => 'Product not found'], 404);
        }

        // Retornar una respuesta JSON con el producto encontrado
        return response()->json(['data' => $product], 200);
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
        // Buscar el producto por su ID
        $product = Product::find($id);

        // Verificar si el producto existe
        if (!$product) {
            // Retornar una respuesta JSON con un mensaje de error si el producto no se encuentra
            return response()->json(['error' => 'Product not found'], 404);
        }

        // Validar los campos del producto
        $validatedData = $request->validate([
            'cate_id' => 'required|integer',
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'small_description' => 'required|string',
            'description' => 'required|string',
            'original_price' => 'required|string|max:255',
            'selling_price' => 'required|string|max:255',
            'image' => 'required|string|max:255',
            'qty' => 'required|string|max:255',
            'tax' => 'required|string|max:255',
            'status' => 'required|integer',
            'trending' => 'required|integer',
            'meta_title' => 'required|string',
            'meta_keyword' => 'required|string',
            'meta_description' => 'required|string',
        ]);

        // Actualizar el producto con los datos validados
        $product->update($validatedData);

        // Retornar una respuesta JSON con el producto actualizado
        return response()->json(['data' => $product], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Buscar el producto por su ID
        $product = Product::find($id);

        // Verificar si el producto existe
        if (!$product) {
            // Retornar una respuesta JSON con un mensaje de error si el producto no se encuentra
            return response()->json(['error' => 'Product not found'], 404);
        }

        // Eliminar el producto
        $product->delete();

        // Retornar una respuesta JSON con un mensaje de éxito
        return response()->json(['message' => 'Product deleted successfully'], 204);
    }
}
