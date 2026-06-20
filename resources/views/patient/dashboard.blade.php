<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-cyan-500 to-blue-500 flex items-center justify-center text-white shadow-lg">
                <i class="fa-solid fa-house-medical-flag"></i>
            </div>
            Patient Dashboard
        </div>
    </x-slot>

    @if(!$patient)
        <div class="bg-gradient-to-r from-amber-500 to-orange-500 rounded-2xl p-6 text-white shadow-lg mb-8 flex items-start gap-4">
            <div class="w-12 h-12 rounded-full bg-white/20 flex items-center justify-center text-2xl shrink-0 backdrop-blur-md border border-white/30">
                <i class="fa-solid fa-triangle-exclamation"></i>
            </div>
            <div>
                <h3 class="text-xl font-bold mb-1">Profile Not Linked</h3>
                <p class="text-orange-50 font-medium">Your account is not yet fully linked to a patient record in the system. Please ensure your registered email matches your NIK or your name exactly matches the full name in the clinic's database.</p>
            </div>
        </div>
    @else
        <!-- Welcome Banner -->
        <div class="relative bg-gradient-to-r from-cyan-600 to-blue-600 rounded-2xl shadow-xl p-8 mb-8 overflow-hidden text-white">
            <div class="absolute right-0 top-0 w-64 h-64 bg-white/10 rounded-full blur-3xl -translate-y-1/2 translate-x-1/4"></div>
            
            <div class="relative z-10 flex flex-col sm:flex-row items-center gap-6">
                <div class="w-24 h-24 rounded-full bg-white p-1 shadow-inner shrink-0">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($patient->full_name) }}&background=0D8ABC&color=fff&size=150" alt="{{ $patient->full_name }}" class="w-full h-full rounded-full object-cover">
                </div>
                <div>
                    <h2 class="text-2xl md:text-3xl font-bold mb-2">Hello, {{ $patient->full_name }}!</h2>
                    <p class="text-cyan-100">Welcome to your secure health portal. Here you can securely view your medical records and examination history.</p>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
            <!-- Personal Information Card -->
            <div class="lg:col-span-1">
                <div class="glass-card rounded-2xl overflow-hidden h-full">
                    <div class="bg-slate-50 px-6 py-4 border-b border-slate-200">
                        <h3 class="text-lg font-bold text-slate-800 flex items-center gap-2">
                            <i class="fa-solid fa-id-card text-blue-500"></i> Demographics
                        </h3>
                    </div>
                    <div class="p-6 space-y-6">
                        <div>
                            <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Full Name</p>
                            <p class="text-base font-bold text-slate-900 flex items-center gap-2">
                                {{ $patient->full_name }}
                                <span class="bg-green-100 text-green-700 text-[10px] px-2 py-0.5 rounded-full uppercase border border-green-200"><i class="fa-solid fa-check mr-1"></i>Verified</span>
                            </p>
                        </div>
                        
                        <div>
                            <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">NIK (Identity Number)</p>
                            <p class="text-base font-medium text-slate-700 font-mono">{{ $patient->nik }}</p>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Date of Birth</p>
                                <p class="text-base font-medium text-slate-700">{{ \Carbon\Carbon::parse($patient->date_of_birth)->format('d M Y') }}</p>
                            </div>
                            <div>
                                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Blood Type</p>
                                <div class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-red-100 text-red-600 font-bold border border-red-200">
                                    {{ $patient->blood_type ?? '-' }}
                                </div>
                            </div>
                        </div>
                        
                        <div class="pt-4 mt-4 border-t border-slate-100">
                            <div class="flex items-center gap-3 text-sm text-slate-500 font-medium bg-slate-50 p-3 rounded-xl border border-slate-100">
                                <i class="fa-solid fa-shield-check text-green-500 text-lg"></i>
                                <span>Your data is protected with ChaCha20 encryption.</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Medical Records -->
            <div class="lg:col-span-2">
                <div class="glass-card rounded-2xl overflow-hidden h-full flex flex-col">
                    <div class="bg-white px-6 py-5 border-b border-slate-100 flex justify-between items-center">
                        <h3 class="text-lg font-bold text-slate-800 flex items-center gap-2">
                            <i class="fa-solid fa-notes-medical text-cyan-500"></i> Recent Visits
                        </h3>
                        <a href="{{ route('patient.medical-records.index') }}" class="text-sm font-semibold text-blue-600 hover:text-blue-800 transition-colors bg-blue-50 hover:bg-blue-100 px-3 py-1.5 rounded-full border border-blue-100">View History</a>
                    </div>
                    
                    <div class="flex-1 p-6">
                        @if(count($myRecords) > 0)
                            <div class="relative border-l-2 border-slate-100 ml-3 space-y-8">
                                @foreach($myRecords as $record)
                                    <div class="relative pl-8">
                                        <div class="absolute -left-[9px] top-1 w-4 h-4 rounded-full bg-cyan-500 ring-4 ring-white shadow-sm"></div>
                                        <div class="bg-white border border-slate-200 rounded-xl p-5 shadow-sm hover:shadow-md transition-shadow group">
                                            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-4 border-b border-slate-100 pb-4">
                                                <div>
                                                    <span class="inline-block px-2.5 py-1 bg-slate-100 text-slate-600 text-xs font-bold rounded-md mb-2 border border-slate-200">#{{ $record->medical_record_number }}</span>
                                                    <h4 class="font-bold text-slate-900 text-lg">Consultation</h4>
                                                </div>
                                                <div class="text-left sm:text-right">
                                                    <p class="text-sm font-bold text-slate-800">{{ \Carbon\Carbon::parse($record->examination_date)->format('d F Y') }}</p>
                                                    <p class="text-xs font-medium text-slate-500 mt-0.5">Dr. {{ $record->doctor->doctor_name }}</p>
                                                </div>
                                            </div>
                                            
                                            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                                                <div class="flex items-center gap-2 text-sm text-green-700 font-semibold bg-green-50 px-3 py-1.5 rounded-lg border border-green-200 w-fit">
                                                    <i class="fa-solid fa-lock text-green-500"></i> Encrypted Record
                                                </div>
                                                <a href="{{ route('patient.medical-records.show', $record->id) }}" class="inline-flex items-center justify-center gap-2 text-sm font-bold text-white bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded-lg transition-colors shadow-sm">
                                                    View Details <i class="fa-solid fa-arrow-right"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="h-full flex flex-col items-center justify-center text-center p-8">
                                <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center text-3xl text-slate-300 mb-4 border border-slate-100 shadow-inner">
                                    <i class="fa-solid fa-folder-open"></i>
                                </div>
                                <h4 class="text-lg font-bold text-slate-700 mb-1">No Records Found</h4>
                                <p class="text-sm text-slate-500 max-w-sm">You don't have any medical records in the system yet. Once you visit the clinic, your records will appear here securely.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endif
</x-app-layout>
