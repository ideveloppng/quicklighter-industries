<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index() {
        $cart = session()->get('cart', []);
        $total = 0;
        foreach($cart as $item) { $total += $item['price'] * $item['quantity']; }
        return view('shop.cart', compact('cart', 'total'));
    }

    public function add(Request $request, $id) {
        $product = Product::findOrFail($id);
        $cart = session()->get('cart', []);

        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "id" => $id,
                "name" => $product->name,
                "quantity" => 1,
                "price" => (float)$product->price,
                "image" => $product->images[0] ?? ''
            ];
        }

        session()->put('cart', $cart);
        
        // Return full cart data for Alpine to render instantly
        return response()->json([
            'message' => 'Success',
            'cart' => array_values($cart), // Convert to array for Javascript
            'cartCount' => count($cart),
            'itemQuantity' => $cart[$id]['quantity'],
            'total' => number_format(array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart)))
        ]);
    }

    public function update(Request $request) {
        if($request->id && $request->quantity) {
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
        }
        return back()->with('success', 'Registry Updated');
    }

    public function remove(Request $request) {
        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
        }
        return back()->with('success', 'Unit Removed');
    }
}