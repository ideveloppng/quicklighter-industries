@extends('layouts.admin')

@section('admin_content')
<div class="space-y-10 pb-20">
    
    <!-- HEADER AREA -->
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-8">
        <div>
            <h1 class="text-3xl lg:text-4xl font-black text-slate-900 tracking-tighter uppercase leading-none">Inventory Control</h1>
            <p class="text-slate-500 text-[10px] font-black uppercase tracking-widest mt-3 border-l-4 border-brand-orange pl-4">
                Total Managed Units: {{ $products->total() }}
            </p>
        </div>
        <a href="{{ route('admin.products.create') }}" class="inline-flex items-center justify-center gap-3 bg-brand-dark text-white px-8 py-5 rounded-sm font-black text-[10px] uppercase tracking-[0.2em] hover:bg-brand-orange transition-all duration-300 shadow-xl">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"></path></svg>
            Register New Unit
        </a>
    </div>

    <!-- STATUS ALERTS (Success messages from Controller) -->
    @if(session('success'))
    <div class="p-5 bg-green-50 border-l-4 border-green-600 flex items-center justify-between">
        <div class="flex items-center gap-3">
            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
            <p class="text-[10px] font-black text-green-800 uppercase tracking-widest">{{ session('success') }}</p>
        </div>
    </div>
    @endif

    <!-- INVENTORY REGISTRY TABLE -->
    <div class="bg-white border border-slate-200 rounded-sm shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-100">
                        <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-widest">Visual ID</th>
                        <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-widest">Model Specifications</th>
                        <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-widest">Stock Level</th>
                        <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-widest text-right">Unit Price</th>
                        <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">Operation</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($products as $product)
                    <tr class="hover:bg-slate-50/50 transition-colors group">
                        <!-- Thumbnail -->
                        <td class="px-8 py-5">
                            <div class="w-20 h-20 bg-slate-100 border border-slate-200 rounded-sm overflow-hidden p-1">
                                @if($product->images && count($product->images) > 0)
                                    <img src="{{ asset('storage/' . $product->images[0]) }}" class="w-full h-full object-cover rounded-sm grayscale group-hover:grayscale-0 transition-all duration-500">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-slate-300">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    </div>
                                @endif
                            </div>
                        </td>

                        <!-- Name & Category -->
                        <td class="px-8 py-5">
                            <div class="space-y-1">
                                <h3 class="text-sm font-black text-slate-900 uppercase tracking-tight">{{ $product->name }}</h3>
                                <div class="flex items-center gap-2">
                                    <span class="text-[9px] font-bold text-brand-orange uppercase tracking-widest">{{ $product->category->name ?? 'Unclassified' }}</span>
                                    @if($product->is_featured)
                                        <span class="w-1 h-1 bg-slate-300 rounded-full"></span>
                                        <span class="text-[8px] font-black text-blue-600 uppercase tracking-widest">Featured</span>
                                    @endif
                                </div>
                            </div>
                        </td>

                        <!-- Stock Status -->
                        <td class="px-8 py-5">
                            <div class="flex flex-col gap-1.5">
                                <span class="text-sm font-black text-slate-700 tracking-widest">{{ $product->stock }} UNITS</span>
                                @if($product->stock <= 5)
                                    <span class="inline-flex w-fit bg-red-100 text-red-700 text-[8px] font-black px-2 py-0.5 rounded-sm uppercase tracking-tighter">Critical Inventory</span>
                                @else
                                    <span class="inline-flex w-fit bg-green-100 text-green-700 text-[8px] font-black px-2 py-0.5 rounded-sm uppercase tracking-tighter">Operational</span>
                                @endif
                            </div>
                        </td>

                        <!-- Price (Naira sign matching weight) -->
                        <td class="px-8 py-5 text-right font-black text-slate-900 text-lg">
                            <span class="tracking-tighter">₦{{ number_format($product->price, 0) }}</span>
                        </td>

                        <!-- Action Controls -->
                        <td class="px-8 py-5">
                            <div class="flex items-center justify-center gap-2 lg:opacity-20 lg:group-hover:opacity-100 transition-all duration-300">
                                <!-- Edit -->
                                <a href="{{ route('admin.products.edit', $product) }}" class="p-3 text-slate-400 hover:text-brand-dark hover:bg-slate-100 rounded-sm transition-all" title="Modify Configuration">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2.828 2.828 0 114 4L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                </a>
                                
                                <!-- Delete -->
                                <form action="{{ route('admin.products.destroy', $product) }}" method="POST" onsubmit="return confirm('AUTHORIZE UNIT DECOMMISSIONING? THIS ACTION IS PERMANENT.')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-3 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded-sm transition-all" title="Secure Disposal">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-8 py-32 text-center">
                            <div class="flex flex-col items-center">
                                <div class="w-16 h-16 bg-slate-50 flex items-center justify-center rounded-full mb-6">
                                    <svg class="w-8 h-8 text-slate-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                                </div>
                                <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.3em]">Digital Warehouse Empty</p>
                                <p class="text-xs font-bold text-slate-300 uppercase mt-2">No units registered in current deployment cycle</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- PAGINATION CONTROLS -->
        @if($products->hasPages())
        <div class="p-8 bg-slate-50 border-t border-slate-100">
            {{ $products->links() }}
        </div>
        @endif
    </div>
</div>
@endsection