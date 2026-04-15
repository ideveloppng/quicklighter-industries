<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QuickLighter Admin | Control Panel</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700;900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>[x-cloak] { display: none !important; } body { font-family: 'Inter', sans-serif; -webkit-font-smoothing: antialiased; }</style>
</head>
<body class="bg-slate-50 text-slate-900 flex h-screen overflow-hidden uppercase" x-data="{ sidebarOpen: false }">

    <div x-show="sidebarOpen" x-cloak class="fixed inset-0 z-40 bg-[#062419]/80 backdrop-blur-sm lg:hidden" @click="sidebarOpen = false"></div>

    <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" class="fixed inset-y-0 left-0 z-50 w-72 bg-[#062419] text-white transition-transform duration-300 transform lg:translate-x-0 lg:static lg:inset-0 flex flex-col shrink-0 border-r border-white/5 uppercase">
        <div class="flex items-center justify-center h-20 border-b border-white/10 shrink-0">
            <span class="text-xl font-black tracking-tighter">Admin<span class="text-[#D9480F]">.</span>HQ</span>
        </div>

        <nav class="flex-1 mt-8 px-6 space-y-2 overflow-y-auto">
            <a href="{{ route('admin.index') }}" class="flex items-center gap-4 px-5 py-4 rounded-sm font-black text-[10px] tracking-[0.2em] {{ Request::is('admin') ? 'bg-[#D9480F] text-white' : 'text-slate-400 hover:text-white' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path></svg>
                Overview
            </a>
            <a href="{{ route('admin.products') }}" class="flex items-center gap-4 px-5 py-4 rounded-sm font-black text-[10px] tracking-[0.2em] {{ Request::is('admin/products*') ? 'bg-[#D9480F] text-white' : 'text-slate-400 hover:text-white' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                Inventory
            </a>
            <a href="{{ route('admin.categories.index') }}" class="flex items-center gap-4 px-5 py-4 rounded-sm font-black text-[10px] tracking-[0.2em] {{ Request::is('admin/categories*') ? 'bg-[#D9480F] text-white' : 'text-slate-400 hover:text-white' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path></svg>
                Categories
            </a>
            <a href="{{ route('admin.orders') }}" class="flex items-center gap-4 px-5 py-4 rounded-sm font-black text-[10px] tracking-[0.2em] {{ Request::is('admin/orders*') ? 'bg-[#D9480F] text-white' : 'text-slate-400 hover:text-white' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                Logistics
            </a>
            <a href="{{ route('admin.payments') }}" class="flex items-center gap-4 px-5 py-4 rounded-sm font-black text-[10px] tracking-[0.2em] {{ Request::is('admin/payments*') ? 'bg-[#D9480F] text-white' : 'text-slate-400 hover:text-white' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                Finance
            </a>
            <a href="{{ route('admin.resellers') }}" class="flex items-center gap-4 px-5 py-4 rounded-sm font-black text-[10px] tracking-[0.2em] {{ Request::is('admin/resellers*') ? 'bg-[#D9480F] text-white' : 'text-slate-400 hover:text-white' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                Resellers
            </a>
            <a href="{{ route('admin.users') }}" class="flex items-center gap-4 px-5 py-4 rounded-sm font-black text-[10px] uppercase tracking-[0.2em] {{ Request::is('admin/users*') ? 'bg-[#D9480F] text-white shadow-lg' : 'text-slate-400 hover:text-white' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                Personnel
            </a>
            <a href="{{ route('admin.applications') }}" class="flex items-center gap-4 px-5 py-4 rounded-sm font-black text-[10px] uppercase tracking-[0.2em] {{ Request::is('admin/applications*') ? 'bg-[#D9480F] text-white' : 'text-slate-400 hover:text-white' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                Applications
            </a>
            <a href="{{ route('admin.messages') }}" class="flex items-center gap-4 px-5 py-4 rounded-sm font-black text-[10px] uppercase tracking-[0.2em] {{ Request::is('admin/messages*') ? 'bg-[#D9480F] text-white' : 'text-slate-400 hover:text-white' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path></svg>
                Messages
            </a>
        </nav>

        <div class="p-6 border-t border-white/10 shrink-0">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="group flex items-center gap-4 px-5 py-4 text-[10px] font-black tracking-[0.2em] text-red-400 hover:text-red-300 w-full text-left transition-colors uppercase">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path></svg>
                    Terminate Session
                </button>
            </form>
        </div>
    </aside>

    <div class="flex-1 flex flex-col min-w-0 h-screen overflow-hidden">
        <header class="h-20 bg-white border-b border-slate-200 flex items-center justify-between px-6 lg:px-10 shrink-0 z-30">
            <button @click="sidebarOpen = true" class="lg:hidden p-2 text-slate-600 transition-colors"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg></button>
            <div class="font-bold text-slate-400 text-[10px] tracking-widest hidden md:block">Operational Environment / {{ now()->format('d M Y') }}</div>
            <div class="flex items-center gap-4">
                <div class="text-right hidden sm:block">
                    <p class="text-xs font-black text-slate-900 uppercase tracking-tight">{{ Auth::user()?->name }}</p>
                    <p class="text-[9px] font-bold text-[#D9480F] tracking-widest leading-none mt-1 uppercase">Admin Access</p>
                </div>
                <div class="w-10 h-10 bg-[#062419] rounded-sm flex items-center justify-center text-white font-black text-sm uppercase">{{ substr(Auth::user()?->name, 0, 1) }}</div>
            </div>
        </header>

        <main class="flex-1 overflow-y-auto p-6 lg:p-12"><div class="max-w-[1600px] mx-auto">@yield('admin_content')</div></main>
    </div>

</body>
</html>