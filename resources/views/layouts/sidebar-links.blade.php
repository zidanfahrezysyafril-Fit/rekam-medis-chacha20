@if(Auth::user()->role === 'admin')
    <a href="{{ route('admin.dashboard') }}" class="group flex items-center px-4 py-2.5 text-sm font-bold rounded-xl transition-all duration-300 mb-1 {{ request()->routeIs('admin.dashboard') ? 'bg-gradient-to-r from-cyan-600 to-teal-600 text-white shadow-md shadow-cyan-600/10' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
        <i class="fa-solid fa-house mr-3 text-sm shrink-0 opacity-75 group-hover:opacity-100 transition-opacity"></i>
        Beranda
    </a>
    <a href="{{ route('admin.users.index') }}" class="group flex items-center px-4 py-2.5 text-sm font-bold rounded-xl transition-all duration-300 mb-1 {{ request()->routeIs('admin.users.*') ? 'bg-gradient-to-r from-cyan-600 to-teal-600 text-white shadow-md shadow-cyan-600/10' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
        <i class="fa-solid fa-users-cog mr-3 text-sm shrink-0 opacity-75 group-hover:opacity-100 transition-opacity"></i>
        Kelola Pengguna
    </a>
    <a href="{{ route('admin.patients.index') }}" class="group flex items-center px-4 py-2.5 text-sm font-bold rounded-xl transition-all duration-300 mb-1 {{ request()->routeIs('admin.patients.*') ? 'bg-gradient-to-r from-cyan-600 to-teal-600 text-white shadow-md shadow-cyan-600/10' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
        <i class="fa-solid fa-hospital-user mr-3 text-sm shrink-0 opacity-75 group-hover:opacity-100 transition-opacity"></i>
        Kelola Pasien
    </a>
    <a href="{{ route('admin.doctors.index') }}" class="group flex items-center px-4 py-2.5 text-sm font-bold rounded-xl transition-all duration-300 mb-1 {{ request()->routeIs('admin.doctors.*') ? 'bg-gradient-to-r from-cyan-600 to-teal-600 text-white shadow-md shadow-cyan-600/10' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
        <i class="fa-solid fa-user-doctor mr-3 text-sm shrink-0 opacity-75 group-hover:opacity-100 transition-opacity"></i>
        Kelola Dokter
    </a>
    <a href="{{ route('admin.activity-logs.index') }}" class="group flex items-center px-4 py-2.5 text-sm font-bold rounded-xl transition-all duration-300 mb-1 {{ request()->routeIs('admin.activity-logs.*') ? 'bg-gradient-to-r from-cyan-600 to-teal-600 text-white shadow-md shadow-cyan-600/10' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
        <i class="fa-solid fa-clock-rotate-left mr-3 text-sm shrink-0 opacity-75 group-hover:opacity-100 transition-opacity"></i>
        Log Aktivitas
    </a>
    <a href="{{ route('admin.encryption-demo.index') }}" class="group flex items-center px-4 py-2.5 text-sm font-bold rounded-xl transition-all duration-300 mb-1 {{ request()->routeIs('admin.encryption-demo.*') ? 'bg-gradient-to-r from-cyan-600 to-teal-600 text-white shadow-md shadow-cyan-600/10' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
        <i class="fa-solid fa-key mr-3 text-sm shrink-0 opacity-75 group-hover:opacity-100 transition-opacity"></i>
        Demonstrasi Enkripsi
    </a>
@elseif(Auth::user()->role === 'doctor')
    <a href="{{ route('doctor.dashboard') }}" class="group flex items-center px-4 py-2.5 text-sm font-bold rounded-xl transition-all duration-300 mb-1 {{ request()->routeIs('doctor.dashboard') ? 'bg-gradient-to-r from-cyan-600 to-teal-600 text-white shadow-md shadow-cyan-600/10' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
        <i class="fa-solid fa-house mr-3 text-sm shrink-0 opacity-75 group-hover:opacity-100 transition-opacity"></i>
        Beranda
    </a>
    <a href="{{ route('doctor.patients.index') }}" class="group flex items-center px-4 py-2.5 text-sm font-bold rounded-xl transition-all duration-300 mb-1 {{ request()->routeIs('doctor.patients.*') ? 'bg-gradient-to-r from-cyan-600 to-teal-600 text-white shadow-md shadow-cyan-600/10' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
        <i class="fa-solid fa-address-book mr-3 text-sm shrink-0 opacity-75 group-hover:opacity-100 transition-opacity"></i>
        Daftar Pasien
    </a>
    <a href="{{ route('doctor.medical-records.index') }}" class="group flex items-center px-4 py-2.5 text-sm font-bold rounded-xl transition-all duration-300 mb-1 {{ request()->routeIs('doctor.medical-records.*') ? 'bg-gradient-to-r from-cyan-600 to-teal-600 text-white shadow-md shadow-cyan-600/10' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
        <i class="fa-solid fa-file-medical mr-3 text-sm shrink-0 opacity-75 group-hover:opacity-100 transition-opacity"></i>
        Rekam Medis
    </a>
@elseif(Auth::user()->role === 'patient')
    <a href="{{ route('patient.dashboard') }}" class="group flex items-center px-4 py-2.5 text-sm font-bold rounded-xl transition-all duration-300 mb-1 {{ request()->routeIs('patient.dashboard') ? 'bg-gradient-to-r from-cyan-600 to-teal-600 text-white shadow-md shadow-cyan-600/10' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
        <i class="fa-solid fa-house mr-3 text-sm shrink-0 opacity-75 group-hover:opacity-100 transition-opacity"></i>
        Beranda
    </a>
    <a href="{{ route('patient.medical-records.index') }}" class="group flex items-center px-4 py-2.5 text-sm font-bold rounded-xl transition-all duration-300 mb-1 {{ request()->routeIs('patient.medical-records.*') ? 'bg-gradient-to-r from-cyan-600 to-teal-600 text-white shadow-md shadow-cyan-600/10' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
        <i class="fa-solid fa-notes-medical mr-3 text-sm shrink-0 opacity-75 group-hover:opacity-100 transition-opacity"></i>
        Riwayat Pemeriksaan
    </a>
@endif
