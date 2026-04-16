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
        
        $total = array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart));

        return response()->json([
            'cart' => array_values($cart),
            'cartCount' => count($cart),
            'itemName' => $product->name,
            'total' => number_format($total)
        ]);
    }

    /**
     * FIXED: AJAX Update logic for Toast and Sidebar
     */
    public function updateQuantity(Request $request)
    {
        $cart = session()->get('cart', []);
        $id = $request->id;
        $action = $request->action;

        if(isset($cart[$id])) {
            if($action === 'inc') {
                $cart[$id]['quantity']++;
            } else {
                if($cart[$id]['quantity'] > 1) {
                    $cart[$id]['quantity']--;
                } else {
                    unset($cart[$id]);
                }
            }
            session()->put('cart', $cart);
        }

        $total = array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart));

        return response()->json([
            'cart' => array_values($cart),
            'cartCount' => count($cart),
            'total' => number_format($total)
        ]);
    }

    public function update(Request $request) {
        if($request->id && $request->quantity) {
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
        }
        return back();
    }

    public function remove(Request $request) {
        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
        }
        return back();
    }
}