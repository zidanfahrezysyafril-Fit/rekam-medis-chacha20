<x-guest-layout>
    <div class="text-center mb-6">
        <h2 class="text-2xl font-extrabold text-slate-800 tracking-tight">Verifikasi Email Anda</h2>
        <p class="text-xs text-slate-505 mt-1.5 font-medium">Terima kasih telah bergabung di MedSecure.</p>
    </div>

    <!-- Alert / Explanation Box -->
    <div class="mb-5 p-3.5 bg-slate-50 border border-slate-200/80 rounded-xl text-xs text-slate-505 leading-relaxed text-center shadow-xs">
        Sebelum dapat mengakses portal rekam medis, harap lakukan verifikasi email Anda dengan menekan tautan yang baru saja kami kirimkan. Jika Anda tidak menerimanya, kami dapat mengirim ulang email verifikasi yang baru.
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 p-3 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-xl text-xs font-semibold text-center animate-pulse">
            Tautan verifikasi baru telah dikirimkan ke alamat email Anda.
        </div>
    @endif

    <div class="mt-6 flex flex-col sm:flex-row items-center justify-between gap-4 pt-4 border-t border-slate-200/60">
        <form method="POST" action="{{ route('verification.send') }}" class="w-full sm:w-auto">
            @csrf
            <div>
                <button type="submit" class="relative overflow-hidden w-full flex justify-center py-2.5 px-4 rounded-xl text-xs font-bold text-white bg-gradient-to-r from-cyan-500 via-sky-500 to-teal-500 shadow-md shadow-cyan-500/10 hover:shadow-cyan-500/30 hover:scale-[1.02] active:scale-[0.98] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500 transition-all duration-300">
                    <!-- Glossy overlay -->
                    <span class="absolute inset-x-2 top-0.5 h-1/3 rounded-full bg-white/20 blur-2xs pointer-events-none"></span>
                    <span class="relative z-10 flex items-center gap-1.5">
                        Kirim Ulang Email Verifikasi <i class="fa-solid fa-paper-plane text-[10px]"></i>
                    </span>
                </button>
            </div>
        </form>

        <form method="POST" action="{{ route('logout') }}" class="w-full sm:w-auto text-center">
            @csrf
            <button type="submit" class="text-xs font-bold text-slate-500 hover:text-red-600 hover:underline transition-colors inline-flex items-center gap-1">
                <i class="fa-solid fa-power-off text-[10px]"></i> Keluar
            </button>
        </form>
    </div>
</x-guest-layout>
