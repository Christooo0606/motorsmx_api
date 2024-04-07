<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;

class CartController extends Controller
{
    public function index()
    {
        $carts = Cart::all();
        return response()->json(['data' => $carts], 200);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required',
            'prod_id' => 'required',
            'prod_qty' => 'required|integer|min:1'
        ]);

        $cart = Cart::create($validatedData);
        return response()->json(['data' => $cart], 201);
    }

    public function show($id)
    {
        $cart = Cart::find($id);
        if (!$cart) {
            return response()->json(['error' => 'Cart not found'], 404);
        }
        return response()->json(['data' => $cart], 200);
    }

    public function update(Request $request, $id)
    {
        $cart = Cart::find($id);
        if (!$cart) {
            return response()->json(['error' => 'Cart not found'], 404);
        }

        $validatedData = $request->validate([
            'user_id' => 'required',
            'prod_id' => 'required',
            'prod_qty' => 'required|integer|min:1'
        ]);

        $cart->update($validatedData);
        return response()->json(['data' => $cart], 200);
    }

    public function destroy($id)
    {
        $cart = Cart::find($id);
        if (!$cart) {
            return response()->json(['error' => 'Cart not found'], 404);
        }
        $cart->delete();
        return response()->json(null, 204);
    }
}
