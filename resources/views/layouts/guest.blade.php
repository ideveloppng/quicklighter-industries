<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>QuickLighter | Security Portal</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700;900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>body { font-family: 'Inter', sans-serif; -webkit-font-smoothing: antialiased; } [x-cloak] { display: none !important; }</style>
</head>
<body class="bg-white text-slate-900 antialiased uppercase overflow-hidden">
    <div class="flex h-screen">
        
        <!-- LEFT COLUMN: VISUAL & OVERLAY (Desktop Only) -->
        <div class="hidden lg:flex lg:w-1/2 relative bg-brand-dark overflow-hidden">
            <!-- Background Image from PC -->
            <img src="{{ asset('images/auth-bg.jpg') }}" class="absolute inset-0 w-full h-full object-cover opacity-40 grayscale" alt="Engineering Background">
            <div class="absolute inset-0 bg-gradient-to-t from-brand-dark via-transparent to-transparent"></div>
            
            <div class="relative z-10 p-20 mt-auto">
                <a href="/" class="text-3xl font-black tracking-tighter text-white uppercase mb-8 block">
                    QuickLighter<span class="text-brand-orange">.</span>
                </a>
                <h2 class="text-5xl font-black text-white leading-tight tracking-tighter uppercase">
                    Engineering the <br>Future of <span class="text-brand-orange">Clean Energy.</span>
                </h2>
                <p class="text-slate-400 mt-6 text-sm font-bold tracking-widest max-w-md leading-loose">
                    JOIN THE NETWORK OF INDUSTRIAL INNOVATION. ACCESS YOUR PERSONALIZED DEPLOYMENT DASHBOARD AND LOGISTICS TERMINAL.
                </p>
                
                <div class="mt-12 flex items-center gap-6">
                    <div class="h-px w-12 bg-brand-orange"></div>
                    <span class="text-[10px] font-black text-white tracking-[0.4em]">Auth Node v2.4.0</span>
                </div>
            </div>
        </div>

        <!-- RIGHT COLUMN: AUTH FORM -->
        <div class="w-full lg:w-1/2 flex flex-col items-center justify-center p-8 lg:p-20 overflow-y-auto bg-white">
            <div class="w-full max-w-md">
                <!-- Back to Home (Mobile & Desktop) -->
                <div class="mb-12">
                    <a href="/" class="inline-flex items-center gap-2 text-[10px] font-black text-slate-400 tracking-widest hover:text-brand-orange transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7"></path></svg>
                        Back to Command Center
                    </a>
                </div>

                {{ $slot }}
            </div>
        </div>

    </div>
</body>
</html>