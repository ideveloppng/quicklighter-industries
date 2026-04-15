@extends('layouts.admin')

@section('admin_content')
<div class="space-y-10 pb-20 uppercase">
    
    <div>
        <h1 class="text-3xl lg:text-4xl font-black text-slate-900 tracking-tighter leading-none">Reseller Registry</h1>
        <p class="text-slate-500 text-[10px] font-black tracking-widest mt-3 border-l-4 border-brand-orange pl-4">Network Node Management</p>
    </div>

    <div class="grid lg:grid-cols-12 gap-10">
        
        <!-- Registration Form -->
        <div class="lg:col-span-4">
            <div class="bg-white border border-slate-200 p-8 sticky top-28 shadow-sm">
                <h3 class="text-xs font-black tracking-[0.3em] text-slate-400 mb-8 border-b border-slate-100 pb-4">Register New Node</h3>
                
                <form action="{{ route('admin.resellers.store') }}" method="POST" class="space-y-6">
                    @csrf
                    <div class="space-y-2">
                        <label class="text-[9px] font-black text-slate-400 tracking-widest">Business/Dealer Name</label>
                        <input type="text" name="name" required class="w-full bg-slate-50 border border-slate-100 px-4 py-4 font-bold text-[11px] tracking-widest outline-none focus:border-brand-orange transition-all">
                    </div>

                    <div class="space-y-2">
                        <label class="text-[9px] font-black text-slate-400 tracking-widest">Operating State</label>
                        <select name="state" required class="w-full bg-slate-50 border border-slate-100 px-4 py-4 font-bold text-[11px] tracking-widest outline-none focus:border-brand-orange appearance-none">
                            @foreach($states as $state)
                                <option value="{{ $state }}">{{ strtoupper($state) }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="space-y-2">
                        <label class="text-[9px] font-black text-slate-400 tracking-widest">Full Address</label>
                        <input type="text" name="location" required class="w-full bg-slate-50 border border-slate-100 px-4 py-4 font-bold text-[11px] tracking-widest outline-none focus:border-brand-orange">
                    </div>

                    <div class="space-y-2">
                        <label class="text-[9px] font-black text-slate-400 tracking-widest">Contact Phone</label>
                        <input type="text" name="phone" required class="w-full bg-slate-50 border border-slate-100 px-4 py-4 font-bold text-[11px] tracking-widest outline-none focus:border-brand-orange">
                    </div>

                    <div class="space-y-2">
                        <label class="text-[9px] font-black text-slate-400 tracking-widest">Official Email (Optional)</label>
                        <input type="email" name="email" class="w-full bg-slate-50 border border-slate-100 px-4 py-4 font-bold text-[11px] tracking-widest outline-none focus:border-brand-orange">
                    </div>

                    <button type="submit" class="w-full bg-brand-dark text-white py-5 font-black text-[10px] tracking-[0.3em] hover:bg-brand-orange transition-all shadow-xl">
                        Authorize Record
                    </button>
                </form>
            </div>
        </div>

        <!-- Registry List -->
        <div class="lg:col-span-8">
            <div class="bg-white border border-slate-200 rounded-sm overflow-hidden shadow-sm">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-100 text-[10px] font-black text-slate-400 tracking-widest">
                            <th class="px-8 py-6">Dealer Identity</th>
                            <th class="px-8 py-6">State</th>
                            <th class="px-8 py-6">Coordinates</th>
                            <th class="px-8 py-6 text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 font-bold text-[11px]">
                        @forelse($resellers as $reseller)
                        <tr class="hover:bg-slate-50/50 transition-all group">
                            <td class="px-8 py-6">
                                <p class="text-slate-900 font-black tracking-tight">{{ $reseller->name }}</p>
                                <p class="text-slate-400 mt-1">{{ $reseller->email ?? 'NO EMAIL' }}</p>
                            </td>
                            <td class="px-8 py-6">
                                <span class="bg-slate-100 px-3 py-1 rounded-full text-[9px] font-black">{{ $reseller->state }}</span>
                            </td>
                            <td class="px-8 py-6">
                                <p class="text-slate-900">{{ $reseller->phone }}</p>
                                <p class="text-slate-400 text-[9px] mt-1">{{ Str::limit($reseller->location, 30) }}</p>
                            </td>
                            <td class="px-8 py-6 text-right">
                                <form action="{{ route('admin.resellers.destroy', $reseller) }}" method="POST" onsubmit="return confirm('Secure Disposal of Record?')">
                                    @csrf @method('DELETE')
                                    <button class="text-slate-300 hover:text-red-600 transition-colors">
                                        <svg class="w-5 h-5 ml-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-8 py-20 text-center text-slate-400 font-black text-[10px] tracking-widest uppercase">No verified resellers in registry.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
@endsection