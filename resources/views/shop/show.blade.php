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

    /* Technical Styles */
    .technical-description h1, .technical-description h2, .technical-description h3 { 
        font-weight: 900; color: #0f172a; margin-top: 1rem; margin-bottom: 0.5rem; 
        text-transform: uppercase; letter-spacing: 0.05em; font-size: 0.75rem; 
    }
    .technical-description ul { list-style-type: none; margin-top: 0.75rem; margin-bottom: 0.75rem; }
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

<div class="bg-white lg:h-[calc(100vh-80px)] overflow-hidden uppercase">
    @php 
        $qty = isset(session('cart', [])[$product->id]) ? session('cart', [])[$product->id]['quantity'] : 0; 
    @endphp

    <div class="max-w-[1440px] mx-auto px-6 lg:px-20 py-6 h-full" x-data="{ 
        qty: {{ $qty }}, 
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
                <svg class="w-3 h-3 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7"></path></svg>
                Back to Catalog
            </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-16 h-full">
            
            <!-- LEFT: TECHNICAL GALLERY (Optimized for Fold) -->
            <div class="lg:col-span-7 flex flex-col h-full overflow-hidden" x-data="{ activeImage: '{{ asset('storage/' . ($product->images[0] ?? '')) }}' }">
                <!-- Main viewing area restricted to prevent push-down -->
                <div class="relative flex-1 bg-slate-50 border border-slate-100 overflow-hidden shadow-sm max-h-[400px] lg:max-h-none">
                    <div x-show="qty > 0" x-cloak class="absolute top-4 right-4 z-20 bg-brand-orange text-white px-4 py-2 font-black text-[10px] tracking-widest shadow-2xl">
                        Deployed: <span x-text="qty"></span> Units
                    </div>
                    <img :src="activeImage" class="w-full h-full object-cover transition-all duration-500">
                </div>

                <!-- Thumbnails - Kept Small -->
                <div class="grid grid-cols-6 gap-3 mt-4 shrink-0">
                    @foreach($product->images as $img)
                        <button @click="activeImage = '{{ asset('storage/' . $img) }}'" 
                                class="aspect-square border-2 transition-all overflow-hidden p-0.5 bg-white" 
                                :class="activeImage === '{{ asset('storage/' . $img) }}' ? 'border-brand-orange shadow-md' : 'border-slate-100 hover:border-slate-300'">
                            <img src="{{ asset('storage/' . $img) }}" class="w-full h-full object-cover">
                        </button>
                    @endforeach
                </div>
            </div>

            <!-- RIGHT: DATA HUB (Everything Visible on Macbook) -->
            <div class="lg:col-span-5 flex flex-col h-full">
                
                <!-- HEADER SECTION -->
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

                <!-- SCROLLABLE TECHNICAL BRIEF -->
                <div class="flex-1 overflow-hidden flex flex-col mb-6">
                    <span class="text-[9px] font-black text-slate-400 block mb-3 tracking-widest uppercase">Technical Description</span>
                    <div class="technical-description technical-description-scroll">
                        {!! $product->description !!}
                    </div>
                </div>

                <!-- STATUS & ACTION BAR (Locked to Bottom of Grid) -->
                <div class="shrink-0 mt-auto space-y-4">
                    <!-- Technical Meta Badges -->
                    <div class="grid grid-cols-2 gap-3">
                        <div class="bg-slate-50 p-4 border border-slate-100 text-center uppercase tracking-widest">
                            <span class="block text-[7px] font-black text-slate-400 mb-1">Stock Status</span>
                            <span class="text-[9px] font-black text-green-600 uppercase">{{ $product->stock > 0 ? 'Operational' : 'Restocking' }}</span>
                        </div>
                        <div class="bg-slate-50 p-4 border border-slate-100 text-center uppercase tracking-widest">
                            <span class="block text-[7px] font-black text-slate-400 mb-1">Configuration</span>
                            <span class="text-[9px] font-black text-slate-900 uppercase">Modular</span>
                        </div>
                    </div>

                    <!-- Add to Deployment CTA -->
                    <div class="pt-2">
                        <button @click="add()" 
                                class="w-full bg-brand-dark text-white py-6 lg:py-7 font-black tracking-[0.4em] text-[11px] hover:bg-brand-orange transition-all duration-500 shadow-xl flex items-center justify-center gap-4">
                            <svg x-show="!adding" class="w-5 h-5 text-brand-orange" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                            <span x-text="adding ? 'DEPLOYING UNIT...' : 'ADD TO DEPLOYMENT'"></span>
                        </button>
                        <p x-show="qty > 0" x-cloak class="text-center mt-4 text-[9px] font-black uppercase tracking-widest text-brand-orange">
                            Manifest Status: <span x-text="qty"></span> Units Prepared
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection