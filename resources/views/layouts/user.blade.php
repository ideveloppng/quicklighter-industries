<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QuickLighter | User Dashboard</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700;900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>[x-cloak] { display: none !important; } body { font-family: 'Inter', sans-serif; -webkit-font-smoothing: antialiased; }</style>
</head>
<body class="bg-slate-50 text-slate-900 flex h-screen overflow-hidden uppercase" x-data="{ sidebarOpen: false }">

    <div x-show="sidebarOpen" x-cloak class="fixed inset-0 z-40 bg-[#062419]/80 backdrop-blur-sm lg:hidden" @click="sidebarOpen = false"></div>

    <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" class="fixed inset-y-0 left-0 z-50 w-72 bg-[#062419] text-white transition-transform duration-300 transform lg:translate-x-0 lg:static lg:inset-0 flex flex-col shrink-0 border-r border-white/5">
        <div class="flex items-center justify-center h-20 border-b border-white/10 shrink-0">
            <span class="text-xl font-black tracking-tighter">USER<span class="text-[#D9480F]">.</span>HQ</span>
        </div>

        <nav class="flex-1 mt-8 px-6 space-y-2 overflow-y-auto">
            <a href="{{ route('user.index') }}" class="flex items-center gap-4 px-5 py-4 rounded-sm font-black text-[10px] tracking-[0.2em] {{ Request::is('user') ? 'bg-[#D9480F] text-white' : 'text-slate-400 hover:text-white' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                Overview
            </a>
            <a href="{{ route('user.orders') }}" class="flex items-center gap-4 px-5 py-4 rounded-sm font-black text-[10px] tracking-[0.2em] {{ Request::is('user/orders*') ? 'bg-[#D9480F] text-white' : 'text-slate-400 hover:text-white' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                My Deployments
            </a>
            <a href="{{ route('shop') }}" class="flex items-center gap-4 px-5 py-4 rounded-sm font-black text-[10px] tracking-[0.2em] text-slate-400 hover:text-white">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                Enter Shop
            </a>
        </nav>

        <div class="p-6 border-t border-white/10 shrink-0">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="group flex items-center gap-4 px-5 py-4 text-[10px] font-black tracking-[0.2em] text-red-400 hover:text-red-300 w-full text-left transition-colors uppercase">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path></svg>
                    Logout System
                </button>
            </form>
        </div>
    </aside>

    <div class="flex-1 flex flex-col min-w-0 h-screen overflow-hidden">
        <header class="h-20 bg-white border-b border-slate-200 flex items-center justify-between px-6 lg:px-10 shrink-0 z-30">
            <button @click="sidebarOpen = true" class="lg:hidden p-2 text-slate-600"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg></button>
            <div class="font-bold text-slate-400 text-[10px] tracking-widest hidden md:block uppercase">User Environment / {{ now()->format('d M Y') }}</div>
            <div class="flex items-center gap-4">
                <div class="text-right hidden sm:block">
                    <p class="text-xs font-black text-slate-900 uppercase">{{ Auth::user()->name }}</p>
                    <p class="text-[9px] font-bold text-[#D9480F] tracking-widest leading-none mt-1 uppercase">Standard Access</p>
                </div>
                <div class="w-10 h-10 bg-[#062419] rounded-sm flex items-center justify-center text-white font-black text-sm uppercase">{{ substr(Auth::user()->name, 0, 1) }}</div>
            </div>
        </header>

        <main class="flex-1 overflow-y-auto p-6 lg:p-12"><div class="max-w-[1600px] mx-auto">@yield('user_content')</div></main>
    </div>

</body>
</html>