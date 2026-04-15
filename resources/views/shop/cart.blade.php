@extends('layouts.app')

@section('content')
<div class="bg-white min-h-screen pb-20">
    
    <section class="py-16 px-6 lg:px-20 bg-slate-50 border-b border-slate-100">
        <div class="max-w-[1440px] mx-auto">
            <!-- BACK BUTTON -->
            <div class="mb-6">
                <a href="{{ route('shop') }}" class="inline-flex items-center gap-3 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] group hover:text-brand-orange transition-all">
                    <svg class="w-4 h-4 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7"></path></svg>
                    Continue Shopping
                </a>
            </div>

            <span class="text-brand-orange font-black uppercase text-[10px] tracking-[0.4em]">Logistics Hub</span>
            <h1 class="text-4xl lg:text-6xl font-black text-slate-900 mt-4 tracking-tighter uppercase leading-none">Your Deployment.</h1>
        </div>
    </section>

    <section class="py-16 px-6 lg:px-20">
        <div class="max-w-[1440px] mx-auto grid lg:grid-cols-12 gap-16">
            
            <!-- Items List -->
            <div class="lg:col-span-8">
                @if(session('cart') && count(session('cart')) > 0)
                    <div class="space-y-8">
                        @foreach(session('cart') as $id => $details)
                            <div class="flex items-center gap-6 border-b border-slate-100 pb-8">
                                <div class="w-24 h-24 lg:w-32 lg:h-32 bg-slate-100 shrink-0 overflow-hidden rounded-sm">
                                    <img src="{{ asset('storage/' . $details['image']) }}" class="w-full h-full object-cover">
                                </div>
                                <div class="flex-1">
                                    <div class="flex justify-between items-start">
                                        <h3 class="text-lg font-black text-slate-900 uppercase tracking-tight">{{ $details['name'] }}</h3>
                                        <p class="font-black text-slate-900">₦{{ number_format($details['price'] * $details['quantity']) }}</p>
                                    </div>
                                    <div class="mt-4 flex items-center gap-6">
                                        <form action="{{ route('cart.update') }}" method="POST" class="flex items-center border border-slate-200">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $id }}">
                                            <input type="number" name="quantity" value="{{ $details['quantity'] }}" min="1" class="w-16 text-center font-bold border-none focus:ring-0 text-sm">
                                            <button class="bg-slate-50 px-4 py-2 border-l border-slate-200 hover:bg-brand-orange hover:text-white transition-colors">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                            </button>
                                        </form>
                                        <form action="{{ route('cart.remove') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $id }}">
                                            <button class="text-[10px] font-black text-red-600 uppercase tracking-widest hover:underline">Remove Unit</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="py-20 text-center border-2 border-dashed border-slate-100">
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Deployment manifest is empty.</p>
                        <a href="{{ route('shop') }}" class="mt-6 inline-block text-brand-orange font-black text-xs uppercase tracking-widest">Return to Shop &rarr;</a>
                    </div>
                @endif
            </div>

            <!-- Summary Card -->
            <div class="lg:col-span-4">
                <div class="bg-slate-900 p-8 lg:p-12 text-white sticky top-32">
                    <h2 class="text-2xl font-black uppercase tracking-tight mb-8">Summary</h2>
                    <div class="space-y-4 border-b border-white/10 pb-8 mb-8">
                        <div class="flex justify-between text-xs font-bold uppercase tracking-widest text-slate-400">
                            <span>Subtotal</span>
                            <span>₦{{ number_format($total) }}</span>
                        </div>
                        <div class="flex justify-between text-xs font-bold uppercase tracking-widest text-slate-400">
                            <span>Logistics</span>
                            <span>Calculated at next step</span>
                        </div>
                    </div>
                    <div class="flex justify-between items-end mb-10">
                        <span class="text-xs font-black uppercase tracking-widest">Total Payable</span>
                        <span class="text-3xl font-black text-brand-orange leading-none">₦{{ number_format($total) }}</span>
                    </div>
                    <!-- FIXED LINK BELOW -->
                    <a href="{{ route('checkout.index') }}" class="block w-full bg-brand-orange text-white py-6 text-center font-black uppercase tracking-[0.3em] text-[10px] hover:bg-white hover:text-brand-dark transition-all duration-300 shadow-xl">
                        Proceed to Checkout
                    </a>
                </div>
            </div>

        </div>
    </section>

</div>
@endsection