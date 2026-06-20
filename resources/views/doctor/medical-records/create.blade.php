<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('doctor.medical-records.index') }}" class="text-slate-500 hover:text-blue-600 transition-colors">
                <i class="fa-solid fa-arrow-left"></i>
            </a>
            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-indigo-500 to-purple-500 flex items-center justify-center text-white shadow-lg">
                <i class="fa-solid fa-notes-medical"></i>
            </div>
            Buat Rekam Medis Baru
        </div>
    </x-slot>

    <div class="max-w-4xl mx-auto glass-card rounded-2xl overflow-hidden shadow-sm">
        <div class="px-6 py-5 border-b border-slate-100 bg-white/50">
            <h3 class="text-lg font-bold text-slate-800 flex items-center gap-2">
                <i class="fa-solid fa-lock text-green-500"></i> Data Akan Dienkripsi
            </h3>
            <p class="text-sm text-slate-500">Semua form isian medis di bawah ini akan dienkripsi secara otomatis menggunakan algoritma ChaCha20 saat disimpan ke dalam database.</p>
        </div>
        <div class="p-6 bg-white">
            <form action="{{ route('doctor.medical-records.store') }}" method="POST">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <div>
                        <label for="patient_id" class="block text-sm font-bold text-slate-700 mb-1">Pilih Pasien</label>
                        <select id="patient_id" name="patient_id" class="mt-1 block w-full border-slate-300 rounded-xl shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 transition-colors" required>
                            <option value="">-- Pilih Pasien --</option>
                            @foreach(\App\Models\Patient::all() as $patient)
                                <option value="{{ $patient->id }}" {{ request('patient_id') == $patient->id ? 'selected' : '' }}>
                                    {{ $patient->full_name }} (NIK: {{ $patient->nik }})
                                </option>
                            @endforeach
                        </select>
                        @error('patient_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="examination_date" class="block text-sm font-bold text-slate-700 mb-1">Tanggal Pemeriksaan</label>
                        <input type="date" name="examination_date" id="examination_date" value="{{ old('examination_date', date('Y-m-d')) }}" class="mt-1 block w-full border-slate-300 rounded-xl shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 transition-colors" required>
                        @error('examination_date')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="space-y-6">
                    <div class="bg-indigo-50/50 p-5 rounded-xl border border-indigo-100">
                        <label for="complaint" class="block text-sm font-bold text-slate-700 mb-2">
                            Keluhan Utama <span class="text-xs font-normal text-green-600 bg-green-100 px-2 py-0.5 rounded-full ml-2">Akan Dienkripsi <i class="fa-solid fa-shield-check"></i></span>
                        </label>
                        <textarea id="complaint" name="complaint" rows="3" class="mt-1 block w-full border-slate-300 rounded-xl shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 transition-colors placeholder-slate-400" placeholder="Jelaskan keluhan yang dialami pasien...">{{ old('complaint') }}</textarea>
                    </div>

                    <div class="bg-indigo-50/50 p-5 rounded-xl border border-indigo-100">
                        <label for="medical_history" class="block text-sm font-bold text-slate-700 mb-2">
                            Riwayat Penyakit <span class="text-xs font-normal text-green-600 bg-green-100 px-2 py-0.5 rounded-full ml-2">Akan Dienkripsi <i class="fa-solid fa-shield-check"></i></span>
                        </label>
                        <textarea id="medical_history" name="medical_history" rows="3" class="mt-1 block w-full border-slate-300 rounded-xl shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 transition-colors placeholder-slate-400" placeholder="Riwayat penyakit terdahulu atau alergi...">{{ old('medical_history') }}</textarea>
                    </div>

                    <div class="bg-indigo-50/50 p-5 rounded-xl border border-indigo-100">
                        <label for="diagnosis" class="block text-sm font-bold text-slate-700 mb-2">
                            Diagnosis <span class="text-xs font-normal text-green-600 bg-green-100 px-2 py-0.5 rounded-full ml-2">Akan Dienkripsi <i class="fa-solid fa-shield-check"></i></span>
                        </label>
                        <textarea id="diagnosis" name="diagnosis" rows="3" class="mt-1 block w-full border-slate-300 rounded-xl shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 transition-colors placeholder-slate-400" placeholder="Diagnosis medis...">{{ old('diagnosis') }}</textarea>
                    </div>

                    <div class="bg-indigo-50/50 p-5 rounded-xl border border-indigo-100">
                        <label for="treatment" class="block text-sm font-bold text-slate-700 mb-2">
                            Tindakan Medis <span class="text-xs font-normal text-green-600 bg-green-100 px-2 py-0.5 rounded-full ml-2">Akan Dienkripsi <i class="fa-solid fa-shield-check"></i></span>
                        </label>
                        <textarea id="treatment" name="treatment" rows="3" class="mt-1 block w-full border-slate-300 rounded-xl shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 transition-colors placeholder-slate-400" placeholder="Tindakan yang diberikan...">{{ old('treatment') }}</textarea>
                    </div>

                    <div class="bg-indigo-50/50 p-5 rounded-xl border border-indigo-100">
                        <label for="prescription" class="block text-sm font-bold text-slate-700 mb-2">
                            Resep Obat <span class="text-xs font-normal text-green-600 bg-green-100 px-2 py-0.5 rounded-full ml-2">Akan Dienkripsi <i class="fa-solid fa-shield-check"></i></span>
                        </label>
                        <textarea id="prescription" name="prescription" rows="3" class="mt-1 block w-full border-slate-300 rounded-xl shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 transition-colors placeholder-slate-400" placeholder="Resep obat untuk pasien...">{{ old('prescription') }}</textarea>
                    </div>

                    <div class="bg-indigo-50/50 p-5 rounded-xl border border-indigo-100">
                        <label for="doctor_notes" class="block text-sm font-bold text-slate-700 mb-2">
                            Catatan Dokter <span class="text-xs font-normal text-green-600 bg-green-100 px-2 py-0.5 rounded-full ml-2">Akan Dienkripsi <i class="fa-solid fa-shield-check"></i></span>
                        </label>
                        <textarea id="doctor_notes" name="doctor_notes" rows="3" class="mt-1 block w-full border-slate-300 rounded-xl shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 transition-colors placeholder-slate-400" placeholder="Catatan internal atau anjuran untuk pasien...">{{ old('doctor_notes') }}</textarea>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-3 pt-6 mt-6 border-t border-slate-100">
                    <a href="{{ route('doctor.patients.index') }}" class="px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold rounded-xl transition-colors">Batal</a>
                    <button type="submit" class="px-6 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl shadow-md shadow-indigo-500/30 transition-all hover:-translate-y-0.5 flex items-center gap-2">
                        <i class="fa-solid fa-lock"></i> Simpan & Enkripsi Data
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
