<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="text-center mb-8">
        <h2 class="text-3xl font-bold text-slate-800">Selamat Datang Kembali</h2>
        <p class="text-sm text-slate-500 mt-2">Masuk untuk mengakses dasbor terenkripsi aman Anda.</p>
    </div>

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-sm font-semibold text-slate-700 mb-1">Alamat Email</label>
            <input id="email" class="block w-full rounded-xl border-slate-200 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 transition-colors bg-white/50 backdrop-blur-sm px-4 py-3" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="Masukkan email Anda" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-sm font-semibold text-slate-700 mb-1">Kata Sandi</label>
            <input id="password" class="block w-full rounded-xl border-slate-200 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 transition-colors bg-white/50 backdrop-blur-sm px-4 py-3"
                            type="password"
                            name="password"
                            required autocomplete="current-password" placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me & Forgot Password -->
        <div class="flex items-center justify-between pt-2">
            <label for="remember_me" class="inline-flex items-center group cursor-pointer">
                <input id="remember_me" type="checkbox" class="rounded border-slate-300 text-blue-600 shadow-sm focus:ring-blue-500 transition-colors cursor-pointer" name="remember">
                <span class="ms-2 text-sm text-slate-600 group-hover:text-slate-800 transition-colors">{{ __('Remember me') }}</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-sm font-semibold text-blue-600 hover:text-blue-800 transition-colors" href="{{ route('password.request') }}">
                    {{ __('Lupa kata sandi?') }}
                </a>
            @endif
        </div>

        <div class="pt-4">
            <button type="submit" class="w-full flex justify-center py-3.5 px-4 border border-transparent rounded-xl shadow-md shadow-blue-500/20 text-sm font-bold text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all hover:shadow-lg hover:-translate-y-0.5">
                {{ __('Masuk Secara Aman') }}
            </button>
        </div>
        
        @if (Route::has('register'))
            <div class="text-center mt-6">
                <p class="text-sm text-slate-500">Belum punya akun? <a href="{{ route('register') }}" class="font-bold text-blue-600 hover:text-blue-800 transition-colors">Daftar di sini</a></p>
            </div>
        @endif
    </form>
</x-guest-layout>
