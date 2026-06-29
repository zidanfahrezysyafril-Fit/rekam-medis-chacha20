<x-guest-layout>
    <div class="text-center mb-6">
        <h2 class="text-2xl font-extrabold text-slate-800 tracking-tight">Lupa Kata Sandi?</h2>
        <p class="text-xs text-slate-500 mt-1.5 font-medium">Masukkan alamat email Anda untuk menerima tautan reset.</p>
    </div>

    <!-- Alert / Explanation Box -->
    <div class="mb-5 p-4 bg-slate-50 border border-slate-200/80 rounded-xl text-xs text-slate-500 leading-relaxed text-center shadow-xs">
        Silakan masukkan alamat email yang terdaftar. Kami akan mengirimkan tautan untuk menyetel ulang kata sandi rekam medis Anda secara aman.
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-1.5">Alamat Email</label>
            <div class="relative">
                <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-slate-400">
                    <i class="fa-solid fa-envelope text-sm"></i>
                </span>
                <input id="email" 
                       class="block w-full pl-11 pr-4 py-3 rounded-xl border border-slate-200 bg-white text-slate-800 placeholder-slate-400 focus:border-cyan-500 focus:ring focus:ring-cyan-500/10 transition-all duration-300 text-sm shadow-xs" 
                       type="email" 
                       name="email" 
                       :value="old('email')" 
                       required 
                       autofocus 
                       placeholder="nama@email.com" />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-1.5" />
        </div>

        <div class="pt-2">
            <button type="submit" class="relative overflow-hidden w-full flex justify-center py-3.5 px-4 rounded-xl text-sm font-bold text-white bg-gradient-to-r from-cyan-500 via-sky-500 to-teal-500 shadow-md shadow-cyan-500/10 hover:shadow-cyan-500/30 hover:scale-[1.02] active:scale-[0.98] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500 transition-all duration-300">
                <!-- Glossy overlay -->
                <span class="absolute inset-x-2 top-0.5 h-1/3 rounded-full bg-white/20 blur-2xs pointer-events-none"></span>
                <span class="relative z-10 flex items-center gap-2">
                    Kirim Link Reset <i class="fa-solid fa-paper-plane text-xs animate-bounce"></i>
                </span>
            </button>
        </div>

        <div class="text-center mt-5 pt-4 border-t border-slate-200/60">
            <p class="text-xs text-slate-500">
                <a href="{{ route('login') }}" class="font-bold text-cyan-600 hover:text-cyan-700 hover:underline transition-colors inline-flex items-center gap-1.5">
                    <i class="fa-solid fa-arrow-left text-[10px]"></i> Kembali ke Login
                </a>
            </p>
        </div>
    </form>
</x-guest-layout>
