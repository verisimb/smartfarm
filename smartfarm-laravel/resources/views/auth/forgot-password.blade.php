<x-guest-layout>
    <div class="mb-6">
        <h2 class="font-outfit text-2xl font-bold text-slate-900">Lupa Kata Sandi</h2>
        <p class="text-sm text-slate-500 mt-1">
            Masukkan alamat email yang terdaftar. Kami akan mengirimkan tautan untuk mengatur ulang kata sandi Anda.
        </p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus placeholder="nama@email.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Submit Button -->
        <div class="pt-2">
            <x-primary-button class="w-full">
                {{ __('Kirim Tautan Atur Ulang') }}
            </x-primary-button>
        </div>

        <!-- Back to Login Link -->
        <div class="text-center pt-4 border-t border-slate-100">
            <p class="text-xs text-slate-500">
                Kembali ke 
                <a href="{{ route('login') }}" class="font-bold text-emerald-600 hover:text-emerald-700 transition-colors">
                    Halaman Masuk
                </a>
            </p>
        </div>
    </form>
</x-guest-layout>
