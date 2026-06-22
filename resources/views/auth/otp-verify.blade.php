<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600 text-center">
        Masukkan kode <strong>6 digit</strong> yang telah dikirim ke email kamu.
    </div>

    @if (session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-700 rounded text-sm text-center">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('otp.verify.submit') }}">
        @csrf

        <div>
            <x-input-label for="otp" value="Kode OTP" />
            <x-text-input
                id="otp"
                name="otp"
                type="text"
                maxlength="6"
                inputmode="numeric"
                pattern="[0-9]{6}"
                class="mt-1 block w-full tracking-[0.5em] text-center text-2xl font-bold"
                placeholder="------"
                autofocus
                required
            />
            <x-input-error :messages="$errors->get('otp')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-primary-button class="w-full justify-center">
                Verifikasi OTP
            </x-primary-button>
        </div>
    </form>

    <form method="POST" action="{{ route('otp.resend') }}" class="mt-4 text-center">
        @csrf
        <button type="submit" class="text-sm text-indigo-600 hover:text-indigo-800 hover:underline">
            Belum terima kode? Kirim Ulang
        </button>
    </form>
</x-guest-layout>