<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'MedSecure') }} - Portal Akses</title>

        <!-- Fonts & Icons -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

        <!-- Scripts -->
        <script src="https://cdn.tailwindcss.com"></script>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            body { font-family: 'Outfit', sans-serif; }
            
            /* Floating animations for ornaments */
            @keyframes floatUp {
                0% { transform: translateY(0px) rotate(0deg); opacity: 0.15; }
                50% { transform: translateY(-20px) rotate(5deg); opacity: 0.28; }
                100% { transform: translateY(0px) rotate(0deg); opacity: 0.15; }
            }
            @keyframes floatDown {
                0% { transform: translateY(0px) rotate(0deg); opacity: 0.12; }
                50% { transform: translateY(15px) rotate(-4deg); opacity: 0.25; }
                100% { transform: translateY(0px) rotate(0deg); opacity: 0.12; }
            }
            .animate-float-slow {
                animation: floatUp 9s ease-in-out infinite;
            }
            .animate-float-medium {
                animation: floatDown 7s ease-in-out infinite;
            }
            .animate-float-fast {
                animation: floatUp 5s ease-in-out infinite;
            }

            /* EKG / ECG line animation */
            @keyframes ecgDraw {
                0% { stroke-dashoffset: 1600; }
                100% { stroke-dashoffset: 0; }
            }
            .ecg-line {
                stroke-dasharray: 800;
                stroke-dashoffset: 800;
                animation: ecgDraw 7s linear infinite;
            }

            /* Grid background overlay */
            .bg-grid-pattern {
                background-size: 30px 30px;
                background-image: linear-gradient(to right, rgba(6, 182, 212, 0.04) 1px, transparent 1px),
                                  linear-gradient(to bottom, rgba(6, 182, 212, 0.04) 1px, transparent 1px);
            }

            /* Heartbeat animation */
            @keyframes heartBeat {
                0% { transform: scale(1); }
                14% { transform: scale(1.08); }
                28% { transform: scale(1); }
                42% { transform: scale(1.08); }
                70% { transform: scale(1); }
            }
            .animate-heart-beat {
                animation: heartBeat 2s infinite ease-in-out;
            }

            /* Form card slide-in animation */
            @keyframes slideInFromRight {
                0% { transform: translateX(50px); opacity: 0; }
                100% { transform: translateX(0); opacity: 1; }
            }
            .animate-slide-in {
                animation: slideInFromRight 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards;
            }

            /* DNA Spiral Animation */
            .dna-rung {
                display: flex;
                align-items: center;
                justify-content: space-between;
                width: 160px;
                height: 12px;
                transform-style: preserve-3d;
                animation: dnaRotate 6s linear infinite;
                animation-delay: var(--delay);
                position: absolute;
                top: var(--y);
                left: calc(50% - 80px);
            }
            .dna-node {
                width: 10px;
                height: 10px;
                border-radius: 50%;
                background-color: currentColor;
                box-shadow: 0 0 8px currentColor;
            }
            .dna-line {
                flex-grow: 1;
                height: 2px;
                margin: 0 4px;
                background-image: repeating-linear-gradient(90deg, transparent, transparent 2px, currentColor 2px, currentColor 4px);
            }
            @keyframes dnaRotate {
                0% {
                    transform: rotateY(0deg);
                }
                100% {
                    transform: rotateY(360deg);
                }
            }

            /* Falling Capsules Background */
            @keyframes fall {
                0% { transform: translateY(-120vh) rotate(0deg); opacity: 0; }
                10% { opacity: 0.35; }
                90% { opacity: 0.35; }
                100% { transform: translateY(120vh) rotate(360deg); opacity: 0; }
            }
            .capsule-pill {
                position: absolute;
                width: 12px;
                height: 32px;
                border-radius: 9999px;
                border: 1px solid rgba(6, 182, 212, 0.25);
                animation: fall 12s linear infinite;
                pointer-events: none;
                z-index: 0;
            }
            .capsule-pill::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                height: 50%;
                border-top-left-radius: 9999px;
                border-top-right-radius: 9999px;
                background-color: rgba(6, 182, 212, 0.45);
            }
            .capsule-pill::after {
                content: '';
                position: absolute;
                bottom: 0;
                left: 0;
                right: 0;
                height: 50%;
                border-bottom-left-radius: 9999px;
                border-bottom-right-radius: 9999px;
                background-color: rgba(255, 255, 255, 0.65);
            }

            /* Hologram 3D effect for doctor image (Smooth 360deg rotation + float) */
            @keyframes hologramPulse {
                0% {
                    transform: translateY(0px) rotateX(12deg) rotateY(0deg);
                    filter: drop-shadow(0 0 15px rgba(6, 182, 212, 0.45)) saturate(1.1);
                }
                50% {
                    transform: translateY(-16px) rotateX(12deg) rotateY(180deg);
                    filter: drop-shadow(0 0 25px rgba(20, 184, 166, 0.65)) saturate(1.35);
                }
                100% {
                    transform: translateY(0px) rotateX(12deg) rotateY(360deg);
                    filter: drop-shadow(0 0 15px rgba(6, 182, 212, 0.45)) saturate(1.1);
                }
            }
            .animate-hologram {
                animation: hologramPulse 10s linear infinite;
                transform-style: preserve-3d;
                perspective: 1000px;
            }
        </style>
    </head>
    <body class="antialiased bg-slate-50 text-slate-800 selection:bg-cyan-500 selection:text-white relative overflow-x-hidden min-h-screen">
        
        <!-- Falling Capsules Background -->
        <div class="fixed inset-0 overflow-hidden pointer-events-none z-0">
            <div class="capsule-pill" style="left: 3%; animation-delay: 0s; animation-duration: 10s;"></div>
            <div class="capsule-pill" style="left: 8%; animation-delay: -3s; animation-duration: 14s;"></div>
            <div class="capsule-pill" style="left: 12%; animation-delay: -7s; animation-duration: 12s;"></div>
            <div class="capsule-pill" style="left: 18%; animation-delay: -1s; animation-duration: 16s;"></div>
            <div class="capsule-pill" style="left: 23%; animation-delay: -5s; animation-duration: 11s;"></div>
            <div class="capsule-pill" style="left: 27%; animation-delay: -10s; animation-duration: 15s;"></div>
            <div class="capsule-pill" style="left: 32%; animation-delay: -2s; animation-duration: 13s;"></div>
            <div class="capsule-pill" style="left: 38%; animation-delay: -8s; animation-duration: 17s;"></div>
            <div class="capsule-pill" style="left: 43%; animation-delay: -4s; animation-duration: 12s;"></div>
            <div class="capsule-pill" style="left: 48%; animation-delay: -12s; animation-duration: 14s;"></div>
            <div class="capsule-pill" style="left: 53%; animation-delay: -6s; animation-duration: 16s;"></div>
            <div class="capsule-pill" style="left: 58%; animation-delay: -15s; animation-duration: 11s;"></div>
            <div class="capsule-pill" style="left: 63%; animation-delay: -2s; animation-duration: 15s;"></div>
            <div class="capsule-pill" style="left: 68%; animation-delay: -9s; animation-duration: 13s;"></div>
            <div class="capsule-pill" style="left: 73%; animation-delay: -5s; animation-duration: 17s;"></div>
            <div class="capsule-pill" style="left: 77%; animation-delay: -11s; animation-duration: 12s;"></div>
            <div class="capsule-pill" style="left: 82%; animation-delay: -3s; animation-duration: 14s;"></div>
            <div class="capsule-pill" style="left: 87%; animation-delay: -8s; animation-duration: 16s;"></div>
            <div class="capsule-pill" style="left: 92%; animation-delay: -13s; animation-duration: 11s;"></div>
            <div class="capsule-pill" style="left: 97%; animation-delay: -1s; animation-duration: 15s;"></div>
            <div class="capsule-pill" style="left: 10%; animation-delay: -11s; animation-duration: 18s;"></div>
            <div class="capsule-pill" style="left: 20%; animation-delay: -4s; animation-duration: 15s;"></div>
            <div class="capsule-pill" style="left: 35%; animation-delay: -13s; animation-duration: 19s;"></div>
            <div class="capsule-pill" style="left: 50%; animation-delay: -7s; animation-duration: 13s;"></div>
            <div class="capsule-pill" style="left: 65%; animation-delay: -14s; animation-duration: 18s;"></div>
            <div class="capsule-pill" style="left: 75%; animation-delay: -1s; animation-duration: 15s;"></div>
            <div class="capsule-pill" style="left: 80%; animation-delay: -10s; animation-duration: 14s;"></div>
            <div class="capsule-pill" style="left: 90%; animation-delay: -5s; animation-duration: 16s;"></div>
        </div>

        <div class="min-h-screen lg:grid lg:grid-cols-12">
            
            <!-- LEFT PANEL: Welcoming Smiling Doctor Illustration, Academic Badge & Features (Desktop only) -->
            <div class="lg:col-span-7 bg-gradient-to-br from-cyan-50/70 via-white to-sky-100/50 flex flex-col justify-between p-10 relative overflow-hidden hidden lg:flex border-r border-slate-200/80">
                <!-- Background decorative grid -->
                <div class="absolute inset-0 bg-grid-pattern opacity-100 z-0"></div>
                
                <!-- Floating decorations -->
                <div class="absolute top-16 left-12 animate-float-slow z-0 text-cyan-400/20">
                    <i class="fa-solid fa-plus text-6xl"></i>
                </div>
                <div class="absolute top-1/3 right-16 animate-float-medium z-0 text-teal-400/15">
                    <i class="fa-solid fa-heart-pulse text-7xl"></i>
                </div>
                <div class="absolute bottom-1/4 left-1/4 animate-float-fast z-0 text-cyan-300/30">
                    <i class="fa-solid fa-shield-halved text-5xl"></i>
                </div>
                
                <!-- Animated ECG Line -->
                <div class="absolute inset-x-0 bottom-1/3 h-32 opacity-25 pointer-events-none z-0">
                    <svg class="w-full h-full" viewBox="0 0 1000 100" preserveAspectRatio="none">
                        <path class="ecg-line" d="M 0 50 L 300 50 L 320 30 L 340 70 L 360 10 L 380 90 L 400 40 L 420 50 L 700 50 L 720 20 L 740 80 L 760 30 L 780 50 L 1000 50" fill="none" stroke="#0891b2" stroke-width="2.5" />
                    </svg>
                </div>

                <!-- 1. Header (Logo & Brand) -->
                <div class="relative z-10 flex justify-between items-center">
                    <a href="/" class="inline-flex items-center gap-3">
                        <div class="w-11 h-11 rounded-2xl bg-gradient-to-br from-cyan-500 to-teal-500 flex items-center justify-center text-white shadow-md shadow-cyan-500/25">
                            <i class="fa-solid fa-shield-heart text-xl"></i>
                        </div>
                        <div>
                            <span class="text-xl font-extrabold tracking-tight bg-gradient-to-r from-cyan-600 to-teal-600 bg-clip-text text-transparent">MedSecure</span>
                            <p class="text-[9px] text-cyan-600 font-bold uppercase tracking-wider -mt-0.5">ChaCha20 Security Platform</p>
                        </div>
                    </a>
                </div>

                <!-- 2. Middle Content (Welcoming Smiling Doctor Card) -->
                <div class="my-auto relative z-10 w-full flex flex-col items-center">
                    <!-- Dynamic Medical Graphic Box -->
                    <div class="relative w-full max-w-sm mb-8 flex justify-center">
                        <div class="absolute inset-0 bg-gradient-to-tr from-cyan-400 to-teal-400 rounded-3xl blur-2xl opacity-15 -rotate-2 scale-95"></div>
                        <div class="relative transition-all duration-500 flex justify-center w-full">
                            <img src="/images/medical_tech_heart.png" alt="Medical Technology Heart" class="w-full h-60 object-contain mix-blend-multiply animate-heart-beat" />
                        </div>
                    </div>

                    <div class="max-w-md text-center">
                        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-cyan-100 text-cyan-800 border border-cyan-200/50 text-[10px] font-bold uppercase tracking-wider mb-4 shadow-sm">
                            <i class="fa-solid fa-circle-check text-[10px] text-cyan-600"></i> Sistem EMR Bersih & Ramah
                        </div>
                        <h1 class="text-3xl font-extrabold text-slate-900 leading-tight mb-3">
                            Akses Rekam Medis Digital <br>
                            <span class="bg-gradient-to-r from-cyan-600 via-sky-600 to-teal-600 bg-clip-text text-transparent">Aman & Modern</span>
                        </h1>
                        <p class="text-slate-500 text-sm leading-relaxed mb-6">
                            Ayo sayangi dirimu dengan merawat dan mengenal dirimu.
                        </p>

                        <!-- Academic Affiliation Card -->
                        <div class="inline-flex items-center gap-3 bg-white border border-slate-200/60 px-4 py-3 rounded-2xl shadow-sm text-left">
                            <div class="w-9 h-9 rounded-xl bg-cyan-50 border border-cyan-100 flex items-center justify-center text-cyan-600 shrink-0">
                                <i class="fa-solid fa-graduation-cap text-base"></i>
                            </div>
                            <div>
                                <h4 class="text-slate-800 font-bold text-xs">Politeknik Negeri Bengkalis</h4>
                                <p class="text-[10px] text-slate-400">Jurusan Teknik Informatika & Kriptografi Medis</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 3. Stats Info (Bottom Panel) -->
                <div class="relative z-10 grid grid-cols-3 gap-4 pt-5 border-t border-slate-200/60">
                    <div class="bg-white/80 border border-slate-100 p-3 rounded-2xl shadow-xs text-center">
                        <p class="text-lg font-extrabold text-cyan-600">ChaCha20</p>
                        <p class="text-[9px] text-slate-500 font-bold uppercase tracking-wider mt-0.5">Stream Cipher</p>
                    </div>
                    <div class="bg-white/80 border border-slate-100 p-3 rounded-2xl shadow-xs text-center">
                        <p class="text-lg font-extrabold text-teal-600">100%</p>
                        <p class="text-[9px] text-slate-500 font-bold uppercase tracking-wider mt-0.5">Integritas Data</p>
                    </div>
                    <div class="bg-white/80 border border-slate-100 p-3 rounded-2xl shadow-xs text-center">
                        <p class="text-lg font-extrabold text-sky-600">24/7</p>
                        <p class="text-[9px] text-slate-500 font-bold uppercase tracking-wider mt-0.5">Proteksi Aktif</p>
                    </div>
                </div>
            </div>

            <!-- RIGHT PANEL: Auth Card Form Area -->
            <div class="col-span-12 lg:col-span-5 min-h-screen flex flex-col justify-between p-6 sm:p-10 bg-gradient-to-tr from-slate-100 via-slate-50 to-cyan-50/20 relative z-10 overflow-y-auto">
                <!-- Mobile Background Decorative Blobs -->
                <div class="absolute top-0 right-0 -translate-y-12 translate-x-12 w-64 h-64 bg-cyan-400/5 rounded-full blur-3xl pointer-events-none lg:hidden"></div>
                <div class="absolute bottom-0 left-0 translate-y-12 -translate-x-12 w-64 h-64 bg-teal-400/5 rounded-full blur-3xl pointer-events-none lg:hidden"></div>

                <!-- Floating Home Button -->
                <div class="absolute top-6 right-6 z-20">
                    <a href="/" class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white hover:bg-slate-50 border border-slate-200 hover:border-slate-300 text-slate-700 hover:text-cyan-600 text-xs font-bold shadow-sm transition-all hover:scale-105 backdrop-blur-sm">
                        <i class="fa-solid fa-arrow-left"></i>
                        Beranda
                    </a>
                </div>

                <!-- Mobile branding (Hidden on desktop) -->
                <div class="lg:hidden flex flex-col items-center mb-6 text-center mt-6">
                    <a href="/" class="inline-flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-cyan-500 to-teal-500 flex items-center justify-center text-white shadow-md shadow-cyan-500/10">
                            <i class="fa-solid fa-shield-heart text-lg"></i>
                        </div>
                        <div class="text-left">
                            <span class="text-xl font-extrabold tracking-tight text-slate-900">MedSecure</span>
                            <p class="text-[9px] text-cyan-600 font-bold uppercase tracking-wider -mt-0.5">Polbeng Medical Security</p>
                        </div>
                    </a>
                </div>

                <!-- Form Card Wrapper -->
                <div class="flex-grow flex items-center justify-center w-full py-4">
                    <div class="w-full max-w-md bg-white border border-slate-200/80 shadow-[0_20px_50px_rgba(15,23,42,0.06)] rounded-[2rem] p-8 md:p-10 relative overflow-hidden transition-all duration-300 hover:shadow-[0_20px_50px_rgba(6,182,212,0.08)] hover:border-cyan-200/50 backdrop-blur-md animate-slide-in">
                        <!-- DNA Spiral Animation Background -->
                        <div class="absolute inset-0 opacity-[0.18] pointer-events-none z-0 overflow-hidden py-12 px-6">
                            <div class="w-full h-full relative" style="perspective: 1000px;">
                                <div class="dna-rung text-cyan-600" style="--y: 5%; --delay: 0s;">
                                    <div class="dna-node"></div>
                                    <div class="dna-line"></div>
                                    <div class="dna-node"></div>
                                </div>
                                <div class="dna-rung text-teal-600" style="--y: 15%; --delay: -0.4s;">
                                    <div class="dna-node"></div>
                                    <div class="dna-line"></div>
                                    <div class="dna-node"></div>
                                </div>
                                <div class="dna-rung text-cyan-600" style="--y: 25%; --delay: -0.8s;">
                                    <div class="dna-node"></div>
                                    <div class="dna-line"></div>
                                    <div class="dna-node"></div>
                                </div>
                                <div class="dna-rung text-teal-600" style="--y: 35%; --delay: -1.2s;">
                                    <div class="dna-node"></div>
                                    <div class="dna-line"></div>
                                    <div class="dna-node"></div>
                                </div>
                                <div class="dna-rung text-cyan-600" style="--y: 45%; --delay: -1.6s;">
                                    <div class="dna-node"></div>
                                    <div class="dna-line"></div>
                                    <div class="dna-node"></div>
                                </div>
                                <div class="dna-rung text-teal-600" style="--y: 55%; --delay: -2.0s;">
                                    <div class="dna-node"></div>
                                    <div class="dna-line"></div>
                                    <div class="dna-node"></div>
                                </div>
                                <div class="dna-rung text-cyan-600" style="--y: 65%; --delay: -2.4s;">
                                    <div class="dna-node"></div>
                                    <div class="dna-line"></div>
                                    <div class="dna-node"></div>
                                </div>
                                <div class="dna-rung text-teal-600" style="--y: 75%; --delay: -2.8s;">
                                    <div class="dna-node"></div>
                                    <div class="dna-line"></div>
                                    <div class="dna-node"></div>
                                </div>
                                <div class="dna-rung text-cyan-600" style="--y: 85%; --delay: -3.2s;">
                                    <div class="dna-node"></div>
                                    <div class="dna-line"></div>
                                    <div class="dna-node"></div>
                                </div>
                                <div class="dna-rung text-teal-600" style="--y: 95%; --delay: -3.6s;">
                                    <div class="dna-node"></div>
                                    <div class="dna-line"></div>
                                    <div class="dna-node"></div>
                                </div>
                            </div>
                        </div>
                        <!-- Decorative background glow inside card -->
                        <div class="absolute -top-12 -right-12 w-32 h-32 bg-cyan-100 rounded-full blur-2xl opacity-40 pointer-events-none"></div>
                        
                        <div class="relative z-10">
                            {{ $slot }}
                        </div>
                    </div>
                </div>

                <!-- Footer (Right Panel) -->
                <div class="text-center py-4 border-t border-slate-200/60 mt-4 w-full relative z-10">
                    <div class="inline-flex items-center gap-2 bg-emerald-50 text-emerald-700 px-3 py-1.5 rounded-full border border-emerald-200/50 text-[10px] font-bold uppercase tracking-wide mb-3 shadow-inner">
                        <span class="relative flex h-1.5 w-1.5">
                          <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                          <span class="relative inline-flex rounded-full h-1.5 w-1.5 bg-emerald-500"></span>
                        </span>
                        ChaCha20-Poly1305 Secure
                    </div>
                    <p class="text-[10px] text-slate-400 font-medium">&copy; {{ date('Y') }} MedSecure.</p>
                    <p class="text-[9px] text-slate-400/80 mt-0.5">Platform Rekam Medis Bersih & Terenkripsi &middot; Politeknik Negeri Bengkalis</p>
                </div>

            </div>

        </div>
    </body>
</html>
