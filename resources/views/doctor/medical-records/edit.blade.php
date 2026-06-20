<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('doctor.medical-records.index') }}" class="text-slate-500 hover:text-blue-600 transition-colors">
                <i class="fa-solid fa-arrow-left"></i>
            </a>
            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-indigo-500 to-purple-500 flex items-center justify-center text-white shadow-lg">
                <i class="fa-solid fa-pen-to-square"></i>
            </div>
            Edit Rekam Medis ({{ $medicalRecord->medical_record_number }})
        </div>
    </x-slot>

    <div class="max-w-4xl mx-auto glass-card rounded-2xl overflow-hidden shadow-sm">
        <div class="px-6 py-5 border-b border-slate-100 bg-white/50">
            <h3 class="text-lg font-bold text-slate-800 flex items-center gap-2">
                <i class="fa-solid fa-lock-open text-orange-500"></i> Mode Dekripsi Aktif
            </h3>
            <p class="text-sm text-slate-500">Data telah didekripsi agar dapat Anda edit. Ketika Anda menyimpan perubahan, sistem akan membuat *nonce* baru dan mengenkripsi ulang seluruh data.</p>
        </div>
        <div class="p-6 bg-white">
            <form action="{{ route('doctor.medical-records.update', $medicalRecord) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <div>
                        <label for="patient_id" class="block text-sm font-bold text-slate-700 mb-1">Pasien</label>
                        <!-- Disabled select for visualization, hidden input for data -->
                        <select disabled class="mt-1 block w-full border-slate-300 bg-slate-100 text-slate-500 rounded-xl shadow-sm focus:outline-none cursor-not-allowed">
                            <option>{{ $medicalRecord->patient->full_name }} (NIK: {{ $medicalRecord->patient->nik }})</option>
                        </select>
                        <input type="hidden" name="patient_id" value="{{ $medicalRecord->patient_id }}">
                    </div>
                    
                    <div>
                        <label for="examination_date" class="block text-sm font-bold text-slate-700 mb-1">Tanggal Pemeriksaan</label>
                        <input type="date" name="examination_date" id="examination_date" value="{{ old('examination_date', \Carbon\Carbon::parse($medicalRecord->examination_date)->format('Y-m-d')) }}" class="mt-1 block w-full border-slate-300 rounded-xl shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 transition-colors" required>
                        @error('examination_date')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="space-y-6">
                    <div class="bg-indigo-50/50 p-5 rounded-xl border border-indigo-100">
                        <label for="complaint" class="block text-sm font-bold text-slate-700 mb-2">Keluhan Utama</label>
                        <textarea id="complaint" name="complaint" rows="3" class="mt-1 block w-full border-slate-300 rounded-xl shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 transition-colors">{{ old('complaint', $medicalRecord->complaint) }}</textarea>
                    </div>

                    <div class="bg-indigo-50/50 p-5 rounded-xl border border-indigo-100">
                        <label for="medical_history" class="block text-sm font-bold text-slate-700 mb-2">Riwayat Penyakit</label>
                        <textarea id="medical_history" name="medical_history" rows="3" class="mt-1 block w-full border-slate-300 rounded-xl shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 transition-colors">{{ old('medical_history', $medicalRecord->medical_history) }}</textarea>
                    </div>

                    <div class="bg-indigo-50/50 p-5 rounded-xl border border-indigo-100">
                        <label for="diagnosis" class="block text-sm font-bold text-slate-700 mb-2">Diagnosis</label>
                        <textarea id="diagnosis" name="diagnosis" rows="3" class="mt-1 block w-full border-slate-300 rounded-xl shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 transition-colors">{{ old('diagnosis', $medicalRecord->diagnosis) }}</textarea>
                    </div>

                    <div class="bg-indigo-50/50 p-5 rounded-xl border border-indigo-100">
                        <label for="treatment" class="block text-sm font-bold text-slate-700 mb-2">Tindakan Medis</label>
                        <textarea id="treatment" name="treatment" rows="3" class="mt-1 block w-full border-slate-300 rounded-xl shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 transition-colors">{{ old('treatment', $medicalRecord->treatment) }}</textarea>
                    </div>

                    <div class="bg-indigo-50/50 p-5 rounded-xl border border-indigo-100">
                        <label for="prescription" class="block text-sm font-bold text-slate-700 mb-2">Resep Obat</label>
                        <textarea id="prescription" name="prescription" rows="3" class="mt-1 block w-full border-slate-300 rounded-xl shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 transition-colors">{{ old('prescription', $medicalRecord->prescription) }}</textarea>
                    </div>

                    <div class="bg-indigo-50/50 p-5 rounded-xl border border-indigo-100">
                        <label for="doctor_notes" class="block text-sm font-bold text-slate-700 mb-2">Catatan Dokter</label>
                        <textarea id="doctor_notes" name="doctor_notes" rows="3" class="mt-1 block w-full border-slate-300 rounded-xl shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 transition-colors">{{ old('doctor_notes', $medicalRecord->doctor_notes) }}</textarea>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-3 pt-6 mt-6 border-t border-slate-100">
                    <a href="{{ route('doctor.medical-records.index') }}" class="px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold rounded-xl transition-colors">Batal</a>
                    <button type="submit" class="px-6 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl shadow-md shadow-indigo-500/30 transition-all hover:-translate-y-0.5 flex items-center gap-2">
                        <i class="fa-solid fa-lock"></i> Enkripsi Ulang & Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
