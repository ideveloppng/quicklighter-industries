@extends('layouts.admin')

@section('admin_content')
<div class="space-y-10">
    
    <!-- HEADER -->
    <div>
        <h1 class="text-3xl font-black text-slate-900 tracking-tighter uppercase leading-none">Category Registry</h1>
        <p class="text-slate-500 text-[10px] font-black uppercase tracking-widest mt-3 border-l-2 border-brand-orange pl-3">
            System Taxonomy & Classification
        </p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
        
        <!-- LEFT: CREATE FORM (4 Cols) -->
        <div class="lg:col-span-4">
            <div class="bg-white border border-slate-200 p-8 rounded-sm sticky top-28">
                <h3 class="text-lg font-black text-slate-900 uppercase tracking-tight mb-6">Register Category</h3>
                
                <form action="{{ route('admin.categories.store') }}" method="POST" class="space-y-6">
                    @csrf
                    <div class="space-y-2">
                        <label class="text-[10px] font-black uppercase tracking-widest text-slate-400">Category Name</label>
                        <input type="text" name="name" required placeholder="e.g. INDUSTRIAL STOVES" 
                               class="w-full bg-slate-50 border border-slate-200 px-5 py-4 font-bold text-slate-900 focus:outline-none focus:border-brand-orange transition-all uppercase text-xs tracking-widest">
                    </div>

                    <button type="submit" class="w-full bg-brand-dark text-white py-5 font-black uppercase tracking-[0.2em] text-[10px] hover:bg-brand-orange transition-all shadow-lg">
                        Authorize Category
                    </button>
                </form>
            </div>
        </div>

        <!-- RIGHT: CATEGORY LIST (8 Cols) -->
        <div class="lg:col-span-8">
            <div class="bg-white border border-slate-200 rounded-sm overflow-hidden">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-100">
                            <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest">Category Name</th>
                            <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">Linked Units</th>
                            <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest text-right">Control</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($categories as $category)
                        <tr class="group hover:bg-slate-50/50 transition-colors">
                            <td class="px-8 py-6">
                                <span class="text-sm font-black text-slate-900 uppercase tracking-tight">{{ $category->name }}</span>
                                <p class="text-[9px] text-slate-400 font-bold uppercase mt-1">Slug: {{ $category->slug }}</p>
                            </td>
                            <td class="px-8 py-6 text-center">
                                <span class="bg-slate-100 text-slate-600 px-3 py-1 rounded-full text-[10px] font-black uppercase">
                                    {{ $category->products_count }} Units
                                </span>
                            </td>
                            <td class="px-8 py-6 text-right">
                                @if($category->products_count == 0)
                                    <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" onsubmit="return confirm('Confirm category deletion?')">
                                        @csrf @method('DELETE')
                                        <button class="text-slate-300 hover:text-red-600 transition-colors">
                                            <svg class="w-5 h-5 ml-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </form>
                                @else
                                    <span title="Cannot delete category with active products" class="cursor-not-allowed opacity-20">
                                        <svg class="w-5 h-5 ml-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                                    </span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="px-8 py-20 text-center text-slate-400 uppercase text-[10px] font-black tracking-widest">
                                No classifications found in database.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
@endsection