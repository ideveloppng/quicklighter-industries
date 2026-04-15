<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserDashboardController extends Controller
{
    /**
     * User Overview
     */
    public function index()
    {
        $user = Auth::user();
        
        // Fetch real data for the user
        $recentOrders = Order::where('user_id', $user->id)
                             ->latest()
                             ->take(5)
                             ->get();
                             
        $totalSpent = Order::where('user_id', $user->id)
                           ->where('payment_status', 'approved')
                           ->sum('total_amount');
                           
        $activeDeployments = Order::where('user_id', $user->id)
                                  ->whereNotIn('status', ['delivered', 'cancelled'])
                                  ->count();

        return view('user.index', compact('recentOrders', 'totalSpent', 'activeDeployments'));
    }

    /**
     * User's Complete Order Manifest
     */
    public function orders()
    {
        $orders = Order::where('user_id', Auth::id())
                       ->latest()
                       ->paginate(10);
                       
        return view('user.orders.index', compact('orders'));
    }

    /**
     * Specific Deployment Detail
     */
    public function showOrder($order_number)
    {
        $order = Order::where('user_id', Auth::id())
                      ->where('order_number', $order_number)
                      ->with('items.product')
                      ->firstOrFail();

        return view('user.orders.show', compact('order'));
    }
}