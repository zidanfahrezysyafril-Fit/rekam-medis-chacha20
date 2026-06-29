<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'MedSecure') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <!-- Icons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <style>
            body { font-family: 'Outfit', sans-serif; }
            .sidebar-gradient {
                background: linear-gradient(180deg, #0f172a 0%, #1e293b 100%);
            }
            .glass-header {
                background: rgba(255, 255, 255, 0.85);
                backdrop-filter: blur(8px);
                -webkit-backdrop-filter: blur(8px);
                border-bottom: 1px solid rgba(226, 232, 240, 0.8);
            }
            .glass-card {
                background: rgba(255, 255, 255, 0.9);
                backdrop-filter: blur(10px);
                border: 1px solid rgba(226, 232, 240, 0.8);
                box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
                transition: all 0.3s ease;
            }
            .glass-card:hover {
                box-shadow: 0 10px 15px -3px rgba(14, 165, 233, 0.1), 0 4px 6px -2px rgba(14, 165, 233, 0.05);
                transform: translateY(-2px);
                border-color: rgba(14, 165, 233, 0.2);
            }

            /* DNA Sidebar Animation */
            .dna-mini-rung {
                display: flex;
                align-items: center;
                justify-content: space-between;
                width: 32px;
                height: 8px;
                transform-style: preserve-3d;
                animation: dnaMiniRotate 4s linear infinite;
                animation-delay: var(--delay);
                position: absolute;
                top: var(--y);
                left: calc(50% - 16px);
            }
            .dna-mini-node {
                width: 6px;
                height: 6px;
                border-radius: 50%;
                background-color: currentColor;
                box-shadow: 0 0 6px currentColor;
            }
            .dna-mini-line {
                flex-grow: 1;
                height: 1px;
                margin: 0 2px;
                background-image: repeating-linear-gradient(90deg, transparent, transparent 1px, currentColor 1px, currentColor 2px);
            }
            @keyframes dnaMiniRotate {
                0% { transform: rotateY(0deg); }
                100% { transform: rotateY(360deg); }
            }
        </style>
    </head>
    <body class="antialiased bg-slate-50 text-slate-800 flex h-[100dvh] overflow-hidden selection:bg-blue-500 selection:text-white">

        <!-- Sidebar -->
        <aside class="w-72 sidebar-gradient text-slate-300 flex flex-col hidden md:flex shadow-2xl z-20 relative">
            <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-5 pointer-events-none"></div>
            
            <div class="h-20 flex items-center px-8 border-b border-slate-700/50 relative z-10">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-blue-500 to-cyan-400 flex items-center justify-center text-white shadow-lg shadow-blue-500/20">
                        @if(Auth::user()->role === 'admin')
                            <i class="fa-solid fa-shield-heart text-sm"></i>
                        @elseif(Auth::user()->role === 'doctor')
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                              <path stroke-linecap="round" stroke-linejoin="round" d="M9 7c0-2-1-3-3-3M15 7c0-2 1-3 3-3" />
                              <path stroke-linecap="round" stroke-linejoin="round" d="M12 18v3m0 0a1 1 0 100-2 1 1 0 000 2z" />
                            </svg>
                        @elseif(Auth::user()->role === 'patient')
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 14c1 1.5 3 2.5 4.5 1M21 14c-1 1.5-3 2.5-4.5 1" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 7v6M9 10h6" stroke-width="2.5" />
                            </svg>
                        @endif
                    </div>
                    <span class="font-bold text-xl tracking-tight text-white">MedSecure</span>
                </div>
            </div>
            
            <div class="flex-1 overflow-y-auto py-6 px-4 relative z-10 custom-scrollbar flex flex-col justify-between">
                <div>
                    <div class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-4 px-4">Menu</div>
                    <nav class="space-y-1.5">
                        @include('layouts.sidebar-links')
                    </nav>
                </div>

                <!-- Status Card with Animated DNA -->
                <div class="mt-8 mx-2 p-4 rounded-2xl bg-slate-800/40 border border-slate-700/30 relative overflow-hidden">
                    <div class="absolute -right-8 -bottom-8 w-24 h-24 bg-cyan-500/10 rounded-full blur-xl pointer-events-none"></div>
                    <div class="flex items-center gap-4 relative z-10">
                        <!-- Mini Rotating DNA Helix -->
                        <div class="w-8 h-14 flex flex-col justify-between items-center relative shrink-0" style="perspective: 1000px;">
                            <div class="dna-mini-rung text-cyan-400" style="--y: 0%; --delay: 0s;">
                                <div class="dna-mini-node"></div>
                                <div class="dna-mini-line"></div>
                                <div class="dna-mini-node"></div>
                            </div>
                            <div class="dna-mini-rung text-teal-400" style="--y: 25%; --delay: -0.5s;">
                                <div class="dna-mini-node"></div>
                                <div class="dna-mini-line"></div>
                                <div class="dna-mini-node"></div>
                            </div>
                            <div class="dna-mini-rung text-cyan-400" style="--y: 50%; --delay: -1.0s;">
                                <div class="dna-mini-node"></div>
                                <div class="dna-mini-line"></div>
                                <div class="dna-mini-node"></div>
                            </div>
                            <div class="dna-mini-rung text-teal-400" style="--y: 75%; --delay: -1.5s;">
                                <div class="dna-mini-node"></div>
                                <div class="dna-mini-line"></div>
                                <div class="dna-mini-node"></div>
                            </div>
                            <div class="dna-mini-rung text-cyan-400" style="--y: 100%; --delay: -2.0s;">
                                <div class="dna-mini-node"></div>
                                <div class="dna-mini-line"></div>
                                <div class="dna-mini-node"></div>
                            </div>
                        </div>
                        <div>
                            <div class="text-[9px] font-bold uppercase tracking-wider text-slate-500">Security Engine</div>
                            <div class="text-xs font-bold text-slate-300 mt-0.5">ChaCha20 Active</div>
                            <div class="text-[9px] text-cyan-400 font-semibold mt-0.5 flex items-center gap-1">
                                <span class="w-1 h-1 rounded-full bg-cyan-400 inline-block animate-ping"></span>
                                Encrypted Connection
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="p-6 border-t border-slate-700/50 bg-slate-900/50 relative z-10">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-slate-700 flex items-center justify-center border border-slate-600 shrink-0">
                        <span class="text-white font-medium text-sm">{{ substr(Auth::user()->name, 0, 1) }}</span>
                    </div>
                    <div class="overflow-hidden">
                        <div class="truncate font-medium text-white text-sm">{{ Auth::user()->name }}</div>
                        <div class="text-blue-400 text-xs font-semibold tracking-wide uppercase mt-0.5 flex items-center gap-1">
                            <span class="w-1.5 h-1.5 rounded-full bg-green-500 inline-block animate-pulse"></span>
                            {{ Auth::user()->role }}
                        </div>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col min-h-0 overflow-hidden relative">
            <!-- Decorative background blob -->
            <div class="absolute top-0 right-0 -translate-y-1/2 translate-x-1/3 w-[500px] h-[500px] bg-blue-100 rounded-full blur-3xl opacity-50 pointer-events-none"></div>

            <!-- Topbar -->
            <header class="h-14 shrink-0 glass-header flex items-center justify-between px-6 lg:px-8 z-10 sticky top-0 border-b border-slate-200/70 shadow-sm">
                <div class="flex items-center">
                    <!-- Mobile Menu Button -->
                    <button class="md:hidden text-slate-500 hover:text-slate-800 focus:outline-none transition-colors">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                    @isset($header)
                        <h2 class="text-lg lg:text-xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-slate-700 to-slate-900 tracking-tight ml-4 md:ml-0">
                            {{ $header }}
                        </h2>
                    @endisset
                </div>
                
                <div class="flex items-center gap-4">
                    <div class="hidden sm:flex items-center text-[11px] font-bold text-slate-500 bg-white px-3 py-1 rounded-full border border-slate-200 shadow-sm">
                        <i class="fa-solid fa-calendar-day text-blue-500 mr-2"></i>
                        {{ now()->format('d M Y') }}
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="flex items-center gap-1.5 text-[11px] text-slate-600 hover:text-red-600 font-bold transition-all bg-white hover:bg-red-50 border border-slate-200 hover:border-red-200 px-3 py-1 rounded-full shadow-sm hover:shadow-md">
                            <i class="fa-solid fa-power-off"></i>
                            Keluar
                        </button>
                    </form>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 min-h-0 overflow-x-hidden overflow-y-auto z-10 flex flex-col">
                <div class="w-full max-w-7xl mx-auto px-6 py-2 flex-grow shrink-0">
                    {{ $slot }}
                </div>

            </main>
        </div>
    </body>
</html>
