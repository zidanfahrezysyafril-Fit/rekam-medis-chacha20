<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-indigo-500 to-purple-500 flex items-center justify-center text-white shadow-lg">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                  <path stroke-linecap="round" stroke-linejoin="round" d="M9 7c0-2-1-3-3-3M15 7c0-2 1-3 3-3" />
                  <path stroke-linecap="round" stroke-linejoin="round" d="M12 18v3m0 0a1 1 0 100-2 1 1 0 000 2z" />
                </svg>
            </div>
            Dasbor Dokter
        </div>
    </x-slot>

    <!-- Welcome Banner -->
    <div class="relative bg-gradient-to-r from-cyan-600 via-sky-600 to-teal-600 rounded-3xl shadow-xl p-8 mb-8 overflow-hidden text-white">
        <!-- Glossy overlay -->
        <span class="absolute inset-x-0 top-0 h-1/2 bg-white/10 blur-sm pointer-events-none"></span>
        <div class="absolute right-0 top-0 w-80 h-80 bg-white/10 rounded-full blur-3xl -translate-y-1/3 translate-x-1/4"></div>
        
        <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div>
                <h2 class="text-2xl md:text-3xl font-extrabold mb-2 tracking-tight">Halo, dr. {{ Auth::user()->name }}! 👋</h2>
                <p class="text-cyan-50 text-sm font-medium max-w-xl leading-relaxed">Selamat datang di ruang kerja medis aman Anda. Anda dapat mengelola rekam medis pasien, menambahkan diagnosis baru, dan meninjau riwayat secara aman menggunakan enkripsi ChaCha20.</p>
            </div>
            <div class="shrink-0 flex gap-3">
                <a href="{{ route('doctor.medical-records.create') }}" class="px-6 py-3 bg-white text-cyan-600 font-bold rounded-xl shadow-lg hover:bg-slate-50 transition-all hover:scale-105 active:scale-95 flex items-center gap-2">
                    <i class="fa-solid fa-plus"></i> Rekam Medis Baru
                </a>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
        <!-- Main Stats & Quick Links -->
        <div class="lg:col-span-2 space-y-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <!-- Total System Patients -->
                <div class="glass-card rounded-2xl p-6 flex items-center gap-5 relative overflow-hidden group">
                    <div class="absolute top-0 right-0 w-24 h-24 bg-cyan-50 rounded-bl-full -z-10 group-hover:scale-110 transition-transform"></div>
                    <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-cyan-400 to-blue-500 flex items-center justify-center text-white text-2xl shadow-lg shadow-cyan-500/30">
                        <i class="fa-solid fa-users-medical"></i>
                    </div>
                    <div>
                        <div class="text-sm font-bold text-slate-500 uppercase tracking-wide mb-1">Total Pasien</div>
                        <div class="text-4xl font-extrabold text-slate-900">{{ $stats['total_patients'] }}</div>
                    </div>
                </div>

                <!-- My Records -->
                <div class="glass-card rounded-2xl p-6 flex items-center gap-5 relative overflow-hidden group">
                    <div class="absolute top-0 right-0 w-24 h-24 bg-indigo-50 rounded-bl-full -z-10 group-hover:scale-110 transition-transform"></div>
                    <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-indigo-400 to-purple-500 flex items-center justify-center text-white text-2xl shadow-lg shadow-indigo-500/30">
                        <i class="fa-solid fa-notes-medical"></i>
                    </div>
                    <div>
                        <div class="text-sm font-bold text-slate-500 uppercase tracking-wide mb-1">Rekam Medis Dibuat</div>
                        <div class="text-4xl font-extrabold text-slate-900">{{ $stats['my_records'] }}</div>
                    </div>
                </div>
            </div>

            <!-- ChaCha20 Security Info Card -->
            <div class="bg-gradient-to-r from-slate-900 to-slate-800 rounded-2xl p-6 text-white shadow-lg relative overflow-hidden">
                <i class="fa-solid fa-shield-halved absolute right-0 bottom-0 text-9xl text-white/5 -mb-6 -mr-6"></i>
                <div class="flex items-start gap-4 relative z-10">
                    <div class="w-12 h-12 rounded-full bg-cyan-500/20 text-cyan-400 flex items-center justify-center text-xl shrink-0">
                        <i class="fa-solid fa-lock"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-lg mb-2 flex items-center gap-2">
                            Enkripsi End-to-End Aktif
                            <span class="flex h-2.5 w-2.5 relative">
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-green-500"></span>
                            </span>
                        </h4>
                        <p class="text-slate-300 text-sm leading-relaxed">Seluruh data pasien sensitif (keluhan, diagnosis, tindakan) yang Anda masukkan secara otomatis dienkripsi menggunakan algoritme ChaCha20 sebelum disimpan di database. Hanya personel berwenang yang dapat mendekripsi dan melihat data ini.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions Sidebar -->
        <div class="glass-card rounded-2xl p-6 h-fit">
            <h3 class="text-lg font-bold text-slate-800 mb-4 border-b border-slate-100 pb-3 flex items-center gap-2">
                <i class="fa-solid fa-bolt text-amber-500"></i> Aksi Cepat
            </h3>
            
            <div class="space-y-3">
                <a href="{{ route('doctor.medical-records.create') }}" class="group block p-4 rounded-xl border border-blue-100 bg-blue-50 hover:bg-blue-600 hover:border-blue-600 hover:shadow-lg transition-all">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-white text-blue-600 group-hover:text-blue-600 flex items-center justify-center font-bold shadow-sm">
                                <i class="fa-solid fa-file-circle-plus"></i>
                            </div>
                            <span class="font-bold text-slate-700 group-hover:text-white">Buat Rekam Medis</span>
                        </div>
                        <i class="fa-solid fa-chevron-right text-slate-400 group-hover:text-white"></i>
                    </div>
                </a>
                
                <a href="{{ route('doctor.patients.index') }}" class="group block p-4 rounded-xl border border-slate-200 bg-white hover:bg-slate-800 hover:border-slate-800 hover:shadow-lg transition-all">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-slate-100 text-slate-600 group-hover:bg-slate-700 group-hover:text-white flex items-center justify-center font-bold">
                                <i class="fa-solid fa-address-book"></i>
                            </div>
                            <span class="font-bold text-slate-700 group-hover:text-white">Daftar Pasien</span>
                        </div>
                        <i class="fa-solid fa-chevron-right text-slate-400 group-hover:text-white"></i>
                    </div>
                </a>
                
                <a href="{{ route('doctor.medical-records.index') }}" class="group block p-4 rounded-xl border border-slate-200 bg-white hover:bg-slate-800 hover:border-slate-800 hover:shadow-lg transition-all">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-slate-100 text-slate-600 group-hover:bg-slate-700 group-hover:text-white flex items-center justify-center font-bold">
                                <i class="fa-solid fa-laptop-medical"></i>
                            </div>
                            <span class="font-bold text-slate-700 group-hover:text-white">Lihat Semua Rekam Medis</span>
                        </div>
                        <i class="fa-solid fa-chevron-right text-slate-400 group-hover:text-white"></i>
                    </div>
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
