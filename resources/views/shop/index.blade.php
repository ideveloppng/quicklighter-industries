@extends('layouts.app')

@section('content')
<div class="bg-white min-h-screen">
    
    <section class="py-16 px-6 lg:px-20 bg-slate-50 border-b border-slate-100 uppercase">
        <div class="max-w-[1440px] mx-auto">
            <span class="text-brand-orange font-black text-[10px] tracking-[0.4em]">Official Catalog</span>
            <h1 class="text-4xl lg:text-7xl font-black text-slate-900 mt-4 tracking-tighter leading-none">Deployment Inventory.</h1>
            @if(request('search'))
                <div class="mt-8 flex items-center gap-4">
                    <span class="bg-brand-dark text-white px-4 py-1 text-[10px] font-black tracking-widest rounded-full">Results for: {{ request('search') }}</span>
                    <a href="{{ route('shop') }}" class="text-[10px] font-black tracking-widest text-brand-orange hover:underline">Reset</a>
                </div>
            @endif
        </div>
    </section>

    <div class="sticky top-20 z-40 bg-white/90 backdrop-blur-md border-b border-slate-100">
        <div class="max-w-[1440px] mx-auto px-6 lg:px-20 flex gap-8 overflow-x-auto no-scrollbar py-5 uppercase">
            <a href="{{ route('shop') }}" class="whitespace-nowrap text-[10px] font-black tracking-[0.2em] {{ !request('category') ? 'text-brand-orange border-b-2 border-brand-orange pb-1' : 'text-slate-400' }}">All Categories</a>
            @foreach($categories as $cat)
                <a href="{{ route('shop', ['category' => $cat->slug]) }}" class="whitespace-nowrap text-[10px] font-black tracking-[0.2em] {{ request('category') == $cat->slug ? 'text-brand-orange border-b-2 border-brand-orange pb-1' : 'text-slate-400' }}">{{ $cat->name }}</a>
            @endforeach
        </div>
    </div>

    <section class="py-20 px-6 lg:px-20 uppercase">
        <div class="max-w-[1440px] mx-auto">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-x-8 gap-y-16">
                @forelse($products as $product)
                @php $qty = isset(session('cart', [])[$product->id]) ? session('cart', [])[$product->id]['quantity'] : 0; @endphp
                <div class="flex flex-col group" x-data="{ added: false, qty: {{ $qty }}, async add() { this.added = true; const data = await window.addToCart({{ $product->id }}); this.qty = data.itemQuantity; setTimeout(() => this.added = false, 2000); } }">
                    <a href="{{ route('shop.show', $product->slug) }}" class="relative aspect-square bg-slate-100 border border-slate-100 overflow-hidden mb-6 block shadow-sm">
                        <div x-show="qty > 0" x-cloak class="absolute top-3 right-3 z-30 bg-brand-orange text-white px-2 py-1 font-black text-[8px] tracking-tighter shadow-xl">Qty: <span x-text="qty"></span></div>
                        <img src="{{ asset('storage/' . ($product->images[0] ?? '')) }}" class="w-full h-full object-cover group-hover:scale-105 transition-all">
                    </a>
                    <button @click="add()" :class="added ? 'bg-green-600' : 'bg-brand-dark hover:bg-brand-orange'" class="w-full text-white py-5 font-black text-[10px] tracking-[0.2em] transition-all mb-4 uppercase">Add to Deployment</button>
                    <div class="flex justify-between items-baseline px-1">
                        <div class="flex flex-col max-w-[70%]"><span class="text-[8px] font-black text-slate-400 tracking-widest mb-1">{{ $product->category->name }}</span><h3 class="text-sm font-black text-slate-900 truncate">{{ $product->name }}</h3></div>
                        <p class="text-base font-black text-slate-900 whitespace-nowrap">₦{{ number_format($product->price, 0) }}</p>
                    </div>
                </div>
                @empty
                <p class="col-span-full text-center text-slate-300 font-black text-[10px] py-32 border-2 border-dashed">Deployment Empty.</p>
                @endforelse
            </div>
            <div class="mt-20">{{ $products->links() }}</div>
        </div>
    </section>
</div>
@endsection