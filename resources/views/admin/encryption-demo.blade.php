<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-emerald-500 to-teal-400 flex items-center justify-center text-white shadow-lg">
                <i class="fa-solid fa-shield-halved"></i>
            </div>
            Demonstrasi Enkripsi & Dekripsi ChaCha20
        </div>
    </x-slot>

    @if($errors->has('decrypt_error'))
        <div class="mb-4 bg-red-50 border-l-4 border-red-500 p-4 rounded-r-xl shadow-sm">
            <div class="flex items-center">
                <i class="fa-solid fa-triangle-exclamation text-red-500 mr-3 text-xl"></i>
                <p class="text-sm text-red-700 font-medium">{{ $errors->first('decrypt_error') }}</p>
            </div>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
        <!-- Input Forms -->
        <div class="space-y-6">
            <!-- Form Enkripsi -->
            <div class="glass-card rounded-2xl overflow-hidden shadow-sm h-fit border-t-4 border-emerald-500">
                <div class="px-6 py-5 border-b border-slate-100 bg-emerald-50/50">
                    <h3 class="text-lg font-bold text-slate-800 flex items-center gap-2">
                        <i class="fa-solid fa-lock text-emerald-500"></i> Proses Enkripsi
                    </h3>
                </div>
                <div class="p-6 bg-white">
                    <form action="{{ route('admin.encryption-demo.process') }}" method="POST">
                        @csrf
                        <input type="hidden" name="action" value="encrypt">
                        <div class="mb-5">
                            <label for="plaintext" class="block text-sm font-bold text-slate-700 mb-2">Teks Asli (Plaintext)</label>
                            <textarea id="plaintext" name="plaintext" rows="4" class="mt-1 block w-full border-slate-300 rounded-xl shadow-sm focus:border-emerald-500 focus:ring focus:ring-emerald-200 transition-colors" placeholder="Masukkan keluhan, diagnosa, atau catatan medis pasien..." required>{{ old('plaintext', $plaintext ?? '') }}</textarea>
                        </div>
                        <div class="flex justify-end">
                            <button type="submit" class="inline-flex items-center justify-center px-5 py-2.5 border border-transparent shadow-md text-sm font-bold rounded-xl text-white bg-emerald-600 hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 transition-all hover:-translate-y-0.5">
                                Enkripsi Data
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Form Dekripsi -->
            <div class="glass-card rounded-2xl overflow-hidden shadow-sm h-fit border-t-4 border-indigo-500">
                <div class="px-6 py-5 border-b border-slate-100 bg-indigo-50/50">
                    <h3 class="text-lg font-bold text-slate-800 flex items-center gap-2">
                        <i class="fa-solid fa-lock-open text-indigo-500"></i> Proses Dekripsi
                    </h3>
                </div>
                <div class="p-6 bg-white">
                    <form action="{{ route('admin.encryption-demo.process') }}" method="POST">
                        @csrf
                        <input type="hidden" name="action" value="decrypt">
                        <div class="mb-4">
                            <label for="ciphertext_input" class="block text-sm font-bold text-slate-700 mb-2">Ciphertext</label>
                            <textarea id="ciphertext_input" name="ciphertext_input" rows="3" class="mt-1 block w-full border-slate-300 rounded-xl shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 transition-colors font-mono text-sm" placeholder="Masukkan ciphertext..." required>{{ old('ciphertext_input', $ciphertext_input ?? '') }}</textarea>
                        </div>
                        <div class="mb-5">
                            <label for="nonce_input" class="block text-sm font-bold text-slate-700 mb-2">Nonce (Base64)</label>
                            <input type="text" id="nonce_input" name="nonce_input" class="mt-1 block w-full border-slate-300 rounded-xl shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 transition-colors font-mono text-sm" placeholder="Masukkan nonce..." value="{{ old('nonce_input', $nonce_input ?? '') }}" required>
                        </div>
                        <div class="flex justify-end">
                            <button type="submit" class="inline-flex items-center justify-center px-5 py-2.5 border border-transparent shadow-md text-sm font-bold rounded-xl text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all hover:-translate-y-0.5">
                                Dekripsi Data
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Results -->
        <div class="glass-card rounded-2xl overflow-hidden shadow-sm h-fit">
            <div class="px-6 py-5 border-b border-slate-100 bg-white/50">
                <h3 class="text-lg font-bold text-slate-800 flex items-center gap-2">
                    <i class="fa-solid fa-microchip text-blue-500"></i> Hasil Proses
                </h3>
            </div>
            <div class="p-6 bg-white">
                @if(isset($action_taken))
                    @if($action_taken === 'encrypt')
                        <div class="relative pl-6 border-l-2 border-emerald-200">
                            <div class="absolute -left-[9px] top-0 w-4 h-4 rounded-full bg-emerald-100 ring-4 ring-white"></div>
                            <h4 class="text-sm font-bold text-slate-800 uppercase tracking-wider mb-3 flex items-center justify-between">
                                <span>Hasil Enkripsi</span>
                                <span class="bg-emerald-100 text-emerald-700 text-xs px-3 py-1 rounded-full font-mono font-bold">{{ $encryptTime }} ms</span>
                            </h4>
                            
                            <div class="bg-slate-50 rounded-xl p-4 border border-slate-100 space-y-4 shadow-inner">
                                <div>
                                    <p class="text-xs font-bold text-slate-500 mb-1 uppercase tracking-wide">Generated Nonce (Base64)</p>
                                    <code class="block w-full text-sm text-emerald-600 bg-white p-2 rounded-lg border border-slate-200 break-all font-mono shadow-sm">{{ $nonce }}</code>
                                </div>
                                
                                <div>
                                    <p class="text-xs font-bold text-slate-500 mb-1 uppercase tracking-wide">Ciphertext (Tersimpan di Database)</p>
                                    <code class="block w-full text-sm text-red-600 bg-white p-2 rounded-lg border border-slate-200 break-all font-mono shadow-sm">{{ $ciphertext }}</code>
                                </div>
                            </div>
                        </div>
                    @elseif($action_taken === 'decrypt')
                        <div class="relative pl-6 border-l-2 border-indigo-200 mt-6">
                            <div class="absolute -left-[9px] top-0 w-4 h-4 rounded-full bg-indigo-100 ring-4 ring-white"></div>
                            <h4 class="text-sm font-bold text-slate-800 uppercase tracking-wider mb-3 flex items-center justify-between">
                                <span>Hasil Dekripsi</span>
                                <span class="bg-indigo-100 text-indigo-700 text-xs px-3 py-1 rounded-full font-mono font-bold">{{ $decryptTime }} ms</span>
                            </h4>
                            
                            <div class="bg-slate-50 rounded-xl p-4 border border-slate-100 shadow-inner">
                                <p class="text-xs font-bold text-slate-500 mb-1 uppercase tracking-wide">Restored Plaintext</p>
                                <div class="w-full text-sm text-slate-900 bg-white p-3 rounded-lg border border-slate-200 whitespace-pre-wrap shadow-sm">{{ $decryptedText }}</div>
                            </div>
                        </div>
                    @endif
                @else
                    <div class="flex flex-col items-center justify-center text-center py-12 px-4">
                        <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center text-4xl text-slate-300 mb-4 border border-slate-100 shadow-inner">
                            <i class="fa-solid fa-flask"></i>
                        </div>
                        <h4 class="text-lg font-bold text-slate-700 mb-2">Belum Ada Data</h4>
                        <p class="text-sm text-slate-500 max-w-sm">Masukkan data pada salah satu form di sebelah kiri untuk melihat hasil dari algoritma ChaCha20.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
