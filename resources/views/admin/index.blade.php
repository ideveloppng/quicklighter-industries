@extends('layouts.admin')

@section('admin_content')
<div class="space-y-12 pb-20 uppercase tracking-tight">
    
    <!-- HEADER AREA -->
    <div class="mb-10">
        <h1 class="text-3xl lg:text-4xl font-black text-slate-900 tracking-tighter uppercase leading-none">Dashboard Overview</h1>
        <p class="text-slate-500 text-[10px] font-black uppercase tracking-widest mt-3 border-l-4 border-brand-orange pl-4">Real-time business performance analytics</p>
    </div>

    <!-- STATS GRID -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-white p-8 border border-slate-200 rounded-sm shadow-sm">
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-4">Total Revenue (Approved)</p>
            <h3 class="text-3xl font-black text-slate-900">₦ {{ number_format($revenue, 0) }}</h3>
            <p class="text-[9px] font-bold text-green-600 mt-4 uppercase tracking-tighter border-t border-slate-50 pt-2">Cleared Assets</p>
        </div>
        <div class="bg-white p-8 border border-slate-200 rounded-sm shadow-sm">
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-4">Pending Deployments</p>
            <h3 class="text-3xl font-black text-slate-900">{{ $pendingOrders }}</h3>
            <p class="text-[9px] font-bold text-brand-orange mt-4 uppercase tracking-tighter border-t border-slate-50 pt-2">Awaiting Logistics</p>
        </div>
        <div class="bg-white p-8 border border-slate-200 rounded-sm shadow-sm">
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-4">Inventory Level</p>
            <h3 class="text-3xl font-black text-slate-900">{{ number_format($inventoryLevel) }}</h3>
            <p class="text-[9px] font-bold text-slate-400 mt-4 uppercase tracking-tighter border-t border-slate-50 pt-2">Units in Stock</p>
        </div>
        <div class="bg-white p-8 border border-slate-200 rounded-sm shadow-sm">
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-4">Authorized Resellers</p>
            <h3 class="text-3xl font-black text-slate-900">{{ $resellerCount }}</h3>
            <p class="text-[9px] font-bold text-slate-400 mt-4 uppercase tracking-tighter border-t border-slate-50 pt-2">Nationwide Nodes</p>
        </div>
    </div>

    <!-- DATA TABLES GRID -->
    <div class="grid lg:grid-cols-2 gap-10">
        
        <!-- RECENT LOGISTICS (ORDERS) -->
        <div class="bg-white border border-slate-200 rounded-sm shadow-sm overflow-hidden flex flex-col">
            <div class="p-6 border-b border-slate-100 flex justify-between items-center bg-slate-50/50">
                <h4 class="font-black text-slate-900 uppercase text-[10px] tracking-[0.2em]">Recent Deployments</h4>
                <a href="{{ route('admin.orders') }}" class="text-[9px] font-black text-brand-orange uppercase tracking-widest hover:underline">View All Manifests</a>
            </div>
            <div class="overflow-x-auto flex-1">
                <table class="w-full text-left border-collapse">
                    <tbody class="divide-y divide-slate-100 font-bold text-[11px]">
                        @forelse($recentOrders as $order)
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-6 py-5">
                                <a href="{{ route('admin.orders.show', $order) }}" class="font-black text-slate-900 border-b-2 border-transparent hover:border-brand-orange transition-all">#{{ $order->order_number }}</a>
                                <p class="text-[8px] text-slate-400 mt-0.5 uppercase tracking-tighter">{{ $order->created_at->format('d M | H:i') }}</p>
                            </td>
                            <td class="px-6 py-5">
                                <span class="text-slate-700 uppercase">{{ $order->first_name }}</span>
                                <p class="text-[8px] text-slate-400 uppercase">{{ $order->state }}</p>
                            </td>
                            <td class="px-6 py-5 text-right">
                                <span class="text-[8px] font-black px-2 py-0.5 rounded-sm {{ $order->status == 'delivered' ? 'bg-green-100 text-green-700' : 'bg-slate-100 text-slate-500' }}">
                                    {{ $order->status }}
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="3" class="px-6 py-10 text-center text-slate-300 text-[10px] font-black">No Manifests Found</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- RECENT TRANSACTIONS (PAYMENTS) -->
        <div class="bg-white border border-slate-200 rounded-sm shadow-sm overflow-hidden flex flex-col">
            <div class="p-6 border-b border-slate-100 flex justify-between items-center bg-slate-50/50">
                <h4 class="font-black text-slate-900 uppercase text-[10px] tracking-[0.2em]">Financial Activity</h4>
                <a href="{{ route('admin.payments') }}" class="text-[9px] font-black text-brand-orange uppercase tracking-widest hover:underline">View All Transactions</a>
            </div>
            <div class="overflow-x-auto flex-1">
                <table class="w-full text-left border-collapse">
                    <tbody class="divide-y divide-slate-100 font-bold text-[11px]">
                        @forelse($recentTransactions as $tx)
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-6 py-5">
                                <p class="text-slate-900 font-black tracking-tighter">₦{{ number_format($tx->total_amount) }}</p>
                                <p class="text-[8px] text-slate-400 mt-0.5 uppercase tracking-tighter">Order #{{ $tx->order_number }}</p>
                            </td>
                            <td class="px-6 py-5 text-center">
                                <a href="{{ asset('storage/' . $tx->payment_proof) }}" target="_blank" class="bg-slate-100 px-3 py-1 text-brand-dark text-[8px] font-black tracking-widest hover:bg-brand-orange hover:text-white transition-all rounded-sm">REVERIFY</a>
                            </td>
                            <td class="px-6 py-5 text-right">
                                <span class="text-[8px] font-black px-2 py-0.5 rounded-sm {{ $tx->payment_status == 'approved' ? 'bg-green-600 text-white' : 'bg-brand-orange text-white' }}">
                                    {{ $tx->payment_status }}
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="3" class="px-6 py-10 text-center text-slate-300 text-[10px] font-black">No Transaction Data</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>

</div>
@endsection