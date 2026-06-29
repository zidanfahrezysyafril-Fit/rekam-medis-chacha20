<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MedSecure | ChaCha20 Medical Security Platform</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Outfit', sans-serif;
            color: #0f172a;
        }

        .hero-bg {
            background:
                radial-gradient(circle at top right, #67E8F955, transparent 40%),
                radial-gradient(circle at bottom left, #22D3EE40, transparent 40%),
                linear-gradient(to bottom, #f7fcff, #ecfeff);
        }

        .glass {
            background: rgba(255, 255, 255, .18);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, .4);
        }

        .glass-card {
            background: linear-gradient(135deg,
                    rgba(255, 255, 255, .45),
                    rgba(34, 211, 238, .12),
                    rgba(20, 184, 166, .08));

            backdrop-filter: blur(25px);

            border: 1px solid rgba(34, 211, 238, .25);

            box-shadow:
                0 0 20px rgba(34, 211, 238, .08),
                inset 0 0 20px rgba(255, 255, 255, .15);

            transition: all .35s ease;

            position: relative;
            overflow: hidden;
        }

        .glass-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 50px rgba(34, 211, 238, .15);
        }

        .text-gradient {
            background: linear-gradient(135deg,
                    #22D3EE,
                    #14B8A6,
                    #0EA5E9);

            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .floating {
            animation: floating 5s ease-in-out infinite;
        }

        @keyframes floating {
            0% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-12px);
            }

            100% {
                transform: translateY(0);
            }
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-12px);
            }
        }

        @keyframes floatDelay {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(12px);
            }
        }

        .animate-float {
            animation: float 4s ease-in-out infinite;
        }

        .animate-float-delay {
            animation: floatDelay 5s ease-in-out infinite;
        }
    </style>
</head>

<body class="flex flex-col min-h-screen bg-slate-950 text-slate-900">
    <main class="flex-grow bg-[#f7fcff]">
    <!-- NAVBAR -->
    <nav class="fixed top-0 left-0 w-full z-50 glass">
        <div class="max-w-7xl mx-auto px-6 lg:px-10">
            <div class="h-20 flex justify-between items-center">
                <div class="flex items-center gap-3">
                    <div
                        class="w-12 h-12 rounded-2xl bg-gradient-to-br from-cyan-500 to-teal-500 flex items-center justify-center text-white shadow-xl">
                        <i class="fa-solid fa-shield-heart"></i>
                    </div>
                    <div>
                        <h2 class="font-extrabold text-2xl">
                            MedSecure
                        </h2>
                        <p class="text-xs text-cyan-600 font-semibold">
                            ChaCha20 Security Platform
                        </p>
                    </div>
                </div>
                <div class="hidden md:flex relative items-center">
                    <!-- Menu -->
                    <div class="relative z-10 flex gap-14 font-semibold text-slate-800">

                        <a href="#beranda" class="hover:text-cyan-600 transition duration-300">
                            Beranda
                        </a>

                        <a href="#fitur" class="hover:text-cyan-600 transition duration-300">
                            Fitur
                        </a>

                        <a href="#keamanan" class="hover:text-cyan-600 transition duration-300">
                            Keamanan
                        </a>

                        <a href="#tentang" class="hover:text-cyan-600 transition duration-300">
                            Tentang
                        </a>

                    </div>

                </div>
                <a href="{{ route('login') }}"
                    class="relative overflow-hidden
           px-10 py-4
           rounded-full
           text-white font-bold text-lg
           bg-gradient-to-r
           from-cyan-400
           via-sky-500
           to-teal-400
           shadow-[0_0_25px_rgba(34,211,238,0.45)]
           hover:scale-105
           hover:shadow-[0_0_35px_rgba(34,211,238,0.65)]
           transition-all duration-300">

                    <!-- Glossy Effect -->
                    <span
                        class="absolute inset-x-2 top-1 h-1/2 rounded-full
                 bg-white/30 blur-sm"></span>

                    <span class="relative z-10">
                        Login
                    </span>

                </a>
            </div>
        </div>
    </nav>
    <!-- HERO SECTION -->
    <section id="beranda" class="relative min-h-screen flex items-center overflow-hidden pt-28">
        <div class="absolute inset-0">

            <!-- Background Image -->
            <img src="{{ asset('images/bchero.png') }}" alt="Medical Future"
                class="w-full h-full object-cover scale-105" style="object-position: 55% center;">

            <!-- Fade Kiri & Kanan -->
            <div class="absolute inset-0"
                style="
            background: linear-gradient(
                to right,
                rgba(255,255,255,0.75) 0%,
                rgba(255,255,255,0.35) 18%,
                rgba(255,255,255,0) 35%,
                rgba(255,255,255,0) 65%,
                rgba(255,255,255,0.20) 82%,
                rgba(255,255,255,0.50) 100%
            );
        ">
            </div>

        </div>

        <!-- Overlay Kiri -->
        <div
            class="absolute inset-0
        bg-gradient-to-r
        from-white/95
        via-white/45
        to-white/15">
        </div>
        <!-- Content -->
        <div class="max-w-7xl mx-auto px-6 lg:px-10 relative z-10 w-full">

            <div class="grid lg:grid-cols-2 items-center min-h-[85vh]">

                <!-- LEFT CONTENT -->
                <div>

                    <div
                        class="inline-flex items-center gap-2
                px-5 py-3 rounded-full
                bg-white/70 backdrop-blur-xl
                border border-cyan-200
                text-cyan-700 font-semibold
                shadow-lg mb-8">

                        <i class="fa-solid fa-shield-heart"></i>

                        Keamanan Layanan Kesehatan Masa Depan

                    </div>

                    <h1
                        class="text-5xl lg:text-7xl
                font-extrabold
                leading-tight
                text-slate-900
                mb-8">

                        Amankan Data
                        Medis dengan

                        <span
                            class="
                    bg-gradient-to-r
                    from-cyan-500
                    via-sky-500
                    to-blue-600
                    bg-clip-text
                    text-transparent">

                            Enkripsi ChaCha20

                        </span>

                    </h1>

                    <p
                        class="text-xl text-slate-600
                leading-relaxed
                max-w-xl
                mb-10">

                        Sistem rekam medis digital generasi baru
                        yang menggabungkan keamanan kriptografi modern,
                        perlindungan data pasien, dan teknologi kesehatan
                        cerdas untuk rumah sakit masa depan.

                    </p>

                    <div class="flex flex-wrap gap-4">

                        <a href="{{ route('login') }}"
                            class="px-8 py-4 rounded-2xl
                    bg-gradient-to-r
                    from-cyan-500
                    to-blue-600
                    text-white
                    font-bold
                    shadow-xl
                    hover:scale-105
                    transition">

                            Sistem Login →

                        </a>

                        <a href="#fitur"
                            class="px-8 py-4 rounded-2xl
                    bg-white/90
                    backdrop-blur-xl
                    border border-slate-200
                    text-slate-700
                    font-bold
                    shadow-lg
                    hover:bg-white">

                            Pelajari Sistem

                        </a>

                    </div>

                </div>
                <!-- RIGHT STATS -->
                <div class="hidden lg:flex justify-end">

                    <div class="space-y-6">

                        <!-- CARD 1 -->
                        <div
                            class="w-[370px]
            bg-white/10
            backdrop-blur-[30px]
            border border-white/20
            rounded-[35px]
            p-6
            shadow-[0_0_60px_rgba(34,211,238,.18)]
            animate-float">

                            <div class="flex items-center gap-5">

                                <div
                                    class="w-16 h-16 rounded-2xl
                    bg-cyan-400/15
                    flex items-center justify-center">

                                    <i class="fa-solid fa-lock text-cyan-300 text-3xl"></i>

                                </div>

                                <div>

                                    <h3 class="text-5xl font-extrabold text-white">
                                        256
                                    </h3>

                                    <p class="text-white/90 text-lg font-medium">
                                        Kekuatan Keamanan
                                    </p>

                                </div>

                            </div>

                        </div>

                        <!-- CARD 2 -->
                        <div
                            class="w-[370px]
            bg-white/10
            backdrop-blur-[30px]
            border border-white/20
            rounded-[35px]
            p-6
            shadow-[0_0_60px_rgba(34,211,238,.18)]
            animate-float-delay">

                            <div class="flex items-center gap-5">

                                <div
                                    class="w-16 h-16 rounded-2xl
                    bg-cyan-400/15
                    flex items-center justify-center">

                                    <i class="fa-solid fa-bolt text-yellow-300 text-3xl"></i>

                                </div>

                                <div>

                                    <h3 class="text-5xl font-extrabold text-white">
                                        20
                                    </h3>

                                    <p class="text-white/90 text-lg font-medium">
                                        Putaran ChaCha20
                                    </p>

                                </div>

                            </div>

                        </div>

                        <!-- CARD 3 -->
                        <div
                            class="w-[370px]
            bg-white/10
            backdrop-blur-[30px]
            border border-white/20
            rounded-[35px]
            p-6
            shadow-[0_0_60px_rgba(34,211,238,.18)]
            animate-float">

                            <div class="flex items-center gap-5">

                                <div
                                    class="w-16 h-16 rounded-2xl
                    bg-cyan-400/15
                    flex items-center justify-center">

                                    <i class="fa-solid fa-shield-heart text-emerald-300 text-3xl"></i>

                                </div>

                                <div>

                                    <h3 class="text-5xl font-extrabold text-white">
                                        100%
                                    </h3>

                                    <p class="text-white/90 text-lg font-medium">
                                        Data Terenkripsi
                                    </p>

                                </div>

                            </div>

                        </div>

                        <!-- CARD 4 -->
                        <div
                            class="w-[370px]
            bg-white/10
            backdrop-blur-[30px]
            border border-white/20
            rounded-[35px]
            p-6
            shadow-[0_0_60px_rgba(34,211,238,.18)]
            animate-float-delay">

                            <div class="flex items-center gap-5">

                                <div
                                    class="w-16 h-16 rounded-2xl
                    bg-cyan-400/15
                    flex items-center justify-center">

                                    <i class="fa-solid fa-hospital text-sky-300 text-3xl"></i>

                                </div>

                                <div>

                                    <h3 class="text-5xl font-extrabold text-white">
                                        24/7
                                    </h3>

                                    <p class="text-white/90 text-lg font-medium">
                                        Monitoring Sistem
                                    </p>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>
        </div>
    </section>

    <!-- FEATURES -->
    <section id="fitur" class="py-28 bg-gradient-to-b from-cyan-50 to-white">
            <div class="max-w-7xl mx-auto px-6 lg:px-10">
                <div class="text-center mb-20">
                    <span class="text-cyan-600 font-bold uppercase tracking-widest">
                        Features
                    </span>
                    <h2 class="text-4xl lg:text-5xl font-extrabold mt-4 mb-6">
                        Smart Medical Security
                        Platform
                    </h2>
                    <p class="max-w-3xl mx-auto text-slate-600 text-lg">
                        MedSecure menghadirkan perlindungan data pasien
                        melalui kombinasi sistem rekam medis digital dan
                        algoritma ChaCha20 yang cepat, ringan, dan aman.
                    </p>
                </div>
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <!-- CARD 1 -->
                    <div class="glass-card rounded-3xl p-8">
                        <div
                            class="w-16 h-16 rounded-2xl bg-cyan-100 flex items-center justify-center text-cyan-600 text-2xl mb-6">
                            <i class="fa-solid fa-lock"></i>
                        </div>
                        <h3 class="font-bold text-2xl mb-4">
                            ChaCha20 Encryption
                        </h3>
                        <p class="text-slate-600">
                            Data rekam medis diamankan menggunakan
                            algoritma stream cipher modern ChaCha20
                            dengan performa tinggi.
                        </p>
                    </div>
                    <!-- CARD 2 -->
                    <div class="glass-card rounded-3xl p-8">
                        <div
                            class="w-16 h-16 rounded-2xl bg-cyan-100 flex items-center justify-center text-cyan-600 text-2xl mb-6">
                            <i class="fa-solid fa-user-shield"></i>
                        </div>
                        <h3 class="font-bold text-2xl mb-4">
                            Role Based Access
                        </h3>
                        <p class="text-slate-600">
                            Akses sistem dibatasi berdasarkan
                            peran pengguna untuk menjaga
                            keamanan informasi pasien.
                        </p>
                    </div>
                    <!-- CARD 3 -->
                    <div class="glass-card rounded-3xl p-8">
                        <div
                            class="w-16 h-16 rounded-2xl bg-cyan-100 flex items-center justify-center text-cyan-600 text-2xl mb-6">
                            <i class="fa-solid fa-file-medical"></i>
                        </div>
                        <h3 class="font-bold text-2xl mb-4">
                            Digital Medical Record
                        </h3>
                        <p class="text-slate-600">
                            Pengelolaan data pasien secara digital
                            untuk meningkatkan efisiensi dan
                            kualitas layanan kesehatan.
                        </p>
                    </div>
                    <!-- CARD 4 -->
                    <div class="glass-card rounded-3xl p-8">
                        <div
                            class="w-16 h-16 rounded-2xl bg-cyan-100 flex items-center justify-center text-cyan-600 text-2xl mb-6">
                            <i class="fa-solid fa-key"></i>
                        </div>
                        <h3 class="font-bold text-2xl mb-4">
                            Secure Key Management
                        </h3>
                        <p class="text-slate-600">
                            Pengelolaan kunci enkripsi yang aman
                            untuk memastikan data tetap terlindungi.
                        </p>
                    </div>
                    <!-- CARD 5 -->
                    <div class="glass-card rounded-3xl p-8">
                        <div
                            class="w-16 h-16 rounded-2xl bg-cyan-100 flex items-center justify-center text-cyan-600 text-2xl mb-6">
                            <i class="fa-solid fa-chart-line"></i>
                        </div>
                        <h3 class="font-bold text-2xl mb-4">
                            Activity Monitoring
                        </h3>
                        <p class="text-slate-600">
                            Monitoring aktivitas pengguna
                            untuk meningkatkan keamanan
                            dan audit sistem.
                        </p>
                    </div>
                    <!-- CARD 6 -->
                    <div class="glass-card rounded-3xl p-8">
                        <div
                            class="w-16 h-16 rounded-2xl bg-cyan-100 flex items-center justify-center text-cyan-600 text-2xl mb-6">
                            <i class="fa-solid fa-shield-heart"></i>
                        </div>
                        <h3 class="font-bold text-2xl mb-4">
                            Healthcare Protection
                        </h3>
                        <p class="text-slate-600">
                            Menjaga kerahasiaan informasi medis
                            sesuai prinsip keamanan data modern.
                        </p>
                    </div>
                </div>
            </div>
        </section>
        <!-- SECURITY SECTION -->
        <section id="keamanan" class="py-28 bg-slate-900 text-white relative overflow-hidden">
            <div class="absolute top-0 right-0 w-96 h-96 bg-cyan-500/20 rounded-full blur-3xl">
            </div>
            <div class="absolute bottom-0 left-0 w-96 h-96 bg-teal-500/20 rounded-full blur-3xl">
            </div>
            <div class="max-w-7xl mx-auto px-6 lg:px-10 relative">
                <div class="text-center mb-20">
                    <span class="text-cyan-400 font-bold uppercase tracking-widest">
                        Security Technology
                    </span>
                    <h2 class="text-4xl lg:text-5xl font-extrabold mt-4 mb-6">
                        How ChaCha20 Protects
                        Medical Data
                    </h2>
                    <p class="max-w-3xl mx-auto text-slate-300 text-lg">
                        Algoritma ChaCha20 digunakan untuk mengenkripsi
                        data rekam medis sehingga hanya pihak yang
                        memiliki akses yang dapat membaca informasi pasien.
                    </p>
                </div>
                <div class="grid lg:grid-cols-3 gap-8">
                    <div class="glass rounded-3xl p-8">
                        <div class="text-5xl mb-6">
                            📄
                        </div>
                        <h3 class="text-2xl font-bold mb-4">
                            Plaintext
                        </h3>
                        <p class="text-slate-300">
                            Data pasien dimasukkan ke dalam sistem
                            dalam bentuk teks asli sebelum diproses.
                        </p>
                    </div>
                    <div class="glass rounded-3xl p-8">
                        <div class="text-5xl mb-6">
                            🔐
                        </div>
                        <h3 class="text-2xl font-bold mb-4">
                            ChaCha20 Process
                        </h3>
                        <p class="text-slate-300">
                            Data dienkripsi menggunakan stream cipher
                            ChaCha20 sehingga tidak dapat dibaca
                            oleh pihak yang tidak berwenang.
                        </p>
                    </div>
                    <div class="glass rounded-3xl p-8">
                        <div class="text-5xl mb-6">
                            🛡
                        </div>
                        <h3 class="text-2xl font-bold mb-4">
                            Ciphertext
                        </h3>
                        <p class="text-slate-300">
                            Data tersimpan dalam bentuk terenkripsi
                            untuk menjaga kerahasiaan rekam medis.
                        </p>
                    </div>
                </div>
            </div>
        </section>
        <!-- ABOUT -->
        <section id="tentang" class="py-28 bg-white">
            <div class="max-w-7xl mx-auto px-6 lg:px-10">
                <div class="grid lg:grid-cols-2 gap-16 items-center">
                    <div>
                        <span class="text-cyan-600 font-bold uppercase tracking-widest">
                            About Project
                        </span>
                        <h2 class="text-4xl lg:text-5xl font-extrabold mt-4 mb-8">
                            MedSecure
                        </h2>
                        <p class="text-lg text-slate-600 leading-relaxed mb-6">
                            MedSecure merupakan sistem rekam medis
                            digital yang dikembangkan sebagai implementasi
                            algoritma kriptografi modern ChaCha20 untuk
                            menjaga keamanan dan kerahasiaan data pasien.
                        </p>
                        <p class="text-lg text-slate-600 leading-relaxed">
                            Sistem ini dirancang untuk membantu tenaga
                            kesehatan dalam mengelola data medis secara
                            aman, cepat, dan efisien dengan dukungan
                            teknologi enkripsi modern.
                        </p>
                    </div>
                    <div>
                        <div class="glass-card rounded-[40px] p-10">
                            <h3 class="text-2xl font-bold mb-8">
                                Project Highlights
                            </h3>
                            <div class="space-y-5">
                                <div class="flex items-center gap-4">
                                    <i class="fa-solid fa-check-circle text-emerald-500 text-xl">
                                    </i>
                                    <span>
                                        ChaCha20 Stream Cipher
                                    </span>
                                </div>
                                <div class="flex items-center gap-4">
                                    <i class="fa-solid fa-check-circle text-emerald-500 text-xl">
                                    </i>
                                    <span>
                                        Secure Medical Records
                                    </span>
                                </div>
                                <div class="flex items-center gap-4">
                                    <i class="fa-solid fa-check-circle text-emerald-500 text-xl">
                                    </i>
                                    <span>
                                        Role Based Access Control
                                    </span>
                                </div>
                                <div class="flex items-center gap-4">
                                    <i class="fa-solid fa-check-circle text-emerald-500 text-xl">
                                    </i>
                                    <span>
                                        Activity Monitoring
                                    </span>
                                </div>
                                <div class="flex items-center gap-4">
                                    <i class="fa-solid fa-check-circle text-emerald-500 text-xl">
                                    </i>
                                    <span>
                                        Healthcare Data Protection
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- CTA -->
        <section class="py-24 bg-gradient-to-r from-cyan-500 to-teal-500 text-white">
            <div class="max-w-5xl mx-auto px-6 text-center">
                <h2 class="text-4xl lg:text-5xl font-extrabold mb-6">
                    Ready to Secure
                    Medical Records?
                </h2>
                <p class="text-xl text-cyan-100 mb-10">
                    Kelola rekam medis dengan perlindungan
                    ChaCha20 dan teknologi keamanan modern.
                </p>
                <a href="{{ route('login') }}"
                    class="inline-block px-10 py-4 bg-white text-cyan-600 rounded-full font-bold shadow-xl">
                    Login Sekarang
                </a>
            </div>
        </section>
        </main>
    <!-- FOOTER -->
    <footer class="bg-slate-950 relative overflow-hidden pt-20 pb-10 border-t border-slate-800">
            <!-- Background Glow -->
            <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[800px] h-[400px] bg-gradient-to-b from-cyan-900/30 to-transparent blur-3xl rounded-full pointer-events-none"></div>
            
            <div class="max-w-7xl mx-auto px-6 lg:px-10 relative z-10">
                <div class="grid md:grid-cols-2 gap-12 items-center mb-16">
                    <div>
                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-cyan-500 to-teal-500 flex items-center justify-center text-white shadow-lg shadow-cyan-500/20">
                                <i class="fa-solid fa-shield-heart text-xl"></i>
                            </div>
                            <div>
                                <h3 class="text-white text-3xl font-extrabold tracking-tight">
                                    MedSecure
                                </h3>
                                <p class="text-xs text-cyan-400 font-bold tracking-widest uppercase mt-1">
                                    Medical Security Platform
                                </p>
                            </div>
                        </div>
                        <p class="text-slate-400 leading-relaxed max-w-md">
                            Sistem Rekam Medis terpadu yang memadukan keandalan teknologi web modern dengan kekuatan algoritma enkripsi ChaCha20-Poly1305 untuk perlindungan data kesehatan.
                        </p>
                    </div>
                    
                    <div class="flex flex-col md:items-end gap-4">
                        <div class="bg-slate-900/80 backdrop-blur-md border border-slate-800 p-6 rounded-3xl max-w-sm text-left md:text-right shadow-2xl">
                            <p class="text-cyan-500 font-extrabold mb-3 uppercase tracking-widest text-xs">Dikembangkan Oleh</p>
                            <h4 class="text-white font-bold text-xl mb-1">Politeknik Negeri Bengkalis</h4>
                            <p class="text-slate-400 text-sm font-medium">Project Kriptografi Modern</p>
                        </div>
                        <div class="flex items-center gap-3 mt-2">
                            <span class="inline-flex items-center gap-2 px-4 py-2 rounded-xl text-xs font-bold bg-emerald-500/10 text-emerald-400 border border-emerald-500/20">
                                <span class="relative flex h-2 w-2">
                                  <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                                  <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                                </span>
                                Sistem Aktif & Terenkripsi
                            </span>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col md:flex-row justify-between items-center gap-6 pt-8 border-t border-slate-800/80">
                    <p class="text-slate-500 text-sm font-medium">
                        &copy; {{ date('Y') }} MedSecure. Hak Cipta Dilindungi Undang-Undang.
                    </p>
                    <div class="flex gap-4">
                        <div class="w-10 h-10 rounded-full bg-slate-900 border border-slate-800 flex items-center justify-center text-slate-500 hover:text-cyan-400 hover:border-cyan-900 transition-all cursor-pointer hover:-translate-y-1">
                            <i class="fa-solid fa-lock"></i>
                        </div>
                        <div class="w-10 h-10 rounded-full bg-slate-900 border border-slate-800 flex items-center justify-center text-slate-500 hover:text-cyan-400 hover:border-cyan-900 transition-all cursor-pointer hover:-translate-y-1">
                            <i class="fa-solid fa-shield"></i>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
</body>

</html>
