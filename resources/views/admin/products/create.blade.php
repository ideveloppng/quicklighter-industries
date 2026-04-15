@extends('layouts.admin')

@section('admin_content')
<!-- Trix Editor Assets -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.js"></script>
<style>
    trix-editor { min-height: 250px !important; background-color: #f8fafc; border: 1px solid #e2e8f0 !important; border-radius: 2px; padding: 1rem !important; font-family: 'Inter', sans-serif; }
    trix-toolbar .trix-button-group { border-color: #e2e8f0 !important; }
</style>

<div class="max-w-4xl mx-auto pb-20 uppercase">
    
    <div class="mb-10">
        <a href="{{ route('admin.products') }}" class="inline-flex items-center gap-2 text-[10px] font-black text-brand-orange tracking-widest hover:gap-3 transition-all mb-4">
            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7"></path></svg>
            Return to Inventory Registry
        </a>
        <h1 class="text-3xl lg:text-4xl font-black text-slate-900 tracking-tighter uppercase leading-none">Register New Unit</h1>
        <p class="text-slate-500 text-[10px] font-black uppercase tracking-widest mt-3 border-l-4 border-brand-orange pl-4">Deployment Configuration Profile</p>
    </div>

    @if ($errors->any())
    <div class="mb-8 p-6 bg-red-50 border-l-4 border-red-600">
        <p class="text-[10px] font-black text-red-600 uppercase tracking-widest mb-2">Configuration Errors Detected:</p>
        <ul class="space-y-1">
            @foreach ($errors->all() as $error)
                <li class="text-xs font-bold text-red-700 tracking-tight">— {{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="bg-white border border-slate-200 shadow-sm rounded-sm overflow-hidden">
        @csrf

        <div class="p-8 lg:p-12 border-b border-slate-100">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                <div class="space-y-3 md:col-span-2">
                    <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 block px-1">Unit Model Name</label>
                    <input type="text" name="name" value="{{ old('name') }}" required class="w-full bg-slate-50 border border-slate-200 px-6 py-5 font-bold text-slate-900 focus:outline-none focus:border-brand-orange transition-all uppercase text-sm tracking-widest outline-none">
                </div>

                <div class="space-y-3">
                    <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 block px-1">Classification Category</label>
                    <select name="category_id" required class="w-full bg-slate-50 border border-slate-200 px-6 py-5 font-bold text-slate-900 focus:outline-none focus:border-brand-orange transition-all uppercase text-xs tracking-widest outline-none appearance-none">
                        <option value="">Select Category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="space-y-3">
                    <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 block px-1">Stock Level (Units)</label>
                    <input type="number" name="stock" value="{{ old('stock', 0) }}" required class="w-full bg-slate-50 border border-slate-200 px-6 py-5 font-bold text-slate-900 focus:outline-none focus:border-brand-orange transition-all tracking-widest outline-none">
                </div>
            </div>
        </div>

        <div class="p-8 lg:p-12 bg-slate-50/50 border-b border-slate-100">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                <div class="space-y-3">
                    <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 block px-1">Selling Price (₦)</label>
                    <input type="number" name="price" value="{{ old('price') }}" required class="w-full bg-white border border-slate-200 px-6 py-5 font-black text-slate-900 focus:outline-none focus:border-brand-orange transition-all tracking-widest outline-none text-lg">
                </div>
                <div class="space-y-3">
                    <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 block px-1">Strike-Through Price (₦)</label>
                    <input type="number" name="old_price" value="{{ old('old_price') }}" class="w-full bg-white border border-slate-200 px-6 py-5 font-bold text-slate-400 focus:outline-none focus:border-brand-orange transition-all tracking-widest outline-none text-lg">
                </div>

                <!-- RICH TEXT DESCRIPTION -->
                <div class="space-y-3 md:col-span-2">
                    <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 block px-1">Technical Specifications (Use Bullets for Features)</label>
                    <input id="description" type="hidden" name="description" value="{{ old('description') }}">
                    <trix-editor input="description" class="trix-content"></trix-editor>
                </div>
            </div>
        </div>

        <!-- SECTION 3: MEDIA ASSETS -->
        <div class="p-8 lg:p-12" x-data="{ previews: [], handleFiles(event) { const files = Array.from(event.target.files); this.previews = files.map(file => URL.createObjectURL(file)); } }">
            <div class="space-y-4">
                <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 block px-1">Visual Documentation (Upload Assets)</label>
                <div class="relative group">
                    <div class="border-2 border-dashed border-slate-200 group-hover:border-brand-orange transition-all rounded-sm p-12 text-center bg-slate-50/30">
                        <input type="file" name="images[]" multiple @change="handleFiles" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                        <div class="relative z-0">
                            <svg class="w-12 h-12 text-slate-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            <p class="text-xs font-black text-slate-600 uppercase tracking-[0.2em]">Select Multi-Angle Photos</p>
                        </div>
                    </div>
                </div>
                <template x-if="previews.length > 0">
                    <div class="mt-8 grid grid-cols-4 md:grid-cols-6 gap-4">
                        <template x-for="(src, index) in previews" :key="index">
                            <div class="aspect-square border border-slate-200 rounded-sm overflow-hidden"><img :src="src" class="w-full h-full object-cover"></div>
                        </template>
                    </div>
                </template>
            </div>

            <div class="mt-12 flex items-center justify-between p-6 bg-slate-50 border border-slate-100 rounded-sm">
                <div><p class="text-[11px] font-black text-slate-900 uppercase tracking-widest">Global Showcase</p></div>
                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" name="is_featured" value="1" class="sr-only peer">
                    <div class="w-14 h-7 bg-slate-300 rounded-full peer peer-checked:after:translate-x-full after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-brand-orange"></div>
                </label>
            </div>
        </div>

        <div class="p-8 lg:p-12 bg-slate-900">
            <button type="submit" class="w-full bg-brand-orange text-white py-6 lg:py-8 font-black uppercase tracking-[0.5em] text-xs hover:bg-white hover:text-brand-dark transition-all duration-500 shadow-2xl">Authorize Deployment</button>
        </div>
    </form>
</div>
@endsection