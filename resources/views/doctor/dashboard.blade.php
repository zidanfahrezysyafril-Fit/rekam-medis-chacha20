<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-indigo-500 to-purple-500 flex items-center justify-center text-white shadow-lg">
                <i class="fa-solid fa-stethoscope"></i>
            </div>
            Doctor Dashboard
        </div>
    </x-slot>

    <!-- Welcome Banner -->
    <div class="relative bg-gradient-to-r from-blue-600 to-indigo-600 rounded-2xl shadow-xl p-8 mb-8 overflow-hidden text-white">
        <div class="absolute right-0 top-0 w-64 h-64 bg-white/10 rounded-full blur-3xl -translate-y-1/2 translate-x-1/4"></div>
        
        <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div>
                <h2 class="text-2xl md:text-3xl font-bold mb-2">Hello, Dr. {{ Auth::user()->name }}! 👋</h2>
                <p class="text-blue-100 max-w-xl">Welcome to your secure medical workspace. You can manage patient records, add new diagnoses, and review histories securely using ChaCha20 encryption.</p>
            </div>
            <div class="shrink-0 flex gap-3">
                <a href="{{ route('doctor.medical-records.create') }}" class="px-6 py-3 bg-white text-indigo-600 font-bold rounded-xl shadow-lg hover:bg-slate-50 transition-all hover:-translate-y-1 flex items-center gap-2">
                    <i class="fa-solid fa-plus"></i> New Record
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
                        <div class="text-sm font-bold text-slate-500 uppercase tracking-wide mb-1">Total Patients</div>
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
                        <div class="text-sm font-bold text-slate-500 uppercase tracking-wide mb-1">My Records Created</div>
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
                            End-to-End Encryption Active
                            <span class="flex h-2.5 w-2.5 relative">
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-green-500"></span>
                            </span>
                        </h4>
                        <p class="text-slate-300 text-sm leading-relaxed">All sensitive patient data (complaints, diagnoses, actions) you enter is automatically encrypted using the ChaCha20 algorithm before being stored in the database. Only authorized personnel can decrypt and view this data.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions Sidebar -->
        <div class="glass-card rounded-2xl p-6 h-fit">
            <h3 class="text-lg font-bold text-slate-800 mb-4 border-b border-slate-100 pb-3 flex items-center gap-2">
                <i class="fa-solid fa-bolt text-amber-500"></i> Quick Actions
            </h3>
            
            <div class="space-y-3">
                <a href="{{ route('doctor.medical-records.create') }}" class="group block p-4 rounded-xl border border-blue-100 bg-blue-50 hover:bg-blue-600 hover:border-blue-600 hover:shadow-lg transition-all">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-white text-blue-600 group-hover:text-blue-600 flex items-center justify-center font-bold shadow-sm">
                                <i class="fa-solid fa-file-circle-plus"></i>
                            </div>
                            <span class="font-bold text-slate-700 group-hover:text-white">Create Record</span>
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
                            <span class="font-bold text-slate-700 group-hover:text-white">Patient Directory</span>
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
                            <span class="font-bold text-slate-700 group-hover:text-white">View All Records</span>
                        </div>
                        <i class="fa-solid fa-chevron-right text-slate-400 group-hover:text-white"></i>
                    </div>
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
