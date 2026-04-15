<x-guest-layout>
    <div class="mb-10">
        <h2 class="text-3xl font-black text-slate-900 tracking-tighter uppercase leading-none">Access Clearance</h2>
        <p class="text-[10px] font-bold text-slate-400 tracking-widest mt-3 border-l-4 border-brand-orange pl-4">Initialize System Session</p>
    </div>

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <div class="space-y-2">
            <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 px-1">Email Identifier</label>
            <input type="email" name="email" :value="old('email')" required autofocus class="w-full bg-slate-50 border border-slate-200 px-5 py-4 font-bold text-slate-900 focus:outline-none focus:border-brand-orange transition-all text-xs tracking-widest outline-none">
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password with Eye Toggle -->
        <div class="space-y-2" x-data="{ show: false }">
            <div class="flex justify-between items-center px-1">
                <label class="text-[10px] font-black uppercase tracking-widest text-slate-400">Security Key</label>
                <a class="text-[9px] font-black text-brand-orange tracking-widest hover:underline" href="{{ route('password.request') }}">Recover?</a>
            </div>
            <div class="relative">
                <input :type="show ? 'text' : 'password'" name="password" required class="w-full bg-slate-50 border border-slate-200 px-5 py-4 font-bold text-slate-900 focus:outline-none focus:border-brand-orange transition-all text-xs tracking-widest outline-none">
                <button type="button" @click="show = !show" class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 hover:text-brand-dark">
                    <svg x-show="!show" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                    <svg x-show="show" x-cloak class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18"/></svg>
                </button>
            </div>
        </div>

        <div class="block mt-6">
            <label class="inline-flex items-center cursor-pointer">
                <input type="checkbox" name="remember" class="rounded-none border-slate-300 text-brand-orange shadow-sm focus:ring-0">
                <span class="ms-3 text-[10px] font-black text-slate-500 uppercase tracking-widest">Keep System Active</span>
            </label>
        </div>

        <div class="pt-4">
            <button class="w-full bg-brand-dark text-white py-6 font-black uppercase tracking-[0.3em] text-[11px] hover:bg-brand-orange transition-all duration-500 shadow-xl">Authorize Access</button>
        </div>

        <div class="mt-10 text-center border-t border-slate-100 pt-10">
            <p class="text-[10px] font-bold text-slate-400 tracking-widest mb-4">New Personnel Member?</p>
            <a href="{{ route('register') }}" class="text-[11px] font-black text-brand-orange tracking-widest hover:text-brand-dark transition-colors underline underline-offset-8">Register Official Profile</a>
        </div>
    </form>
</x-guest-layout>