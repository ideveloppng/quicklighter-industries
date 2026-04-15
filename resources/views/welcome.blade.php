@extends('layouts.app')

@section('content')
<div class="bg-white">
    
    <!-- HERO SLIDER SECTION -->
    <section 
        x-data="{ 
            activeSlide: 0, 
            slides: [
                { 
                    title: 'Cook Faster.', 
                    highlight: 'Save 50% on Charcoal.', 
                    sub: 'The next generation of smokeless biomass gasification technology. Engineered for the modern industrial kitchen.',
                    image: '{{ asset('images/hero-1.jpg') }}' 
                },
                { 
                    title: 'Zero Smoke.', 
                    highlight: 'Clean Cooking for your Home.', 
                    sub: 'Engineered to eliminate harmful emissions while maximizing thermal output and safety.',
                    image: '{{ asset('images/hero-2.jpg') }}' 
                },
                { 
                    title: 'Built to Last.', 
                    highlight: 'Industrial Grade Engineering.', 
                    sub: 'Forged with sustainable materials and calibrated for maximum efficiency in every environment.',
                    image: '{{ asset('images/hero-3.jpg') }}' 
                }
            ],
            init() {
                setInterval(() => {
                    this.activeSlide = (this.activeSlide + 1) % this.slides.length
                }, 7000);
            }
        }" 
        class="relative h-[85vh] lg:h-[95vh] w-full overflow-hidden bg-black"
    >
        <template x-for="(slide, index) in slides" :key="index">
            <div x-show="activeSlide === index" x-transition:enter="transition opacity duration-1000" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition opacity duration-1000" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="absolute inset-0">
                <div class="absolute inset-0 bg-black/75 z-10"></div>
                <img :src="slide.image" :class="activeSlide === index ? 'animate-ken-burns' : ''" class="h-full w-full object-cover">
            </div>
        </template>

        <div class="relative z-20 h-full max-w-[1440px] mx-auto px-6 lg:px-20 flex items-center">
            <template x-for="(slide, index) in slides" :key="'text-' + index">
                <div x-show="activeSlide === index" x-transition:enter="transition all delay-300 duration-700 ease-out" x-transition:enter-start="opacity-0 translate-y-12" x-transition:enter-end="opacity-100 translate-y-0" class="absolute max-w-4xl">
                    <span class="text-brand-orange font-bold tracking-[0.3em] uppercase text-xs">Precision Engineering</span>
                    <h1 class="text-5xl lg:text-8xl font-black text-white mt-4 leading-[1.05] tracking-tighter">
                        <span x-text="slide.title"></span> <br>
                        <span class="text-brand-orange" x-text="slide.highlight"></span>
                    </h1>
                    <p class="text-slate-300 mt-8 text-lg lg:text-xl max-w-xl leading-relaxed font-medium" x-text="slide.sub"></p>
                    <div class="mt-12 flex flex-wrap gap-5">
                        <a href="/shop" class="bg-brand-orange text-white px-10 py-5 rounded-sm font-black text-sm uppercase tracking-widest hover:bg-white hover:text-brand-dark transition-all duration-300 flex items-center gap-3">
                            Shop Stoves <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                        </a>
                    </div>
                </div>
            </template>
        </div>
        <div class="absolute bottom-12 left-6 lg:left-20 z-30 flex items-center gap-4">
            <template x-for="(slide, index) in slides" :key="'dot-' + index">
                <button @click="activeSlide = index" class="group relative h-1 transition-all duration-500" :class="activeSlide === index ? 'w-16 bg-brand-orange' : 'w-8 bg-white/20 hover:bg-white/40'"></button>
            </template>
        </div>
    </section>

    <!-- ABOUT US SECTION -->
    <section class="py-32 px-6 lg:px-20 bg-slate-50 overflow-hidden border-b border-slate-100">
        <div class="max-w-[1440px] mx-auto flex flex-col lg:flex-row items-center gap-16 lg:gap-24">
            <div class="lg:w-1/2 order-2 lg:order-1">
                <div class="inline-block px-3 py-1 bg-brand-orange/10 text-brand-orange font-bold uppercase text-[10px] tracking-[0.3em] mb-4">Our Mission</div>
                <h2 class="text-4xl lg:text-5xl font-black text-slate-900 leading-tight tracking-tighter">Innovation That Protects.</h2>
                <div class="mt-8 space-y-6 text-slate-600 leading-relaxed font-medium">
                    <p>QuickLighter Industries is a forward-thinking Nigerian company dedicated to transforming everyday home and industrial experiences through innovative, affordable, and eco-friendly solutions. From Eco-friendly charcoal stoves to multipurpose home accessories, our products are built with safety, sustainability, and style in mind.</p>
                    <p>At QuickLighter, we believe that innovation should not just be functional—it should simplify life, improve well-being, and protect the environment. Every product we create is tested for durability, performance, and user satisfaction.</p>
                </div>
                <div class="mt-10">
                    <a href="/about" class="inline-flex items-center gap-3 bg-brand-dark text-white px-8 py-4 rounded-sm font-black text-xs uppercase tracking-widest hover:bg-brand-orange transition-all duration-300 group">
                        Learn More About Us
                        <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                    </a>
                </div>
            </div>
            <div class="lg:w-1/2 order-1 lg:order-2 relative">
                <div class="relative z-10 w-full lg:w-[85%] ml-auto">
                    <img src="{{ asset('images/about-main.jpg') }}" alt="QuickLighter" class="rounded-sm shadow-2xl w-full h-[500px] object-cover">
                </div>
                <div class="absolute -bottom-10 left-0 z-20 w-48 h-48 lg:w-64 lg:h-64 border-[12px] border-white shadow-2xl hidden sm:block">
                    <img src="{{ asset('images/about-secondary.jpg') }}" alt="Detail" class="w-full h-full object-cover">
                </div>
            </div>
        </div>
    </section>

    <!-- PRODUCT ECOSYSTEM SECTION -->
    <section class="py-32 px-6 lg:px-20 bg-white overflow-hidden">
        <div class="max-w-[1440px] mx-auto">
            <div class="flex flex-col lg:flex-row justify-between items-start lg:items-end mb-20 gap-8">
                <div class="relative">
                    <span class="absolute -top-12 left-0 text-8xl font-black text-slate-100 select-none z-0">02</span>
                    <div class="relative z-10">
                        <span class="text-brand-orange font-bold uppercase text-xs tracking-[0.4em]">The Collection</span>
                        <h2 class="text-5xl lg:text-7xl font-black text-brand-dark mt-4 tracking-tighter">Engineered <br>Ecosystems.</h2>
                    </div>
                </div>
                <div class="lg:max-w-md pb-2 border-l-4 border-brand-orange pl-6">
                    <p class="text-slate-500 font-medium leading-relaxed uppercase text-[11px] tracking-wider">
                        We don't just manufacture products; we engineer solutions for the African landscape. Every unit is a marriage of thermal physics and ergonomic design.
                    </p>
                </div>
            </div>

            <div class="grid lg:grid-cols-12 gap-8">
                <!-- CATEGORY 01: COOKING APPLIANCES -->
                <div class="lg:col-span-7 group relative bg-slate-50 overflow-hidden rounded-sm border border-slate-100 transition-all duration-500">
                    <div class="flex flex-col md:flex-row h-full">
                        <div class="p-10 md:w-1/2 flex flex-col justify-between z-20">
                            <div>
                                <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Category 01</span>
                                <h3 class="text-3xl font-black text-brand-dark mt-2">Thermal <br>Appliances.</h3>
                                <ul class="mt-8 space-y-4">
                                    <li class="flex items-center gap-3 text-sm font-bold text-slate-600">
                                        <span class="w-1.5 h-1.5 bg-brand-orange rounded-full"></span> 50% Fuel Reduction
                                    </li>
                                    <li class="flex items-center gap-3 text-sm font-bold text-slate-600">
                                        <span class="w-1.5 h-1.5 bg-brand-orange rounded-full"></span> Zero-Smoke Gasification
                                    </li>
                                </ul>
                            </div>
                            <div class="mt-12">
                                <a href="/shop?category=cooking-appliances" class="inline-block border-b-2 border-brand-dark pb-1 text-xs font-black uppercase tracking-widest hover:text-brand-orange hover:border-brand-orange transition-all">
                                    Explore Appliances &rarr;
                                </a>
                            </div>
                        </div>
                        <div class="md:w-1/2 h-80 md:h-full relative overflow-hidden bg-slate-900">
                            <img src="{{ asset('images/product-cooking-alt.jpg') }}" alt="Stove" class="absolute inset-0 w-full h-full object-cover opacity-80 group-hover:scale-110 transition-transform duration-700">
                        </div>
                    </div>
                </div>

                <!-- CATEGORY 02: HOME ACCESSORIES -->
                <div class="lg:col-span-5 group relative bg-brand-dark overflow-hidden rounded-sm shadow-xl text-white">
                    <div class="absolute inset-0 z-0">
                        <img src="{{ asset('images/product-acc-alt.jpg') }}" alt="Accessories" class="w-full h-full object-cover opacity-30 group-hover:scale-110 transition-transform duration-700">
                        <div class="absolute inset-0 bg-gradient-to-t from-brand-dark via-brand-dark/40 to-transparent"></div>
                    </div>
                    <div class="relative z-10 p-10 h-full flex flex-col justify-between min-h-[500px]">
                        <div>
                            <span class="text-[10px] font-black text-brand-orange uppercase tracking-widest">Category 02</span>
                            <h3 class="text-4xl font-black mt-2 tracking-tight">Smart <br>Hardware.</h3>
                            <p class="mt-4 text-slate-400 text-sm font-medium leading-relaxed max-w-xs">Space-saving solutions designed for modern urban living. Minimalist form, maximalist function.</p>
                        </div>
                        <a href="/shop?category=home-accessories" class="block w-full text-center bg-white text-brand-dark py-4 font-black text-xs uppercase tracking-widest hover:bg-brand-orange hover:text-white transition-all">
                            View Accessories
                        </a>
                    </div>
                </div>
            </div>

            <!-- Bottom Feature Bar -->
            <div class="mt-12 grid grid-cols-2 lg:grid-cols-4 gap-4">
                <div class="bg-white p-8 border border-slate-100 text-center">
                    <p class="text-2xl font-black text-brand-dark">2.5mm</p>
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mt-1">Steel Gauge</p>
                </div>
                <div class="bg-white p-8 border border-slate-100 text-center">
                    <p class="text-2xl font-black text-brand-dark">10yr+</p>
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mt-1">Service Life</p>
                </div>
                <div class="bg-white p-8 border border-slate-100 text-center">
                    <p class="text-2xl font-black text-brand-dark">0.02%</p>
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mt-1">Carbon Output</p>
                </div>
                <div class="bg-white p-8 border border-slate-100 text-center">
                    <p class="text-2xl font-black text-brand-dark">PRO</p>
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mt-1">Tested Quality</p>
                </div>
            </div>
        </div>
    </section>

    <!-- FEATURED PRODUCTS SECTION -->
    <section class="py-24 px-6 lg:px-20 bg-slate-50 border-y border-slate-100">
        <div class="max-w-[1440px] mx-auto">
            <div class="flex justify-between items-end mb-16">
                <h2 class="text-4xl lg:text-5xl font-black text-slate-900 tracking-tighter uppercase leading-none">Featured Units.</h2>
                <a href="{{ route('shop') }}" class="text-[10px] font-black uppercase tracking-widest text-slate-400 hover:text-brand-orange transition-colors">View All Products</a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10">
                @forelse($featuredProducts as $product)
                @php
                    // Check initial quantity in cart session
                    $cart = session('cart', []);
                    $initialQty = isset($cart[$product->id]) ? $cart[$product->id]['quantity'] : 0;
                @endphp

                <div class="flex flex-col group" x-data="{ 
                        added: false, 
                        qty: {{ $initialQty }},
                        async add() {
                            this.added = true;
                            // The addToCart JS function now returns the full cart data
                            const data = await window.addToCart({{ $product->id }});
                            this.qty = data.itemQuantity;
                            
                            // This will trigger the global @cart-updated listener in app.blade.php
                            setTimeout(() => this.added = false, 2000);
                        }
                    }">
                    <a href="{{ route('shop.show', $product->slug) }}" class="relative aspect-square overflow-hidden bg-white border border-slate-100 block">
                        <!-- QUANTITY BADGE -->
                        <div x-show="qty > 0" x-cloak class="absolute top-4 right-4 z-30 bg-brand-orange text-white px-3 py-1 font-black text-[10px] uppercase tracking-tighter">
                            Deployed: <span x-text="qty"></span> Units
                        </div>

                        @if($product->images)
                            <img src="{{ asset('storage/' . $product->images[0]) }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                        @endif
                    </a>

                    <!-- Add to Cart Button -->
                    <button @click="add()" 
                            :class="added ? 'bg-green-600' : 'bg-brand-dark hover:bg-brand-orange'" 
                            class="w-full text-white py-5 font-black text-[10px] uppercase tracking-[0.2em] transition-all flex items-center justify-center gap-2">
                        <span x-show="!added">Add to Deployment</span>
                        <span x-show="added" x-cloak>Added Successfully</span>
                    </button>

                    <div class="mt-6 flex justify-between items-baseline px-1">
                        <h3 class="text-lg font-black text-slate-900 uppercase truncate pr-4">{{ $product->name }}</h3>
                        <p class="text-xl font-black text-slate-900 whitespace-nowrap">₦{{ number_format($product->price, 0) }}</p>
                    </div>
                </div>
                @empty
                    <p class="col-span-full text-center text-slate-400 font-black uppercase text-[10px] py-20">No featured units available.</p>
                @endforelse
            </div>
        </div>
    </section>

    <!-- FIELD REPORTS -->
    <section class="py-24 px-6 lg:px-20 bg-white">
        <div class="max-w-[1440px] mx-auto">
            <div class="text-center mb-16">
                <span class="text-brand-orange font-bold uppercase text-xs tracking-[0.3em]">Field Reports</span>
                <h2 class="text-4xl lg:text-5xl font-black text-slate-900 mt-4 tracking-tighter uppercase leading-none">Voices of the Revolution.</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @php
                    $testimonials = [
                        ['quote' => 'The reduction in charcoal costs was immediate. In our Lagos restaurant, we saved over ₦150,000 in the first month alone. The build quality is exceptional.', 'author' => 'Chidi Okafor', 'location' => 'Executive Chef, Lagos'],
                        ['quote' => 'No more smoke in my kitchen. It is clean, fast, and actually looks beautiful on my counter. My kids can finally breathe while I am cooking.', 'author' => 'Amina Bello', 'location' => 'Home Owner, Abuja'],
                        ['quote' => 'We use these for our community outreach programs. Reliable, portable, and extremely fuel efficient. Truly precision ecology in action.', 'author' => 'Oluwaseun Ade', 'location' => 'NGO Director, Ibadan']
                    ];
                @endphp

                @foreach($testimonials as $item)
                <div class="bg-slate-50 p-12 border-l-4 border-brand-orange flex flex-col justify-between transition-all duration-300">
                    <div>
                        <div class="text-brand-orange mb-8 uppercase text-[10px] font-black tracking-widest">Verified Report</div>
                        <p class="text-slate-800 font-bold leading-relaxed text-sm uppercase tracking-tight">
                            "{{ $item['quote'] }}"
                        </p>
                    </div>
                    <div class="mt-12">
                        <p class="font-black text-slate-900 uppercase tracking-widest text-xs">{{ $item['author'] }}</p>
                        <p class="text-brand-orange text-[9px] font-black uppercase tracking-[0.2em] mt-1">{{ $item['location'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- SCIENCE SECTION -->
    <section class="bg-brand-dark py-32 px-6 lg:px-20 text-white relative overflow-hidden">
        <div class="lg:flex lg:gap-24 relative z-10">
            <div class="lg:w-1/2 grid grid-cols-1 sm:grid-cols-2 gap-12">
                <div>
                    <div class="text-brand-orange mb-6"><svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg></div>
                    <h4 class="font-black text-xl tracking-tight uppercase">Vortex Airflow</h4>
                    <p class="text-slate-400 text-sm mt-3 leading-relaxed uppercase tracking-tight">Dual-channel forced air intake ensures complete combustion and zero waste.</p>
                </div>
                <div>
                    <div class="text-brand-orange mb-6"><svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path></svg></div>
                    <h4 class="font-black text-xl tracking-tight uppercase">Zero Smoke</h4>
                    <p class="text-slate-400 text-sm mt-3 leading-relaxed uppercase tracking-tight">Advanced gasification converts smoke into usable energy for cooking.</p>
                </div>
            </div>
            <div class="lg:w-1/2 mt-24 lg:mt-0">
                <span class="text-brand-orange font-bold uppercase text-xs tracking-[0.3em]">The Science</span>
                <h2 class="text-5xl lg:text-6xl font-black mt-6 leading-tight tracking-tighter uppercase">Advanced Biomass Gasification.</h2>
                <p class="text-slate-400 mt-8 text-lg leading-relaxed font-medium uppercase text-xs tracking-widest">We've re-engineered the combustion process from the molecular level. By separating the drying, pyrolysis, and gasification stages, QuickLighter stoves extract every joule of energy from biomass.</p>
            </div>
        </div>
    </section>

</div>
@endsection