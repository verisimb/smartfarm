<section class="space-y-6">
    <header>
        <h2 class="text-lg font-bold font-outfit text-slate-900">
            Hapus Akun
        </h2>

        <p class="mt-2 text-sm text-slate-500">
            Setelah akun Anda dihapus, semua data dan riwayat prediksi lahan Anda akan dihapus secara permanen. Silakan unduh data penting apa pun yang ingin Anda simpan sebelum menghapus akun.
        </p>
    </header>

    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
    >Hapus Akun Saya</x-danger-button>
</section>
