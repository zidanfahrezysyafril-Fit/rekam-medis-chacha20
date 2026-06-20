<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.doctors.index') }}" class="text-slate-500 hover:text-blue-600 transition-colors">
                <i class="fa-solid fa-arrow-left"></i>
            </a>
            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-blue-500 to-cyan-400 flex items-center justify-center text-white shadow-lg">
                <i class="fa-solid fa-pen"></i>
            </div>
            Edit Data Dokter
        </div>
    </x-slot>

    <div class="max-w-3xl mx-auto glass-card rounded-2xl overflow-hidden shadow-sm">
        <div class="px-6 py-5 border-b border-slate-100 bg-white/50">
            <h3 class="text-lg font-bold text-slate-800">Perbarui Profil Klinis Dokter</h3>
            <p class="text-sm text-slate-500">Catatan: Untuk mengubah password akses, silakan gunakan menu Kelola Pengguna.</p>
        </div>
        <div class="p-6 bg-white">
            <form action="{{ route('admin.doctors.update', $doctor) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="space-y-4 mb-6">
                    <div>
                        <label for="doctor_name" class="block text-sm font-bold text-slate-700 mb-1">Nama Lengkap Dokter</label>
                        <input type="text" name="doctor_name" id="doctor_name" value="{{ old('doctor_name', $doctor->doctor_name) }}" class="mt-1 block w-full border-slate-300 rounded-xl shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 transition-colors" required>
                        @error('doctor_name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="sip_number" class="block text-sm font-bold text-slate-700 mb-1">Nomor SIP</label>
                        <input type="text" name="sip_number" id="sip_number" value="{{ old('sip_number', $doctor->sip_number) }}" class="mt-1 block w-full border-slate-300 rounded-xl shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 transition-colors" required>
                        @error('sip_number')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="specialization" class="block text-sm font-bold text-slate-700 mb-1">Spesialisasi</label>
                        <input type="text" name="specialization" id="specialization" value="{{ old('specialization', $doctor->specialization) }}" class="mt-1 block w-full border-slate-300 rounded-xl shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 transition-colors" required>
                        @error('specialization')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="phone_number" class="block text-sm font-bold text-slate-700 mb-1">Nomor Telepon/HP</label>
                        <input type="text" name="phone_number" id="phone_number" value="{{ old('phone_number', $doctor->phone_number) }}" class="mt-1 block w-full border-slate-300 rounded-xl shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 transition-colors" required>
                        @error('phone_number')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="flex items-center justify-end gap-3 pt-4 border-t border-slate-100">
                    <a href="{{ route('admin.doctors.index') }}" class="px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold rounded-xl transition-colors">Batal</a>
                    <button type="submit" class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl shadow-md shadow-blue-500/30 transition-all hover:-translate-y-0.5">Perbarui Data</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
