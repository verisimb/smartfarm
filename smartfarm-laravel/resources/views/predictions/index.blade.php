<x-app-layout>
    <x-slot name="header">
        Riwayat Analisis Lahan
    </x-slot>

    <div class="space-y-6 animate-fade-in-up">
        <!-- Header & Action section -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h2 class="font-outfit text-2xl font-bold text-slate-900">Data Historis Lahan</h2>
                <p class="text-sm text-slate-500">Kelola dan pantau seluruh hasil prediksi yang pernah Anda buat.</p>
            </div>
            <a href="{{ route('predictions.create') }}" class="inline-flex items-center justify-center gap-2 rounded-full bg-emerald-600 px-6 py-2.5 text-sm font-bold text-white transition-all hover:bg-emerald-700 active:scale-[0.98]">
                <i class="hgi-stroke hgi-plus-01"></i>
                Analisis Baru
            </a>
        </div>

        @if(session('success'))
            <div class="rounded-2xl bg-emerald-50 p-4 border border-emerald-100 flex items-center gap-3 animate-in fade-in slide-in-from-top-4 duration-500">
                <i class="hgi-stroke hgi-checkmark-circle-01 text-emerald-600 text-xl"></i>
                <p class="text-sm text-emerald-700 font-medium">{{ session('success') }}</p>
            </div>
        @endif

        <!-- Table Container -->
        <div class="rounded-3xl border border-slate-200 bg-white overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-slate-50/50 border-b border-slate-100">
                        <tr>
                            <th class="px-6 py-4 text-[10px] font-bold uppercase tracking-widest text-slate-400">No.</th>
                            <th class="px-6 py-4 text-[10px] font-bold uppercase tracking-widest text-slate-400">Tgl & Waktu</th>
                            <th class="px-6 py-4 text-[10px] font-bold uppercase tracking-widest text-slate-400">Nutrisi (NPK)</th>
                            <th class="px-6 py-4 text-[10px] font-bold uppercase tracking-widest text-slate-400">Rekomendasi</th>
                            <th class="px-6 py-4 text-[10px] font-bold uppercase tracking-widest text-slate-400">Tipe Lahan</th>
                            <th class="px-6 py-4 text-[10px] font-bold uppercase tracking-widest text-slate-400 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($predictions as $index => $prediction)
                            <tr class="group hover:bg-slate-50/50 transition-colors">
                                <td class="px-6 py-5">
                                    <span class="text-xs font-bold text-slate-400">{{ $index + 1 }}</span>
                                </td>
                                <td class="px-6 py-5">
                                    <p class="text-sm font-bold text-slate-700">{{ $prediction->created_at->format('d M Y') }}</p>
                                    <p class="text-[10px] text-slate-400 font-medium">{{ $prediction->created_at->format('H:i') }} WIB</p>
                                </td>
                                <td class="px-6 py-5">
                                    <div class="flex items-center gap-2">
                                        <div class="flex flex-col items-center">
                                            <span class="text-[9px] font-bold text-slate-400 uppercase tracking-tighter">N</span>
                                            <span class="text-xs font-black text-slate-700">{{ $prediction->N }}</span>
                                        </div>
                                        <div class="h-6 w-px bg-slate-200 mx-1"></div>
                                        <div class="flex flex-col items-center">
                                            <span class="text-[9px] font-bold text-slate-400 uppercase tracking-tighter">P</span>
                                            <span class="text-xs font-black text-slate-700">{{ $prediction->P }}</span>
                                        </div>
                                        <div class="h-6 w-px bg-slate-200 mx-1"></div>
                                        <div class="flex flex-col items-center">
                                            <span class="text-[9px] font-bold text-slate-400 uppercase tracking-tighter">K</span>
                                            <span class="text-xs font-black text-slate-700">{{ $prediction->K }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-5">
                                    <div class="inline-flex items-center gap-2 rounded-full bg-emerald-50 px-3 py-1 text-xs font-bold text-emerald-700 border border-emerald-100/50">
                                        <i class="hgi-stroke hgi-leaf-01"></i>
                                        {{ $prediction->recommended_crop }}
                                    </div>
                                </td>
                                <td class="px-6 py-5">
                                    <span class="text-xs font-semibold text-slate-600">{{ str_contains($prediction->land_type, ' / ') ? str_replace(' / ', ' (', $prediction->land_type) . ')' : $prediction->land_type }}</span>
                                </td>
                                <td class="px-6 py-5">
                                    <div class="flex items-center justify-center gap-2">
                                        <!-- Detail Button -->
                                        <a href="{{ route('predictions.show', $prediction->id) }}" class="flex h-9 w-9 items-center justify-center rounded-xl bg-white border border-slate-200 text-slate-500 transition-all hover:bg-emerald-50 hover:text-emerald-600 hover:border-emerald-200 group/btn" title="Detail">
                                            <i class="hgi-stroke hgi-view text-lg"></i>
                                        </a>
                                        <!-- Edit Button -->
                                        <a href="{{ route('predictions.edit', $prediction->id) }}" class="flex h-9 w-9 items-center justify-center rounded-xl bg-white border border-slate-200 text-slate-500 transition-all hover:bg-amber-50 hover:text-amber-600 hover:border-amber-200" title="Edit">
                                            <i class="hgi-stroke hgi-pencil-edit-01 text-lg"></i>
                                        </a>
                                        <!-- Delete Button -->
                                        <button type="button" x-data="" x-on:click.prevent="$dispatch('open-delete-modal', { action: '{{ route('predictions.destroy', $prediction->id) }}' })" class="flex h-9 w-9 items-center justify-center rounded-xl bg-white border border-slate-200 text-slate-500 transition-all hover:bg-red-50 hover:text-red-600 hover:border-red-200" title="Hapus">
                                            <i class="hgi-stroke hgi-delete-02 text-lg"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-20 text-center">
                                    <div class="flex flex-col items-center">
                                        <div class="flex h-20 w-20 items-center justify-center rounded-full bg-slate-50 text-slate-200 mb-4">
                                            <i class="hgi-stroke hgi-note-01 text-5xl"></i>
                                        </div>
                                        <h3 class="font-outfit text-lg font-bold text-slate-900">Belum Ada Data Riwayat</h3>
                                        <p class="mt-1 text-sm text-slate-400 max-w-xs">Saat ini Anda belum melakukan prediksi apa pun. Mulai analisis pertama Anda sekarang!</p>
                                        <a href="{{ route('predictions.create') }}" class="mt-6 inline-flex items-center gap-2 rounded-full bg-emerald-600 px-6 py-2.5 text-sm font-bold text-white transition-all hover:bg-emerald-700 active:scale-[0.98]">
                                            Analisis Pertama
                                            <i class="hgi-stroke hgi-analytics-01"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        
        @if($predictions->isNotEmpty())
            <p class="text-center text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-4">Akhir dari Riwayat Lahan</p>
        @endif
    </div>

    <!-- Delete Confirmation Modal -->
    <x-modal name="confirm-delete" focusable>
        <div class="p-6" x-data="{ actionUrl: '' }" x-on:open-delete-modal.window="actionUrl = $event.detail.action; $dispatch('open-modal', 'confirm-delete')">
            <h2 class="text-lg font-bold font-outfit text-slate-900">
                Konfirmasi Hapus Data
            </h2>
            <p class="mt-2 text-sm text-slate-500">
                Apakah Anda yakin ingin menghapus data riwayat analisis lahan ini? Skenario/laporan prediksi ini akan dihapus permanen dan tidak dapat dipulihkan kembali.
            </p>
            <div class="mt-6 flex justify-end gap-3">
                <button type="button" x-on:click="$dispatch('close-modal', 'confirm-delete')" class="px-5 py-2.5 rounded-full border border-slate-200 hover:bg-slate-50 text-sm font-bold text-slate-500 transition-all">
                    Batal
                </button>
                <form :action="actionUrl" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-5 py-2.5 rounded-full bg-red-600 hover:bg-red-700 text-sm font-bold text-white transition-all">
                        Hapus Data
                    </button>
                </form>
            </div>
        </div>
    </x-modal>
</x-app-layout>
