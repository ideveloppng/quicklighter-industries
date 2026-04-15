@extends('layouts.app')

@section('content')
<div class="bg-white uppercase">

    <!-- HERO -->
    <section class="relative h-[60vh] flex items-center overflow-hidden bg-brand-dark">
        <img src="{{ asset('images/reseller-hero.jpg') }}" class="absolute inset-0 w-full h-full object-cover opacity-30" alt="Distribution Center">
        <div class="absolute inset-0 bg-gradient-to-t from-brand-dark via-transparent to-transparent"></div>
        <div class="relative z-10 max-w-[1440px] mx-auto px-6 lg:px-20 w-full">
            <span class="text-brand-orange font-bold text-xs tracking-[0.4em]">Business Network</span>
            <h1 class="text-5xl lg:text-7xl font-black text-white mt-4 tracking-tighter leading-none">Partners in <br>Precision.</h1>
        </div>
    </section>

    <!-- DIRECTORY (DYNAMIC DATA) -->
    <section class="py-32 px-6 lg:px-20 bg-slate-50 border-y border-slate-100">
        <div class="max-w-[1000px] mx-auto">
            <div class="text-center mb-20">
                <span class="text-brand-orange font-bold text-xs tracking-[0.3em]">Network Directory</span>
                <h2 class="text-4xl lg:text-6xl font-black text-slate-900 mt-4 tracking-tighter leading-none">Existing Resellers.</h2>
                <div class="w-24 h-1 bg-brand-orange mx-auto mt-8"></div>
            </div>

            <!-- ACCORDION WITH DATABASE DATA -->
            <div x-data="{ activeState: null }" class="space-y-6">
                @foreach($resellers as $stateName => $dealers)
                <div class="border border-slate-200 bg-white group" :class="activeState === '{{ $stateName }}' ? 'border-brand-orange' : ''">
                    <button @click="activeState === '{{ $stateName }}' ? activeState = null : activeState = '{{ $stateName }}'" class="w-full flex justify-between items-center p-8 text-left focus:outline-none">
                        <div class="flex items-center gap-4">
                            <svg class="w-8 h-8 text-yellow-500" fill="currentColor" viewBox="0 0 20 20"><path d="M2 6a2 2 0 012-2h5l2 2h5a2 2 0 012 2v6a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"></path></svg>
                            <span class="text-xl lg:text-2xl font-black tracking-tight" :class="activeState === '{{ $stateName }}' ? 'text-brand-maroon' : 'text-slate-900'">{{ $stateName }}</span>
                        </div>
                        <svg class="w-6 h-6 transform transition-transform duration-300 text-brand-orange" :class="activeState === '{{ $stateName }}' ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7"></path></svg>
                    </button>

                    <div x-show="activeState === '{{ $stateName }}'" x-cloak x-transition:enter="transition ease-out duration-300" class="px-8 pb-10 border-t border-slate-50 pt-8">
                        <div class="space-y-12">
                            @foreach($dealers as $index => $dealer)
                                <div class="relative pl-4 border-l-2 border-slate-100">
                                    <h4 class="text-xl font-black text-slate-900 tracking-tight mb-6">{{ $index + 1 }}. {{ $dealer->name }}</h4>
                                    <div class="grid md:grid-cols-2 gap-10 mb-10">
                                        <div class="space-y-4">
                                            <div><span class="block text-[10px] font-black text-slate-400 tracking-widest mb-1">Location</span><p class="text-slate-900 font-bold text-sm">{{ $dealer->location }}</p></div>
                                            <div><span class="block text-[10px] font-black text-slate-400 tracking-widest mb-1">Phone</span><p class="text-slate-900 font-bold text-sm tracking-widest">{{ $dealer->phone }}</p></div>
                                        </div>
                                        <div><span class="block text-[10px] font-black text-slate-400 tracking-widest mb-1">Email</span><p class="text-slate-900 font-bold text-sm">{{ $dealer->email ?? 'N/A' }}</p></div>
                                    </div>
                                    <div class="flex flex-wrap gap-4">
                                        <a href="tel:{{ $dealer->phone }}" class="inline-flex items-center gap-3 bg-brand-dark text-white px-8 py-4 rounded-sm font-black text-[10px] tracking-[0.2em] hover:bg-brand-orange transition-all">Call Dealer</a>
                                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $dealer->phone) }}" target="_blank" class="inline-flex items-center gap-3 bg-[#128C7E] text-white px-8 py-4 rounded-sm font-black text-[10px] tracking-[0.2em] hover:bg-opacity-90 transition-all">WhatsApp Message</a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endforeach
                
                @if($resellers->isEmpty())
                    <div class="py-20 text-center border-2 border-dashed border-slate-200">
                        <p class="text-[10px] font-black text-slate-400 tracking-widest">Our authorized node network is currently being configured.</p>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <<!-- SECTION 3: APPLICATION FORM (FUNCTIONAL) -->
    <section class="py-32 px-6 lg:px-20 bg-white">
        <div class="max-w-[1000px] mx-auto">
            <div class="text-center mb-16 uppercase">
                <span class="text-brand-orange font-bold text-xs tracking-[0.3em]">Partnership Inquiry</span>
                <h2 class="text-4xl lg:text-5xl font-black text-slate-900 mt-4 tracking-tighter leading-none">Begin Application.</h2>
                <div class="w-16 h-1 bg-slate-900 mx-auto mt-8 mb-8"></div>
                
                @if(session('success'))
                    <div class="p-5 bg-green-50 border-l-4 border-green-600 text-green-800 text-[10px] font-black tracking-widest">{{ session('success') }}</div>
                @endif
            </div>

            <form action="{{ route('reseller.apply') }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-10">
                @csrf
                <div class="space-y-3">
                    <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 px-1">Registered Business Name</label>
                    <input type="text" name="business_name" required class="w-full bg-slate-50 border border-slate-200 px-6 py-5 rounded-sm font-bold text-slate-900 focus:outline-none focus:border-brand-orange transition-all uppercase text-xs tracking-widest outline-none">
                </div>
                <div class="space-y-3">
                    <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 px-1">Full Name (Principal)</label>
                    <input type="text" name="contact_person" required class="w-full bg-slate-50 border border-slate-200 px-6 py-5 rounded-sm font-bold text-slate-900 focus:outline-none focus:border-brand-orange transition-all uppercase text-xs tracking-widest outline-none">
                </div>
                <div class="space-y-3">
                    <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 px-1">Email Address</label>
                    <input type="email" name="email" required class="w-full bg-slate-50 border border-slate-200 px-6 py-5 rounded-sm font-bold text-slate-900 focus:outline-none focus:border-brand-orange transition-all uppercase text-xs tracking-widest outline-none">
                </div>
                <div class="space-y-3">
                    <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 px-1">Phone Number</label>
                    <input type="tel" name="phone" required class="w-full bg-slate-50 border border-slate-200 px-6 py-5 rounded-sm font-bold text-slate-900 focus:outline-none focus:border-brand-orange transition-all tracking-widest outline-none">
                </div>
                <div class="space-y-3 md:col-span-2">
                    <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 px-1">Territory (City & State)</label>
                    <input type="text" name="territory" required class="w-full bg-slate-50 border border-slate-200 px-6 py-5 rounded-sm font-bold text-slate-900 focus:outline-none focus:border-brand-orange transition-all uppercase text-xs tracking-widest outline-none">
                </div>
                <div class="space-y-3 md:col-span-2">
                    <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 px-1">Business Description</label>
                    <textarea name="description" rows="4" required class="w-full bg-slate-50 border border-slate-200 px-6 py-5 rounded-sm font-bold text-slate-900 focus:outline-none focus:border-brand-orange transition-all uppercase text-xs tracking-widest outline-none"></textarea>
                </div>
                <div class="md:col-span-2">
                    <button type="submit" class="w-full bg-brand-dark text-white py-8 font-black uppercase tracking-[0.4em] text-xs hover:bg-brand-orange transition-all duration-300 shadow-xl">Submit Official Request</button>
                </div>
            </form>
        </div>
    </section>

</div>
@endsection