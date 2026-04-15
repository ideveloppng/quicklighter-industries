@extends('layouts.user')

@section('user_content')
<div class="space-y-12 pb-20 uppercase tracking-tight">
    
    <div class="mb-10">
        <h1 class="text-3xl lg:text-4xl font-black text-slate-900 tracking-tighter uppercase leading-none">Welcome, {{ explode(' ', Auth::user()->name)[0] }}</h1>
        <p class="text-slate-500 text-[10px] font-black uppercase tracking-widest mt-3 border-l-4 border-brand-orange pl-4">Account Activity Overview</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white p-8 border border-slate-200 rounded-sm shadow-sm">
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-4">Total Invested</p>
            <h3 class="text-3xl font-black text-slate-900">₦ {{ number_format($totalSpent, 0) }}</h3>
        </div>
        <div class="bg-white p-8 border border-slate-200 rounded-sm shadow-sm">
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-4">Active Deployments</p>
            <h3 class="text-3xl font-black text-slate-900">{{ $activeDeployments }}</h3>
        </div>
        <div class="bg-white p-8 border border-slate-200 rounded-sm shadow-sm">
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-4">Account Status</p>
            <h3 class="text-xl font-black text-green-600">VERIFIED</h3>
        </div>
    </div>

    <div class="bg-white border border-slate-200 rounded-sm shadow-sm overflow-hidden">
        <div class="p-6 border-b border-slate-100 flex justify-between items-center bg-slate-50/50">
            <h4 class="font-black text-slate-900 uppercase text-[10px] tracking-[0.2em]">Recent Orders</h4>
            <a href="{{ route('user.orders') }}" class="text-[9px] font-black text-brand-orange uppercase tracking-widest hover:underline">View All Orders</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-white text-[10px] font-black text-slate-400 border-b border-slate-100">
                        <th class="px-8 py-5">Order #</th>
                        <th class="px-8 py-5">Date</th>
                        <th class="px-8 py-5">Amount</th>
                        <th class="px-8 py-5 text-right">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 font-bold text-[11px]">
                    @forelse($recentOrders as $order)
                    <tr>
                        <td class="px-8 py-5"><a href="{{ route('user.orders.show', $order->order_number) }}" class="text-slate-900 font-black hover:text-brand-orange">#{{ $order->order_number }}</a></td>
                        <td class="px-8 py-5 text-slate-500">{{ $order->created_at->format('d M Y') }}</td>
                        <td class="px-8 py-5 text-slate-900">₦{{ number_format($order->total_amount) }}</td>
                        <td class="px-8 py-5 text-right">
                            <span class="px-2 py-1 text-[8px] font-black uppercase rounded-sm {{ $order->status == 'delivered' ? 'bg-green-50 text-green-600' : 'bg-slate-100 text-slate-500' }}">
                                {{ $order->status }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="4" class="px-8 py-10 text-center text-slate-300">No transactions recorded.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection