<x-guest-layout>
    <div class="text-center mb-6">
        <h2 class="text-2xl font-extrabold text-slate-800 tracking-tight">Atur Ulang Kata Sandi</h2>
        <p class="text-xs text-slate-505 mt-1.5 font-medium">Buat kata sandi baru untuk mengamankan kembali akses Anda.</p>
    </div>

    <form method="POST" action="{{ route('password.store') }}" class="space-y-4">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

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
                       :value="old('email', $request->email)" 
                       required 
                       autofocus 
                       autocomplete="username" 
                       placeholder="nama@email.com" />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-1.5" />
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-1.5">Kata Sandi Baru</label>
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
            <x-input-error :messages="$errors->get('password')" class="mt-1.5" />
        </div>

        <!-- Confirm Password -->
        <div>
            <label for="password_confirmation" class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-1.5">Konfirmasi Kata Sandi Baru</label>
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

        <div class="pt-2">
            <button type="submit" class="relative overflow-hidden w-full flex justify-center py-3.5 px-4 rounded-xl text-sm font-bold text-white bg-gradient-to-r from-cyan-500 via-sky-500 to-teal-500 shadow-md shadow-cyan-500/10 hover:shadow-cyan-500/30 hover:scale-[1.02] active:scale-[0.98] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500 transition-all duration-300">
                <!-- Glossy overlay -->
                <span class="absolute inset-x-2 top-0.5 h-1/3 rounded-full bg-white/20 blur-2xs pointer-events-none"></span>
                <span class="relative z-10 flex items-center gap-2">
                    Simpan Kata Sandi Baru <i class="fa-solid fa-check text-xs"></i>
                </span>
            </button>
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
