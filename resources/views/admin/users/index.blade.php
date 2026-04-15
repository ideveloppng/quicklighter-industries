@extends('layouts.admin')

@section('admin_content')
<div class="space-y-10 pb-20 uppercase tracking-tight" x-data="{ tab: 'users' }">
    
    <!-- HEADER -->
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
        <div>
            <h1 class="text-3xl lg:text-4xl font-black text-slate-900 tracking-tighter uppercase leading-none">Personnel Registry</h1>
            <p class="text-slate-500 text-[10px] font-black uppercase tracking-widest mt-3 border-l-4 border-brand-orange pl-4">System Access Control & Hierarchy</p>
        </div>

        <!-- TAB SWITCHER -->
        <div class="flex bg-slate-200 p-1 rounded-sm">
            <button @click="tab = 'users'" 
                    :class="tab === 'users' ? 'bg-white text-slate-900 shadow-sm' : 'text-slate-500 hover:text-slate-700'"
                    class="px-6 py-2 text-[10px] font-black tracking-widest transition-all">
                USERS ({{ $users->total() }})
            </button>
            <button @click="tab = 'admins'" 
                    :class="tab === 'admins' ? 'bg-brand-dark text-brand-orange shadow-sm' : 'text-slate-500 hover:text-slate-700'"
                    class="px-6 py-2 text-[10px] font-black tracking-widest transition-all">
                ADMINS ({{ count($admins) }})
            </button>
        </div>
    </div>

    <!-- FLASH ALERTS -->
    @if(session('success'))
        <div class="p-4 bg-green-50 border-l-4 border-green-600 text-green-800 text-[10px] font-black tracking-widest shadow-sm">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="p-4 bg-red-50 border-l-4 border-red-600 text-red-800 text-[10px] font-black tracking-widest shadow-sm">{{ session('error') }}</div>
    @endif

    <!-- TAB 1: STANDARD USERS -->
    <div x-show="tab === 'users'" x-cloak x-transition:enter="transition ease-out duration-200" class="space-y-6">
        <div class="bg-white border border-slate-200 rounded-sm overflow-hidden shadow-sm">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-100 text-[10px] font-black text-slate-400 tracking-widest">
                        <th class="px-8 py-5 uppercase">Identity</th>
                        <th class="px-8 py-5 uppercase">Communications</th>
                        <th class="px-8 py-5 uppercase">Elevation</th>
                        <th class="px-8 py-6 text-right uppercase">Operation</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 font-bold text-[11px]">
                    @forelse($users as $user)
                    <tr class="hover:bg-slate-50 transition-all group">
                        <td class="px-8 py-6">
                            <span class="text-sm font-black text-slate-900 tracking-tighter">{{ $user->name }}</span>
                            <p class="text-[8px] text-slate-400 mt-1">Registry Date: {{ $user->created_at->format('d M Y') }}</p>
                        </td>
                        <td class="px-8 py-6">
                            <p class="text-slate-900 lowercase">{{ $user->email }}</p>
                            <p class="text-slate-400 mt-1 tracking-widest">{{ $user->phone ?? 'NO PHONE REGISTERED' }}</p>
                        </td>
                        <td class="px-8 py-6">
                            <form action="{{ route('admin.users.toggle', $user) }}" method="POST">
                                @csrf
                                <button type="submit" class="bg-slate-100 text-slate-400 text-[9px] font-black px-3 py-1 rounded-sm hover:bg-brand-dark hover:text-white transition-all tracking-widest">
                                    GRANT ADMIN HQ ACCESS
                                </button>
                            </form>
                        </td>
                        <td class="px-8 py-6 text-right">
                            <div class="flex items-center justify-end gap-3 opacity-20 group-hover:opacity-100 transition-all">
                                <a href="{{ route('admin.users.reset', $user) }}" class="p-2 text-slate-400 hover:text-brand-orange transition-colors" title="Manual Reset">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path></svg>
                                </a>
                                <form action="{{ route('admin.users.destroy', $user) }}" method="POST" onsubmit="return confirm('PERMANENTLY PURGE RECORD?')">
                                    @csrf @method('DELETE')
                                    <button class="p-2 text-slate-400 hover:text-red-600"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="4" class="px-8 py-20 text-center text-slate-300 text-[10px] font-black uppercase">No standard users registered.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-6 bg-slate-50 border-t border-slate-100 uppercase text-[10px] font-black tracking-widest">{{ $users->links() }}</div>
    </div>

    <!-- TAB 2: ADMINS -->
    <div x-show="tab === 'admins'" x-cloak x-transition:enter="transition ease-out duration-200" class="space-y-6">
        <div class="bg-white border border-slate-200 rounded-sm overflow-hidden shadow-sm">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-900 text-white text-[10px] font-black tracking-widest uppercase">
                        <th class="px-8 py-5">Admin Identity</th>
                        <th class="px-8 py-5">System Channels</th>
                        <th class="px-8 py-5">Authorization</th>
                        <th class="px-8 py-6 text-right">Operation</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 font-bold text-[11px]">
                    @foreach($admins as $admin)
                    <tr class="hover:bg-slate-50 transition-all group">
                        <td class="px-8 py-6">
                            <span class="text-sm font-black text-slate-900 tracking-tighter">{{ $admin->name }}</span>
                            @if($admin->id === auth()->id())
                                <span class="ml-2 bg-brand-orange text-white text-[7px] px-2 py-0.5 rounded-full">ACTIVE NODE</span>
                            @endif
                        </td>
                        <td class="px-8 py-6">
                            <p class="text-slate-900 lowercase">{{ $admin->email }}</p>
                            <p class="text-slate-400 mt-1 tracking-widest">{{ $admin->phone ?? '---' }}</p>
                        </td>
                        <td class="px-8 py-6">
                            <form action="{{ route('admin.users.toggle', $admin) }}" method="POST">
                                @csrf
                                <button type="submit" 
                                        @if($admin->id === auth()->id()) disabled @endif
                                        class="text-[9px] font-black px-3 py-1 border border-slate-200 rounded-sm transition-all hover:border-brand-orange hover:text-brand-orange {{ $admin->id === auth()->id() ? 'opacity-20 cursor-not-allowed' : '' }}">
                                    REVOKE HQ ACCESS
                                </button>
                            </form>
                        </td>
                        <td class="px-8 py-6 text-right">
                            <div class="flex items-center justify-end gap-3 opacity-40 group-hover:opacity-100 transition-all">
                                <a href="{{ route('admin.users.reset', $admin) }}" class="p-2 text-slate-400 hover:text-brand-orange transition-colors" title="Key Override">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path></svg>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection