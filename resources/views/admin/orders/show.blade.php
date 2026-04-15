@extends('layouts.admin')

@section('admin_content')
<div class="max-w-6xl mx-auto pb-20 uppercase">
    
    <!-- HEADER -->
    <div class="mb-10 flex flex-col md:flex-row md:items-end justify-between gap-6">
        <div>
            <a href="{{ route('admin.orders') }}" class="inline-flex items-center gap-2 text-[10px] font-black text-brand-orange tracking-widest mb-4 hover:gap-3 transition-all">
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7"></path></svg>
                Back to Manifest
            </a>
            <h1 class="text-3xl lg:text-4xl font-black text-slate-900 tracking-tighter leading-none">Deployment Detail</h1>
            <p class="text-slate-500 text-[10px] font-black tracking-widest mt-3 border-l-4 border-brand-orange pl-4">ID Reference: #{{ $order->order_number }}</p>
        </div>
        
        <!-- STATUS CONTROL -->
        <div class="bg-slate-100 p-4 rounded-sm flex items-center gap-6 border border-slate-200">
            <div>
                <span class="block text-[8px] font-black text-slate-400 tracking-widest mb-1">Current State</span>
                <span class="text-xs font-black text-slate-900">{{ strtoupper($order->status) }}</span>
            </div>
            <form action="{{ route('admin.orders.updateStatus', $order) }}" method="POST">
                @csrf @method('PUT')
                <select name="status" onchange="this.form.submit()" class="bg-white border border-slate-200 text-[9px] font-black tracking-widest p-2 rounded-sm focus:ring-brand-orange outline-none">
                    <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>PENDING</option>
                    <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>PROCESSING</option>
                    <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>SHIPPED</option>
                    <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>DELIVERED</option>
                    <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>CANCELLED</option>
                </select>
            </form>
        </div>
    </div>

    <div class="grid lg:grid-cols-12 gap-8">
        
        <!-- LEFT: LOGISTICS PROFILE -->
        <div class="lg:col-span-8 space-y-8">
            
            <!-- Shipping Info Card -->
            <div class="bg-white border border-slate-200 rounded-sm shadow-sm p-8 lg:p-12">
                <h3 class="text-xs font-black tracking-[0.3em] text-slate-400 mb-8 border-b border-slate-100 pb-4 uppercase">1. Personnel & Logistics Coordinates</h3>
                
                <div class="grid md:grid-cols-2 gap-12">
                    <div>
                        <span class="block text-[9px] font-black text-slate-400 tracking-widest mb-2">Recipient Name</span>
                        <p class="text-lg font-black text-slate-900 tracking-tight">{{ $order->first_name }} {{ $order->last_name }}</p>
                    </div>
                    <div>
                        <span class="block text-[9px] font-black text-slate-400 tracking-widest mb-2">Communication Channel</span>
                        <p class="text-sm font-bold text-slate-900">{{ $order->email }}</p>
                        <p class="text-sm font-bold text-slate-900 mt-1 tracking-widest">{{ $order->phone }}</p>
                    </div>
                    <div class="md:col-span-2">
                        <span class="block text-[9px] font-black text-slate-400 tracking-widest mb-2">Deployment Address</span>
                        <p class="text-base font-bold text-slate-900 leading-relaxed">
                            {{ $order->address }}<br>
                            {{ $order->city }}, {{ $order->state }} State<br>
                            Nigeria.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Financial Manifest (Items) -->
            <div class="bg-white border border-slate-200 rounded-sm shadow-sm overflow-hidden">
                <div class="p-8 border-b border-slate-100 bg-slate-50 flex justify-between items-center">
                    <h3 class="text-xs font-black tracking-[0.3em] text-slate-900 uppercase">2. Deployment Manifest</h3>
                    <span class="bg-brand-dark text-white text-[9px] font-black px-3 py-1">{{ count($order->items) }} Units Prepared</span>
                </div>
                <table class="w-full text-left">
                    <thead>
                        <tr class="text-[9px] font-black text-slate-400 tracking-widest border-b border-slate-100">
                            <th class="px-8 py-5">System ID / Model</th>
                            <th class="px-8 py-5 text-center">Qty</th>
                            <th class="px-8 py-5 text-right">Unit Price</th>
                            <th class="px-8 py-5 text-right">Total</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 font-bold text-xs">
                        @foreach($order->items as $item)
                        <tr>
                            <td class="px-8 py-6">
                                <span class="text-slate-900 font-black uppercase">{{ $item->product->name }}</span>
                            </td>
                            <td class="px-8 py-6 text-center text-slate-500">x{{ $item->quantity }}</td>
                            <td class="px-8 py-6 text-right text-slate-500">₦{{ number_format($item->price) }}</td>
                            <td class="px-8 py-6 text-right font-black text-slate-900">₦{{ number_format($item->price * $item->quantity) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>

        <!-- RIGHT: FINANCIAL AUDIT -->
        <div class="lg:col-span-4 space-y-8">
            <div class="bg-slate-900 text-white p-8 lg:p-10 rounded-sm shadow-xl sticky top-28">
                <h3 class="text-[10px] font-black tracking-[0.4em] text-brand-orange mb-8 uppercase">Financial Clearance</h3>
                
                <div class="space-y-6">
                    <div class="flex justify-between items-end border-b border-white/10 pb-6">
                        <span class="text-[9px] font-black text-slate-400 tracking-widest">Payment Status</span>
                        <span class="text-xs font-black {{ $order->payment_status == 'approved' ? 'text-green-400' : 'text-brand-orange' }}">
                            {{ strtoupper($order->payment_status) }}
                        </span>
                    </div>

                    <div class="flex justify-between items-end">
                        <span class="text-[9px] font-black text-slate-400 tracking-widest uppercase">Grand Total</span>
                        <span class="text-3xl font-black text-white leading-none">₦{{ number_format($order->total_amount) }}</span>
                    </div>

                    @if($order->payment_proof)
                        <div class="pt-6 border-t border-white/10">
                            <span class="block text-[8px] font-black text-slate-400 tracking-widest mb-4">Evidence of Transfer</span>
                            <a href="{{ asset('storage/' . $order->payment_proof) }}" target="_blank" class="block group relative aspect-square overflow-hidden rounded-sm border border-white/20">
                                <img src="{{ asset('storage/' . $order->payment_proof) }}" class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-500">
                                <div class="absolute inset-0 bg-brand-dark/60 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                    <span class="text-[9px] font-black tracking-widest">Enlarge Asset</span>
                                </div>
                            </a>
                        </div>
                    @endif

                    @if($order->payment_status == 'pending')
                        <div class="grid gap-3 pt-6">
                            <form action="{{ route('admin.payments.approve', $order) }}" method="POST">
                                @csrf
                                <button class="w-full bg-green-600 py-4 font-black text-[9px] tracking-widest hover:bg-green-700 transition-all uppercase">Authorize Clearance</button>
                            </form>
                            <form action="{{ route('admin.payments.reject', $order) }}" method="POST">
                                @csrf
                                <button class="w-full border border-white/20 py-4 font-black text-[9px] tracking-widest hover:bg-red-600 transition-all uppercase">Reject Payment</button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        </div>

    </div>
</div>
@endsection