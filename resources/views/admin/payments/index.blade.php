@extends('layouts.admin')

@section('admin_content')
<div class="space-y-10 pb-20 uppercase">
    
    <div>
        <h1 class="text-3xl lg:text-4xl font-black text-slate-900 tracking-tighter leading-none">Financial Clearance</h1>
        <p class="text-slate-500 text-[10px] font-black tracking-widest mt-3 border-l-4 border-brand-orange pl-4">Verification of Bank Transfers</p>
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
                        <th class="px-8 py-6 text-[10px] font-black text-slate-400 tracking-widest">Payee Details</th>
                        <th class="px-8 py-6 text-[10px] font-black text-slate-400 tracking-widest text-center">Receipt Evidence</th>
                        <th class="px-8 py-6 text-[10px] font-black text-slate-400 tracking-widest text-right">Amount Payable</th>
                        <th class="px-8 py-6 text-[10px] font-black text-slate-400 tracking-widest text-center">Clearance Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach($orders as $order)
                    <tr class="hover:bg-slate-50/50 transition-all group">
                        <td class="px-8 py-6 text-sm font-black text-slate-900 tracking-tighter">#{{ $order->order_number }}</td>
                        <td class="px-8 py-6">
                            <p class="text-sm font-black text-slate-800">{{ $order->first_name }} {{ $order->last_name }}</p>
                            <p class="text-[9px] text-slate-400 font-bold tracking-widest mt-1">Ref: Bank Transfer</p>
                        </td>
                        <td class="px-8 py-6 text-center">
                            @if($order->payment_proof)
                                <a href="{{ asset('storage/' . $order->payment_proof) }}" target="_blank" class="inline-flex items-center gap-2 bg-slate-900 text-white px-4 py-2 text-[9px] font-black tracking-widest rounded-sm hover:bg-brand-orange transition-all">
                                    Verify Receipt <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                                </a>
                            @else
                                <span class="text-[9px] font-black text-slate-300">No Proof Uploaded</span>
                            @endif
                        </td>
                        <td class="px-8 py-6 text-right text-base font-black text-slate-900 tracking-tighter">
                            ₦{{ number_format($order->total_amount) }}
                        </td>
                        <td class="px-8 py-6">
                            <div class="flex items-center justify-center gap-2">
                                @if($order->payment_status == 'pending')
                                    <form action="{{ route('admin.payments.approve', $order) }}" method="POST">
                                        @csrf
                                        <button class="bg-green-600 text-white px-4 py-2 text-[9px] font-black tracking-widest hover:bg-green-700 transition-all">Authorize</button>
                                    </form>
                                    <form action="{{ route('admin.payments.reject', $order) }}" method="POST">
                                        @csrf
                                        <button class="bg-red-600 text-white px-4 py-2 text-[9px] font-black tracking-widest hover:bg-red-700 transition-all">Reject</button>
                                    </form>
                                @else
                                    <span class="text-[10px] font-black tracking-[0.2em] {{ $order->payment_status == 'approved' ? 'text-green-600' : 'text-red-600' }}">
                                        {{ $order->payment_status }}
                                    </span>
                                @endif
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