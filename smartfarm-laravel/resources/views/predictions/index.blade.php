<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-full bg-emerald-100 flex items-center justify-center">
                    <i class="hgi-stroke hgi-database-01 text-emerald-700 text-lg"></i>
                </div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Riwayat Prediksi Lahan</h2>
            </div>
            <a href="{{ route('predictions.create') }}"
               id="btn-new-prediction"
               class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white px-6 py-2.5 text-sm font-semibold rounded-full transition-all duration-200 hover:shadow-lg hover:-translate-y-0.5">
                <i class="hgi-stroke hgi-leaf-01"></i>
                Prediksi Baru
            </a>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Flash Messages --}}
            @if(session('success'))
                <div id="flash-success" class="mb-6 flex items-center gap-3 bg-emerald-50 border border-emerald-200 text-emerald-800 px-5 py-4 rounded-xl text-sm font-medium shadow-sm">
                    <i class="hgi-stroke hgi-checkmark-circle-01 text-emerald-600 text-base flex-shrink-0"></i>
                    {{ session('success') }}
                </div>
            @endif

            @if($predictions->isEmpty())
                {{-- Empty State --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-16 text-center">
                    <div class="w-20 h-20 rounded-full bg-emerald-50 flex items-center justify-center mx-auto mb-5">
                        <i class="hgi-stroke hgi-leaf-01 text-4xl text-emerald-400"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-700 mb-2">Belum Ada Riwayat Prediksi</h3>
                    <p class="text-gray-400 text-sm mb-8 max-w-sm mx-auto">
                        Mulai analisis lahan pertanian Anda untuk mendapatkan rekomendasi tanaman yang tepat.
                    </p>
                    <a href="{{ route('predictions.create') }}"
                       id="btn-start-prediction"
                       class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white px-8 py-3 text-sm font-semibold rounded-full transition-all duration-200 hover:shadow-lg">
                        <i class="hgi-stroke hgi-leaf-01"></i>
                        Mulai Prediksi Pertama
                    </a>
                </div>
            @else
                {{-- Table Card --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="px-6 py-5 border-b border-gray-50 flex items-center justify-between">
                        <div>
                            <h3 class="text-base font-semibold text-gray-800">Semua Riwayat Analisis</h3>
                            <p class="text-xs text-gray-400 mt-0.5">Total {{ $predictions->count() }} prediksi tersimpan</p>
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-sm">
                            <thead>
                                <tr class="bg-gray-50 text-left">
                                    <th class="px-6 py-3.5 text-xs font-semibold text-gray-500 uppercase tracking-wider">#</th>
                                    <th class="px-6 py-3.5 text-xs font-semibold text-gray-500 uppercase tracking-wider">Tanaman</th>
                                    <th class="px-6 py-3.5 text-xs font-semibold text-gray-500 uppercase tracking-wider">Tipe Lahan</th>
                                    <th class="px-6 py-3.5 text-xs font-semibold text-gray-500 uppercase tracking-wider">Cluster</th>
                                    <th class="px-6 py-3.5 text-xs font-semibold text-gray-500 uppercase tracking-wider">N-P-K</th>
                                    <th class="px-6 py-3.5 text-xs font-semibold text-gray-500 uppercase tracking-wider">Tanggal</th>
                                    <th class="px-6 py-3.5 text-xs font-semibold text-gray-500 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-50">
                                @foreach($predictions as $index => $prediction)
                                    <tr class="hover:bg-emerald-50/40 transition-colors duration-150 group">
                                        <td class="px-6 py-4 text-gray-400 font-outfit text-xs font-medium">
                                            {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex items-center gap-2.5">
                                                <div class="w-8 h-8 rounded-full bg-emerald-100 flex items-center justify-center flex-shrink-0">
                                                    <i class="hgi-stroke hgi-leaf-01 text-emerald-600 text-sm"></i>
                                                </div>
                                                <span class="font-semibold text-gray-800 capitalize">
                                                    {{ $prediction->recommended_crop }}
                                                </span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-emerald-100 text-emerald-700">
                                                {{ $prediction->land_type }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4">
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-slate-100 text-slate-600 font-outfit">
                                                Cluster {{ $prediction->cluster }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-gray-500 font-outfit text-xs">
                                            {{ $prediction->N }}-{{ $prediction->P }}-{{ $prediction->K }}
                                        </td>
                                        <td class="px-6 py-4 text-gray-400 text-xs">
                                            {{ $prediction->created_at->format('d M Y, H:i') }}
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex items-center gap-1.5 opacity-0 group-hover:opacity-100 transition-opacity duration-150">
                                                <a href="{{ route('predictions.show', $prediction->id) }}"
                                                   id="btn-show-{{ $prediction->id }}"
                                                   title="Lihat Detail"
                                                   class="w-8 h-8 rounded-full bg-emerald-50 hover:bg-emerald-100 flex items-center justify-center text-emerald-600 transition-colors duration-150">
                                                    <i class="hgi-stroke hgi-analytics-01 text-sm"></i>
                                                </a>
                                                <a href="{{ route('predictions.edit', $prediction->id) }}"
                                                   id="btn-edit-{{ $prediction->id }}"
                                                   title="Edit"
                                                   class="w-8 h-8 rounded-full bg-slate-50 hover:bg-slate-100 flex items-center justify-center text-slate-500 transition-colors duration-150">
                                                    <i class="hgi-stroke hgi-settings-01 text-sm"></i>
                                                </a>
                                                <form method="POST" action="{{ route('predictions.destroy', $prediction->id) }}"
                                                      onsubmit="return confirm('Yakin ingin menghapus prediksi ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                            id="btn-delete-{{ $prediction->id }}"
                                                            title="Hapus"
                                                            class="w-8 h-8 rounded-full bg-red-50 hover:bg-red-100 flex items-center justify-center text-red-400 hover:text-red-600 transition-colors duration-150">
                                                        <i class="hgi-stroke hgi-delete-02 text-sm"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </div>
    </div>

    {{-- Hugeicons CDN --}}
    @push('scripts')
        <script>
            // Auto hide flash message after 4s
            setTimeout(() => {
                const flash = document.getElementById('flash-success');
                if (flash) {
                    flash.style.transition = 'opacity 0.5s';
                    flash.style.opacity = '0';
                    setTimeout(() => flash.remove(), 500);
                }
            }, 4000);
        </script>
    @endpush
</x-app-layout>
