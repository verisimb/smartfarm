<x-guest-layout>
    <div class="mb-6">
        <h2 class="font-outfit text-2xl font-bold text-slate-900">Verifikasi Email Anda</h2>
        <p class="text-sm text-slate-500 mt-1">
            Terima kasih telah mendaftar! Sebelum memulai, silakan verifikasi alamat email Anda dengan mengklik tautan yang baru saja kami kirimkan. Jika Anda tidak menerimanya, kami akan dengan senang hati mengirimkan ulang.
        </p>
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-bold text-sm text-emerald-600 bg-emerald-50 border border-emerald-200/50 px-4 py-2.5 rounded-2xl">
            Tautan verifikasi baru telah dikirim ke alamat email yang Anda daftarkan.
        </div>
    @endif

    <div class="mt-6 flex flex-col sm:flex-row items-center justify-between gap-4">
        <form method="POST" action="{{ route('verification.send') }}" class="w-full sm:w-auto">
            @csrf
            <x-primary-button class="w-full">
                {{ __('Kirim Ulang Email Verifikasi') }}
            </x-primary-button>
        </form>

        <form method="POST" action="{{ route('logout') }}" class="w-full sm:w-auto text-center">
            @csrf
            <button type="submit" class="text-xs font-semibold text-slate-400 hover:text-slate-600 transition-colors uppercase tracking-widest cursor-pointer">
                {{ __('Keluar Akun') }}
            </button>
        </form>
    </div>
</x-guest-layout>
