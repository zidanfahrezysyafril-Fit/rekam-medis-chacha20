<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MedSecure - Sistem Rekam Medis Digital dengan Keamanan ChaCha20</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { font-family: 'Outfit', sans-serif; }
        .glass-panel {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.4);
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(226, 232, 240, 0.8);
            box-shadow: 0 10px 30px -10px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }
        .glass-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px -10px rgba(14, 165, 233, 0.15);
            border-color: rgba(14, 165, 233, 0.3);
        }
        .animate-float { animation: float 6s ease-in-out infinite; }
        .animate-float-delayed { animation: float 6s ease-in-out 3s infinite; }
        .animate-pulse-glow { animation: pulseGlow 3s infinite; }
        
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-15px); }
            100% { transform: translateY(0px); }
        }
        @keyframes pulseGlow {
            0% { box-shadow: 0 0 0 0 rgba(14, 165, 233, 0.4); }
            70% { box-shadow: 0 0 0 15px rgba(14, 165, 233, 0); }
            100% { box-shadow: 0 0 0 0 rgba(14, 165, 233, 0); }
        }
        .text-gradient {
            background: linear-gradient(135deg, #0ea5e9, #3b82f6, #4f46e5);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .bg-gradient-main {
            background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 50%, #dbeafe 100%);
        }
    </style>
</head>
<body class="antialiased bg-slate-50 text-slate-800 selection:bg-cyan-500 selection:text-white">

    <!-- 1. Navbar -->
    <nav class="fixed w-full z-50 top-0 py-4 px-6 lg:px-12 transition-all duration-300 glass-panel border-b border-slate-200/50 shadow-sm">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-cyan-500 to-blue-600 flex items-center justify-center text-white font-bold text-xl shadow-lg shadow-cyan-500/30">
                    <i class="fa-solid fa-shield-heart"></i>
                </div>
                <span class="text-2xl font-extrabold tracking-tight text-slate-900">Med<span class="text-blue-600">Secure</span></span>
            </div>
            <div class="hidden md:flex items-center gap-8">
                <a href="#beranda" class="text-sm font-semibold text-slate-700 hover:text-blue-600 transition-colors">Beranda</a>
                <a href="#fitur" class="text-sm font-semibold text-slate-700 hover:text-blue-600 transition-colors">Fitur</a>
                <a href="#keamanan" class="text-sm font-semibold text-slate-700 hover:text-blue-600 transition-colors">Keamanan</a>
                <a href="#tentang" class="text-sm font-semibold text-slate-700 hover:text-blue-600 transition-colors">Tentang Sistem</a>
            </div>
            <div>
                @if (Route::has('login'))
                    <div class="flex items-center gap-4">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="text-sm font-bold text-white bg-gradient-to-r from-cyan-500 to-blue-600 hover:from-cyan-600 hover:to-blue-700 px-6 py-2.5 rounded-full shadow-md transition-all hover:shadow-lg hover:-translate-y-0.5">Dashboard &rarr;</a>
                        @else
                            <a href="{{ route('login') }}" class="text-sm font-bold text-white bg-gradient-to-r from-cyan-500 to-blue-600 hover:from-cyan-600 hover:to-blue-700 px-8 py-2.5 rounded-full shadow-md shadow-cyan-500/30 transition-all hover:shadow-lg hover:-translate-y-0.5 flex items-center gap-2">
                                <i class="fa-solid fa-right-to-bracket"></i> Login
                            </a>
                        @endauth
                    </div>
                @endif
            </div>
        </div>
    </nav>

    <!-- 2. Hero Section -->
    <section id="beranda" class="relative min-h-screen flex items-center pt-28 pb-20 overflow-hidden bg-gradient-main">
        <!-- Background Decorations -->
        <div class="absolute top-0 right-0 -translate-y-12 translate-x-1/3">
            <div class="w-[800px] h-[800px] rounded-full bg-gradient-to-bl from-cyan-300/40 to-blue-300/40 blur-3xl"></div>
        </div>
        <div class="absolute bottom-0 left-0 translate-y-1/3 -translate-x-1/3">
            <div class="w-[600px] h-[600px] rounded-full bg-gradient-to-tr from-blue-300/40 to-indigo-200/40 blur-3xl"></div>
        </div>

        <div class="max-w-7xl mx-auto px-6 lg:px-12 relative z-10 w-full">
            <div class="grid lg:grid-cols-2 gap-16 items-center">
                <!-- Text Content -->
                <div class="max-w-2xl">
                    <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/80 text-cyan-700 text-sm font-bold mb-6 shadow-sm border border-cyan-100 backdrop-blur-md">
                        <span class="flex h-2.5 w-2.5 relative">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-cyan-500 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-cyan-600"></span>
                        </span>
                        Sistem Informasi Manajemen Kesehatan
                    </div>
                    <h1 class="text-5xl lg:text-6xl xl:text-7xl font-extrabold tracking-tight text-slate-900 leading-[1.1] mb-6">
                        Keamanan Rekam <br> Medis Digital dengan <br>
                        <span class="text-gradient">Teknologi ChaCha20</span>
                    </h1>
                    <p class="text-lg md:text-xl text-slate-600 mb-10 leading-relaxed font-medium">
                        Melindungi kerahasiaan data pasien melalui sistem rekam medis digital yang aman, cepat, dan terpercaya dengan algoritma enkripsi modern.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="{{ route('login') }}" class="inline-flex justify-center items-center gap-3 px-8 py-4 text-base font-bold text-white bg-gradient-to-r from-blue-600 to-cyan-500 rounded-full hover:from-blue-700 hover:to-cyan-600 transition-all shadow-lg shadow-blue-500/30 hover:shadow-xl hover:-translate-y-1 animate-pulse-glow">
                            Mulai Sekarang
                            <i class="fa-solid fa-arrow-right"></i>
                        </a>
                        <a href="#fitur" class="inline-flex justify-center items-center gap-2 px-8 py-4 text-base font-bold text-slate-700 bg-white rounded-full hover:bg-slate-50 transition-all shadow-md border border-slate-200 hover:shadow-lg hover:-translate-y-1">
                            Pelajari Lebih Lanjut
                        </a>
                    </div>
                </div>

                <!-- Visual/Image -->
                <div class="relative lg:h-[600px] flex items-center justify-center mt-10 lg:mt-0">
                    <div class="absolute inset-0 bg-gradient-to-tr from-cyan-400 to-blue-500 rounded-[3rem] transform rotate-3 scale-105 opacity-20 blur-2xl"></div>
                    
                    <div class="relative glass-panel rounded-[2.5rem] p-8 shadow-2xl w-full max-w-lg animate-float z-20 border border-white/60 bg-white/40">
                        <div class="flex justify-between items-center mb-6">
                            <div class="flex gap-2">
                                <div class="w-3 h-3 rounded-full bg-red-400"></div>
                                <div class="w-3 h-3 rounded-full bg-amber-400"></div>
                                <div class="w-3 h-3 rounded-full bg-green-400"></div>
                            </div>
                            <div class="text-xs font-bold text-slate-500 bg-white/60 px-3 py-1 rounded-full"><i class="fa-solid fa-lock text-green-500 mr-1"></i> Terenkripsi</div>
                        </div>

                        <!-- Mock Patient Record -->
                        <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 mb-6 relative overflow-hidden">
                            <div class="absolute top-0 right-0 w-32 h-32 bg-cyan-50 rounded-bl-full -z-10"></div>
                            <div class="flex items-center gap-4 mb-6">
                                <div class="w-14 h-14 rounded-full bg-cyan-100 text-cyan-600 flex items-center justify-center text-2xl shadow-inner">
                                    <i class="fa-solid fa-user-injured"></i>
                                </div>
                                <div>
                                    <h3 class="font-extrabold text-slate-900 text-xl">Budi Santoso</h3>
                                    <p class="text-sm text-slate-500 font-medium">ID: RM-2023-0892</p>
                                </div>
                            </div>
                            
                            <div class="space-y-3">
                                <div class="flex justify-between items-center p-3 rounded-xl bg-slate-50 border border-slate-100">
                                    <span class="text-sm text-slate-500 font-medium"><i class="fa-solid fa-file-medical mr-2 text-blue-400"></i>Diagnosa</span>
                                    <span class="text-sm font-bold text-slate-800 bg-blue-100/50 px-2 py-1 rounded">Hipertensi</span>
                                </div>
                                <div class="p-4 rounded-xl bg-gradient-to-r from-slate-900 to-slate-800 text-white shadow-lg relative overflow-hidden">
                                    <div class="absolute right-0 top-0 opacity-10 text-6xl -mt-2 -mr-2"><i class="fa-solid fa-shield-halved"></i></div>
                                    <div class="flex justify-between items-center mb-2">
                                        <span class="text-xs font-bold text-cyan-300 tracking-wider uppercase">Data Sensitif</span>
                                        <span class="text-[10px] font-bold bg-cyan-500/30 text-cyan-100 px-2 py-0.5 rounded">ChaCha20</span>
                                    </div>
                                    <div class="font-mono text-xs text-slate-300 break-all leading-relaxed bg-black/30 p-2 rounded border border-white/10">
                                        7A 8B 9C 0D 1E 2F 3A 4B ... [ENCRYPTED CIPHERTEXT]
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Floating Badges -->
                        <div class="absolute -right-8 top-1/3 glass-panel px-5 py-3 rounded-2xl shadow-xl animate-float-delayed z-30 flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-green-100 text-green-600 flex items-center justify-center text-lg">
                                <i class="fa-solid fa-check-double"></i>
                            </div>
                            <div>
                                <p class="text-xs text-slate-500 font-medium">Integritas Data</p>
                                <p class="text-sm font-bold text-slate-900">Terjamin</p>
                            </div>
                        </div>

                        <div class="absolute -left-8 bottom-1/4 glass-panel px-5 py-3 rounded-2xl shadow-xl animate-float z-30 flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center text-lg">
                                <i class="fa-solid fa-stopwatch"></i>
                            </div>
                            <div>
                                <p class="text-xs text-slate-500 font-medium">Performa</p>
                                <p class="text-sm font-bold text-slate-900">Sangat Cepat</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 3. Statistik Sistem -->
    <section class="py-12 bg-white border-y border-slate-100 relative z-20 shadow-sm">
        <div class="max-w-7xl mx-auto px-6 lg:px-12">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 divide-x divide-slate-100">
                <div class="text-center px-4">
                    <div class="text-4xl font-extrabold text-blue-600 mb-2">10k+</div>
                    <div class="text-sm font-bold text-slate-500 uppercase tracking-wide">Data Pasien Aman</div>
                </div>
                <div class="text-center px-4">
                    <div class="text-4xl font-extrabold text-cyan-500 mb-2">100%</div>
                    <div class="text-sm font-bold text-slate-500 uppercase tracking-wide">Rekam Medis Terenkripsi</div>
                </div>
                <div class="text-center px-4">
                    <div class="text-4xl font-extrabold text-indigo-500 mb-2">50+</div>
                    <div class="text-sm font-bold text-slate-500 uppercase tracking-wide">Dokter Terdaftar</div>
                </div>
                <div class="text-center px-4">
                    <div class="text-4xl font-extrabold text-emerald-500 mb-2">24/7</div>
                    <div class="text-sm font-bold text-slate-500 uppercase tracking-wide">Aktivitas Sistem Tercatat</div>
                </div>
            </div>
        </div>
    </section>

    <!-- 4. Fitur Utama -->
    <section id="fitur" class="py-24 bg-slate-50 relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-6 lg:px-12 relative z-10">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <h2 class="text-sm font-bold text-blue-600 uppercase tracking-widest mb-3">Fitur Utama Sistem</h2>
                <h3 class="text-4xl md:text-5xl font-extrabold text-slate-900 mb-6">Manajemen Rekam Medis Komprehensif</h3>
                <p class="text-lg text-slate-600 font-medium">Dibangun dengan standar keamanan tinggi untuk memastikan kemudahan pengelolaan data sekaligus melindungi privasi pasien.</p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Fitur 1 -->
                <div class="glass-card p-8 rounded-3xl group relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-blue-50 rounded-bl-full -z-10 group-hover:scale-110 transition-transform"></div>
                    <div class="w-14 h-14 rounded-2xl bg-blue-100 text-blue-600 flex items-center justify-center text-2xl mb-6 shadow-inner group-hover:bg-blue-600 group-hover:text-white transition-colors">
                        <i class="fa-solid fa-users"></i>
                    </div>
                    <h4 class="text-xl font-bold text-slate-900 mb-3">Manajemen Pasien</h4>
                    <p class="text-slate-600 font-medium leading-relaxed">Mengelola data demografi dan informasi pasien secara digital dengan antarmuka yang intuitif dan mudah digunakan.</p>
                </div>

                <!-- Fitur 2 -->
                <div class="glass-card p-8 rounded-3xl group relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-cyan-50 rounded-bl-full -z-10 group-hover:scale-110 transition-transform"></div>
                    <div class="w-14 h-14 rounded-2xl bg-cyan-100 text-cyan-600 flex items-center justify-center text-2xl mb-6 shadow-inner group-hover:bg-cyan-600 group-hover:text-white transition-colors">
                        <i class="fa-solid fa-laptop-medical"></i>
                    </div>
                    <h4 class="text-xl font-bold text-slate-900 mb-3">Rekam Medis Digital</h4>
                    <p class="text-slate-600 font-medium leading-relaxed">Pencatatan hasil pemeriksaan, keluhan, diagnosa, dan riwayat kesehatan pasien yang terintegrasi secara seamless.</p>
                </div>

                <!-- Fitur 3 -->
                <div class="glass-card p-8 rounded-3xl group relative overflow-hidden ring-2 ring-blue-500/20 shadow-lg shadow-blue-500/10">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-indigo-50 rounded-bl-full -z-10 group-hover:scale-110 transition-transform"></div>
                    <div class="absolute top-4 right-4 bg-gradient-to-r from-blue-600 to-cyan-500 text-white text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-wider shadow-sm">Core Tech</div>
                    <div class="w-14 h-14 rounded-2xl bg-indigo-100 text-indigo-600 flex items-center justify-center text-2xl mb-6 shadow-inner group-hover:bg-indigo-600 group-hover:text-white transition-colors">
                        <i class="fa-solid fa-user-shield"></i>
                    </div>
                    <h4 class="text-xl font-bold text-slate-900 mb-3">Enkripsi ChaCha20</h4>
                    <p class="text-slate-600 font-medium leading-relaxed">Mengamankan data sensitif rekam medis menggunakan algoritma stream cipher modern yang sangat cepat dan aman.</p>
                </div>

                <!-- Fitur 4 -->
                <div class="glass-card p-8 rounded-3xl group relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-emerald-50 rounded-bl-full -z-10 group-hover:scale-110 transition-transform"></div>
                    <div class="w-14 h-14 rounded-2xl bg-emerald-100 text-emerald-600 flex items-center justify-center text-2xl mb-6 shadow-inner group-hover:bg-emerald-600 group-hover:text-white transition-colors">
                        <i class="fa-solid fa-list-check"></i>
                    </div>
                    <h4 class="text-xl font-bold text-slate-900 mb-3">Audit Log</h4>
                    <p class="text-slate-600 font-medium leading-relaxed">Mencatat seluruh aktivitas pengguna sistem, dari login hingga perubahan data, untuk transparansi dan akuntabilitas.</p>
                </div>

                <!-- Fitur 5 -->
                <div class="glass-card p-8 rounded-3xl group relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-amber-50 rounded-bl-full -z-10 group-hover:scale-110 transition-transform"></div>
                    <div class="w-14 h-14 rounded-2xl bg-amber-100 text-amber-600 flex items-center justify-center text-2xl mb-6 shadow-inner group-hover:bg-amber-600 group-hover:text-white transition-colors">
                        <i class="fa-solid fa-sitemap"></i>
                    </div>
                    <h4 class="text-xl font-bold text-slate-900 mb-3">Role-Based Access Control</h4>
                    <p class="text-slate-600 font-medium leading-relaxed">Sistem otorisasi bertingkat. Admin, Dokter, dan Pasien memiliki hak akses dan dashboard yang disesuaikan.</p>
                </div>

                <!-- Fitur 6 -->
                <div class="glass-card p-8 rounded-3xl group relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-rose-50 rounded-bl-full -z-10 group-hover:scale-110 transition-transform"></div>
                    <div class="w-14 h-14 rounded-2xl bg-rose-100 text-rose-600 flex items-center justify-center text-2xl mb-6 shadow-inner group-hover:bg-rose-600 group-hover:text-white transition-colors">
                        <i class="fa-solid fa-file-pdf"></i>
                    </div>
                    <h4 class="text-xl font-bold text-slate-900 mb-3">Export Laporan PDF</h4>
                    <p class="text-slate-600 font-medium leading-relaxed">Kemudahan mencetak dan mengunduh riwayat rekam medis dalam format PDF standar untuk keperluan rujukan.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- 5. Bagian Keamanan -->
    <section id="keamanan" class="py-24 bg-slate-900 text-white relative overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-full overflow-hidden z-0">
            <div class="absolute w-[800px] h-[800px] bg-blue-600/20 rounded-full blur-[100px] -top-[400px] -left-[200px]"></div>
            <div class="absolute w-[600px] h-[600px] bg-cyan-600/20 rounded-full blur-[80px] bottom-[100px] -right-[100px]"></div>
        </div>
        
        <div class="max-w-7xl mx-auto px-6 lg:px-12 relative z-10">
            <div class="grid lg:grid-cols-2 gap-16 items-center">
                <div>
                    <h2 class="text-sm font-bold text-cyan-400 uppercase tracking-widest mb-3">Kriptografi Modern</h2>
                    <h3 class="text-4xl md:text-5xl font-extrabold mb-6">Mengapa Menggunakan ChaCha20?</h3>
                    
                    <div class="space-y-6 mt-8">
                        <div class="flex gap-4 items-start">
                            <div class="w-12 h-12 rounded-xl bg-blue-500/20 text-blue-400 flex items-center justify-center text-xl shrink-0 border border-blue-500/30">
                                <i class="fa-solid fa-bolt"></i>
                            </div>
                            <div>
                                <h4 class="text-xl font-bold mb-2">Enkripsi Modern & Cepat</h4>
                                <p class="text-slate-300 leading-relaxed font-medium">ChaCha20 adalah stream cipher yang dirancang untuk performa optimal. Lebih cepat dari AES pada perangkat tanpa akselerasi perangkat keras khusus.</p>
                            </div>
                        </div>
                        
                        <div class="flex gap-4 items-start">
                            <div class="w-12 h-12 rounded-xl bg-cyan-500/20 text-cyan-400 flex items-center justify-center text-xl shrink-0 border border-cyan-500/30">
                                <i class="fa-solid fa-shield-virus"></i>
                            </div>
                            <div>
                                <h4 class="text-xl font-bold mb-2">Tingkat Keamanan Tinggi</h4>
                                <p class="text-slate-300 leading-relaxed font-medium">Memiliki margin keamanan yang sangat kuat terhadap serangan kriptanalisis. Digunakan sebagai standar enkripsi global oleh Google, Cloudflare, dan TLS 1.3.</p>
                            </div>
                        </div>

                        <div class="flex gap-4 items-start">
                            <div class="w-12 h-12 rounded-xl bg-indigo-500/20 text-indigo-400 flex items-center justify-center text-xl shrink-0 border border-indigo-500/30">
                                <i class="fa-solid fa-database"></i>
                            </div>
                            <div>
                                <h4 class="text-xl font-bold mb-2">Perlindungan Data Database</h4>
                                <p class="text-slate-300 leading-relaxed font-medium">Data keluhan, diagnosa, dan tindakan medis tersimpan dalam bentuk ciphertext. Meskipun database diretas, data tetap tidak bisa dibaca tanpa kunci dekripsi.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Ilustrasi Proses Enkripsi -->
                <div class="bg-slate-800/50 backdrop-blur-md border border-slate-700 p-8 rounded-3xl">
                    <h4 class="text-center font-bold text-slate-300 mb-8 tracking-wider">PROSES TRANSFORMASI DATA</h4>
                    
                    <div class="space-y-6">
                        <!-- Plaintext -->
                        <div class="bg-slate-700/50 p-4 rounded-xl border border-slate-600">
                            <div class="flex justify-between items-center mb-2">
                                <span class="text-sm font-bold text-green-400"><i class="fa-solid fa-file-lines mr-2"></i>Plaintext (Data Asli)</span>
                            </div>
                            <p class="text-slate-200 font-mono text-sm break-all bg-slate-900/50 p-3 rounded">
                                "Pasien mengeluh sakit kepala kronis..."
                            </p>
                        </div>
                        
                        <!-- Proses -->
                        <div class="flex flex-col items-center justify-center -my-2 relative z-10">
                            <div class="h-8 w-px bg-slate-600"></div>
                            <div class="bg-gradient-to-r from-blue-600 to-cyan-500 text-white px-6 py-2 rounded-full font-bold shadow-lg flex items-center gap-2">
                                <i class="fa-solid fa-key"></i> ChaCha20 Engine
                            </div>
                            <div class="h-8 w-px bg-slate-600"></div>
                        </div>
                        
                        <!-- Ciphertext -->
                        <div class="bg-slate-900 p-4 rounded-xl border border-blue-500/30 relative overflow-hidden">
                            <div class="absolute right-0 top-0 w-24 h-24 bg-blue-500/10 rounded-bl-full"></div>
                            <div class="flex justify-between items-center mb-2">
                                <span class="text-sm font-bold text-red-400"><i class="fa-solid fa-file-shield mr-2"></i>Ciphertext (Data Tersimpan)</span>
                            </div>
                            <p class="text-blue-200/70 font-mono text-xs break-all leading-relaxed">
                                E2 8C 4A 9F 1B 7D 5E 3A C2 F4 88 19 D3 B6 A1 7C E5 99 2F 4B ...
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 6. Cara Kerja Sistem -->
    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-6 lg:px-12">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <h2 class="text-sm font-bold text-blue-600 uppercase tracking-widest mb-3">Alur Sistem</h2>
                <h3 class="text-4xl font-extrabold text-slate-900 mb-6">Bagaimana MedSecure Bekerja?</h3>
            </div>

            <div class="grid md:grid-cols-4 gap-8 relative">
                <!-- Line Connector (Desktop only) -->
                <div class="hidden md:block absolute top-1/2 left-[10%] right-[10%] h-0.5 bg-gradient-to-r from-blue-100 via-cyan-200 to-blue-100 -translate-y-1/2 z-0"></div>

                <!-- Langkah 1 -->
                <div class="relative z-10 text-center">
                    <div class="w-20 h-20 mx-auto bg-white border-4 border-blue-100 rounded-2xl shadow-xl flex items-center justify-center text-3xl text-blue-600 mb-6 relative group hover:border-blue-500 transition-colors">
                        <div class="absolute -top-3 -right-3 w-8 h-8 bg-blue-600 text-white rounded-full flex items-center justify-center font-bold text-sm shadow-md">1</div>
                        <i class="fa-solid fa-user-doctor group-hover:scale-110 transition-transform"></i>
                    </div>
                    <h4 class="text-xl font-bold text-slate-900 mb-2">Input Data</h4>
                    <p class="text-slate-600 font-medium">Dokter menginput rekam medis dan hasil diagnosa pasien ke dalam form.</p>
                </div>

                <!-- Langkah 2 -->
                <div class="relative z-10 text-center mt-8 md:mt-0">
                    <div class="w-20 h-20 mx-auto bg-white border-4 border-cyan-100 rounded-2xl shadow-xl flex items-center justify-center text-3xl text-cyan-500 mb-6 relative group hover:border-cyan-500 transition-colors">
                        <div class="absolute -top-3 -right-3 w-8 h-8 bg-cyan-500 text-white rounded-full flex items-center justify-center font-bold text-sm shadow-md">2</div>
                        <i class="fa-solid fa-lock group-hover:scale-110 transition-transform"></i>
                    </div>
                    <h4 class="text-xl font-bold text-slate-900 mb-2">Enkripsi ChaCha20</h4>
                    <p class="text-slate-600 font-medium">Sistem secara otomatis mengenkripsi data sensitif menggunakan algoritma ChaCha20.</p>
                </div>

                <!-- Langkah 3 -->
                <div class="relative z-10 text-center mt-8 md:mt-0">
                    <div class="w-20 h-20 mx-auto bg-white border-4 border-indigo-100 rounded-2xl shadow-xl flex items-center justify-center text-3xl text-indigo-500 mb-6 relative group hover:border-indigo-500 transition-colors">
                        <div class="absolute -top-3 -right-3 w-8 h-8 bg-indigo-500 text-white rounded-full flex items-center justify-center font-bold text-sm shadow-md">3</div>
                        <i class="fa-solid fa-server group-hover:scale-110 transition-transform"></i>
                    </div>
                    <h4 class="text-xl font-bold text-slate-900 mb-2">Penyimpanan Aman</h4>
                    <p class="text-slate-600 font-medium">Data tersimpan di database dalam bentuk ciphertext yang tidak dapat dibaca secara langsung.</p>
                </div>

                <!-- Langkah 4 -->
                <div class="relative z-10 text-center mt-8 md:mt-0">
                    <div class="w-20 h-20 mx-auto bg-white border-4 border-emerald-100 rounded-2xl shadow-xl flex items-center justify-center text-3xl text-emerald-500 mb-6 relative group hover:border-emerald-500 transition-colors">
                        <div class="absolute -top-3 -right-3 w-8 h-8 bg-emerald-500 text-white rounded-full flex items-center justify-center font-bold text-sm shadow-md">4</div>
                        <i class="fa-solid fa-unlock-keyhole group-hover:scale-110 transition-transform"></i>
                    </div>
                    <h4 class="text-xl font-bold text-slate-900 mb-2">Dekripsi & Akses</h4>
                    <p class="text-slate-600 font-medium">Data didekripsi secara on-the-fly hanya saat diakses oleh pengguna yang berhak (Dokter/Pasien).</p>
                </div>
            </div>
        </div>
    </section>

    <!-- 7. Tentang Sistem -->
    <section id="tentang" class="py-24 bg-slate-50 border-t border-slate-200">
        <div class="max-w-5xl mx-auto px-6 lg:px-12 text-center">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-blue-100 text-blue-600 mb-6">
                <i class="fa-solid fa-graduation-cap text-3xl"></i>
            </div>
            <h2 class="text-3xl md:text-4xl font-extrabold text-slate-900 mb-6">Tentang Penelitian Ini</h2>
            <div class="bg-white p-8 md:p-10 rounded-3xl shadow-lg border border-slate-100 text-left">
                <p class="text-lg text-slate-700 leading-relaxed mb-6 font-medium text-center italic">
                    "Implementasi Algoritma ChaCha20 untuk Pengamanan Data Rekam Medis pada Sistem Rekam Medis Digital Berbasis Web"
                </p>
                <div class="h-px bg-slate-200 w-full mb-6"></div>
                <p class="text-slate-600 leading-relaxed mb-4">
                    Sistem ini dikembangkan sebagai implementasi dari penelitian akademis yang berfokus pada peningkatan keamanan sistem informasi kesehatan. Mengingat tingginya kasus kebocoran data belakangan ini, perlindungan terhadap data medis pasien menjadi hal yang sangat krusial.
                </p>
                <p class="text-slate-600 leading-relaxed">
                    MedSecure dirancang dengan memprioritaskan tiga aspek utama keamanan informasi: 
                    <strong class="text-blue-600">Kerahasiaan (Confidentiality)</strong> dengan memastikan hanya pihak berwenang yang dapat melihat data, 
                    <strong class="text-blue-600">Integritas (Integrity)</strong> untuk mencegah modifikasi tidak sah, dan 
                    <strong class="text-blue-600">Ketersediaan (Availability)</strong> melalui antarmuka web yang dapat diakses kapan saja.
                </p>
            </div>
        </div>
    </section>

    <!-- 8. CTA Section -->
    <section class="py-20 relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-blue-600 to-cyan-500 z-0"></div>
        <!-- Abstract patterns -->
        <div class="absolute inset-0 opacity-10 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] z-0"></div>
        
        <div class="max-w-4xl mx-auto px-6 lg:px-12 relative z-10 text-center text-white">
            <h2 class="text-4xl md:text-5xl font-extrabold mb-6">Mulai Kelola Rekam Medis dengan Aman</h2>
            <p class="text-xl text-blue-100 mb-10 font-medium">Tinggalkan pencatatan manual. Beralih ke sistem digital yang terenkripsi penuh untuk kenyamanan dan keamanan klinik atau rumah sakit Anda.</p>
            
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <a href="{{ route('login') }}" class="px-8 py-4 bg-white text-blue-600 font-bold rounded-full hover:bg-slate-50 transition-all shadow-xl hover:shadow-2xl hover:-translate-y-1 flex items-center justify-center gap-2">
                    <i class="fa-solid fa-arrow-right-to-bracket"></i> Login Sistem
                </a>
                <a href="#kontak" class="px-8 py-4 bg-blue-700/50 text-white font-bold rounded-full hover:bg-blue-700 transition-all border border-blue-400/50 backdrop-blur-sm flex items-center justify-center gap-2">
                    <i class="fa-solid fa-headset"></i> Hubungi Kami
                </a>
            </div>
        </div>
    </section>

    <!-- 9. Footer -->
    <footer id="kontak" class="bg-slate-900 pt-16 pb-8 border-t-4 border-cyan-500">
        <div class="max-w-7xl mx-auto px-6 lg:px-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-12">
                <div class="md:col-span-2">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-cyan-500 to-blue-600 flex items-center justify-center text-white font-bold text-xl">
                            <i class="fa-solid fa-shield-heart"></i>
                        </div>
                        <span class="text-2xl font-extrabold tracking-tight text-white">Med<span class="text-cyan-400">Secure</span></span>
                    </div>
                    <p class="text-slate-400 leading-relaxed font-medium max-w-sm">
                        Sistem Informasi Rekam Medis Digital terdepan dengan teknologi enkripsi ChaCha20 untuk menjamin keamanan dan kerahasiaan data pasien.
                    </p>
                </div>
                
                <div>
                    <h4 class="text-white font-bold text-lg mb-6 tracking-wide">Tautan Cepat</h4>
                    <ul class="space-y-3">
                        <li><a href="#beranda" class="text-slate-400 hover:text-cyan-400 transition-colors font-medium">Beranda</a></li>
                        <li><a href="#fitur" class="text-slate-400 hover:text-cyan-400 transition-colors font-medium">Fitur Sistem</a></li>
                        <li><a href="#keamanan" class="text-slate-400 hover:text-cyan-400 transition-colors font-medium">Keamanan ChaCha20</a></li>
                        <li><a href="#tentang" class="text-slate-400 hover:text-cyan-400 transition-colors font-medium">Tentang Penelitian</a></li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="text-white font-bold text-lg mb-6 tracking-wide">Hubungi Kami</h4>
                    <ul class="space-y-4">
                        <li class="flex items-start gap-3 text-slate-400 font-medium">
                            <i class="fa-solid fa-envelope mt-1 text-cyan-500"></i>
                            <span>admin@medsecure.id</span>
                        </li>
                        <li class="flex items-start gap-3 text-slate-400 font-medium">
                            <i class="fa-solid fa-phone mt-1 text-cyan-500"></i>
                            <span>+62 812 3456 7890</span>
                        </li>
                        <li class="flex items-start gap-3 text-slate-400 font-medium">
                            <i class="fa-solid fa-location-dot mt-1 text-cyan-500"></i>
                            <span>Fakultas Ilmu Komputer,<br>Universitas XYZ</span>
                        </li>
                    </ul>
                </div>
            </div>
            
            <div class="border-t border-slate-800 pt-8 flex flex-col md:flex-row justify-between items-center gap-4">
                <p class="text-slate-500 font-medium text-sm">
                    &copy; {{ date('Y') }} MedSecure Project. Hak Cipta Dilindungi.
                </p>
                <div class="flex gap-4">
                    <a href="#" class="w-10 h-10 rounded-full bg-slate-800 text-slate-400 flex items-center justify-center hover:bg-cyan-500 hover:text-white transition-all"><i class="fa-brands fa-github"></i></a>
                    <a href="#" class="w-10 h-10 rounded-full bg-slate-800 text-slate-400 flex items-center justify-center hover:bg-cyan-500 hover:text-white transition-all"><i class="fa-brands fa-linkedin-in"></i></a>
                    <a href="#" class="w-10 h-10 rounded-full bg-slate-800 text-slate-400 flex items-center justify-center hover:bg-cyan-500 hover:text-white transition-all"><i class="fa-brands fa-instagram"></i></a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });

        // Navbar blur on scroll
        const navbar = document.querySelector('nav');
        window.addEventListener('scroll', () => {
            if (window.scrollY > 50) {
                navbar.classList.add('shadow-md', 'bg-white/90');
                navbar.classList.remove('bg-white/40');
                navbar.classList.remove('border-slate-200/50');
                navbar.classList.add('border-slate-200');
            } else {
                navbar.classList.remove('shadow-md', 'bg-white/90');
                navbar.classList.add('bg-white/40');
                navbar.classList.add('border-slate-200/50');
                navbar.classList.remove('border-slate-200');
            }
        });
    </script>
</body>
</html>
