<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.patients.index') }}" class="text-slate-500 hover:text-blue-600 transition-colors">
                <i class="fa-solid fa-arrow-left"></i>
            </a>
            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-blue-500 to-cyan-400 flex items-center justify-center text-white shadow-lg">
                <i class="fa-solid fa-user-plus"></i>
            </div>
            Tambah Pasien
        </div>
    </x-slot>

    <div class="max-w-4xl mx-auto glass-card rounded-2xl overflow-hidden shadow-sm">
        <div class="px-6 py-5 border-b border-slate-100 bg-white/50">
            <h3 class="text-lg font-bold text-slate-800">Registrasi Pasien Baru</h3>
            <p class="text-sm text-slate-500">Sistem akan secara otomatis membuatkan akun login pasien untuk portal rekam medis.</p>
        </div>
        <div class="p-6 bg-white">
            <form action="{{ route('admin.patients.store') }}" method="POST">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-6">
                    <!-- Akun Login Info -->
                    <div class="space-y-4">
                        <h4 class="font-bold text-slate-700 border-b border-slate-100 pb-2 flex items-center gap-2">
                            <i class="fa-solid fa-key text-blue-500"></i> Akun Portal Pasien
                        </h4>
                        
                        <div>
                            <label for="email" class="block text-sm font-bold text-slate-700 mb-1">Alamat Email</label>
                            <input type="email" name="email" id="email" value="{{ old('email') }}" class="mt-1 block w-full border-slate-300 rounded-xl shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 transition-colors" required>
                            @error('email')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="password" class="block text-sm font-bold text-slate-700 mb-1">Password Awal</label>
                            <input type="password" name="password" id="password" class="mt-1 block w-full border-slate-300 rounded-xl shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 transition-colors" required minlength="8">
                            @error('password')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Profil Pasien Info -->
                    <div class="space-y-4">
                        <h4 class="font-bold text-slate-700 border-b border-slate-100 pb-2 flex items-center gap-2">
                            <i class="fa-solid fa-id-card text-indigo-500"></i> Identitas Pasien
                        </h4>

                        <div>
                            <label for="nik" class="block text-sm font-bold text-slate-700 mb-1">NIK (Nomor Induk Kependudukan)</label>
                            <input type="text" name="nik" id="nik" value="{{ old('nik') }}" class="mt-1 block w-full border-slate-300 rounded-xl shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 transition-colors" required maxlength="20">
                            @error('nik')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="full_name" class="block text-sm font-bold text-slate-700 mb-1">Nama Lengkap Sesuai KTP</label>
                            <input type="text" name="full_name" id="full_name" value="{{ old('full_name') }}" class="mt-1 block w-full border-slate-300 rounded-xl shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 transition-colors" required>
                            @error('full_name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="date_of_birth" class="block text-sm font-bold text-slate-700 mb-1">Tanggal Lahir</label>
                                <input type="date" name="date_of_birth" id="date_of_birth" value="{{ old('date_of_birth') }}" class="mt-1 block w-full border-slate-300 rounded-xl shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 transition-colors" required>
                                @error('date_of_birth')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label for="gender" class="block text-sm font-bold text-slate-700 mb-1">Jenis Kelamin</label>
                                <select name="gender" id="gender" class="mt-1 block w-full border-slate-300 rounded-xl shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 transition-colors" required>
                                    <option value="">Pilih</option>
                                    <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                                @error('gender')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="phone_number" class="block text-sm font-bold text-slate-700 mb-1">No. Handphone</label>
                                <input type="text" name="phone_number" id="phone_number" value="{{ old('phone_number') }}" class="mt-1 block w-full border-slate-300 rounded-xl shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 transition-colors" required>
                                @error('phone_number')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label for="blood_type" class="block text-sm font-bold text-slate-700 mb-1">Golongan Darah</label>
                                <select name="blood_type" id="blood_type" class="mt-1 block w-full border-slate-300 rounded-xl shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 transition-colors">
                                    <option value="">Tidak Tahu</option>
                                    @foreach(['A', 'B', 'AB', 'O', 'A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'] as $bt)
                                        <option value="{{ $bt }}" {{ old('blood_type') == $bt ? 'selected' : '' }}>{{ $bt }}</option>
                                    @endforeach
                                </select>
                                @error('blood_type')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label for="address" class="block text-sm font-bold text-slate-700 mb-1">Alamat Lengkap</label>
                            <textarea name="address" id="address" rows="3" class="mt-1 block w-full border-slate-300 rounded-xl shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 transition-colors" required>{{ old('address') }}</textarea>
                            @error('address')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-3 pt-4 border-t border-slate-100">
                    <a href="{{ route('admin.patients.index') }}" class="px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold rounded-xl transition-colors">Batal</a>
                    <button type="submit" class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl shadow-md shadow-blue-500/30 transition-all hover:-translate-y-0.5">Simpan Pasien</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
