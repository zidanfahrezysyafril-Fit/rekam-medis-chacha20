<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'SecureEMR') }} - Access</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            body { font-family: 'Outfit', sans-serif; }
            .glass-panel {
                background: rgba(255, 255, 255, 0.85);
                backdrop-filter: blur(16px);
                -webkit-backdrop-filter: blur(16px);
                border: 1px solid rgba(255, 255, 255, 0.4);
            }
        </style>
    </head>
    <body class="antialiased bg-slate-50 text-slate-800 selection:bg-blue-500 selection:text-white relative overflow-x-hidden">
        
        <!-- Background Decorations -->
        <div class="fixed top-0 right-0 -translate-y-12 translate-x-1/3 z-0 pointer-events-none">
            <div class="w-[800px] h-[800px] rounded-full bg-gradient-to-bl from-blue-300/40 to-indigo-200/40 blur-3xl"></div>
        </div>
        <div class="fixed bottom-0 left-0 translate-y-1/3 -translate-x-1/3 z-0 pointer-events-none">
            <div class="w-[600px] h-[600px] rounded-full bg-gradient-to-tr from-cyan-200/40 to-blue-200/40 blur-3xl"></div>
        </div>

        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 relative z-10 p-4">
            <div class="mb-8 text-center">
                <a href="/" class="inline-flex items-center gap-3">
                    <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-blue-600 to-indigo-500 flex items-center justify-center text-white font-bold text-2xl shadow-lg shadow-blue-500/30">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-7 h-7"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" /></svg>
                    </div>
                    <span class="text-2xl font-extrabold tracking-tight text-slate-900">SecureEMR</span>
                </a>
                <p class="mt-3 text-slate-500 text-sm font-medium">ChaCha20 Encrypted Health Portal</p>
            </div>

            <div class="w-full sm:max-w-md px-8 py-10 glass-panel shadow-2xl shadow-blue-900/5 sm:rounded-[2rem]">
                {{ $slot }}
            </div>
            
            <div class="mt-8 text-center text-xs text-slate-400 font-medium">
                &copy; {{ date('Y') }} SecureEMR System. All data is end-to-end encrypted.
            </div>
        </div>
    </body>
</html>
