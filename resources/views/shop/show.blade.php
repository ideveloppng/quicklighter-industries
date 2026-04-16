@extends('layouts.app')

@section('content')
<style>
    /* Technical Description Internal Scrollbar for Macbook fold-optimization */
    .technical-description-scroll {
        max-height: 220px;
        overflow-y: auto;
        padding-right: 1rem;
    }
    .technical-description-scroll::-webkit-scrollbar { width: 4px; }
    .technical-description-scroll::-webkit-scrollbar-track { background: #f1f1f1; }
    .technical-description-scroll::-webkit-scrollbar-thumb { background: #D9480F; }

    /* Technical HTML rendering styles */
    .technical-description h1, .technical-description h2, .technical-description h3 { 
        font-weight: 900; color: #0f172a; margin-top: 1rem; margin-bottom: 0.5rem; 
        text-transform: uppercase; letter-spacing: 0.05em; font-size: 0.75rem; 
    }
    .technical-description ul { list-style-type: none !important; margin-top: 0.75rem; margin-bottom: 0.75rem; }
    .technical-description li { 
        position: relative; padding-left: 1.25rem; margin-bottom: 0.4rem; 
        font-weight: 700; color: #475569; font-size: 0.7rem; text-transform: uppercase; letter-spacing: 0.025em; 
    }
    .technical-description li::before { 
        content: ""; position: absolute; left: 0; top: 0.35rem; width: 5px; height: 5px; 
        background-color: #D9480F; 
    }
    .technical-description p { margin-bottom: 0.75rem; font-size: 0.75rem; font-weight: 600; color: #64748b; }
</style>

<div class="bg-white lg:h-[calc(100vh-96px)] overflow-hidden uppercase">
    @php 
        $cart = session('cart', []);
        $initialQty = isset($cart[$product->id]) ? $cart[$product->id]['quantity'] : 0; 
    @endphp

    <div class="max-w-[1440px] mx-auto px-6 lg:px-20 py-6 h-full" x-data="{ 
        qty: {{ $initialQty }}, 
        adding: false, 
        async add() { 
            this.adding = true; 
            const data = await window.addToCart({{ $product->id }}); 
            this.qty = data.itemQuantity; 
            setTimeout(() => this.adding = false, 2000); 
        } 
    }">
        
        <!-- COMPACT BACK BUTTON -->
        <div class="mb-4">
            <a href="{{ route('shop') }}" class="inline-flex items-center gap-2 text-[9px] font-black text-slate-400 tracking-[0.2em] group hover:text-brand-orange transition-all">
                <ion-icon name="arrow-back-outline" class="text-sm"></ion-icon>
                Back to Catalog
            </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-16 h-full">
            
            <!-- LEFT: TECHNICAL GALLERY -->
            <div class="lg:col-span-7 flex flex-col h-full overflow-hidden" x-data="{ activeImage: '{{ asset('storage/' . ($product->images[0] ?? '')) }}' }">
                <!-- Viewing Deck -->
                <div class="relative flex-1 bg-slate-50 border border-slate-100 overflow-hidden shadow-sm max-h-[400px] lg:max-h-none">
                    <div x-show="qty > 0" x-cloak class="absolute top-4 right-4 z-20 bg-brand-orange text-white px-4 py-2 font-black text-[10px] tracking-widest shadow-2xl">
                        Deployed: <span x-text="qty"></span> Units
                    </div>
                    <img :src="activeImage" class="w-full h-full object-cover transition-all duration-500">
                </div>

                <!-- Technical Angles (Thumbnails) -->
                <div class="grid grid-cols-6 gap-3 mt-4 shrink-0">
                    @foreach($product->images as $img)
                        <button @click="activeImage = '{{ asset('storage/' . $img) }}'" 
                                class="aspect-square border-2 transition-all overflow-hidden p-0.5 bg-white" 
                                :class="activeImage === '{{ asset('storage/' . $img) }}' ? 'border-brand-orange shadow-md' : 'border-slate-100 hover:border-slate-200'">
                            <img src="{{ asset('storage/' . $img) }}" class="w-full h-full object-cover">
                        </button>
                    @endforeach
                </div>
            </div>

            <!-- RIGHT: DATA HUB -->
            <div class="lg:col-span-5 flex flex-col h-full uppercase">
                
                <!-- PRODUCT IDENTITY -->
                <div class="mb-6 pb-6 border-b border-slate-100 shrink-0">
                    <span class="text-brand-orange font-black text-[9px] tracking-[0.4em]">{{ $product->category->name }}</span>
                    <h1 class="text-3xl lg:text-4xl font-black text-slate-900 mt-2 tracking-tighter leading-tight uppercase">{{ $product->name }}</h1>
                    
                    <div class="flex items-baseline gap-4 mt-4">
                        <p class="text-3xl font-black text-slate-900 tracking-tighter">₦{{ number_format($product->price, 0) }}</p>
                        @if($product->old_price)
                            <p class="text-lg text-slate-300 font-bold line-through tracking-tighter uppercase">₦{{ number_format($product->old_price, 0) }}</p>
                        @endif
                    </div>
                </div>

                <!-- SCROLLABLE TECHNICAL DESCRIPTION -->
                <div class="flex-1 overflow-hidden flex flex-col mb-6">
                    <span class="text-[9px] font-black text-slate-400 block mb-3 tracking-widest">Technical Description</span>
                    <div class="technical-description technical-description-scroll leading-relaxed">
                        {!! $product->description !!}
                    </div>
                </div>

                <!-- ACTION & STATUS BAR -->
                <div class="shrink-0 mt-auto space-y-4 bg-white pt-4">
                    <div class="grid grid-cols-2 gap-3">
                        <div class="bg-slate-50 p-4 border border-slate-100 text-center tracking-widest rounded-sm">
                            <span class="block text-[7px] font-black text-slate-400 mb-1">Stock Status</span>
                            <span class="text-[9px] font-black text-green-600 uppercase">{{ $product->stock > 0 ? 'Active Deployment' : 'Restocking' }}</span>
                        </div>
                        <div class="bg-slate-50 p-4 border border-slate-100 text-center tracking-widest rounded-sm">
                            <span class="block text-[7px] font-black text-slate-400 mb-1">Configuration</span>
                            <span class="text-[9px] font-black text-slate-900 uppercase">Modular Unit</span>
                        </div>
                    </div>

                    <button @click="add()" 
                            class="w-full bg-brand-dark text-white py-6 lg:py-7 font-black tracking-[0.4em] text-[11px] hover:bg-brand-orange transition-all duration-500 shadow-xl flex items-center justify-center gap-4">
                        <ion-icon name="add-circle-outline" class="text-xl text-brand-orange" x-show="!adding"></ion-icon>
                        <span x-text="adding ? 'PROCESSING...' : 'ADD TO CART'"></span>
                    </button>
                    
                    <p x-show="qty > 0" x-cloak class="text-center mt-2 text-[9px] font-black uppercase tracking-widest text-brand-orange">
                        Current manifest count: <span x-text="qty"></span> units
                    </p>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- COMPARABLE UNITS SECTION (Scrollable bottom area) -->
@if($related->count() > 0)
<section class="py-20 px-6 lg:px-20 bg-slate-50 border-t border-slate-100 uppercase tracking-tight">
    <div class="max-w-[1440px] mx-auto">
        <div class="mb-12">
            <span class="text-brand-orange font-black text-[10px] tracking-[0.4em]">Comparable Units</span>
            <h2 class="text-3xl font-black text-slate-900 mt-2 tracking-tighter uppercase">Alternative Configs.</h2>
        </div>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach($related as $rel)
                <a href="{{ route('shop.show', $rel->slug) }}" class="group block bg-white border border-slate-200 p-2 hover:shadow-xl transition-all duration-500">
                    <div class="aspect-square overflow-hidden mb-4 bg-slate-100">
                        <img src="{{ asset('storage/' . ($rel->images[0] ?? '')) }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    </div>
                    <div class="px-2 pb-4">
                        <h4 class="text-[10px] font-black uppercase tracking-tight text-slate-900 truncate">{{ $rel->name }}</h4>
                        <p class="text-sm font-black text-brand-orange mt-1">₦{{ number_format($rel->price, 0) }}</p>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>
@endif
@endsection