<x-guest-layout>
    <div class="text-center mb-6">
        <h2 class="text-2xl font-extrabold text-slate-800 tracking-tight">Verifikasi Keamanan OTP</h2>
        <p class="text-xs text-slate-505 mt-1.5 font-medium">Langkah verifikasi tambahan untuk perlindungan rekam medis.</p>
    </div>

    <!-- Alert / Explanation Box -->
    <div class="mb-5 p-3.5 bg-slate-50 border border-slate-200/80 rounded-xl text-xs text-slate-600 leading-relaxed text-center shadow-xs">
        Silakan masukkan <strong>6 digit kode keamanan</strong> yang telah kami kirimkan ke alamat email Anda. Kode ini berlaku selama <strong class="text-cyan-700 font-bold">5 menit</strong>.
    </div>

    @if (session('success'))
        <div class="mb-4 p-3 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-xl text-xs font-semibold text-center">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('otp.verify.submit') }}" class="space-y-4">
        @csrf

        <div>
            <label for="otp" class="block text-xs font-bold text-slate-600 uppercase tracking-wider text-center mb-3">Kode OTP Keamanan</label>
            <div class="relative">
                <input
                    id="otp"
                    name="otp"
                    type="text"
                    maxlength="6"
                    inputmode="numeric"
                    pattern="[0-9]{6}"
                    class="block w-full tracking-[0.5em] text-center text-3xl font-extrabold py-3 rounded-xl border border-slate-200 bg-white text-slate-800 placeholder-slate-300 focus:border-cyan-500 focus:ring focus:ring-cyan-500/10 transition-all duration-300 shadow-xs"
                    placeholder="000000"
                    autofocus
                    required
                />
            </div>
            <x-input-error :messages="$errors->get('otp')" class="mt-2 text-center" />
        </div>

        <div class="pt-2">
            <button type="submit" class="relative overflow-hidden w-full flex justify-center py-3.5 px-4 rounded-xl text-sm font-bold text-white bg-gradient-to-r from-cyan-500 via-sky-500 to-teal-500 shadow-md shadow-cyan-500/10 hover:shadow-cyan-500/30 hover:scale-[1.02] active:scale-[0.98] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500 transition-all duration-300">
                <!-- Glossy overlay -->
                <span class="absolute inset-x-2 top-0.5 h-1/3 rounded-full bg-white/20 blur-2xs pointer-events-none"></span>
                <span class="relative z-10 flex items-center gap-2">
                    Verifikasi OTP <i class="fa-solid fa-shield-check text-xs"></i>
                </span>
            </button>
        </div>
    </form>

    <form method="POST" action="{{ route('otp.resend') }}" class="mt-5 text-center pt-4 border-t border-slate-200/60">
        @csrf
        <button type="submit" class="text-xs font-bold text-cyan-600 hover:text-cyan-700 hover:underline transition-colors inline-flex items-center gap-1.5">
            <i class="fa-solid fa-rotate-right text-[10px]"></i> Belum menerima kode? Kirim Ulang
        </button>
    </form>
</x-guest-layout>