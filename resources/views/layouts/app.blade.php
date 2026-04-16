<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>QuickLighter | Precision Engineering & Eco-Stoves</title>

    <!-- Fonts: Inter for that clean Industrial look -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700;900&display=swap" rel="stylesheet">
    
    <!-- Ionicons -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { font-family: 'Inter', sans-serif; -webkit-font-smoothing: antialiased; font-style: normal !important; }
        em, i, italic { font-style: normal !important; } 
        [x-cloak] { display: none !important; }
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
        
        /* Trix Editor Industrial Reset */
        .trix-content ul { list-style-type: none !important; margin: 1rem 0 !important; }
        .trix-content li { position: relative; padding-left: 1.5rem; margin-bottom: 0.5rem; font-weight: 700; color: #475569; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.025em; }
        .trix-content li::before { content: ""; position: absolute; left: 0; top: 0.4rem; width: 6px; height: 6px; background-color: #D9480F; }
        
        html { scroll-behavior: smooth; }
    </style>
</head>
<body class="bg-white text-slate-900 overflow-x-hidden uppercase" 
    x-data="{ 
        mobileMenu: false, 
        chatOpen: false,
        showScroll: false
    }"
    @scroll.window="showScroll = (window.pageYOffset > 500)">

    <!-- HEADER -->
    <header class="bg-white border-b border-slate-100 sticky top-0 z-50">
        <div class="max-w-[1440px] mx-auto px-4 lg:px-10 h-24 flex items-center justify-between">
            
            <!-- LOGO (Left Aligned) -->
            <div class="flex-1">
                <a href="/" class="flex items-center">
                    <img src="{{ asset('images/logo.png') }}" alt="QuickLighter" class="h-10 lg:h-12 w-auto object-contain">
                </a>
            </div>

            <!-- DESKTOP NAVIGATION (Hidden on Mobile/Tablet) -->
            <nav class="hidden xl:flex flex-1 items-center justify-center gap-8 h-full">
                <div class="relative h-full flex items-center">
                    <a href="/" class="text-[11px] font-black uppercase tracking-widest transition-colors {{ Request::is('/') ? 'text-brand-orange' : 'text-slate-500 hover:text-slate-900' }}">Home</a>
                    @if(Request::is('/')) <div class="absolute bottom-0 left-0 w-full h-[2px] bg-brand-orange"></div> @endif
                </div>
                <div class="relative h-full flex items-center">
                    <a href="/shop" class="text-[11px] font-black uppercase tracking-widest transition-colors {{ Request::is('shop*') ? 'text-brand-orange' : 'text-slate-500 hover:text-slate-900' }}">Shop</a>
                    @if(Request::is('shop*')) <div class="absolute bottom-0 left-0 w-full h-[2px] bg-brand-orange"></div> @endif
                </div>
                <div class="relative h-full flex items-center">
                    <a href="/track" class="text-[11px] font-black uppercase tracking-widest transition-colors {{ Request::is('track*') ? 'text-brand-orange' : 'text-slate-500 hover:text-slate-900' }}">Track</a>
                    @if(Request::is('track*')) <div class="absolute bottom-0 left-0 w-full h-[2px] bg-brand-orange"></div> @endif
                </div>
                <a href="/about" class="text-[11px] font-black uppercase tracking-widest text-slate-500 hover:text-slate-900">About</a>
                <a href="/support" class="text-[11px] font-black uppercase tracking-widest text-slate-500 hover:text-slate-900">Support</a>
                <a href="/reseller" class="text-[11px] font-black uppercase tracking-widest text-slate-500 hover:text-slate-900">Reseller</a>
            </nav>

            <!-- TOOLS -->
            <div class="flex-1 flex items-center justify-end gap-3 lg:gap-5">
                <!-- Search (Desktop) -->
                <form action="{{ route('shop') }}" method="GET" class="hidden lg:block">
                    <div class="flex items-center bg-slate-100 rounded-full px-4 py-2 w-32 lg:w-44 border border-transparent focus-within:border-brand-orange transition-all">
                        <button type="submit"><ion-icon name="search-outline" class="text-slate-400"></ion-icon></button>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="SEARCH" class="bg-transparent border-none text-[10px] font-black tracking-widest ml-2 focus:ring-0 outline-none w-full">
                    </div>
                </form>

                <!-- Auth (Desktop) -->
                <div class="hidden md:flex items-center">
                    @guest <a href="/login" class="text-[10px] font-black uppercase tracking-widest text-slate-900 hover:text-brand-orange transition-colors">Login</a> @endguest
                    @auth 
                        <a href="{{ Auth::user()->is_admin ? route('admin.index') : route('user.index') }}" class="p-2 text-slate-900 hover:text-brand-orange transition-colors">
                            <ion-icon name="person-outline" class="text-xl"></ion-icon>
                        </a>
                    @endauth
                </div>

                <!-- Cart Button -->
                <a href="{{ route('cart.index') }}" class="p-2 text-slate-900 hover:text-brand-orange transition-colors relative">
                    <ion-icon name="cart-outline" class="text-2xl"></ion-icon>
                    <span id="cart-count-badge" class="absolute top-1 right-0 bg-brand-orange text-white text-[8px] font-black px-1.5 py-0.5 rounded-full border-2 border-white" x-text="$store.cart.count"></span>
                </a>

                <!-- MOBILE HAMBURGER (ONLY VISIBLE ON MOBILE/TABLET) -->
                <button @click="mobileMenu = true" class="xl:hidden p-2 text-slate-900">
                    <ion-icon name="menu-outline" class="text-4xl"></ion-icon>
                </button>
            </div>
        </div>
    </header>

    <!-- MOBILE SIDEBAR -->
    <template x-teleport="body">
        <div x-show="mobileMenu" x-cloak class="fixed inset-0 z-[100] xl:hidden">
            <div @click="mobileMenu = false" class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm"></div>
            <div x-show="mobileMenu" x-transition:enter="transition transform duration-300" x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0" class="absolute right-0 top-0 bottom-0 w-[85%] bg-white shadow-2xl flex flex-col uppercase">
                <!-- Sidebar Top -->
                <div class="p-6 border-b border-slate-100 flex justify-between items-center bg-slate-50">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-8 w-auto">
                    <button @click="mobileMenu = false" class="text-slate-400 p-2"><ion-icon name="close-outline" class="text-3xl"></ion-icon></button>
                </div>

                <div class="flex-1 overflow-y-auto p-8 space-y-10">
                    <!-- SEARCH BAR IN SIDEBAR -->
                    <div class="space-y-3">
                        <span class="text-[10px] font-black text-slate-400 tracking-widest uppercase">System Search</span>
                        <form action="{{ route('shop') }}" method="GET">
                            <div class="flex items-center bg-slate-100 rounded-sm px-4 py-4 border border-slate-200 focus-within:border-brand-orange transition-colors">
                                <ion-icon name="search-outline" class="text-slate-400 text-lg"></ion-icon>
                                <input type="text" name="search" placeholder="SEARCH CATALOG..." class="bg-transparent border-none text-xs font-black tracking-widest ml-3 focus:ring-0 outline-none w-full uppercase">
                            </div>
                        </form>
                    </div>

                    <!-- PRIMARY LINKS -->
                    <nav class="flex flex-col gap-2">
                        <span class="text-[10px] font-black text-slate-400 tracking-widest uppercase mb-4">Logistics Nodes</span>
                        <a href="/" @click="mobileMenu = false" class="flex items-center justify-between py-4 border-b border-slate-50 text-lg font-black {{ Request::is('/') ? 'text-brand-orange' : 'text-slate-900' }}">HOME TERMINAL <ion-icon name="chevron-forward-outline"></ion-icon></a>
                        <a href="/shop" @click="mobileMenu = false" class="flex items-center justify-between py-4 border-b border-slate-50 text-lg font-black {{ Request::is('shop*') ? 'text-brand-orange' : 'text-slate-900' }}">CATALOG <ion-icon name="chevron-forward-outline"></ion-icon></a>
                        <a href="/track" @click="mobileMenu = false" class="flex items-center justify-between py-4 border-b border-slate-50 text-lg font-black {{ Request::is('track*') ? 'text-brand-orange' : 'text-slate-900' }}">TRACK DEPLOYMENT <ion-icon name="chevron-forward-outline"></ion-icon></a>
                        <a href="/about" @click="mobileMenu = false" class="flex items-center justify-between py-4 border-b border-slate-50 text-lg font-black text-slate-900">ABOUT <ion-icon name="chevron-forward-outline"></ion-icon></a>
                        <a href="/support" @click="mobileMenu = false" class="flex items-center justify-between py-4 border-b border-slate-50 text-lg font-black text-slate-900">SUPPORT <ion-icon name="chevron-forward-outline"></ion-icon></a>
                    </nav>

                    <!-- AUTH BUTTONS IN SIDEBAR -->
                    <div class="pt-6">
                        @guest
                            <a href="/login" class="flex items-center justify-between bg-brand-dark text-white p-5 rounded-sm shadow-lg transition-all hover:bg-brand-orange">
                                <span class="text-xs font-black tracking-[0.2em]">ACCESS CLEARANCE</span>
                                <ion-icon name="log-in-outline" class="text-xl"></ion-icon>
                            </a>
                        @endguest
                        @auth
                            <a href="{{ Auth::user()->is_admin ? route('admin.index') : route('user.index') }}" class="flex items-center justify-between bg-slate-100 text-slate-900 p-5 rounded-sm border border-slate-200">
                                <span class="text-xs font-black tracking-[0.2em]">MY DASHBOARD</span>
                                <ion-icon name="person-outline" class="text-xl text-brand-orange"></ion-icon>
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </template>

    <!-- SUCCESS TOAST POP-UP -->
    <template x-teleport="body">
        <div x-show="$store.cart.showToast" x-cloak 
             x-transition:enter="transition ease-out duration-300 transform" 
             x-transition:enter-start="translate-y-20 opacity-0 scale-90" 
             x-transition:enter-end="translate-y-0 opacity-100 scale-100"
             x-transition:leave="transition ease-in duration-200 opacity-0"
             class="fixed bottom-10 left-1/2 -translate-x-1/2 z-[200] w-[95%] max-w-md">
            <div class="bg-brand-dark text-white p-6 rounded-sm shadow-2xl flex items-center justify-between border-b-4 border-brand-orange">
                <div class="flex items-center gap-4">
                    <ion-icon name="checkmark-done-outline" class="text-brand-orange text-3xl"></ion-icon>
                    <div class="flex flex-col">
                        <p class="text-[9px] font-black tracking-widest text-slate-400 leading-none mb-1">UNIT DEPLOYED</p>
                        <p class="text-[11px] font-black truncate max-w-[180px]" x-text="$store.cart.itemName"></p>
                    </div>
                </div>
                <div class="flex gap-2">
                    <a href="{{ route('cart.index') }}" class="bg-brand-orange text-white px-4 py-2 text-[9px] font-black tracking-widest rounded-sm hover:bg-white hover:text-brand-dark transition-all">VIEW CART</a>
                    <button @click="$store.cart.showToast = false" class="text-slate-400 p-1 hover:text-white"><ion-icon name="close-outline" class="text-xl"></ion-icon></button>
                </div>
            </div>
        </div>
    </template>

    <main class="min-h-screen">@yield('content')</main>

    <!-- FOOTER -->
    <footer class="bg-white border-t border-slate-100 py-24 px-6 lg:px-20 mt-20 uppercase tracking-widest">
        <div class="max-w-[1440px] mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-16">
            <!-- Brand -->
            <div class="space-y-8">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-10 grayscale brightness-200">
                <p class="text-slate-500 text-[10px] font-bold leading-loose max-w-xs uppercase">
                    QuickLighter Industries is a forward-thinking Nigerian company dedicated to transforming everyday home experiences through innovative solutions.
                </p>
                <!-- SOCIAL MEDIA ICONS (IONICONS) -->
                <div class="flex gap-6 text-2xl">
                    <a href="#" class="text-slate-400 hover:text-brand-orange transition-all"><ion-icon name="logo-facebook"></ion-icon></a>
                    <a href="#" class="text-slate-400 hover:text-brand-orange transition-all"><ion-icon name="logo-instagram"></ion-icon></a>
                    <a href="#" class="text-slate-400 hover:text-brand-orange transition-all"><ion-icon name="logo-twitter"></ion-icon></a>
                    <a href="#" class="text-slate-400 hover:text-brand-orange transition-all"><ion-icon name="logo-linkedin"></ion-icon></a>
                </div>
            </div>
            <!-- Inventory -->
            <div class="space-y-6">
                <h5 class="text-[10px] font-black text-slate-400 tracking-[0.3em] uppercase">Showroom</h5>
                <ul class="space-y-4 text-[11px] font-black uppercase">
                    <li><a href="/shop" class="hover:text-brand-orange transition-all">Inventory</a></li>
                    <li><a href="/track" class="hover:text-brand-orange transition-all">Track Deployment</a></li>
                    <li><a href="/reseller" class="hover:text-brand-orange transition-all">Authorized Nodes</a></li>
                </ul>
            </div>
            <!-- Support -->
            <div class="space-y-6">
                <h5 class="text-[10px] font-black text-slate-400 tracking-[0.3em] uppercase">Support Node</h5>
                <ul class="space-y-4 text-[11px] font-black uppercase">
                    <li><a href="/support" class="hover:text-brand-orange transition-all">Contact Hub</a></li>
                    <li><a href="#" class="hover:text-brand-orange transition-all">Privacy Policy</a></li>
                    <li><a href="#" class="hover:text-brand-orange transition-all">Terms of Use</a></li>
                </ul>
            </div>
            <!-- Coordinates -->
            <div class="space-y-6">
                <h5 class="text-[10px] font-black text-slate-400 tracking-[0.3em] uppercase">Coordinates</h5>
                <ul class="space-y-4 text-[11px] font-bold text-slate-600 leading-relaxed uppercase tracking-widest">
                    <li>Ikeja Industrial Estate,<br>Lagos State, Nigeria.</li>
                    <li class="text-slate-900 font-black underline">INFO@QUICKLIGHTER.COM</li>
                </ul>
            </div>
        </div>
        <!-- CENTERED COPYRIGHT -->
        <div class="mt-20 pt-10 border-t border-slate-100 text-center uppercase">
            <p class="text-[9px] font-black text-slate-400 tracking-[0.5em]">© 2024 QUICKLIGHTER INDUSTRIES. PRECISION ECOLOGY.</p>
        </div>
    </footer>

    <!-- FLOATING UI -->
    <div class="fixed bottom-8 right-8 z-[110] flex flex-col items-end gap-4">
        <button x-show="showScroll" x-cloak @click="window.scrollTo({top: 0, behavior: 'smooth'})" class="w-12 h-12 bg-brand-dark text-white flex items-center justify-center shadow-2xl hover:bg-brand-orange transition-all duration-300 border border-white/10"><ion-icon name="arrow-up-outline" class="text-xl"></ion-icon></button>
        <div class="relative flex flex-col items-end">
            <!-- WhatsApp Widget -->
            <div x-show="chatOpen" x-cloak x-transition class="absolute bottom-20 right-0 w-[320px] bg-white shadow-2xl rounded-xl border border-slate-100 overflow-hidden uppercase">
                <div class="bg-[#075e54] p-5 text-white flex justify-between items-start">
                    <div><h4 class="font-black text-sm tracking-tight leading-none uppercase">Quick Lighter HQ</h4><p class="text-[10px] font-bold opacity-80 mt-2">typically replies in minutes</p></div>
                    <button @click="chatOpen = false" class="opacity-50 hover:opacity-100"><ion-icon name="close-outline" class="text-xl"></ion-icon></button>
                </div>
                <div class="p-6 bg-[#e5ddd5]" style="background-image: url('https://user-images.githubusercontent.com/15075759/28719144-86dc0f70-73b1-11e7-911d-60d70fcd2de4.png');">
                    <div class="bg-white p-4 rounded-lg rounded-tl-none shadow-sm relative text-xs font-bold text-slate-800 normal-case leading-relaxed">Welcome to QuickLighter Industries. Nigeria's trusted brand for innovative cooking appliances. How can we help you today?</div>
                </div>
                <div class="p-4 bg-white"><a href="https://wa.me/2348168907662" target="_blank" class="flex items-center justify-center gap-3 bg-[#25D366] text-white py-3 rounded-full font-black text-xs tracking-widest hover:bg-[#128C7E] transition-all uppercase">WHATSAPP TERMINAL</a></div>
            </div>
            <button @click="chatOpen = !chatOpen" class="w-16 h-16 bg-[#25D366] text-white flex items-center justify-center rounded-full shadow-2xl hover:scale-110 transition-all"><ion-icon name="logo-whatsapp" class="text-3xl"></ion-icon></button>
        </div>
    </div>

</body>
</html>