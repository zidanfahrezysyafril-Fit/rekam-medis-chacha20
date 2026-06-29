<x-guest-layout>
    <div class="text-center mb-6">
        <h2 class="text-2xl font-extrabold text-slate-800 tracking-tight">Konfirmasi Kata Sandi</h2>
        <p class="text-xs text-slate-505 mt-1.5 font-medium">Sesi aman. Konfirmasikan kata sandi Anda.</p>
    </div>

    <!-- Alert / Explanation Box -->
    <div class="mb-5 p-3.5 bg-slate-50 border border-slate-200/80 rounded-xl text-xs text-slate-505 leading-relaxed text-center shadow-xs">
        Ini adalah area aman aplikasi. Silakan konfirmasikan kata sandi Anda sebelum melanjutkan akses data rekam medis.
    </div>

    <form method="POST" action="{{ route('password.confirm') }}" class="space-y-4">
        @csrf

        <!-- Password -->
        <div>
            <label for="password" class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-1.5">Kata Sandi Anda</label>
            <div class="relative">
                <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-slate-400">
                    <i class="fa-solid fa-lock text-sm"></i>
                </span>
                <input id="password" 
                       class="block w-full pl-11 pr-11 py-3 rounded-xl border border-slate-200 bg-white text-slate-800 placeholder-slate-400 focus:border-cyan-500 focus:ring focus:ring-cyan-500/10 transition-all duration-300 text-sm shadow-xs"
                       type="password"
                       name="password"
                       required 
                       autocomplete="current-password" 
                       placeholder="••••••••" />
                <button type="button" 
                        onclick="togglePasswordVisibility('password', 'password-toggle-icon')" 
                        class="absolute inset-y-0 right-0 pr-4 flex items-center text-slate-400 hover:text-cyan-600 transition-colors">
                    <i id="password-toggle-icon" class="fa-solid fa-eye text-sm"></i>
                </button>
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-1.5" />
        </div>

        <div class="pt-2">
            <button type="submit" class="relative overflow-hidden w-full flex justify-center py-3.5 px-4 rounded-xl text-sm font-bold text-white bg-gradient-to-r from-cyan-500 via-sky-500 to-teal-500 shadow-md shadow-cyan-500/10 hover:shadow-cyan-500/30 hover:scale-[1.02] active:scale-[0.98] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500 transition-all duration-300">
                <!-- Glossy overlay -->
                <span class="absolute inset-x-2 top-0.5 h-1/3 rounded-full bg-white/20 blur-2xs pointer-events-none"></span>
                <span class="relative z-10 flex items-center gap-2">
                    Konfirmasi Kata Sandi <i class="fa-solid fa-key text-xs"></i>
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
