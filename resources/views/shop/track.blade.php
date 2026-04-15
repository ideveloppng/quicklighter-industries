@extends('layouts.app')

@section('content')
<div class="bg-white min-h-screen pb-20 uppercase tracking-tight">
    
    <!-- HEADER -->
    <section class="py-16 px-6 lg:px-20 bg-slate-50 border-b border-slate-100">
        <div class="max-w-[1440px] mx-auto">
            <span class="text-brand-orange font-black text-[10px] tracking-[0.4em]">Logistics Terminal</span>
            <h1 class="text-4xl lg:text-7xl font-black text-slate-900 mt-4 tracking-tighter leading-none">Track Deployment.</h1>
        </div>
    </section>

    <div class="max-w-[800px] mx-auto px-6 mt-16">
        
        <!-- SINGLE INPUT SEARCH FORM -->
        <div class="bg-white border border-slate-200 p-8 lg:p-12 shadow-sm rounded-sm mb-12">
            <form action="{{ route('track.search') }}" method="GET" class="space-y-6">
                <div class="space-y-3">
                    <label class="text-[10px] font-black text-slate-400 tracking-widest px-1">Order Reference Number</label>
                    <div class="flex flex-col md:flex-row gap-4">
                        <input type="text" name="order_number" value="{{ request('order_number') }}" required 
                               placeholder="ENTER REFERENCE (E.G. QL-XXXXXX)" 
                               class="flex-1 bg-slate-50 border border-slate-200 px-5 py-5 font-black text-slate-900 outline-none focus:border-brand-orange transition-all text-sm tracking-[0.2em] uppercase">
                        
                        <button type="submit" class="bg-brand-dark text-white px-10 py-5 font-black uppercase tracking-[0.3em] text-[10px] hover:bg-brand-orange transition-all duration-500 shadow-xl whitespace-nowrap">
                            Query Status
                        </button>
                    </div>
                </div>
            </form>

            @if(session('error'))
                <div class="mt-6 p-4 bg-red-50 border-l-4 border-red-600 text-red-700 text-[10px] font-black tracking-widest uppercase">
                    {{ session('error') }}
                </div>
            @endif
        </div>

        <!-- TRACKING RESULT AREA -->
        @if(isset($order))
            <div class="space-y-12">
                
                <!-- 1. STATUS TIMELINE -->
                <div class="relative bg-slate-900 p-10 rounded-sm overflow-hidden">
                    <div class="absolute top-1/2 left-0 w-full h-1 bg-white/10 -translate-y-1/2"></div>
                    
                    @php
                        $statuses = ['pending', 'processing', 'shipped', 'delivered'];
                        $currentIndex = array_search($order->status, $statuses);
                    @endphp

                    <div class="relative flex justify-between items-center">
                        @foreach($statuses as $index => $step)
                            <div class="flex flex-col items-center z-10">
                                <div class="w-8 h-8 rounded-full border-4 flex items-center justify-center transition-all duration-700 {{ $index <= $currentIndex ? 'bg-brand-orange border-brand-orange text-white' : 'bg-slate-800 border-slate-700 text-slate-500' }}">
                                    @if($index < $currentIndex)
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="4" d="M5 13l4 4L19 7"></path></svg>
                                    @else
                                        <span class="text-[10px] font-black">{{ $index + 1 }}</span>
                                    @endif
                                </div>
                                <span class="mt-4 text-[9px] font-black tracking-widest {{ $index <= $currentIndex ? 'text-brand-orange' : 'text-slate-500' }}">{{ strtoupper($step) }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- 2. DEPLOYMENT DETAILS -->
                <div class="bg-white border border-slate-200 rounded-sm shadow-sm overflow-hidden">
                    <div class="p-8 border-b border-slate-100 flex justify-between items-center bg-slate-50/50">
                        <h3 class="text-sm font-black text-slate-900 tracking-tighter">Reference ID: #{{ $order->order_number }}</h3>
                        <span class="px-3 py-1 rounded-sm text-[9px] font-black bg-brand-dark text-brand-orange tracking-widest uppercase">{{ $order->status }}</span>
                    </div>
                    
                    <div class="p-8 grid md:grid-cols-2 gap-10">
                        <div>
                            <span class="block text-[9px] font-black text-slate-400 tracking-widest mb-2">Registry Entity</span>
                            <p class="text-lg font-black text-slate-900">{{ $order->first_name }} {{ $order->last_name }}</p>
                        </div>
                        <div>
                            <span class="block text-[9px] font-black text-slate-400 tracking-widest mb-2">Target Coordinates</span>
                            <p class="text-sm font-bold text-slate-900 leading-relaxed uppercase">{{ $order->city }}, {{ $order->state }} State</p>
                        </div>
                        <div class="md:col-span-2 pt-6 border-t border-slate-100">
                            <span class="block text-[9px] font-black text-slate-400 tracking-widest mb-4">Unit Manifest</span>
                            <div class="space-y-3">
                                @foreach($order->items as $item)
                                    <div class="flex justify-between items-center font-bold text-[11px] bg-slate-50 p-3">
                                        <span class="text-slate-900">{{ $item->product->name }} (x{{ $item->quantity }})</span>
                                        <span class="text-slate-400">LOGGED</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        @endif

    </div>
</div>
@endsection