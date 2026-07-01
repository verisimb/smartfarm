<x-app-layout>
    <x-slot name="header">
        Profil Saya
    </x-slot>

    <div class="space-y-6 animate-fade-in-up">
        <!-- Header Section -->
        <div>
            <h2 class="font-outfit text-2xl font-bold text-slate-900">Pengaturan Profil</h2>
            <p class="text-sm text-slate-500">Kelola informasi profil, kata sandi, dan keamanan akun Anda.</p>
        </div>

        <div class="rounded-3xl border border-slate-200 bg-white p-6 sm:p-8">
            <div class="max-w-xl">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        <div class="rounded-3xl border border-slate-200 bg-white p-6 sm:p-8">
            <div class="max-w-xl">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        <div class="rounded-3xl border border-slate-200 bg-white p-6 sm:p-8">
            <div class="max-w-xl">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>

    <!-- User Deletion Confirmation Modal -->
    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6 sm:p-8">
            @csrf
            @method('delete')

            <h2 class="text-lg font-bold font-outfit text-slate-900">
                Apakah Anda yakin ingin menghapus akun Anda?
            </h2>

            <p class="mt-2 text-sm text-slate-500">
                Setelah akun Anda dihapus, semua data dan riwayat prediksi lahan Anda akan dihapus secara permanen. Silakan masukkan kata sandi Anda untuk mengonfirmasi bahwa Anda ingin menghapus akun secara permanen.
            </p>

            <div class="mt-6">
                <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-full"
                    placeholder="Kata Sandi Anda"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end gap-3">
                <button type="button" x-on:click="$dispatch('close-modal', 'confirm-user-deletion')" class="px-5 py-2.5 rounded-full border border-slate-200 hover:bg-slate-50 text-sm font-bold text-slate-500 transition-all">
                    Batal
                </button>

                <button type="submit" class="px-5 py-2.5 rounded-full bg-red-600 hover:bg-red-700 text-sm font-bold text-white transition-all">
                    Hapus Akun Permanen
                </button>
            </div>
        </form>
    </x-modal>
</x-app-layout>
