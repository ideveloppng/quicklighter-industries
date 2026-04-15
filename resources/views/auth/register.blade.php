<x-guest-layout>
    <div class="mb-10">
        <h2 class="text-3xl font-black text-slate-900 tracking-tighter uppercase leading-none">Personnel Registry</h2>
        <p class="text-[10px] font-bold text-slate-400 tracking-widest mt-3 border-l-4 border-brand-orange pl-4">Create Master Deployment Account</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf

        <!-- Name -->
        <div class="space-y-1">
            <label class="text-[9px] font-black uppercase tracking-widest text-slate-400 px-1">Full Legal Name</label>
            <input type="text" name="name" :value="old('name')" required class="w-full bg-slate-50 border border-slate-100 px-5 py-4 font-bold text-slate-900 focus:outline-none focus:border-brand-orange transition-all text-xs tracking-widest outline-none">
        </div>

        <!-- Email -->
        <div class="space-y-1">
            <label class="text-[9px] font-black uppercase tracking-widest text-slate-400 px-1">Official Email</label>
            <input type="email" name="email" :value="old('email')" required class="w-full bg-slate-50 border border-slate-100 px-5 py-4 font-bold text-slate-900 focus:outline-none focus:border-brand-orange transition-all text-xs tracking-widest outline-none">
        </div>

        <!-- Phone Number (NEW) -->
        <div class="space-y-1">
            <label class="text-[9px] font-black uppercase tracking-widest text-slate-400 px-1">Operational Phone (WhatsApp)</label>
            <input type="text" name="phone" :value="old('phone')" required class="w-full bg-slate-50 border border-slate-100 px-5 py-4 font-bold text-slate-900 focus:outline-none focus:border-brand-orange transition-all text-xs tracking-widest outline-none">
        </div>

        <!-- Password -->
        <div class="space-y-1" x-data="{ show: false }">
            <label class="text-[9px] font-black uppercase tracking-widest text-slate-400 px-1">Define Access Key</label>
            <div class="relative">
                <input :type="show ? 'text' : 'password'" name="password" required class="w-full bg-slate-50 border border-slate-100 px-5 py-4 font-bold text-slate-900 focus:outline-none focus:border-brand-orange outline-none">
                <button type="button" @click="show = !show" class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-300">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                </button>
            </div>
        </div>

        <!-- Confirm Password -->
        <div class="space-y-1" x-data="{ show: false }">
            <label class="text-[9px] font-black uppercase tracking-widest text-slate-400 px-1">Verify Access Key</label>
            <div class="relative">
                <input :type="show ? 'text' : 'password'" name="password_confirmation" required class="w-full bg-slate-50 border border-slate-100 px-5 py-4 font-bold text-slate-900 focus:outline-none focus:border-brand-orange outline-none">
                <button type="button" @click="show = !show" class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-300">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                </button>
            </div>
        </div>

        <div class="pt-6">
            <button class="w-full bg-brand-dark text-white py-6 font-black uppercase tracking-[0.3em] text-[11px] hover:bg-brand-orange transition-all duration-500 shadow-xl">Complete Registration</button>
        </div>

        <div class="mt-8 text-center border-t border-slate-50 pt-8 uppercase">
            <p class="text-[9px] font-bold text-slate-400 tracking-widest">Already have Clearance?</p>
            <a href="{{ route('login') }}" class="mt-2 inline-block text-[10px] font-black text-brand-orange tracking-widest underline underline-offset-8">Return to Terminal</a>
        </div>
    </form>
</x-guest-layout>