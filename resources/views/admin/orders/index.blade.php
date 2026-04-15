@extends('layouts.admin')

@section('admin_content')
<div class="space-y-10 pb-20 uppercase tracking-tight">
    
    <div>
        <h1 class="text-3xl lg:text-4xl font-black text-slate-900 tracking-tighter leading-none">Logistics Manifest</h1>
        <p class="text-slate-500 text-[10px] font-black tracking-widest mt-3 border-l-4 border-brand-orange pl-4">Deployment & Shipping Control</p>
    </div>

    @if(session('success'))
        <div class="p-4 bg-green-50 border-l-4 border-green-600 text-green-800 text-[10px] font-black tracking-widest">{{ session('success') }}</div>
    @endif

    <div class="bg-white border border-slate-200 rounded-sm overflow-hidden shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-100">
                        <th class="px-8 py-6 text-[10px] font-black text-slate-400 tracking-widest">Order ID</th>
                        <th class="px-8 py-6 text-[10px] font-black text-slate-400 tracking-widest">Customer Details</th>
                        <th class="px-8 py-6 text-[10px] font-black text-slate-400 tracking-widest text-center">Payment</th>
                        <th class="px-8 py-6 text-[10px] font-black text-slate-400 tracking-widest text-center">Logistics Status</th>
                        <th class="px-8 py-6 text-[10px] font-black text-slate-400 tracking-widest text-right">Operation</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 font-bold text-[11px]">
                    @foreach($orders as $order)
                    <tr class="hover:bg-slate-50/50 transition-all group">
                        <td class="px-8 py-6">
                            <a href="{{ route('admin.orders.show', $order) }}" class="group">
                                <span class="text-sm font-black text-slate-900 tracking-tighter border-b-2 border-transparent group-hover:border-brand-orange transition-all">#{{ $order->order_number }}</span>
                                <p class="text-[8px] text-slate-400 font-bold mt-1 uppercase">{{ $order->created_at->format('d M Y') }}</p>
                            </a>
                        </td>
                        <td class="px-8 py-6">
                            <p class="text-sm font-black text-slate-800">{{ $order->first_name }} {{ $order->last_name }}</p>
                            <p class="text-[9px] text-slate-400 font-bold tracking-widest mt-1 uppercase">{{ $order->state }} | {{ $order->phone }}</p>
                        </td>
                        <td class="px-8 py-6 text-center">
                            <span class="px-3 py-1 rounded-full text-[8px] font-black tracking-tighter {{ $order->payment_status == 'approved' ? 'bg-green-100 text-green-700' : 'bg-slate-100 text-slate-500' }}">
                                {{ strtoupper($order->payment_status) }}
                            </span>
                        </td>
                        <td class="px-8 py-6 text-center">
                            <form action="{{ route('admin.orders.updateStatus', $order) }}" method="POST" class="flex items-center justify-center">
                                @csrf @method('PUT')
                                <select name="status" onchange="this.form.submit()" class="bg-slate-100 border-none text-[9px] font-black tracking-widest p-2 rounded-sm focus:ring-brand-orange outline-none">
                                    <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>PENDING</option>
                                    <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>PROCESSING</option>
                                    <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>SHIPPED</option>
                                    <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>DELIVERED</option>
                                    <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>CANCELLED</option>
                                </select>
                            </form>
                        </td>
                        <td class="px-8 py-6 text-right">
                            <div class="flex justify-end gap-3 opacity-20 group-hover:opacity-100 transition-opacity">
                                <!-- VIEW RECEIPT ACTION -->
                                <a href="{{ route('order.receipt', $order->order_number) }}" class="p-2 text-slate-400 hover:text-brand-orange transition-colors" title="View Receipt">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                </a>
                                <a href="{{ route('admin.orders.show', $order) }}" class="p-2 text-slate-400 hover:text-brand-dark transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection