<x-guest-layout>
    <div class="mb-10">
        <h2 class="text-3xl font-black text-slate-900 tracking-tighter uppercase leading-none">Initialize New Key</h2>
        <p class="text-[10px] font-bold text-slate-400 tracking-widest mt-3 border-l-4 border-brand-orange pl-4">Updating Security Credentials</p>
    </div>

    <form method="POST" action="{{ route('password.store') }}" class="space-y-6">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <div class="space-y-2">
            <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 px-1">Verify Email Coordinate</label>
            <input type="email" name="email" value="{{ old('email', $request->email) }}" required autofocus 
                   class="w-full bg-slate-50 border border-slate-200 px-5 py-4 font-bold text-slate-900 focus:outline-none focus:border-brand-orange transition-all text-xs tracking-widest outline-none">
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- New Password -->
        <div class="space-y-2" x-data="{ show: false }">
            <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 px-1">Define New Access Key</label>
            <div class="relative">
                <input :type="show ? 'text' : 'password'" name="password" required 
                       class="w-full bg-slate-50 border border-slate-200 px-5 py-4 font-bold text-slate-900 focus:outline-none focus:border-brand-orange transition-all text-xs tracking-widest outline-none">
                <button type="button" @click="show = !show" class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 hover:text-brand-dark">
                    <svg x-show="!show" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                    <svg x-show="show" x-cloak class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18"/></svg>
                </button>
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="space-y-2" x-data="{ show: false }">
            <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 px-1">Verify New Access Key</label>
            <div class="relative">
                <input :type="show ? 'text' : 'password'" name="password_confirmation" required 
                       class="w-full bg-slate-50 border border-slate-200 px-5 py-4 font-bold text-slate-900 focus:outline-none focus:border-brand-orange transition-all text-xs tracking-widest outline-none">
                <button type="button" @click="show = !show" class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 hover:text-brand-dark">
                    <svg x-show="!show" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                    <svg x-show="show" x-cloak class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18"/></svg>
                </button>
            </div>
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="pt-4">
            <button class="w-full bg-brand-dark text-white py-6 font-black uppercase tracking-[0.4em] text-[11px] hover:bg-brand-orange transition-all duration-500 shadow-xl">
                Reset System Credentials
            </button>
        </div>
    </form>
</x-guest-layout>