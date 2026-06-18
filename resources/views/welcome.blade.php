<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>SecureEMR - ChaCha20 Encrypted</title>
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            body { font-family: 'Outfit', sans-serif; }
            .glass-panel {
                background: rgba(255, 255, 255, 0.7);
                backdrop-filter: blur(12px);
                -webkit-backdrop-filter: blur(12px);
                border: 1px solid rgba(255, 255, 255, 0.4);
            }
            .animate-float {
                animation: float 6s ease-in-out infinite;
            }
            .animate-float-delayed {
                animation: float 6s ease-in-out 3s infinite;
            }
            @keyframes float {
                0% { transform: translateY(0px); }
                50% { transform: translateY(-15px); }
                100% { transform: translateY(0px); }
            }
        </style>
    </head>
    <body class="antialiased bg-slate-50 text-slate-800 selection:bg-blue-500 selection:text-white">
        
        <!-- Navigation -->
        <nav class="absolute w-full z-50 top-0 py-6 px-6 lg:px-12 flex justify-between items-center">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-blue-600 to-indigo-500 flex items-center justify-center text-white font-bold text-xl shadow-lg shadow-blue-500/30">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" /></svg>
                </div>
                <span class="text-xl font-bold tracking-tight text-slate-900">SecureEMR</span>
            </div>
            <div>
                @if (Route::has('login'))
                    <div class="flex items-center gap-4">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="text-sm font-semibold text-blue-600 hover:text-blue-800 transition-colors">Dashboard &rarr;</a>
                        @else
                            <a href="{{ route('login') }}" class="text-sm font-medium text-slate-600 hover:text-slate-900 transition-colors">Sign In</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="text-sm font-semibold text-white bg-slate-900 hover:bg-slate-800 px-6 py-2.5 rounded-full shadow-md transition-all hover:shadow-lg hover:-translate-y-0.5">Register</a>
                            @endif
                        @endauth
                    </div>
                @endif
            </div>
        </nav>

        <!-- Hero Section -->
        <div class="relative min-h-screen flex items-center pt-20 overflow-hidden">
            <!-- Background Decorations -->
            <div class="absolute top-0 right-0 -translate-y-12 translate-x-1/3">
                <div class="w-[700px] h-[700px] rounded-full bg-gradient-to-bl from-blue-400/30 to-indigo-300/30 blur-3xl"></div>
            </div>
            <div class="absolute bottom-0 left-0 translate-y-1/3 -translate-x-1/3">
                <div class="w-[600px] h-[600px] rounded-full bg-gradient-to-tr from-cyan-300/30 to-blue-200/30 blur-3xl"></div>
            </div>

            <div class="max-w-7xl mx-auto px-6 lg:px-12 relative z-10 w-full">
                <div class="grid lg:grid-cols-2 gap-12 items-center">
                    <!-- Text Content -->
                    <div class="max-w-2xl">
                        <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-white/80 text-blue-700 text-sm font-semibold mb-6 shadow-sm border border-slate-200/50 backdrop-blur-md">
                            <span class="flex h-2 w-2 relative">
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-500 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-2 w-2 bg-blue-600"></span>
                            </span>
                            ChaCha20 Powered Security
                        </div>
                        <h1 class="text-5xl lg:text-7xl font-extrabold tracking-tight text-slate-900 leading-[1.1] mb-6">
                            Next-Gen <br>
                            <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-indigo-500">Medical Records</span>
                        </h1>
                        <p class="text-lg text-slate-600 mb-8 leading-relaxed max-w-lg font-light">
                            Experience the future of healthcare management. Military-grade encryption meets intuitive design, ensuring your patient data is both accessible and impenetrably secure.
                        </p>
                        <div class="flex flex-col sm:flex-row gap-4">
                            <a href="{{ route('login') }}" class="inline-flex justify-center items-center gap-2 px-8 py-4 text-base font-semibold text-white bg-blue-600 rounded-full hover:bg-blue-700 transition-all shadow-lg shadow-blue-500/30 hover:shadow-xl hover:-translate-y-1">
                                Enter Secure Portal
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" /></svg>
                            </a>
                        </div>
                    </div>

                    <!-- Visual/Image -->
                    <div class="relative lg:h-[600px] flex items-center justify-center">
                        <div class="absolute inset-0 bg-gradient-to-tr from-blue-500 to-indigo-400 rounded-[2rem] transform rotate-6 scale-105 opacity-10 blur-xl"></div>
                        
                        <div class="relative glass-panel rounded-[2rem] p-8 shadow-2xl w-full max-w-md animate-float z-20">
                            <!-- Mock UI Component -->
                            <div class="flex items-center justify-between mb-8 pb-6 border-b border-slate-200/50">
                                <div class="flex items-center gap-3">
                                    <div class="w-12 h-12 rounded-full bg-slate-200 overflow-hidden shadow-inner">
                                        <img src="https://ui-avatars.com/api/?name=Dr+Sarah&background=0D8ABC&color=fff&rounded=true" alt="Doctor" class="w-full h-full object-cover">
                                    </div>
                                    <div>
                                        <h3 class="font-bold text-slate-900 text-lg leading-tight">Dr. Sarah Jenkins</h3>
                                        <p class="text-sm text-slate-500">Cardiologist</p>
                                    </div>
                                </div>
                                <div class="px-3 py-1 bg-green-100/80 text-green-700 rounded-full text-xs font-bold shadow-sm">Verified</div>
                            </div>
                            
                            <div class="space-y-4">
                                <div class="flex justify-between items-center mb-2">
                                    <h4 class="text-xs font-bold text-slate-400 uppercase tracking-wider">Recent Activity</h4>
                                </div>
                                <div class="h-16 bg-white/50 rounded-xl w-full border border-white p-3 flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 shrink-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" /></svg>
                                    </div>
                                    <div>
                                        <div class="h-3 bg-slate-200 rounded-full w-24 mb-2"></div>
                                        <div class="h-2 bg-slate-100 rounded-full w-16"></div>
                                    </div>
                                </div>
                                
                                <div class="mt-6 p-5 rounded-2xl bg-gradient-to-br from-slate-900 to-slate-800 text-white shadow-xl relative overflow-hidden">
                                    <div class="absolute top-0 right-0 -translate-y-4 translate-x-4 w-24 h-24 bg-blue-500/20 rounded-full blur-xl"></div>
                                    <div class="flex items-center gap-4 relative z-10">
                                        <div class="w-12 h-12 rounded-full bg-white/10 flex items-center justify-center backdrop-blur-md border border-white/10">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6 text-blue-400"><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" /></svg>
                                        </div>
                                        <div>
                                            <h4 class="text-sm font-bold text-white tracking-wide">Data Encrypted</h4>
                                            <p class="text-xs text-slate-300 font-light mt-0.5">ChaCha20 stream cipher</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Floating Badge -->
                        <div class="absolute -right-6 top-1/4 glass-panel px-6 py-4 rounded-2xl shadow-xl animate-float-delayed z-30 flex items-center gap-3 border-l-4 border-l-green-500">
                            <div class="w-8 h-8 rounded-full bg-green-100 text-green-600 flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" /></svg>
                            </div>
                            <div>
                                <p class="text-xs text-slate-500 font-medium">Status</p>
                                <p class="text-sm font-bold text-slate-900">100% Secured</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
