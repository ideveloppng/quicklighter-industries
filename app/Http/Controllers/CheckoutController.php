<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\AdminNewOrderAlert;
use App\Mail\UserOrderUpdateNotification;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) { return redirect()->route('shop'); }
        $total = 0;
        foreach($cart as $item) { $total += $item['price'] * $item['quantity']; }
        return view('shop.checkout', compact('cart', 'total'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'email' => 'required|email|max:150',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:500',
            'state' => 'required|string|max:100',
            'city' => 'required|string|max:100',
            'payment_proof' => 'required|image|max:2048',
        ]);

        $cart = session()->get('cart');
        $total = 0;
        foreach($cart as $item) { $total += $item['price'] * $item['quantity']; }

        DB::beginTransaction();
        try {
            $proofPath = $request->file('payment_proof')->store('payment_proofs', 'public');
            $order = Order::create([
                'user_id' => auth()->id(),
                'order_number' => 'QL-' . strtoupper(Str::random(8)),
                'total_amount' => $total,
                'status' => 'pending',
                'payment_status' => 'pending',
                'payment_proof' => $proofPath,
                'payment_method' => 'bank_transfer',
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'state' => $request->state,
                'city' => $request->city,
            ]);

            foreach($cart as $id => $details) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $id,
                    'quantity' => $details['quantity'],
                    'price' => $details['price'],
                ]);
            }

            DB::commit();
            
            // --- EMAIL LOGIC START ---
            // 1. Alert Admin
            Mail::to('admin@quicklighter.com')->send(new AdminNewOrderAlert($order));
            
            // 2. Confirm to User
            Mail::to($order->email)->send(new UserOrderUpdateNotification($order, 'CONFIRMATION'));
            // --- EMAIL LOGIC END ---

            session()->forget('cart');
            return redirect()->route('checkout.success', $order->order_number);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return back()->withInput()->with('error', 'Logistics error: ' . $e->getMessage());
        }
    }

    public function success($order_number)
    {
        $order = Order::where('order_number', $order_number)->with('items.product')->firstOrFail();
        return view('shop.success', compact('order'));
    }

    public function receipt($order_number)
    {
        $order = Order::where('order_number', $order_number)->with('items.product')->firstOrFail();
        return view('shop.receipt', compact('order'));
    }
}