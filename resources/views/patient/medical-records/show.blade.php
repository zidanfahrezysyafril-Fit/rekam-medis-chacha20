<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('patient.medical-records.index') }}" class="text-slate-500 hover:text-cyan-600 transition-colors">
                <i class="fa-solid fa-arrow-left"></i>
            </a>
            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-cyan-500 to-blue-500 flex items-center justify-center text-white shadow-lg">
                <i class="fa-solid fa-file-medical"></i>
            </div>
            Detail Rekam Medis (Didekripsi)
        </div>
    </x-slot>

    <div class="mb-6 flex justify-end gap-3">
        <a href="{{ route('patient.medical-records.export-pdf', $medicalRecord) }}" class="inline-flex items-center justify-center px-4 py-2 bg-red-50 border border-red-200 rounded-xl font-bold text-sm text-red-600 hover:bg-red-600 hover:text-white transition-colors shadow-sm">
            <i class="fa-solid fa-file-pdf mr-2"></i> Download PDF
        </a>
    </div>

    <div class="max-w-4xl mx-auto glass-card rounded-2xl overflow-hidden shadow-sm">
        <!-- Record Header info -->
        <div class="px-6 py-5 border-b border-slate-100 bg-white/50 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <h3 class="text-xl font-bold text-slate-800">No. {{ $medicalRecord->medical_record_number }}</h3>
                <p class="text-sm text-slate-500 mt-1">Dokter Pemeriksa: <strong>{{ $medicalRecord->doctor->doctor_name }}</strong></p>
            </div>
            <div class="text-left md:text-right">
                <div class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-bold bg-green-50 text-green-700 border border-green-200 mb-2">
                    <i class="fa-solid fa-unlock text-green-500"></i> Berhasil Didekripsi
                </div>
                <p class="text-xs text-slate-500 mt-1">Tgl Periksa: {{ \Carbon\Carbon::parse($medicalRecord->examination_date)->format('d M Y') }}</p>
            </div>
        </div>

        <div class="p-6 bg-white">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                <!-- Decrypted Fields -->
                <div class="md:col-span-2">
                    <h4 class="text-sm font-bold text-cyan-600 uppercase tracking-wider mb-4 flex items-center gap-2">
                        <i class="fa-solid fa-file-waveform"></i> Hasil Pemeriksaan
                    </h4>
                </div>

                <div>
                    <p class="text-sm font-bold text-slate-700 mb-2 border-b border-slate-100 pb-2">Keluhan Utama</p>
                    <div class="text-sm text-slate-800 whitespace-pre-wrap bg-cyan-50/50 p-4 rounded-xl border border-cyan-100 min-h-[100px]">{{ $medicalRecord->complaint ?: '-' }}</div>
                </div>

                <div>
                    <p class="text-sm font-bold text-slate-700 mb-2 border-b border-slate-100 pb-2">Riwayat Penyakit</p>
                    <div class="text-sm text-slate-800 whitespace-pre-wrap bg-cyan-50/50 p-4 rounded-xl border border-cyan-100 min-h-[100px]">{{ $medicalRecord->medical_history ?: '-' }}</div>
                </div>

                <div>
                    <p class="text-sm font-bold text-slate-700 mb-2 border-b border-slate-100 pb-2">Diagnosis</p>
                    <div class="text-sm text-slate-800 whitespace-pre-wrap bg-amber-50/50 p-4 rounded-xl border border-amber-100 min-h-[100px]">{{ $medicalRecord->diagnosis ?: '-' }}</div>
                </div>

                <div>
                    <p class="text-sm font-bold text-slate-700 mb-2 border-b border-slate-100 pb-2">Tindakan Medis</p>
                    <div class="text-sm text-slate-800 whitespace-pre-wrap bg-cyan-50/50 p-4 rounded-xl border border-cyan-100 min-h-[100px]">{{ $medicalRecord->treatment ?: '-' }}</div>
                </div>

                <div>
                    <p class="text-sm font-bold text-slate-700 mb-2 border-b border-slate-100 pb-2">Resep Obat</p>
                    <div class="text-sm text-slate-800 whitespace-pre-wrap bg-green-50/50 p-4 rounded-xl border border-green-100 min-h-[100px]">{{ $medicalRecord->prescription ?: '-' }}</div>
                </div>

                <div>
                    <p class="text-sm font-bold text-slate-700 mb-2 border-b border-slate-100 pb-2">Catatan Dokter</p>
                    <div class="text-sm text-slate-800 whitespace-pre-wrap bg-purple-50/50 p-4 rounded-xl border border-purple-100 min-h-[100px]">{{ $medicalRecord->doctor_notes ?: '-' }}</div>
                </div>
            </div>
            
            <div class="mt-8 bg-slate-50 p-4 rounded-xl border border-slate-200 text-sm text-slate-600 flex items-start gap-3">
                <i class="fa-solid fa-circle-info text-blue-500 mt-0.5"></i>
                <p>Informasi rekam medis ini sangat rahasia. Di dalam server, data ini tersimpan dalam bentuk terenkripsi (Ciphertext) menggunakan ChaCha20 dan hanya bisa dibaca (didekripsi) melalui otorisasi akses pada portal ini.</p>
            </div>
        </div>
    </div>
</x-app-layout>
