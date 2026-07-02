<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-cyan-500 to-blue-500 flex items-center justify-center text-white shadow-lg">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 14c1 1.5 3 2.5 4.5 1M21 14c-1 1.5-3 2.5-4.5 1" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 7v6M9 10h6" stroke-width="2.5" />
                </svg>
            </div>
            Dasbor Pasien
        </div>
    </x-slot>

    @if(!$patient)
        <div class="glass-card rounded-2xl overflow-hidden shadow-sm mb-8">
            <div class="bg-gradient-to-r from-amber-500 to-orange-500 px-6 py-5 border-b border-orange-400 text-white flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-white/20 flex items-center justify-center text-xl shrink-0 backdrop-blur-md border border-white/30">
                    <i class="fa-solid fa-clipboard-user"></i>
                </div>
                <div>
                    <h3 class="text-lg font-bold">Lengkapi Profil Anda</h3>
                    <p class="text-orange-50 text-sm">Silakan lengkapi data demografi Anda di bawah ini agar dapat terhubung dengan rekam medis di sistem kami.</p>
                </div>
            </div>
            <div class="p-6 bg-white">
                <form action="{{ route('patient.profile.store') }}" method="POST">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label for="nik" class="block text-sm font-bold text-slate-700 mb-1">NIK (Nomor Induk Kependudukan)</label>
                            <input type="text" name="nik" id="nik" value="{{ old('nik') }}" class="mt-1 block w-full border-slate-300 rounded-xl shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 transition-colors" required placeholder="16 digit NIK">
                            @error('nik') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label for="full_name" class="block text-sm font-bold text-slate-700 mb-1">Nama Lengkap</label>
                            <input type="text" name="full_name" id="full_name" value="{{ old('full_name', auth()->user()->name) }}" class="mt-1 block w-full border-slate-300 rounded-xl shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 transition-colors" required>
                            <p class="mt-1 text-xs text-slate-500">Nama akun login Anda akan diperbarui mengikuti nama ini.</p>
                            @error('full_name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label for="date_of_birth" class="block text-sm font-bold text-slate-700 mb-1">Tanggal Lahir</label>
                            <input type="date" name="date_of_birth" id="date_of_birth" value="{{ old('date_of_birth') }}" class="mt-1 block w-full border-slate-300 rounded-xl shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 transition-colors" required>
                            @error('date_of_birth') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label for="gender" class="block text-sm font-bold text-slate-700 mb-1">Jenis Kelamin</label>
                            <select name="gender" id="gender" class="mt-1 block w-full border-slate-300 rounded-xl shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 transition-colors" required>
                                <option value="">Pilih Jenis Kelamin...</option>
                                <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                            @error('gender') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label for="blood_type" class="block text-sm font-bold text-slate-700 mb-1">Golongan Darah</label>
                            <select name="blood_type" id="blood_type" translate="no" class="notranslate mt-1 block w-full border-slate-300 rounded-xl shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 transition-colors">
                                <option value="">Pilih Golongan Darah (Opsional)</option>
                                <option value="A" {{ old('blood_type') == 'A' ? 'selected' : '' }}>A</option>
                                <option value="B" {{ old('blood_type') == 'B' ? 'selected' : '' }}>B</option>
                                <option value="AB" {{ old('blood_type') == 'AB' ? 'selected' : '' }}>AB</option>
                                <option value="O" {{ old('blood_type') == 'O' ? 'selected' : '' }}>O</option>
                            </select>
                            @error('blood_type') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label for="phone_number" class="block text-sm font-bold text-slate-700 mb-1">Nomor Telepon/HP</label>
                            <input type="text" name="phone_number" id="phone_number" value="{{ old('phone_number') }}" class="mt-1 block w-full border-slate-300 rounded-xl shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 transition-colors" required>
                            @error('phone_number') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                    </div>
                    <div class="mb-6">
                        <label for="address" class="block text-sm font-bold text-slate-700 mb-1">Alamat Lengkap</label>
                        <textarea name="address" id="address" rows="3" class="mt-1 block w-full border-slate-300 rounded-xl shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 transition-colors" required>{{ old('address') }}</textarea>
                        @error('address') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                    <div class="flex justify-end pt-4 border-t border-slate-100">
                        <button type="submit" class="px-6 py-2 bg-gradient-to-r from-cyan-600 to-teal-600 hover:opacity-95 text-white font-bold rounded-xl shadow-md shadow-cyan-600/20 transition-all hover:scale-[1.02] active:scale-[0.98]">
                            Simpan Profil
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @else
        <!-- Welcome Banner -->
        <div class="relative bg-gradient-to-r from-cyan-600 via-sky-600 to-teal-600 rounded-3xl shadow-xl p-8 mb-8 overflow-hidden text-white">
            <!-- Glossy overlay -->
            <span class="absolute inset-x-0 top-0 h-1/2 bg-white/10 blur-sm pointer-events-none"></span>
            <div class="absolute right-0 top-0 w-80 h-80 bg-white/10 rounded-full blur-3xl -translate-y-1/3 translate-x-1/4"></div>
            
            <div class="relative z-10 flex flex-col sm:flex-row items-center gap-6">
                <div class="w-24 h-24 rounded-full bg-white p-1 shadow-lg shrink-0">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($patient->full_name) }}&background=0D8ABC&color=fff&size=150" alt="{{ $patient->full_name }}" class="w-full h-full rounded-full object-cover">
                </div>
                <div>
                    <h2 class="text-2xl md:text-3xl font-extrabold mb-2 tracking-tight">Halo, {{ $patient->full_name }}! 👋</h2>
                    <p class="text-cyan-50 text-sm font-medium max-w-2xl leading-relaxed">Selamat datang di portal kesehatan aman Anda. Di sini Anda dapat melihat rekam medis dan riwayat pemeriksaan Anda secara aman.</p>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
            <!-- Personal Information Card -->
            <div class="lg:col-span-1">
                <div class="glass-card rounded-2xl overflow-hidden">
                    <div class="bg-slate-50 px-6 py-4 border-b border-slate-200 flex justify-between items-center">
                        <h3 class="text-lg font-bold text-slate-800 flex items-center gap-2">
                            <i class="fa-solid fa-id-card text-blue-500"></i> Demografi
                        </h3>
                        <button onclick="toggleEditProfile()" class="text-xs font-bold text-blue-600 hover:text-blue-800 bg-blue-50 hover:bg-blue-100 px-2.5 py-1.5 rounded-lg border border-blue-100 transition-colors">
                            <i class="fa-solid fa-user-pen mr-1"></i> Edit Profil
                        </button>
                    </div>

                    <!-- View Profile Section -->
                    <div id="profile-view-section" class="p-6 space-y-6 @if($errors->any()) hidden @endif">
                        <div>
                            <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Nama Lengkap</p>
                            <p class="text-base font-bold text-slate-900 flex items-center gap-2">
                                {{ $patient->full_name }}
                                <span class="bg-green-100 text-green-700 text-[10px] px-2 py-0.5 rounded-full uppercase border border-green-200"><i class="fa-solid fa-check mr-1"></i>Terverifikasi</span>
                            </p>
                        </div>
                        
                        <div>
                            <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">NIK (Nomor Induk Kependudukan)</p>
                            <p class="text-base font-medium text-slate-700 font-mono" title="Terenkripsi">{{ $patient->nik }} <i class="fa-solid fa-lock text-emerald-500 ml-1 text-xs"></i></p>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Tanggal Lahir</p>
                                <p class="text-base font-medium text-slate-700" title="Terenkripsi">{{ \Carbon\Carbon::parse($patient->date_of_birth)->format('d M Y') }} <i class="fa-solid fa-lock text-emerald-500 ml-1 text-xs"></i></p>
                            </div>
                            <div>
                                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Golongan Darah</p>
                                <div translate="no" class="notranslate inline-flex items-center justify-center min-w-8 px-2 h-8 rounded-lg bg-red-100 text-red-600 font-bold border border-red-200" title="Terenkripsi">
                                    {{ $patient->blood_type ?? '-' }} <i class="fa-solid fa-lock text-emerald-500 ml-1 text-[10px]"></i>
                                </div>
                            </div>
                        </div>

                        <div>
                            <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Nomor Telepon/HP</p>
                            <p class="text-base font-medium text-slate-700" title="Terenkripsi">{{ $patient->phone_number }} <i class="fa-solid fa-lock text-emerald-500 ml-1 text-xs"></i></p>
                        </div>

                        <div>
                            <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Alamat Lengkap</p>
                            <p class="text-base font-medium text-slate-700" title="Terenkripsi">{{ $patient->address }} <i class="fa-solid fa-lock text-emerald-500 ml-1 text-xs"></i></p>
                        </div>
                        
                        <div class="pt-4 mt-4 border-t border-slate-100">
                            <div class="flex items-center gap-3 text-sm text-slate-500 font-medium bg-slate-50 p-3 rounded-xl border border-slate-100">
                                <i class="fa-solid fa-shield-check text-green-500 text-lg"></i>
                                <span>Data Anda dilindungi dengan enkripsi ChaCha20.</span>
                            </div>
                        </div>
                    </div>

                    <!-- Edit Profile Section -->
                    <div id="profile-edit-section" class="p-6 space-y-4 @if(!$errors->any()) hidden @endif">
                        <form action="{{ route('patient.profile.update') }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div>
                                <label for="edit_nik" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">NIK (Nomor Induk Kependudukan)</label>
                                <input type="text" name="nik" id="edit_nik" value="{{ old('nik', $patient->nik) }}" class="block w-full border-slate-300 rounded-xl shadow-sm text-sm focus:border-blue-500 focus:ring focus:ring-blue-200 transition-colors" required placeholder="16 digit NIK">
                                @error('nik') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label for="edit_full_name" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Nama Lengkap</label>
                                <input type="text" name="full_name" id="edit_full_name" value="{{ old('full_name', $patient->full_name) }}" class="block w-full border-slate-300 rounded-xl shadow-sm text-sm focus:border-blue-500 focus:ring focus:ring-blue-200 transition-colors" required>
                                @error('full_name') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label for="edit_date_of_birth" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Tanggal Lahir</label>
                                <input type="date" name="date_of_birth" id="edit_date_of_birth" value="{{ old('date_of_birth', $patient->date_of_birth) }}" class="block w-full border-slate-300 rounded-xl shadow-sm text-sm focus:border-blue-500 focus:ring focus:ring-blue-200 transition-colors" required>
                                @error('date_of_birth') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label for="edit_gender" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Jenis Kelamin</label>
                                <select name="gender" id="edit_gender" class="block w-full border-slate-300 rounded-xl shadow-sm text-sm focus:border-blue-500 focus:ring focus:ring-blue-200 transition-colors" required>
                                    <option value="Male" {{ old('gender', $patient->gender) == 'Male' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="Female" {{ old('gender', $patient->gender) == 'Female' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                                @error('gender') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label for="edit_blood_type" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Golongan Darah</label>
                                <select name="blood_type" id="edit_blood_type" translate="no" class="notranslate block w-full border-slate-300 rounded-xl shadow-sm text-sm focus:border-blue-500 focus:ring focus:ring-blue-200 transition-colors">
                                    <option value="">Pilih Golongan Darah (Opsional)</option>
                                    <option value="A" {{ old('blood_type', $patient->blood_type) == 'A' ? 'selected' : '' }}>A</option>
                                    <option value="B" {{ old('blood_type', $patient->blood_type) == 'B' ? 'selected' : '' }}>B</option>
                                    <option value="AB" {{ old('blood_type', $patient->blood_type) == 'AB' ? 'selected' : '' }}>AB</option>
                                    <option value="O" {{ old('blood_type', $patient->blood_type) == 'O' ? 'selected' : '' }}>O</option>
                                </select>
                                @error('blood_type') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label for="edit_phone_number" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Nomor Telepon/HP</label>
                                <input type="text" name="phone_number" id="edit_phone_number" value="{{ old('phone_number', $patient->phone_number) }}" class="block w-full border-slate-300 rounded-xl shadow-sm text-sm focus:border-blue-500 focus:ring focus:ring-blue-200 transition-colors" required>
                                @error('phone_number') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label for="edit_address" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Alamat Lengkap</label>
                                <textarea name="address" id="edit_address" rows="3" class="block w-full border-slate-300 rounded-xl shadow-sm text-sm focus:border-blue-500 focus:ring focus:ring-blue-200 transition-colors" required>{{ old('address', $patient->address) }}</textarea>
                                @error('address') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                            </div>
                            <div class="flex gap-2 justify-end pt-2">
                                <button type="button" onclick="toggleEditProfile()" class="px-4 py-2 border border-slate-200 text-slate-700 font-bold rounded-lg text-xs hover:bg-slate-50 transition-colors">
                                    Batal
                                </button>
                                <button type="submit" class="px-4 py-2 bg-blue-600 text-white font-bold rounded-lg text-xs hover:bg-blue-700 transition-colors shadow-sm">
                                    Simpan Perubahan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Recent Medical Records -->
            <div class="lg:col-span-2">
                <div class="glass-card rounded-2xl overflow-hidden h-full flex flex-col">
                    <div class="bg-white px-6 py-5 border-b border-slate-100 flex justify-between items-center">
                        <h3 class="text-lg font-bold text-slate-800 flex items-center gap-2">
                            <i class="fa-solid fa-notes-medical text-cyan-500"></i> Kunjungan Terbaru
                        </h3>
                        <a href="{{ route('patient.medical-records.index') }}" class="text-sm font-semibold text-blue-600 hover:text-blue-800 transition-colors bg-blue-50 hover:bg-blue-100 px-3 py-1.5 rounded-full border border-blue-100">Lihat Riwayat</a>
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
                                                    <h4 class="font-bold text-slate-900 text-lg">Konsultasi</h4>
                                                </div>
                                                <div class="text-left sm:text-right">
                                                    <p class="text-sm font-bold text-slate-800">{{ \Carbon\Carbon::parse($record->examination_date)->format('d F Y') }}</p>
                                                    <p class="text-xs font-medium text-slate-500 mt-0.5">Dr. {{ $record->doctor->doctor_name }}</p>
                                                </div>
                                            </div>
                                            
                                            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                                                <div class="flex items-center gap-2 text-sm text-green-700 font-semibold bg-green-50 px-3 py-1.5 rounded-lg border border-green-200 w-fit">
                                                    <i class="fa-solid fa-lock text-green-500"></i> Rekam Medis Terenkripsi
                                                </div>
                                                <a href="{{ route('patient.medical-records.show', $record->id) }}" class="inline-flex items-center justify-center gap-2 text-sm font-bold text-white bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded-lg transition-colors shadow-sm">
                                                    Lihat Detail <i class="fa-solid fa-arrow-right"></i>
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
                                <h4 class="text-lg font-bold text-slate-700 mb-1">Tidak Ada Rekam Medis</h4>
                                <p class="text-sm text-slate-500 max-w-sm">Anda belum memiliki rekam medis di sistem. Setelah Anda mengunjungi klinik, rekam medis Anda akan muncul di sini secara aman.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if($patient)
    <script>
        function toggleEditProfile() {
            const viewSection = document.getElementById('profile-view-section');
            const editSection = document.getElementById('profile-edit-section');
            if (viewSection && editSection) {
                viewSection.classList.toggle('hidden');
                editSection.classList.toggle('hidden');
            }
        }
    </script>
    @endif
</x-app-layout>
