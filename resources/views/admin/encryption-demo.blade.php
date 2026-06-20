<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-emerald-500 to-teal-400 flex items-center justify-center text-white shadow-lg">
                <i class="fa-solid fa-shield-halved"></i>
            </div>
            Demonstrasi Enkripsi ChaCha20
        </div>
    </x-slot>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
        <!-- Input Form -->
        <div class="glass-card rounded-2xl overflow-hidden shadow-sm h-fit">
            <div class="px-6 py-5 border-b border-slate-100 bg-white/50">
                <h3 class="text-lg font-bold text-slate-800 flex items-center gap-2">
                    <i class="fa-solid fa-keyboard text-emerald-500"></i> Input Data Rekam Medis
                </h3>
            </div>
            <div class="p-6 bg-white">
                <form action="{{ route('admin.encryption-demo.process') }}" method="POST">
                    @csrf
                    <div class="mb-5">
                        <label for="plaintext" class="block text-sm font-bold text-slate-700 mb-2">Teks Asli (Plaintext)</label>
                        <textarea id="plaintext" name="plaintext" rows="5" class="mt-1 block w-full border-slate-300 rounded-xl shadow-sm focus:border-emerald-500 focus:ring focus:ring-emerald-200 transition-colors" placeholder="Masukkan keluhan, diagnosa, atau catatan medis pasien di sini untuk melihat bagaimana data tersebut dienkripsi..." required>{{ old('plaintext', $plaintext ?? '') }}</textarea>
                    </div>
                    
                    <div class="bg-emerald-50 border border-emerald-100 rounded-xl p-4 mb-5 flex items-start gap-3">
                        <i class="fa-solid fa-circle-info text-emerald-500 mt-0.5"></i>
                        <p class="text-sm text-emerald-800 font-medium leading-relaxed">
                            Sistem akan memproses teks ini menggunakan pustaka PHP Libsodium (XChaCha20). Nonce (Number Used Once) akan dihasilkan secara acak untuk menjamin keamanan meskipun kunci yang sama digunakan berulang kali.
                        </p>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="inline-flex items-center justify-center px-6 py-3 border border-transparent shadow-md text-sm font-bold rounded-xl text-white bg-emerald-600 hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 transition-all hover:-translate-y-0.5">
                            <i class="fa-solid fa-lock mr-2"></i> Enkripsi & Dekripsi Data
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Results -->
        <div class="glass-card rounded-2xl overflow-hidden shadow-sm h-fit">
            <div class="px-6 py-5 border-b border-slate-100 bg-white/50">
                <h3 class="text-lg font-bold text-slate-800 flex items-center gap-2">
                    <i class="fa-solid fa-microchip text-blue-500"></i> Hasil Proses & Metrik Waktu
                </h3>
            </div>
            <div class="p-6 bg-white">
                @if(isset($ciphertext))
                    <div class="space-y-6">
                        <!-- Encryption Phase -->
                        <div class="relative pl-6 border-l-2 border-slate-200">
                            <div class="absolute -left-[9px] top-0 w-4 h-4 rounded-full bg-slate-200 ring-4 ring-white"></div>
                            <h4 class="text-sm font-bold text-slate-800 uppercase tracking-wider mb-3 flex items-center justify-between">
                                <span>Fase 1: Enkripsi</span>
                                <span class="bg-blue-100 text-blue-700 text-xs px-3 py-1 rounded-full font-mono font-bold">{{ $encryptTime }} ms</span>
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

                        <!-- Decryption Phase -->
                        <div class="relative pl-6 border-l-2 border-slate-200">
                            <div class="absolute -left-[9px] top-0 w-4 h-4 rounded-full bg-slate-200 ring-4 ring-white"></div>
                            <h4 class="text-sm font-bold text-slate-800 uppercase tracking-wider mb-3 flex items-center justify-between">
                                <span>Fase 2: Dekripsi</span>
                                <span class="bg-indigo-100 text-indigo-700 text-xs px-3 py-1 rounded-full font-mono font-bold">{{ $decryptTime }} ms</span>
                            </h4>
                            
                            <div class="bg-slate-50 rounded-xl p-4 border border-slate-100 shadow-inner">
                                <p class="text-xs font-bold text-slate-500 mb-1 uppercase tracking-wide">Restored Plaintext (Hasil Dekripsi)</p>
                                <div class="w-full text-sm text-slate-900 bg-white p-3 rounded-lg border border-slate-200 whitespace-pre-wrap shadow-sm">{{ $decryptedText }}</div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="flex flex-col items-center justify-center text-center py-12 px-4">
                        <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center text-4xl text-slate-300 mb-4 border border-slate-100 shadow-inner">
                            <i class="fa-solid fa-flask"></i>
                        </div>
                        <h4 class="text-lg font-bold text-slate-700 mb-2">Belum Ada Data</h4>
                        <p class="text-sm text-slate-500 max-w-sm">Masukkan teks pada form di sebelah kiri dan klik tombol untuk melihat proses enkripsi ChaCha20 secara real-time.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
