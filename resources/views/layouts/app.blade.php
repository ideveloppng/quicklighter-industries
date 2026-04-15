<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>QuickLighter | Precision Engineering & Eco-Stoves</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700;900&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { font-family: 'Inter', sans-serif; -webkit-font-smoothing: antialiased; font-style: normal !important; }
        em, i { font-style: normal !important; }
        [x-cloak] { display: none !important; }
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
        
        .trix-content ul { list-style-type: none !important; margin: 1rem 0 !important; }
        .trix-content li { position: relative; padding-left: 1.5rem; margin-bottom: 0.5rem; font-weight: 700; color: #475569; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.025em; }
        .trix-content li::before { content: ""; position: absolute; left: 0; top: 0.4rem; width: 6px; height: 6px; background-color: #D9480F; }

        /* Custom Scroll Behavior */
        html { scroll-behavior: smooth; }
    </style>
</head>
<body class="bg-white text-slate-900 overflow-x-hidden uppercase" 
    x-data="{ 
        mobileMenu: false, 
        cartOpen: false,
        chatOpen: false,
        showScroll: false,
        cartItems: {{ json_encode(array_values(session('cart', []))) }},
        cartTotal: '{{ number_format(array_sum(array_map(fn($i) => $i['price'] * $i['quantity'], session('cart', [])))) }}'
    }"
    @scroll.window="showScroll = (window.pageYOffset > 500)"
    @cart-updated.window="cartItems = $event.detail.cart; cartTotal = $event.detail.total; cartOpen = true">

    <!-- HEADER -->
    <header class="bg-white border-b border-slate-100 sticky top-0 z-50">
        <div class="max-w-[1440px] mx-auto px-4 lg:px-10 h-20 flex items-center justify-between">
            <div class="flex-1">
                <a href="/" class="flex items-center">
                    <img src="{{ asset('images/logo.png') }}" alt="QuickLighter Logo" class="h-10 w-auto object-contain">
                </a>
            </div>

            <nav class="hidden xl:flex flex-1 items-center justify-center gap-6 h-full">
                <div class="relative h-full flex items-center">
                    <a href="/" class="text-[11px] font-bold uppercase tracking-widest transition-colors {{ Request::is('/') ? 'text-slate-900' : 'text-slate-500 hover:text-slate-900' }}">Home</a>
                    @if(Request::is('/')) <div class="absolute bottom-0 left-0 w-full h-[2px] bg-brand-orange"></div> @endif
                </div>
                <div class="relative h-full flex items-center">
                    <a href="/shop" class="text-[11px] font-bold uppercase tracking-widest transition-colors {{ Request::is('shop*') ? 'text-slate-900' : 'text-slate-500 hover:text-slate-900' }}">Shop</a>
                    @if(Request::is('shop*')) <div class="absolute bottom-0 left-0 w-full h-[2px] bg-brand-orange"></div> @endif
                </div>
                <div class="relative h-full flex items-center">
                    <a href="/track" class="text-[11px] font-bold uppercase tracking-widest transition-colors {{ Request::is('track*') ? 'text-slate-900' : 'text-slate-500 hover:text-slate-900' }}">Track Order</a>
                    @if(Request::is('track*')) <div class="absolute bottom-0 left-0 w-full h-[2px] bg-brand-orange"></div> @endif
                </div>
                <div class="relative h-full flex items-center">
                    <a href="/about" class="text-[11px] font-bold uppercase tracking-widest transition-colors {{ Request::is('about*') ? 'text-slate-900' : 'text-slate-500 hover:text-slate-900' }}">About</a>
                    @if(Request::is('about*')) <div class="absolute bottom-0 left-0 w-full h-[2px] bg-brand-orange"></div> @endif
                </div>
                <div class="relative h-full flex items-center">
                    <a href="/support" class="text-[11px] font-bold uppercase tracking-widest transition-colors {{ Request::is('support*') ? 'text-slate-900' : 'text-slate-500 hover:text-slate-900' }}">Support</a>
                    @if(Request::is('support*')) <div class="absolute bottom-0 left-0 w-full h-[2px] bg-brand-orange"></div> @endif
                </div>
                <div class="relative h-full flex items-center">
                    <a href="/reseller" class="text-[11px] font-bold uppercase tracking-widest transition-colors {{ Request::is('reseller*') ? 'text-slate-900' : 'text-slate-500 hover:text-slate-900' }}">Reseller</a>
                    @if(Request::is('reseller*')) <div class="absolute bottom-0 left-0 w-full h-[2px] bg-brand-orange"></div> @endif
                </div>
            </nav>

            <div class="flex-1 flex items-center justify-end gap-2 lg:gap-4">
                <form action="{{ route('shop') }}" method="GET" class="hidden lg:block">
                    <div class="flex items-center bg-slate-100 rounded-full px-4 py-2 w-32 lg:w-44 border border-transparent focus-within:border-brand-orange transition-all">
                        <button type="submit"><svg class="w-3.5 h-3.5 text-slate-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg></button>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="SEARCH" class="bg-transparent border-none text-[10px] font-black tracking-widest ml-2 focus:ring-0 placeholder-slate-400 w-full uppercase outline-none">
                    </div>
                </form>

                <div class="hidden md:flex items-center ml-2">
                    @guest
                        <a href="/login" class="text-[10px] font-black uppercase tracking-widest text-slate-900 hover:text-brand-orange transition-colors whitespace-nowrap">Login / Signup</a>
                    @endguest
                    @auth
                        <a href="{{ Auth::user()->is_admin ? route('admin.index') : route('user.index') }}" class="p-2 text-slate-900 hover:text-brand-orange transition-colors flex items-center gap-2">
                            <span class="text-[10px] font-black uppercase tracking-widest hidden xl:inline">Dashboard</span>
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        </a>
                    @endauth
                </div>

                <button @click="cartOpen = true" class="p-2 text-slate-900 hover:text-brand-orange transition-colors relative">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                    <span id="cart-count-badge" class="absolute top-1 right-0 bg-brand-orange text-white text-[8px] font-black px-1.5 py-0.5 rounded-full border-2 border-white" x-text="cartItems.length"></span>
                </button>

                <button @click="mobileMenu = true" class="md:hidden p-2 text-slate-900">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path></svg>
                </button>
            </div>
        </div>
    </header>

    <!-- MOBILE OVERLAY SIDEBAR -->
    <template x-teleport="body">
        <div x-show="mobileMenu" x-cloak class="fixed inset-0 z-[100] md:hidden">
            <div @click="mobileMenu = false" x-show="mobileMenu" x-transition:enter="transition opacity duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm"></div>
            <div x-show="mobileMenu" x-transition:enter="transition transform duration-300" x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0" class="absolute right-0 top-0 bottom-0 w-[85%] bg-white shadow-2xl flex flex-col">
                <div class="p-6 border-b border-slate-100 flex justify-between items-center">
                    <span class="font-black text-lg tracking-tighter text-slate-900 uppercase">Menu</span>
                    <button @click="mobileMenu = false" class="text-slate-400 p-2"><svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path></svg></button>
                </div>
                <div class="flex-1 overflow-y-auto p-6 space-y-10">
                    <nav class="flex flex-col gap-6">
                        <a href="/" @click="mobileMenu = false" class="text-3xl font-black {{ Request::is('/') ? 'text-brand-orange' : 'text-slate-900' }}">Home</a>
                        <a href="/shop" @click="mobileMenu = false" class="text-3xl font-black {{ Request::is('shop*') ? 'text-brand-orange' : 'text-slate-900' }}">Shop</a>
                        <a href="/track" @click="mobileMenu = false" class="text-3xl font-black">Track Order</a>
                        <a href="/about" @click="mobileMenu = false" class="text-3xl font-black">About Us</a>
                        <a href="/support" @click="mobileMenu = false" class="text-3xl font-black">Support</a>
                    </nav>
                </div>
            </div>
        </div>
    </template>

    <main class="min-h-screen">
        @yield('content')
    </main>

    <!-- FOOTER -->
    <footer class="bg-white border-t border-slate-100 py-20 px-6 lg:px-20 mt-20 uppercase">
        <div class="max-w-[1440px] mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 lg:gap-16">
            <!-- Brand & Desc -->
            <div class="space-y-6">
                <a href="/" class="flex items-center">
                    <img src="{{ asset('images/logo.png') }}" alt="QuickLighter Logo" class="h-12 w-auto object-contain grayscale brightness-200 hover:grayscale-0 transition-all duration-500">
                </a>
                <p class="text-slate-500 text-[10px] font-bold leading-loose tracking-widest max-w-xs">
                    QuickLighter Industries is a forward-thinking Nigerian company dedicated to transforming everyday home and industrial experiences through innovative, eco-friendly solutions.
                </p>
                <div class="flex gap-4 pt-2">
                    <!-- Social Icons -->
                    <a href="#" class="text-slate-400 hover:text-brand-orange transition-colors"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg></a>
                    <a href="#" class="text-slate-400 hover:text-brand-orange transition-colors"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.355 2.618 6.778 6.98 6.978 1.28.058 1.688.072 4.948.072s3.668-.014 4.948-.072c4.354-.2 6.782-2.618 6.979-6.98.058-1.28.072-1.689.072-4.948 0-3.259-.014-3.668-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg></a>
                </div>
            </div>

            <!-- Links 1 -->
            <div class="space-y-6">
                <h5 class="text-[10px] font-black text-slate-400 tracking-widest border-l-2 border-brand-orange pl-3">Inventory</h5>
                <ul class="space-y-3 text-[11px] font-black text-slate-900 tracking-widest">
                    <li><a href="/shop" class="hover:text-brand-orange transition-all">Deployment Catalog</a></li>
                    <li><a href="/track" class="hover:text-brand-orange transition-all">Logistics Tracking</a></li>
                    <li><a href="/reseller" class="hover:text-brand-orange transition-all">Authorized Nodes</a></li>
                </ul>
            </div>

            <!-- Links 2 -->
            <div class="space-y-6">
                <h5 class="text-[10px] font-black text-slate-400 tracking-widest border-l-2 border-brand-orange pl-3">Resources</h5>
                <ul class="space-y-3 text-[11px] font-black text-slate-900 tracking-widest">
                    <li><a href="/about" class="hover:text-brand-orange transition-all">Our Story</a></li>
                    <li><a href="/support" class="hover:text-brand-orange transition-all">Support Terminal</a></li>
                    <li><a href="#" class="hover:text-brand-orange transition-all">Technical Specs</a></li>
                </ul>
            </div>

            <!-- Contact -->
            <div class="space-y-6">
                <h5 class="text-[10px] font-black text-slate-400 tracking-widest border-l-2 border-brand-orange pl-3">Coordinates</h5>
                <ul class="space-y-4 text-[11px] font-bold text-slate-600 tracking-widest leading-loose">
                    <li class="flex items-start gap-3"><svg class="w-4 h-4 text-brand-orange shrink-0 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg><span>Plot B, Ikorodu Ind Estate, Lagos, NG.</span></li>
                    <li class="flex items-center gap-3"><svg class="w-4 h-4 text-brand-orange shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg><span>INFO@QUICKLIGHTER.COM</span></li>
                </ul>
            </div>
        </div>

        <div class="max-w-[1440px] mx-auto mt-20 pt-10 border-t border-slate-100 text-center">
            <p class="text-[9px] font-black text-slate-400 tracking-[0.4em]">© 2024 QUICKLIGHTER INDUSTRIES. PRECISION ECOLOGY.</p>
        </div>
    </footer>

    <!-- FLOATING ACTIONS -->
    <div class="fixed bottom-8 right-8 z-[100] flex flex-col gap-4 items-end">
        
        <!-- SCROLL TO TOP -->
        <button x-show="showScroll" x-cloak x-transition @click="window.scrollTo({top: 0, behavior: 'smooth'})" 
                class="w-12 h-12 bg-brand-dark text-white flex items-center justify-center shadow-2xl hover:bg-brand-orange transition-all duration-300 border border-white/10">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 15l7-7 7 7"></path></svg>
        </button>

        <!-- WHATSAPP WIDGET NODE -->
        <div class="relative flex flex-col items-end">
            <!-- Modal Window -->
            <div x-show="chatOpen" x-cloak x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="opacity-0 translate-y-10 scale-95" x-transition:enter-end="opacity-100 translate-y-0 scale-100" 
                 class="absolute bottom-20 right-0 w-[320px] bg-white shadow-[0_20px_50px_rgba(0,0,0,0.2)] rounded-xl overflow-hidden border border-slate-100">
                <!-- Header -->
                <div class="bg-[#075e54] p-5 text-white flex justify-between items-start">
                    <div>
                        <h4 class="font-black text-sm tracking-tight leading-none">QUICK LIGHTER INDUSTRIES</h4>
                        <p class="text-[10px] font-bold opacity-80 mt-2">Typically replies within minutes</p>
                    </div>
                    <button @click="chatOpen = false" class="opacity-60 hover:opacity-100"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg></button>
                </div>
                <!-- Body -->
                <div class="p-6 bg-[#e5ddd5]" style="background-image: url('https://user-images.githubusercontent.com/15075759/28719144-86dc0f70-73b1-11e7-911d-60d70fcd2de4.png');">
                    <div class="bg-white p-4 rounded-lg rounded-tl-none shadow-sm relative">
                        <p class="text-xs font-bold text-slate-800 leading-relaxed normal-case">
                            Hello! 👋<br><br>
                            Welcome to QuickLighter Industries, Nigeria’s trusted brand for innovative cooking appliances and home accessories.<br><br>
                            We’re excited to have you here. If you need help, product info, or a quick tour, feel free to ask; we’re here for you!
                        </p>
                        <span class="absolute top-0 -left-2 border-[10px] border-transparent border-t-white"></span>
                    </div>
                </div>
                <!-- Footer Button -->
                <div class="p-4 bg-white">
                    <a href="https://wa.me/2348168907662" target="_blank" class="flex items-center justify-center gap-3 bg-[#25D366] text-white py-3 rounded-full font-black text-xs tracking-widest hover:bg-[#128C7E] transition-all duration-300">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.67-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                        WHATSAPP US
                    </a>
                    <p class="text-center text-[9px] font-bold text-slate-400 mt-4 tracking-widest">ONLINE | PRIVACY POLICY</p>
                </div>
            </div>

            <!-- Main Floating Button -->
            <button @click="chatOpen = !chatOpen" 
                    class="w-16 h-16 bg-[#25D366] text-white flex items-center justify-center rounded-full shadow-[0_10px_30px_rgba(37,211,102,0.4)] hover:scale-110 transition-all duration-300 z-[110]">
                <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.67-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
            </button>
        </div>
    </div>

</body>
</html>