<x-guest-layout>
    <div class="mb-10">
        <h2 class="text-3xl font-black text-slate-900 tracking-tighter uppercase leading-none">Key Recovery</h2>
        <p class="text-[10px] font-bold text-slate-400 tracking-widest mt-3 border-l-4 border-brand-orange pl-4">Security Protocol: Password Reset</p>
    </div>

    <div class="mb-8 text-xs font-bold text-slate-500 leading-loose uppercase tracking-tight">
        Forgot your access key? No problem. Provide your registered email address and we will dispatch a secure reset link to your coordinates.
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="space-y-8">
        @csrf

        <!-- Email Address -->
        <div class="space-y-2">
            <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 px-1">Registered Email Coordinate</label>
            <input type="email" name="email" :value="old('email')" required autofocus 
                   class="w-full bg-slate-50 border border-slate-200 px-5 py-4 font-bold text-slate-900 focus:outline-none focus:border-brand-orange transition-all text-xs tracking-widest outline-none">
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="pt-2">
            <button class="w-full bg-brand-dark text-white py-6 font-black uppercase tracking-[0.3em] text-[11px] hover:bg-brand-orange transition-all duration-500 shadow-xl">
                Dispatch Reset Instructions
            </button>
        </div>

        <div class="mt-10 text-center border-t border-slate-100 pt-10">
            <p class="text-[10px] font-bold text-slate-400 tracking-widest mb-4">Remembered your key?</p>
            <a href="{{ route('login') }}" class="text-[11px] font-black text-brand-orange tracking-widest hover:text-brand-dark transition-colors underline underline-offset-8 uppercase">Return to Login Terminal</a>
        </div>
    </form>
</x-guest-layout>