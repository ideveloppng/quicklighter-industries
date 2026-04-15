<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Reseller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserOrderUpdateNotification;

class AdminController extends Controller
{
    public function index()
    {
        $revenue = Order::where('payment_status', 'approved')->sum('total_amount');
        $pendingOrders = Order::where('status', 'pending')->count();
        $inventoryLevel = Product::sum('stock');
        $resellerCount = Reseller::count();
        $recentOrders = Order::latest()->take(5)->get();
        $recentTransactions = Order::whereNotNull('payment_proof')->latest()->take(5)->get();
        return view('admin.index', compact('revenue', 'pendingOrders', 'inventoryLevel', 'resellerCount', 'recentOrders', 'recentTransactions'));
    }

    public function updateOrderStatus(Request $request, Order $order)
    {
        $request->validate(['status' => 'required|in:pending,processing,shipped,delivered,cancelled']);
        $order->update(['status' => $request->status]);

        // Trigger User Email
        Mail::to($order->email)->send(new UserOrderUpdateNotification($order, 'LOGISTICS_UPDATE'));

        return back()->with('success', 'STATUS UPDATED & USER NOTIFIED.');
    }

    public function approvePayment(Order $order)
    {
        $order->update(['payment_status' => 'approved', 'status' => 'processing']);
        
        // Trigger User Email
        Mail::to($order->email)->send(new UserOrderUpdateNotification($order, 'PAYMENT_APPROVED'));

        return back()->with('success', 'PAYMENT APPROVED & USER NOTIFIED.');
    }

    public function rejectPayment(Order $order)
    {
        $order->update(['payment_status' => 'rejected']);
        
        // Trigger User Email
        Mail::to($order->email)->send(new UserOrderUpdateNotification($order, 'PAYMENT_REJECTED'));

        return back()->with('error', 'PAYMENT REJECTED & USER NOTIFIED.');
    }

    // Personnel Registry
    public function users() { $admins = User::where('is_admin', true)->get(); $users = User::where('is_admin', false)->paginate(20); return view('admin.users.index', compact('admins', 'users')); }
    public function toggleAdmin(User $user) { if ($user->id === auth()->id()) return back(); $user->update(['is_admin' => !$user->is_admin]); return back(); }
    public function showResetPassword(User $user) { return view('admin.users.reset-password', compact('user')); }
    public function updateUserPassword(Request $request, User $user) { $user->update(['password' => Hash::make($request->password)]); return redirect()->route('admin.users'); }
    public function destroyUser(User $user) { if ($user->id !== auth()->id()) $user->delete(); return back(); }

    // Other management methods (Inventory, resellers, etc)
    public function orders() { $orders = Order::latest()->paginate(15); return view('admin.orders.index', compact('orders')); }
    public function showOrder(Order $order) { $order->load('items.product'); return view('admin.orders.show', compact('order')); }
    public function payments() { $orders = Order::whereNotNull('payment_proof')->latest()->paginate(15); return view('admin.payments.index', compact('orders')); }
    public function resellers() { $resellers = Reseller::latest()->get(); $states = ['Abia', 'Abuja (FCT)', 'Adamawa', 'Akwa Ibom', 'Anambra', 'Bauchi', 'Bayelsa', 'Benue', 'Borno', 'Cross River', 'Delta', 'Ebonyi', 'Edo', 'Ekiti', 'Enugu', 'Gombe', 'Imo', 'Jigawa', 'Kaduna', 'Kano', 'Katsina', 'Kebbi', 'Kogi', 'Kwara', 'Lagos', 'Nasarawa', 'Niger', 'Ogun', 'Ondo', 'Osun', 'Oyo', 'Plateau', 'Rivers', 'Sokoto', 'Taraba', 'Yobe', 'Zamfara']; return view('admin.resellers.index', compact('resellers', 'states')); }
    public function storeReseller(Request $request) { Reseller::create($request->all()); return back(); }
    public function destroyReseller(Reseller $reseller) { $reseller->delete(); return back(); }
    public function applications() { $applications = \App\Models\ResellerApplication::latest()->paginate(15); return view('admin.applications.index', compact('applications')); }
    public function messages() { $messages = \App\Models\ContactMessage::latest()->paginate(15); return view('admin.messages.index', compact('messages')); }
    public function destroyApplication($id) { \App\Models\ResellerApplication::findOrFail($id)->delete(); return back(); }
    public function destroyMessage($id) { \App\Models\ContactMessage::findOrFail($id)->delete(); return back(); }
}