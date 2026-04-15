@extends('layouts.app')

@section('content')
<div class="bg-white uppercase tracking-tight">

    <!-- HERO: SERVICE & SUPPORT -->
    <section class="relative min-h-[70vh] flex items-center overflow-hidden bg-brand-dark py-20">
        <!-- Background Image from PC -->
        <img src="{{ asset('images/support-hero.jpg') }}" class="absolute inset-0 w-full h-full object-cover opacity-20 grayscale" alt="Support Hub">
        <div class="absolute inset-0 bg-gradient-to-t from-brand-dark via-brand-dark/60 to-transparent"></div>
        
        <div class="relative z-10 max-w-[1440px] mx-auto px-6 lg:px-20 w-full">
            <span class="text-brand-orange font-black text-[10px] tracking-[0.5em] uppercase">Service & Support Terminal</span>
            <h1 class="text-5xl lg:text-8xl font-black text-white mt-4 tracking-tighter leading-none">
                HOW CAN WE <br>HELP YOU?
            </h1>
            
            <div class="mt-12 max-w-3xl space-y-8">
                <p class="text-slate-200 text-lg lg:text-2xl font-black leading-tight tracking-tight">
                    WE’D LOVE TO HEAR FROM YOU! WHETHER YOU HAVE A QUESTION ABOUT OUR PRODUCTS, SERVICES, PARTNERSHIP OPPORTUNITIES, OR YOU SIMPLY WANT TO GIVE FEEDBACK WE’RE HERE TO HELP.
                </p>
                <p class="text-slate-400 text-sm lg:text-base font-bold leading-relaxed tracking-widest">
                    WHETHER YOU’RE A NEW CUSTOMER OR A LONG-TERM PARTNER, YOUR SATISFACTION IS OUR TOP PRIORITY. REACH OUT TODAY LET’S MAKE SOMETHING AMAZING HAPPEN TOGETHER!
                </p>
            </div>

            <div class="mt-12 flex flex-wrap gap-6">
                <a href="#contact-form" class="bg-brand-orange text-white px-10 py-5 rounded-sm font-black text-[10px] tracking-[0.3em] hover:bg-white hover:text-brand-dark transition-all duration-500 shadow-2xl">
                    INITIALIZE INQUIRY
                </a>
                <!-- SOCIAL MEDIA QUICK LINKS -->
                <div class="flex items-center gap-4 bg-white/5 backdrop-blur-md px-6 py-4 border border-white/10 rounded-sm">
                    <span class="text-[9px] font-black text-slate-400 tracking-widest mr-2 border-r border-white/10 pr-4 uppercase">Social Nodes</span>
                    <div class="flex gap-4">
                        <a href="#" class="text-white hover:text-brand-orange transition-colors"><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg></a>
                        <a href="#" class="text-white hover:text-brand-orange transition-colors"><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0C8.74 0 8.333.015 7.053.072 5.775.132 4.905.333 4.14.63c-.789.306-1.459.717-2.126 1.384S.935 3.35.63 4.14C.333 4.905.131 5.775.072 7.053.012 8.333 0 8.74 0 12s.015 3.667.072 4.947c.06 1.277.261 2.148.558 2.913.306.788.717 1.459 1.384 2.126.667.666 1.336 1.079 2.126 1.384.766.296 1.636.499 2.913.558C8.333 23.984 8.74 24 12 24s3.667-.015 4.947-.072c1.277-.06 2.148-.262 2.913-.558.788-.306 1.459-.718 2.126-1.384.666-.667 1.079-1.335 1.384-2.126.296-.765.499-1.636.558-2.913.06-1.28.072-1.687.072-4.947s-.015-3.667-.072-4.947c-.06-1.277-.262-2.149-.558-2.913-.306-.789-.718-1.459-1.384-2.126C21.319 1.347 20.651.935 19.86.63c-.765-.297-1.636-.499-2.913-.558C15.667.012 15.26 0 12 0zm0 2.16c3.203 0 3.585.016 4.85.071 1.17.055 1.805.249 2.227.415.562.217.96.477 1.382.896.419.42.679.819.896 1.381.164.422.36 1.057.413 2.227.057 1.266.07 1.646.07 4.85s-.015 3.584-.071 4.85c-.055 1.17-.249 1.805-.415 2.227-.217.562-.477.96-.896 1.382-.42.419-.819.679-1.381.896-.422.164-1.056.36-2.227.413-1.266.057-1.646.07-4.85.07s-3.584-.015-4.85-.071c-1.17-.055-1.805-.249-2.227-.415-.562-.217-.96-.477-1.382-.896-.419-.42-.679-.819-.896-1.381-.164-.422-.36-1.057-.413-2.227C2.177 15.585 2.16 15.204 2.16 12s.015-3.585.071-4.85c.055-1.17.249-1.805.415-2.227.217-.562.477-.96.896-1.382.42-.419.819-.679 1.381-.896.422-.164 1.056-.36 2.227-.413 1.266-.057 1.646-.07 4.85-.07zM12 5.837a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg></a>
                        <a href="#" class="text-white hover:text-brand-orange transition-colors"><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg></a>
                        <a href="#" class="text-white hover:text-brand-orange transition-colors"><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION 1: QUICK ACTION CHANNELS -->
    <section class="py-24 px-6 lg:px-20 border-b border-slate-100">
        <div class="max-w-[1440px] mx-auto grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Channel 01 -->
            <div class="p-10 bg-slate-50 border border-slate-200 group hover:border-brand-orange transition-all duration-500">
                <div class="text-brand-orange mb-6"><svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg></div>
                <h4 class="text-xl font-black text-slate-900 tracking-tight">GENERAL INQUIRIES</h4>
                <div class="mt-6 space-y-2">
                    <p class="text-sm font-bold text-slate-500 tracking-widest">INFO@QUICKLIGHTER.COM</p>
                    <p class="text-sm font-black text-slate-900 tracking-[0.2em]">+234 (0) 816 890 7662</p>
                </div>
            </div>

            <!-- Channel 02 -->
            <div class="p-10 bg-slate-50 border border-slate-200 group hover:border-brand-orange transition-all duration-500">
                <div class="text-brand-orange mb-6"><svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg></div>
                <h4 class="text-xl font-black text-slate-900 tracking-tight">SALES & RESELLING</h4>
                <div class="mt-6 space-y-2">
                    <p class="text-sm font-bold text-slate-500 tracking-widest">SALES@QUICKLIGHTER.COM</p>
                    <p class="text-sm font-black text-slate-900 tracking-[0.2em]">+234 (0) 816 890 7662</p>
                </div>
            </div>

            <!-- Channel 03 -->
            <div class="p-10 bg-[#128C7E] text-white shadow-2xl transition-all duration-500">
                <div class="text-white mb-6 opacity-40"><svg class="w-10 h-10" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.67-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg></div>
                <h4 class="text-xl font-black tracking-tight">TECHNICAL WHATSAPP</h4>
                <div class="mt-6 space-y-4">
                    <p class="text-xs font-bold leading-relaxed opacity-80">DIRECT LINE TO OUR ENGINEERING DEPARTMENT FOR IMMEDIATE ASSISTANCE.</p>
                    <a href="https://wa.me/2348168907662" target="_blank" class="inline-block bg-white text-[#128C7E] px-6 py-3 rounded-sm font-black text-[10px] tracking-widest hover:bg-slate-100 transition-all uppercase">Open Terminal &rarr;</a>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION 2: PHYSICAL NODES -->
    <section class="py-24 px-6 lg:px-20 bg-slate-50 uppercase">
        <div class="max-w-[1440px] mx-auto grid lg:grid-cols-2 gap-12 lg:gap-20">
            <div class="space-y-6">
                <span class="text-brand-orange font-black text-[10px] tracking-[0.4em]">Corporate HQ</span>
                <h3 class="text-4xl font-black text-slate-900 tracking-tighter leading-none">HEADQUARTERS.</h3>
                <div class="p-10 bg-white border border-slate-200 rounded-sm">
                    <p class="text-base font-black text-slate-900 leading-relaxed tracking-wide">
                        [HQ ADDRESS LINE 01] <br>
                        [HQ ADDRESS LINE 02] <br>
                        LAGOS, NIGERIA.
                    </p>
                    <div class="mt-10 pt-10 border-t border-slate-100">
                        <p class="text-[9px] font-black text-slate-400 tracking-widest mb-1">OPERATIONAL CYCLE</p>
                        <p class="text-xs font-bold text-slate-900 tracking-widest uppercase">MON - FRI / 09:00 - 17:00</p>
                    </div>
                </div>
            </div>

            <div class="space-y-6">
                <span class="text-brand-orange font-black text-[10px] tracking-[0.4em]">Fabrication Hub</span>
                <h3 class="text-4xl font-black text-slate-900 tracking-tighter leading-none">THE FACTORY.</h3>
                <div class="p-10 bg-white border border-slate-200 rounded-sm">
                    <p class="text-base font-black text-slate-900 leading-relaxed tracking-wide uppercase">
                        FACTORY COMPLEX B, <br>
                        BESIDE IKORODU POWER STATION, <br>
                        LAGOS, NIGERIA.
                    </p>
                    <div class="mt-10 pt-10 border-t border-slate-100 flex justify-between items-center">
                        <span class="bg-brand-dark text-white px-3 py-1 text-[8px] font-black tracking-widest uppercase">Certified Site</span>
                        <span class="text-[9px] font-black text-slate-400 tracking-widest uppercase">Security Node: Active</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION 3: INQUIRY TERMINAL -->
    <section id="contact-form" class="py-32 px-6 lg:px-20 bg-white">
        <div class="max-w-[1100px] mx-auto grid lg:grid-cols-12 gap-16 uppercase">
            
            <div class="lg:col-span-4 space-y-8">
                <h2 class="text-4xl font-black text-slate-900 tracking-tighter leading-none">SUBMIT <br>A REQUEST.</h2>
                <div class="w-16 h-1 bg-brand-orange"></div>
                <p class="text-slate-500 font-bold text-[11px] tracking-widest leading-loose">
                    FOR TECHNICAL SPECIFICATIONS, WARRANTY CLAIMS, OR BULK ORDER QUOTES, PLEASE USE OUR OFFICIAL CORRESPONDENCE CHANNEL.
                </p>
                
                <!-- NEW SOCIAL SYNC AREA -->
                <div class="pt-10 border-t border-slate-100">
                    <span class="text-[9px] font-black text-slate-400 tracking-[0.3em] block mb-6 uppercase">Sync with Official Nodes</span>
                    <div class="flex gap-6">
                        <a href="#" class="w-12 h-12 flex items-center justify-center bg-slate-50 border border-slate-200 text-slate-900 hover:bg-brand-orange hover:text-white transition-all duration-300 rounded-sm">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                        </a>
                        <a href="#" class="w-12 h-12 flex items-center justify-center bg-slate-50 border border-slate-200 text-slate-900 hover:bg-brand-orange hover:text-white transition-all duration-300 rounded-sm">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0C8.74 0 8.333.015 7.053.072 5.775.132 4.905.333 4.14.63c-.789.306-1.459.717-2.126 1.384S.935 3.35.63 4.14C.333 4.905.131 5.775.072 7.053.012 8.333 0 8.74 0 12s.015 3.667.072 4.947c.06 1.277.261 2.148.558 2.913.306.788.717 1.459 1.384 2.126.667.666 1.336 1.079 2.126 1.384.766.296 1.636.499 2.913.558C8.333 23.984 8.74 24 12 24s3.667-.015 4.947-.072c1.277-.06 2.148-.262 2.913-.558.788-.306 1.459-.718 2.126-1.384.666-.667 1.079-1.335 1.384-2.126.296-.765.499-1.636.558-2.913.06-1.28.072-1.687.072-4.947s-.015-3.667-.072-4.947c-.06-1.277-.262-2.149-.558-2.913-.306-.789-.718-1.459-1.384-2.126C21.319 1.347 20.651.935 19.86.63c-.765-.297-1.636-.499-2.913-.558C15.667.012 15.26 0 12 0zm0 2.16c3.203 0 3.585.016 4.85.071 1.17.055 1.805.249 2.227.415.562.217.96.477 1.382.896.419.42.679.819.896 1.381.164.422.36 1.057.413 2.227.057 1.266.07 1.646.07 4.85s-.015 3.584-.071 4.85c-.055 1.17-.249 1.805-.415 2.227-.217.562-.477.96-.896 1.382-.42.419-.819.679-1.381.896-.422.164-1.056.36-2.227.413-1.266.057-1.646.07-4.85.07s-3.584-.015-4.85-.071c-1.17-.055-1.805-.249-2.227-.415-.562-.217-.96-.477-1.382-.896-.419-.42-.679-.819-.896-1.381-.164-.422-.36-1.057-.413-2.227C2.177 15.585 2.16 15.204 2.16 12s.015-3.585.071-4.85c.055-1.17.249-1.805.415-2.227.217-.562.477-.96.896-1.382.42-.419.819-.679 1.381-.896.422-.164 1.056-.36 2.227-.413 1.266-.057 1.646-.07 4.85-.07zM12 5.837a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                        </a>
                        <a href="#" class="w-12 h-12 flex items-center justify-center bg-slate-50 border border-slate-200 text-slate-900 hover:bg-brand-orange hover:text-white transition-all duration-300 rounded-sm">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                        </a>
                    </div>
                </div>

                @if(session('success'))
                    <div class="p-4 bg-green-50 border-l-4 border-green-600 text-green-800 text-[10px] font-black tracking-widest shadow-sm">{{ session('success') }}</div>
                @endif
            </div>

            <div class="lg:col-span-8">
                <form action="{{ route('support.contact') }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    @csrf
                    <div class="space-y-3">
                        <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 px-1">Legal Full Name</label>
                        <input type="text" name="name" required class="w-full bg-slate-50 border border-slate-200 px-6 py-5 rounded-sm font-black text-slate-900 focus:outline-none focus:border-brand-orange transition-all outline-none text-xs tracking-widest uppercase">
                    </div>
                    <div class="space-y-3">
                        <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 px-1">Email Address</label>
                        <input type="email" name="email" required class="w-full bg-slate-50 border border-slate-200 px-6 py-5 rounded-sm font-black text-slate-900 focus:outline-none focus:border-brand-orange transition-all outline-none text-xs tracking-widest lowercase">
                    </div>
                    <div class="space-y-3 md:col-span-2">
                        <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 px-1">Inquiry Department</label>
                        <select name="subject" class="w-full bg-slate-50 border border-slate-200 px-6 py-5 rounded-sm font-black text-slate-900 focus:outline-none focus:border-brand-orange transition-all outline-none text-xs tracking-[0.2em]">
                            <option value="Technical Support">Technical Product Support</option>
                            <option value="Wholesale">Wholesale & Distribution</option>
                            <option value="Partnership">Partner Onboarding</option>
                            <option value="Feedback">General Feedback</option>
                        </select>
                    </div>
                    <div class="space-y-3 md:col-span-2">
                        <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 px-1">Message Details</label>
                        <textarea name="message" rows="6" required class="w-full bg-slate-50 border border-slate-200 px-6 py-5 rounded-sm font-black text-slate-900 focus:outline-none focus:border-brand-orange transition-all outline-none text-xs tracking-widest uppercase"></textarea>
                    </div>
                    <div class="md:col-span-2 pt-6">
                        <button type="submit" class="w-full bg-brand-dark text-white py-8 font-black uppercase tracking-[0.4em] text-xs hover:bg-brand-orange transition-all duration-300 shadow-xl">
                            DISPATCH INQUIRY TO HQ
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>

</div>
@endsection