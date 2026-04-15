@extends('layouts.user')

@section('user_content')
<div class="space-y-10 pb-20 uppercase tracking-tight">
    
    <div>
        <h1 class="text-3xl font-black text-slate-900 tracking-tighter uppercase leading-none">Order Manifest</h1>
        <p class="text-slate-500 text-[10px] font-black uppercase tracking-widest mt-3 border-l-4 border-brand-orange pl-4">Deployment History & Status</p>
    </div>

    <div class="bg-white border border-slate-200 rounded-sm shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-100 text-[10px] font-black text-slate-400 tracking-widest">
                        <th class="px-8 py-6">Reference</th>
                        <th class="px-8 py-6 text-center">Value</th>
                        <th class="px-8 py-6 text-center">Payment</th>
                        <th class="px-8 py-6 text-center">Logistics</th>
                        <th class="px-8 py-6 text-right">Operation</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 font-bold text-[11px]">
                    @forelse($orders as $order)
                    <tr class="hover:bg-slate-50/50 transition-all group">
                        <td class="px-8 py-6">
                            <a href="{{ route('user.orders.show', $order->order_number) }}" class="text-sm font-black text-slate-900 hover:text-brand-orange transition-colors">#{{ $order->order_number }}</a>
                            <p class="text-[8px] text-slate-400 mt-1 uppercase tracking-tighter">{{ $order->created_at->format('d M Y') }}</p>
                        </td>
                        <td class="px-8 py-6 text-center text-slate-900 tracking-tighter">
                            ₦{{ number_format($order->total_amount) }}
                        </td>
                        <td class="px-8 py-6 text-center">
                            <span class="text-[9px] font-black px-2 py-0.5 rounded-sm {{ $order->payment_status == 'approved' ? 'bg-green-100 text-green-700' : 'bg-brand-orange/10 text-brand-orange' }}">
                                {{ strtoupper($order->payment_status) }}
                            </span>
                        </td>
                        <td class="px-8 py-6 text-center">
                            <span class="text-[9px] font-black text-slate-600 uppercase">{{ $order->status }}</span>
                        </td>
                        <td class="px-8 py-6 text-right">
                            <div class="flex items-center justify-end gap-3">
                                <!-- VIEW RECEIPT ACTION -->
                                <a href="{{ route('order.receipt', $order->order_number) }}" class="p-2 text-slate-400 hover:text-brand-orange transition-colors" title="Technical Receipt">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                </a>
                                <!-- TRACK BUTTON -->
                                <a href="{{ route('track.search', ['order_number' => $order->order_number]) }}" 
                                   class="inline-flex items-center gap-2 bg-brand-dark text-white px-4 py-2 text-[9px] font-black tracking-widest hover:bg-brand-orange transition-all duration-300">
                                    TRACK
                                </a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-8 py-20 text-center text-slate-300 font-black text-[10px] tracking-widest uppercase">No deployment history found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection