<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class TrackingController extends Controller
{
    /**
     * Display the initial tracking terminal.
     */
    public function index()
    {
        return view('shop.track');
    }

    /**
     * Query the logistics registry by Reference only.
     */
    public function track(Request $request)
    {
        $request->validate([
            'order_number' => 'required|string',
        ]);

        // Unified search by Order Reference
        $order = Order::where('order_number', $request->order_number)
                      ->with('items.product')
                      ->first();

        if (!$order) {
            return back()->with('error', 'UNAUTHORIZED ACCESS: Order reference not found in logistics registry.');
        }

        return view('shop.track', compact('order'));
    }
}