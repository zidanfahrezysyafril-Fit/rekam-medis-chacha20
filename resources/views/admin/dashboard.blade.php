<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-blue-500 to-cyan-400 flex items-center justify-center text-white shadow-lg">
                <i class="fa-solid fa-shield-heart"></i>
            </div>
            Ringkasan Admin
        </div>
    </x-slot>

    <!-- Welcome Banner -->
    <div class="relative bg-gradient-to-r from-cyan-600 via-sky-600 to-teal-600 rounded-3xl shadow-xl p-8 mb-8 overflow-hidden text-white">
        <!-- Glossy overlay -->
        <span class="absolute inset-x-0 top-0 h-1/2 bg-white/10 blur-sm pointer-events-none"></span>
        <div class="absolute right-0 top-0 w-80 h-80 bg-white/10 rounded-full blur-3xl -translate-y-1/3 translate-x-1/4"></div>
        
        <div class="relative z-10">
            <h2 class="text-2xl md:text-3xl font-extrabold mb-2 tracking-tight">Selamat datang kembali, {{ Auth::user()->name }}! 👋</h2>
            <p class="text-cyan-50 text-sm font-medium max-w-2xl leading-relaxed">Berikut adalah ringkasan sistem MedSecure hari ini. Pantau aktivitas pengguna, pendaftaran dokter, dan rekam medis pasien di satu tempat.</p>
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Users -->
        <div class="glass-card rounded-2xl p-6 relative overflow-hidden group">
            <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity">
                <i class="fa-solid fa-users text-6xl text-blue-500"></i>
            </div>
            <div class="flex flex-col h-full relative z-10">
                <div class="w-12 h-12 rounded-xl bg-blue-100 text-blue-600 flex items-center justify-center text-xl mb-4 shadow-inner">
                    <i class="fa-solid fa-users"></i>
                </div>
                <div class="text-sm font-bold text-slate-500 uppercase tracking-wider mb-1">Total Pengguna</div>
                <div class="text-3xl font-extrabold text-slate-900">{{ $stats['users'] }}</div>
            </div>
        </div>

        <!-- Total Doctors -->
        <div class="glass-card rounded-2xl p-6 relative overflow-hidden group">
            <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity">
                <i class="fa-solid fa-user-doctor text-6xl text-cyan-500"></i>
            </div>
            <div class="flex flex-col h-full relative z-10">
                <div class="w-12 h-12 rounded-xl bg-cyan-100 text-cyan-600 flex items-center justify-center text-xl mb-4 shadow-inner">
                    <i class="fa-solid fa-user-doctor"></i>
                </div>
                <div class="text-sm font-bold text-slate-500 uppercase tracking-wider mb-1">Dokter</div>
                <div class="text-3xl font-extrabold text-slate-900">{{ $stats['doctors'] }}</div>
            </div>
        </div>

        <!-- Total Patients -->
        <div class="glass-card rounded-2xl p-6 relative overflow-hidden group">
            <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity">
                <i class="fa-solid fa-hospital-user text-6xl text-indigo-500"></i>
            </div>
            <div class="flex flex-col h-full relative z-10">
                <div class="w-12 h-12 rounded-xl bg-indigo-100 text-indigo-600 flex items-center justify-center text-xl mb-4 shadow-inner">
                    <i class="fa-solid fa-hospital-user"></i>
                </div>
                <div class="text-sm font-bold text-slate-500 uppercase tracking-wider mb-1">Pasien</div>
                <div class="text-3xl font-extrabold text-slate-900">{{ $stats['patients'] }}</div>
            </div>
        </div>

        <!-- Medical Records -->
        <div class="glass-card rounded-2xl p-6 relative overflow-hidden group">
            <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity">
                <i class="fa-solid fa-file-medical text-6xl text-emerald-500"></i>
            </div>
            <div class="flex flex-col h-full relative z-10">
                <div class="w-12 h-12 rounded-xl bg-emerald-100 text-emerald-600 flex items-center justify-center text-xl mb-4 shadow-inner">
                    <i class="fa-solid fa-file-medical"></i>
                </div>
                <div class="text-sm font-bold text-slate-500 uppercase tracking-wider mb-1">Rekam Medis</div>
                <div class="text-3xl font-extrabold text-slate-900">{{ $stats['medical_records'] }}</div>
            </div>
        </div>
    </div>

    <!-- Recent Activities -->
    <div class="glass-card rounded-2xl overflow-hidden shadow-sm mb-8">
        <div class="px-6 py-5 border-b border-slate-100 flex justify-between items-center bg-white/50">
            <h3 class="text-lg font-bold text-slate-800 flex items-center gap-2">
                <i class="fa-solid fa-clock-rotate-left text-blue-500"></i> Aktivitas Terbaru
            </h3>
            <a href="{{ route('admin.activity-logs.index') }}" class="text-sm font-semibold text-blue-600 hover:text-blue-800 transition-colors">Lihat Semua &rarr;</a>
        </div>
        <div class="divide-y divide-slate-100">
            @forelse($recentActivities as $log)
                <div class="p-6 flex items-start gap-4 hover:bg-slate-50/50 transition-colors">
                    <div class="w-10 h-10 rounded-full bg-slate-100 border border-slate-200 flex items-center justify-center text-slate-500 font-bold shrink-0 shadow-sm">
                        {{ substr($log->user->name ?? 'S', 0, 1) }}
                    </div>
                    <div class="flex-1">
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-1 mb-1">
                            <p class="text-sm font-bold text-slate-900">{{ $log->user->name ?? 'System' }}</p>
                            <span class="text-xs font-semibold text-slate-500 bg-slate-100 px-2 py-1 rounded-md border border-slate-200">{{ $log->created_at->diffForHumans() }}</span>
                        </div>
                        <p class="text-sm text-slate-600">{{ $log->activity }}</p>
                    </div>
                </div>
            @empty
                <div class="p-12 text-center text-slate-500 flex flex-col items-center">
                    <div class="w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center text-2xl text-slate-400 mb-4 shadow-inner">
                        <i class="fa-solid fa-inbox"></i>
                    </div>
                    <p class="font-medium text-slate-600">Tidak ada aktivitas terbaru.</p>
                </div>
            @endforelse
        </div>
    </div>
</x-app-layout>
