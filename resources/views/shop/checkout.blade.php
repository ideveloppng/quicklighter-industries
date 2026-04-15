@extends('layouts.app')

@section('content')
<div class="bg-white min-h-screen pb-20 uppercase">
    <section class="py-16 px-6 lg:px-20 bg-slate-50 border-b border-slate-100">
        <div class="max-w-[1440px] mx-auto">
            <h1 class="text-4xl lg:text-6xl font-black text-slate-900 tracking-tighter uppercase leading-none">Order Deployment.</h1>
        </div>
    </section>

    <!-- ERROR DISPLAY BLOCK -->
    @if ($errors->any() || session('error'))
        <div class="max-w-[1440px] mx-auto mt-10 px-6 lg:px-20">
            <div class="p-6 bg-red-50 border-l-4 border-red-600">
                <p class="text-[10px] font-black text-red-600 uppercase tracking-widest mb-2">Deployment Blocked / Validation Errors:</p>
                <ul class="space-y-1">
                    @if(session('error'))
                        <li class="text-xs font-bold text-red-700 tracking-tight">— {{ session('error') }}</li>
                    @endif
                    @foreach ($errors->all() as $error)
                        <li class="text-xs font-bold text-red-700 tracking-tight">— {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    <form action="{{ route('checkout.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <section class="py-16 px-6 lg:px-20">
            <div class="max-w-[1440px] mx-auto grid lg:grid-cols-12 gap-16">
                
                <!-- Left: Form -->
                <div class="lg:col-span-8 space-y-12">
                    
                    <!-- Shipping Info -->
                    <div class="space-y-8">
                        <h2 class="text-xl font-black uppercase tracking-widest border-l-4 border-brand-orange pl-4">1. Logistics Details</h2>
                        <div class="grid md:grid-cols-2 gap-6">
                            <input type="text" name="first_name" value="{{ old('first_name') }}" placeholder="FIRST NAME" required class="w-full bg-slate-50 border border-slate-200 px-6 py-4 font-bold text-xs tracking-widest outline-none focus:border-brand-orange">
                            <input type="text" name="last_name" value="{{ old('last_name') }}" placeholder="LAST NAME" required class="w-full bg-slate-50 border border-slate-200 px-6 py-4 font-bold text-xs tracking-widest outline-none focus:border-brand-orange">
                            <input type="email" name="email" value="{{ old('email') }}" placeholder="EMAIL ADDRESS" required class="w-full bg-slate-50 border border-slate-200 px-6 py-4 font-bold text-xs tracking-widest outline-none focus:border-brand-orange">
                            <input type="tel" name="phone" value="{{ old('phone') }}" placeholder="PHONE NUMBER" required class="w-full bg-slate-50 border border-slate-200 px-6 py-4 font-bold text-xs tracking-widest outline-none focus:border-brand-orange">
                            <div class="md:col-span-2">
                                <input type="text" name="address" value="{{ old('address') }}" placeholder="FULL DELIVERY ADDRESS" required class="w-full bg-slate-50 border border-slate-200 px-6 py-4 font-bold text-xs tracking-widest outline-none focus:border-brand-orange">
                            </div>
                            <input type="text" name="state" value="{{ old('state') }}" placeholder="STATE" required class="w-full bg-slate-50 border border-slate-200 px-6 py-4 font-bold text-xs tracking-widest outline-none focus:border-brand-orange">
                            <input type="text" name="city" value="{{ old('city') }}" placeholder="CITY" required class="w-full bg-slate-50 border border-slate-200 px-6 py-4 font-bold text-xs tracking-widest outline-none focus:border-brand-orange">
                        </div>
                    </div>

                    <!-- Bank Details Instructions -->
                    <div class="p-8 bg-brand-dark text-white rounded-sm shadow-xl">
                        <h2 class="text-lg font-black uppercase tracking-widest mb-6 text-brand-orange">2. Bank Transfer Instructions</h2>
                        <div class="space-y-4 font-bold text-sm tracking-widest uppercase">
                            <p>Bank: <span class="text-slate-400">GTBank</span></p>
                            <p>Account Name: <span class="text-slate-400">QuickLighter Industries Ltd</span></p>
                            <p>Account Number: <span class="text-slate-400">0123456789</span></p>
                            <div class="bg-white/5 p-6 border border-white/10 mt-6">
                                <p class="text-xs text-slate-400">Required Amount:</p>
                                <p class="text-brand-orange text-3xl font-black mt-1">₦{{ number_format($total) }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Proof Upload -->
                    <div class="space-y-6" x-data="{ preview: null }">
                        <h2 class="text-xl font-black uppercase tracking-widest border-l-4 border-brand-orange pl-4">3. Payment Verification</h2>
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Upload a screenshot or photo of your transfer receipt (Max 2MB)</p>
                        
                        <div class="relative border-2 border-dashed border-slate-200 p-12 text-center rounded-sm hover:border-brand-orange transition-all bg-slate-50/30">
                            <input type="file" name="payment_proof" required @change="preview = URL.createObjectURL($event.target.files[0])" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                            <div x-show="!preview" class="space-y-4">
                                <svg class="w-12 h-12 text-slate-200 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                <p class="text-[10px] font-black uppercase tracking-widest text-slate-400">Click to Attach Receipt Evidence</p>
                            </div>
                            <div x-show="preview" x-cloak class="relative inline-block">
                                <img :src="preview" class="max-h-64 mx-auto rounded-sm shadow-2xl border-4 border-white">
                                <p class="mt-4 text-[9px] font-black text-brand-orange tracking-widest uppercase">Asset Ready for Upload</p>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Right: Summary -->
                <div class="lg:col-span-4">
                    <div class="bg-white border border-slate-200 p-8 sticky top-32 shadow-sm">
                        <h3 class="text-lg font-black uppercase tracking-tight mb-8">Manifest Summary</h3>
                        <div class="space-y-5 mb-8">
                            @foreach($cart as $item)
                                <div class="flex justify-between items-start gap-4">
                                    <span class="text-[10px] font-bold uppercase tracking-widest text-slate-500 leading-tight">{{ $item['name'] }} (x{{ $item['quantity'] }})</span>
                                    <span class="text-xs font-black text-slate-900 whitespace-nowrap">₦{{ number_format($item['price'] * $item['quantity']) }}</span>
                                </div>
                            @endforeach
                        </div>
                        <div class="border-t border-slate-100 pt-6">
                            <div class="flex justify-between items-end">
                                <span class="text-[10px] font-black uppercase tracking-widest text-slate-400">Total Payable</span>
                                <span class="text-2xl font-black text-slate-900">₦{{ number_format($total) }}</span>
                            </div>
                        </div>
                        <button type="submit" class="w-full bg-brand-dark text-white py-6 mt-10 font-black uppercase tracking-[0.4em] text-xs hover:bg-brand-orange transition-all duration-500 shadow-xl">
                            Finalize Deployment
                        </button>
                        <p class="text-center mt-6 text-[8px] font-bold text-slate-400 uppercase tracking-widest leading-loose">
                            By clicking finalize, you verify that logistics details provided are accurate.
                        </p>
                    </div>
                </div>

            </div>
        </section>
    </form>
</div>
@endsection