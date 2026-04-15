@extends('layouts.admin')

@section('admin_content')
<div class="space-y-10 pb-20 uppercase">
    
    <div>
        <h1 class="text-3xl lg:text-4xl font-black text-slate-900 tracking-tighter leading-none">Intelligence Feed</h1>
        <p class="text-slate-500 text-[10px] font-black tracking-widest mt-3 border-l-4 border-brand-orange pl-4">General & Technical Correspondence</p>
    </div>

    @if(session('success'))
        <div class="p-4 bg-green-50 border-l-4 border-green-600 text-green-800 text-[10px] font-black tracking-widest">{{ session('success') }}</div>
    @endif

    <div class="bg-white border border-slate-200 rounded-sm overflow-hidden shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-100">
                        <th class="px-8 py-6 text-[10px] font-black text-slate-400 tracking-widest uppercase">Sender Identity</th>
                        <th class="px-8 py-6 text-[10px] font-black text-slate-400 tracking-widest uppercase">Classification</th>
                        <th class="px-8 py-6 text-[10px] font-black text-slate-400 tracking-widest uppercase">Message Content</th>
                        <th class="px-8 py-6 text-[10px] font-black text-slate-400 tracking-widest uppercase text-right">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($messages as $msg)
                    <tr class="hover:bg-slate-50/50 transition-all group">
                        <td class="px-8 py-6">
                            <span class="text-sm font-black text-slate-900 tracking-tighter uppercase">{{ $msg->name }}</span>
                            <p class="text-[9px] text-slate-400 font-bold mt-1 uppercase">{{ $msg->email }}</p>
                        </td>
                        <td class="px-8 py-6">
                            <span class="text-[10px] font-black text-brand-orange tracking-widest uppercase">
                                {{ $msg->subject }}
                            </span>
                        </td>
                        <td class="px-8 py-6">
                            <p class="text-[10px] text-slate-600 font-bold leading-relaxed max-w-md uppercase tracking-tight">
                                {{ $msg->message }}
                            </p>
                        </td>
                        <td class="px-8 py-6 text-right">
                            <div class="flex justify-end gap-4 opacity-20 group-hover:opacity-100 transition-opacity">
                                <a href="mailto:{{ $msg->email }}" class="text-slate-400 hover:text-brand-orange transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                </a>
                                <form action="{{ route('admin.messages.destroy', $msg->id) }}" method="POST" onsubmit="return confirm('PURGE CORRESPONDENCE RECORD?')">
                                    @csrf @method('DELETE')
                                    <button class="text-slate-400 hover:text-red-600 transition-colors">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-8 py-20 text-center text-slate-300 font-black text-[10px] tracking-[0.3em] uppercase">Communication log empty.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-6 bg-slate-50 border-t border-slate-100">
            {{ $messages->links() }}
        </div>
    </div>
</div>
@endsection