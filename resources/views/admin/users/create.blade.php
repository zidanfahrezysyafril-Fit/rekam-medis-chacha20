<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.users.index') }}" class="text-slate-500 hover:text-blue-600 transition-colors">
                <i class="fa-solid fa-arrow-left"></i>
            </a>
            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-blue-500 to-cyan-400 flex items-center justify-center text-white shadow-lg">
                <i class="fa-solid fa-user-plus"></i>
            </div>
            Tambah Pengguna
        </div>
    </x-slot>

    <div class="max-w-3xl mx-auto glass-card rounded-2xl overflow-hidden shadow-sm">
        <div class="px-6 py-5 border-b border-slate-100 bg-white/50">
            <h3 class="text-lg font-bold text-slate-800">Informasi Pengguna Baru</h3>
            <p class="text-sm text-slate-500">Silakan isi formulir di bawah ini untuk menambahkan pengguna sistem.</p>
        </div>
        <div class="p-6 bg-white">
            <form action="{{ route('admin.users.store') }}" method="POST">
                @csrf
                
                <div class="mb-4">
                    <label for="name" class="block text-sm font-bold text-slate-700 mb-1">Nama Lengkap</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" class="mt-1 block w-full border-slate-300 rounded-xl shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 transition-colors" required>
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="email" class="block text-sm font-bold text-slate-700 mb-1">Alamat Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" class="mt-1 block w-full border-slate-300 rounded-xl shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 transition-colors" required>
                    @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-sm font-bold text-slate-700 mb-1">Password</label>
                    <input type="password" name="password" id="password" class="mt-1 block w-full border-slate-300 rounded-xl shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 transition-colors" required minlength="8">
                    @error('password')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="role" class="block text-sm font-bold text-slate-700 mb-1">Peran (Role)</label>
                    <select name="role" id="role" class="mt-1 block w-full border-slate-300 rounded-xl shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 transition-colors" required>
                        <option value="">-- Pilih Peran --</option>
                        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="doctor" {{ old('role') == 'doctor' ? 'selected' : '' }}>Dokter</option>
                        <option value="patient" {{ old('role') == 'patient' ? 'selected' : '' }}>Pasien</option>
                    </select>
                    @error('role')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-end gap-3 pt-4 border-t border-slate-100">
                    <a href="{{ route('admin.users.index') }}" class="px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold rounded-xl transition-colors">Batal</a>
                    <button type="submit" class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl shadow-md shadow-blue-500/30 transition-all hover:-translate-y-0.5">Simpan Pengguna</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
