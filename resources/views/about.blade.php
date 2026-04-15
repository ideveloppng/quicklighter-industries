@extends('layouts.app')

@section('content')
<div class="bg-white">

    <!-- HERO: THE MISSION -->
    <section class="relative h-[60vh] flex items-center overflow-hidden bg-brand-dark uppercase">
        <!-- Background Image from PC -->
        <img src="{{ asset('images/about-hero.jpg') }}" class="absolute inset-0 w-full h-full object-cover opacity-40 grayscale" alt="Factory">
        <div class="absolute inset-0 bg-gradient-to-r from-brand-dark to-transparent"></div>
        
        <div class="relative z-10 max-w-[1440px] mx-auto px-6 lg:px-20 w-full">
            <span class="text-brand-orange font-bold uppercase text-xs tracking-[0.4em]">The Vision</span>
            <h1 class="text-5xl lg:text-7xl font-black text-white mt-4 tracking-tighter leading-none">
                Engineering <br>A Greener Africa.
            </h1>
        </div>
    </section>

    <!-- SECTION 1: WHO WE ARE -->
    <section class="py-24 px-6 lg:px-20 uppercase">
        <div class="max-w-[1440px] mx-auto grid lg:grid-cols-2 gap-16 items-center">
            <div>
                <span class="text-brand-orange font-bold uppercase text-xs tracking-[0.3em]">The Story</span>
                <h2 class="text-4xl font-black text-slate-900 mt-4 leading-tight tracking-tighter">Transforming Everyday <br>Nigerian Experiences.</h2>
                <div class="mt-8 space-y-6 text-slate-600 font-bold text-xs tracking-wide leading-loose">
                    <p>
                        QuickLighter Industries is a forward-thinking Nigerian company dedicated to transforming everyday home and industrial experiences through innovative, affordable, and eco-friendly solutions. 
                    </p>
                    <p>
                        Founded on the principles of thermal physics and sustainable engineering, our products range from smokeless charcoal stoves to multipurpose home accessories. We aim to solve the dual challenge of high fuel costs and environmental degradation.
                    </p>
                    <p>
                        At QuickLighter, we believe that innovation should simplify life. Every product we create is tested for durability, performance, and user satisfaction in our Lagos-based facility.
                    </p>
                </div>
            </div>
            <!-- Image Layout -->
            <div class="relative">
                <img src="{{ asset('images/about2.jpg') }}" class="rounded-sm shadow-2xl w-full h-[500px] object-cover" alt="Engineering">
                <!-- Floating Stat Badge (Italic Removed) -->
                <div class="absolute -bottom-8 -left-8 bg-brand-orange text-white p-8 shadow-2xl">
                    <p class="text-4xl font-black">100%</p>
                    <p class="text-[10px] font-black uppercase tracking-widest mt-1">Nigerian Engineered</p>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION 2: THE IMPACT (Stats) (Italics Removed from values) -->
    <section class="bg-slate-50 py-24 px-6 lg:px-20 border-y border-slate-100 uppercase">
        <div class="max-w-[1440px] mx-auto grid grid-cols-2 lg:grid-cols-4 gap-12">
            <div class="text-center">
                <h3 class="text-5xl font-black text-brand-dark">50%</h3>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mt-2">Charcoal Savings</p>
            </div>
            <div class="text-center">
                <h3 class="text-5xl font-black text-brand-dark">Zero</h3>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mt-2">Smoke Emission</p>
            </div>
            <div class="text-center">
                <h3 class="text-5xl font-black text-brand-dark">10k+</h3>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mt-2">Homes Transformed</p>
            </div>
            <div class="text-center">
                <h3 class="text-5xl font-black text-brand-dark">2.5mm</h3>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mt-2">Industrial Steel</p>
            </div>
        </div>
    </section>

    <!-- SECTION 3: CORE VALUES -->
    <section class="py-24 px-6 lg:px-20 uppercase">
        <div class="max-w-[1440px] mx-auto">
            <div class="text-center mb-16">
                <span class="text-brand-orange font-bold uppercase text-xs tracking-[0.3em]">Our Foundation</span>
                <h2 class="text-4xl font-black text-slate-900 mt-4 tracking-tighter leading-none">Principles of Precision.</h2>
            </div>
            
            <div class="grid md:grid-cols-3 gap-8">
                <!-- Value 1 -->
                <div class="p-10 border border-slate-100 hover:border-brand-orange transition-colors group">
                    <div class="w-12 h-12 bg-slate-100 flex items-center justify-center text-brand-dark group-hover:bg-brand-orange group-hover:text-white transition-all">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>
                    <h4 class="text-xl font-black mt-6 uppercase tracking-tight">Sustainability</h4>
                    <p class="text-slate-500 font-bold text-[11px] mt-4 leading-relaxed tracking-wide">We engineer products that minimize carbon footprints and protect Nigeria's natural forests.</p>
                </div>

                <!-- Value 2 -->
                <div class="p-10 border border-slate-100 hover:border-brand-orange transition-colors group">
                    <div class="w-12 h-12 bg-slate-100 flex items-center justify-center text-brand-dark group-hover:bg-brand-orange group-hover:text-white transition-all">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                    </div>
                    <h4 class="text-xl font-black mt-6 uppercase tracking-tight">Quality Assurance</h4>
                    <p class="text-slate-500 font-bold text-[11px] mt-4 leading-relaxed tracking-wide">Every unit undergoes a rigorous 12-point quality check for heat retention and structural integrity.</p>
                </div>

                <!-- Value 3 -->
                <div class="p-10 border border-slate-100 hover:border-brand-orange transition-colors group">
                    <div class="w-12 h-12 bg-slate-100 flex items-center justify-center text-brand-dark group-hover:bg-brand-orange group-hover:text-white transition-all">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h4 class="text-xl font-black mt-6 uppercase tracking-tight">Affordability</h4>
                    <p class="text-slate-500 font-bold text-[11px] mt-4 leading-relaxed tracking-wide">Advanced technology shouldn't be a luxury. We make clean energy accessible to all income levels.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION 4: CTA -->
    <section class="py-32 px-6 lg:px-20 bg-brand-dark text-white text-center uppercase tracking-tight">
        <h2 class="text-4xl lg:text-5xl font-black tracking-tighter leading-none">Ready to experience <br>the QuickLighter difference?</h2>
        <p class="mt-8 text-slate-400 max-w-xl mx-auto font-bold text-xs tracking-widest leading-loose">Browse our collection of thermal appliances and smart home hardware.</p>
        <div class="mt-12">
            <a href="/shop" class="bg-brand-orange text-white px-12 py-5 rounded-sm font-black text-xs uppercase tracking-[0.3em] hover:bg-white hover:text-brand-dark transition-all duration-300 shadow-2xl">
                Enter Digital Showroom
            </a>
        </div>
    </section>

</div>
@endsection