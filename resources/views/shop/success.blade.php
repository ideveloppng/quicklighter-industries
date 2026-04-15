@extends('layouts.app')

@section('content')
<div class="bg-white min-h-screen py-10 lg:py-20 uppercase tracking-tight">
    <div class="max-w-[800px] mx-auto px-6">
        
        <!-- SUCCESS HEADER -->
        <div class="text-center mb-12">
            <div class="w-20 h-20 bg-green-600 text-white flex items-center justify-center mx-auto mb-6 rounded-full shadow-xl">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
            </div>
            <h1 class="text-4xl font-black text-slate-900 tracking-tighter leading-tight uppercase">Deployment Logged.</h1>
            <p class="text-slate-500 font-bold text-[10px] tracking-widest mt-2 uppercase">Official Transaction Evidence Below</p>
        </div>

        <!-- THE RECEIPT (Technical Manifest) -->
        <div class="bg-white border-2 border-slate-900 shadow-2xl relative overflow-hidden">
            <!-- Diagonal Watermark -->
            <div class="absolute inset-0 flex items-center justify-center pointer-events-none opacity-[0.03] rotate-[-30deg]">
                <span class="text-9xl font-black">QUICKLIGHTER</span>
            </div>

            <!-- Receipt Header -->
            <div class="p-8 lg:p-12 border-b border-slate-100 flex flex-col md:flex-row justify-between items-start md:items-center gap-6 relative z-10">
                <div>
                    <h2 class="text-2xl font-black text-slate-900 tracking-tighter">TECHNICAL RECEIPT</h2>
                    <p class="text-[10px] font-black text-brand-orange tracking-[0.3em] mt-1">LOGISTICS ID: #{{ $order->order_number }}</p>
                </div>
                <div class="text-right">
                    <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Registry Date</p>
                    <p class="text-sm font-black text-slate-900">{{ $order->created_at->format('d M Y | H:i') }}</p>
                </div>
            </div>

            <!-- Entities Involved -->
            <div class="grid md:grid-cols-2 gap-px bg-slate-100 relative z-10">
                <div class="bg-white p-8 lg:p-10">
                    <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest block mb-4">Supplier Entity</span>
                    <p class="text-xs font-black text-slate-900 leading-relaxed uppercase">
                        QuickLighter Industries Ltd.<br>
                        Manufacturing Complex B,<br>
                        Lagos, Nigeria.
                    </p>
                </div>
                <div class="bg-white p-8 lg:p-10">
                    <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest block mb-4">Recipient Entity</span>
                    <p class="text-xs font-black text-slate-900 leading-relaxed uppercase">
                        {{ $order->first_name }} {{ $order->last_name }}<br>
                        {{ $order->address }}, {{ $order->city }}<br>
                        {{ $order->state }} State, Nigeria.
                    </p>
                </div>
            </div>

            <!-- Manifest Body -->
            <div class="p-8 lg:p-12 relative z-10">
                <table class="w-full text-left">
                    <thead>
                        <tr class="text-[9px] font-black text-slate-400 border-b border-slate-100 tracking-widest uppercase">
                            <th class="py-4">Unit Identification</th>
                            <th class="py-4 text-center">Qty</th>
                            <th class="py-4 text-right">Value</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @foreach($order->items as $item)
                        <tr class="font-bold text-xs uppercase">
                            <td class="py-6 text-slate-900 tracking-tight">{{ $item->product->name }}</td>
                            <td class="py-6 text-center text-slate-400">x{{ $item->quantity }}</td>
                            <td class="py-6 text-right text-slate-900">₦{{ number_format($item->price * $item->quantity) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr class="border-t-2 border-slate-900">
                            <td colspan="2" class="py-6 text-[10px] font-black text-slate-900 tracking-widest">AGGREGATE VALUE</td>
                            <td class="py-6 text-right text-xl font-black text-slate-900">₦{{ number_format($order->total_amount) }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <!-- Footer Metadata -->
            <div class="bg-slate-50 p-8 text-center relative z-10 border-t border-slate-100">
                <p class="text-[9px] font-black text-slate-400 tracking-[0.2em]">ELECTRONICALLY GENERATED LOGISTICS MANIFEST / NO SIGNATURE REQUIRED</p>
            </div>
        </div>

        <!-- CLOSE ACTIONS -->
        <div class="mt-12 flex flex-col md:flex-row gap-4">
            <a href="{{ route('shop') }}" class="flex-1 bg-brand-dark text-white py-5 text-center font-black text-[10px] uppercase tracking-[0.3em] hover:bg-brand-orange transition-all shadow-xl">
                Close & Return to Showroom
            </a>
            <button onclick="window.print()" class="flex-1 border-2 border-slate-900 py-5 font-black text-[10px] uppercase tracking-[0.3em] hover:bg-slate-900 hover:text-white transition-all">
                Download PDF Manifest
            </button>
        </div>

    </div>
</div>
@endsection