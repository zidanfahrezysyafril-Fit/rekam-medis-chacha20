<x-guest-layout>
    <div class="text-center mb-6">
        <h2 class="text-2xl font-extrabold text-slate-800 tracking-tight">Buat Akun Baru</h2>
        <p class="text-xs text-slate-500 mt-1.5 font-medium">Daftar untuk mulai mengelola rekam medis terenkripsi Anda.</p>
    </div>

    <!-- Patient registration info badge -->
    <div class="mb-5 p-3 bg-cyan-50 border border-cyan-100 rounded-xl flex items-center gap-3 shadow-xs">
        <div class="w-8 h-8 rounded-lg bg-cyan-100/60 flex items-center justify-center text-cyan-600 shrink-0 animate-pulse">
            <i class="fa-solid fa-user-injured text-sm"></i>
        </div>
        <div class="text-left">
            <p class="text-[10px] text-cyan-800 font-extrabold uppercase tracking-wide">Pendaftaran Pasien</p>
            <p class="text-[11px] text-slate-500">Akun baru otomatis terdaftar sebagai pasien medis.</p>
        </div>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf
        <input type="hidden" name="role" value="patient">

        <!-- Name -->
        <div>
            <label for="name" class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-1.5">Nama Lengkap</label>
            <div class="relative">
                <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-slate-400">
                    <i class="fa-solid fa-user text-sm"></i>
                </span>
                <input id="name" 
                       class="block w-full pl-11 pr-4 py-3 rounded-xl border border-slate-200 bg-white text-slate-800 placeholder-slate-400 focus:border-cyan-500 focus:ring focus:ring-cyan-500/10 transition-all duration-300 text-sm shadow-xs" 
                       type="text" 
                       name="name" 
                       :value="old('name')" 
                       required 
                       autofocus 
                       autocomplete="name" 
                       placeholder="Nama lengkap Anda" />
            </div>
            <x-input-error :messages="$errors->get('name')" class="mt-1.5" />
        </div>

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
                       autocomplete="username" 
                       placeholder="nama@email.com" />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-1.5" />
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-1.5">Kata Sandi</label>
            <div class="relative">
                <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-slate-400">
                    <i class="fa-solid fa-lock text-sm"></i>
                </span>
                <input id="password" 
                       class="block w-full pl-11 pr-11 py-3 rounded-xl border border-slate-200 bg-white text-slate-800 placeholder-slate-400 focus:border-cyan-500 focus:ring focus:ring-cyan-500/10 transition-all duration-300 text-sm shadow-xs" 
                       type="password" 
                       name="password" 
                       required 
                       autocomplete="new-password" 
                       placeholder="••••••••" />
                <button type="button" 
                        onclick="togglePasswordVisibility('password', 'password-toggle-icon')" 
                        class="absolute inset-y-0 right-0 pr-4 flex items-center text-slate-400 hover:text-cyan-600 transition-colors">
                    <i id="password-toggle-icon" class="fa-solid fa-eye text-sm"></i>
                </button>
            </div>
            <p class="mt-1.5 text-[11px] text-slate-500 flex items-center gap-1.5 font-medium">
                <i class="fa-solid fa-shield-halved text-cyan-600 text-xs"></i> Minimal 8 karakter (kombinasi huruf besar, huruf kecil, angka, & simbol).
            </p>
            <x-input-error :messages="$errors->get('password')" class="mt-1.5" />
        </div>

        <!-- Confirm Password -->
        <div>
            <label for="password_confirmation" class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-1.5">Konfirmasi Kata Sandi</label>
            <div class="relative">
                <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-slate-400">
                    <i class="fa-solid fa-key text-sm"></i>
                </span>
                <input id="password_confirmation" 
                       class="block w-full pl-11 pr-11 py-3 rounded-xl border border-slate-200 bg-white text-slate-800 placeholder-slate-400 focus:border-cyan-500 focus:ring focus:ring-cyan-500/10 transition-all duration-300 text-sm shadow-xs" 
                       type="password" 
                       name="password_confirmation" 
                       required 
                       autocomplete="new-password" 
                       placeholder="••••••••" />
                <button type="button" 
                        onclick="togglePasswordVisibility('password_confirmation', 'confirm-password-toggle-icon')" 
                        class="absolute inset-y-0 right-0 pr-4 flex items-center text-slate-400 hover:text-cyan-600 transition-colors">
                    <i id="confirm-password-toggle-icon" class="fa-solid fa-eye text-sm"></i>
                </button>
            </div>
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1.5" />
        </div>

        <div class="pt-4">
            <button type="submit" class="relative overflow-hidden w-full flex justify-center py-3.5 px-4 rounded-xl text-sm font-bold text-white bg-gradient-to-r from-cyan-500 via-sky-500 to-teal-500 shadow-md shadow-cyan-500/10 hover:shadow-cyan-500/30 hover:scale-[1.02] active:scale-[0.98] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500 transition-all duration-300">
                <!-- Glossy overlay -->
                <span class="absolute inset-x-2 top-0.5 h-1/3 rounded-full bg-white/20 blur-2xs pointer-events-none"></span>
                <span class="relative z-10 flex items-center gap-2">
                    Daftar Secara Aman <i class="fa-solid fa-user-plus text-xs"></i>
                </span>
            </button>
        </div>

        <div class="text-center mt-5 pt-4 border-t border-slate-200/60">
            <p class="text-xs text-slate-500">Sudah memiliki akun? <a href="{{ route('login') }}" class="font-bold text-cyan-600 hover:text-cyan-700 hover:underline transition-colors">Masuk di sini</a></p>
        </div>
    </form>

    <script>
        function togglePasswordVisibility(fieldId, iconId) {
            const field = document.getElementById(fieldId);
            const icon = document.getElementById(iconId);
            if (field && icon) {
                if (field.type === 'password') {
                    field.type = 'text';
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash');
                } else {
                    field.type = 'password';
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                }
            }
        }
    </script>
</x-guest-layout>