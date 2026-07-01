<x-app-layout>
    <x-slot name="header">
        Detail Prediksi Lahan
    </x-slot>

    <div class="max-w-5xl mx-auto space-y-8 animate-fade-in-up">
        <!-- Top Toolbar -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <a href="{{ route('predictions.index') }}" class="inline-flex items-center gap-2 text-sm font-bold text-slate-500 hover:text-slate-900 transition-colors uppercase tracking-widest">
                <i class="hgi-stroke hgi-arrow-left-01"></i>
                Kembali ke Riwayat
            </a>
            
            <div class="flex items-center gap-3 w-full sm:w-auto">
                <a href="{{ route('predictions.edit', $prediction->id) }}" class="flex-1 sm:flex-initial inline-flex items-center justify-center gap-2 rounded-full bg-white border border-slate-200 px-6 py-2.5 text-sm font-bold text-slate-600 transition-all hover:bg-slate-50 hover:border-slate-300">
                    <i class="hgi-stroke hgi-pencil-edit-01"></i>
                    Edit Data
                </a>
                <button type="button" x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-delete')" class="flex-1 sm:flex-initial inline-flex items-center justify-center gap-2 rounded-full bg-red-50 border border-red-100 px-6 py-2.5 text-sm font-bold text-red-600 transition-all hover:bg-red-100 hover:border-red-200">
                    <i class="hgi-stroke hgi-trash-can-01"></i>
                    Hapus
                </button>
            </div>
        </div>

        <!-- Result Card -->
        <div class="relative overflow-hidden rounded-[40px] bg-white border border-slate-200 p-8 sm:p-12 shadow-sm">
            <div class="absolute right-0 top-0 h-full w-1/3 bg-emerald-50/30 -z-10 translate-x-12 skew-x-12 hidden lg:block"></div>
            
            <div class="grid gap-12 lg:grid-cols-2 items-center">
                <div>
                    <span class="inline-flex items-center gap-1.5 bg-emerald-50 border border-emerald-100 px-4 py-1 rounded-full text-[10px] font-bold text-emerald-700 uppercase tracking-widest mb-6">Analisis Berhasil</span>
                    <h2 class="font-outfit text-4xl sm:text-5xl font-black text-slate-900 leading-tight">
                        Tanaman Terbaik:<br>
                        <span class="text-emerald-600 font-serif italic font-normal">{{ $prediction->recommended_crop }}</span>
                    </h2>
                    <p class="mt-6 text-slate-500 text-sm sm:text-base leading-relaxed max-w-sm">
                        Berdasarkan parameter nutrisi dan lingkungan yang dimasukkan, model Random Forest merekomendasikan penanaman <span class="font-bold text-slate-900">{{ $prediction->recommended_crop }}</span> untuk hasil maksimal.
                    </p>
                    
                    <div class="mt-8 flex items-center gap-4">
                        <div class="flex h-16 w-16 items-center justify-center rounded-3xl bg-emerald-600 text-white shadow-lg shadow-emerald-200">
                            <i class="hgi-stroke hgi-mountain text-3xl"></i>
                        </div>
                        <div>
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest leading-none">Tipe Lahan Klasifikasi</p>
                            <p class="mt-1 text-2xl font-black text-slate-900 font-outfit">{{ str_contains($prediction->land_type, ' / ') ? str_replace(' / ', ' (', $prediction->land_type) . ')' : $prediction->land_type }}</p>
                        </div>
                    </div>
                </div>

                <div class="relative">
                    <!-- Illustration Mockup -->
                    <div class="w-full max-w-sm mx-auto aspect-square rounded-[3rem] bg-emerald-50 border border-emerald-100 flex flex-col items-center justify-center p-8 text-center animate-in zoom-in duration-700">
                        <i class="hgi-stroke hgi-leaf-01 text-[120px] text-emerald-600/20 mb-4"></i>
                        <div class="bg-white rounded-3xl p-6 shadow-xl shadow-emerald-900/5 border border-emerald-100 max-w-[240px] -mt-12">
                            <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Detail Prediksi</span>
                            <div class="mt-2 text-xl font-bold font-outfit text-slate-900">{{ $prediction->recommended_crop }}</div>
                            <div class="mt-1 h-1.5 w-full bg-slate-100 rounded-full overflow-hidden">
                                <div class="h-full bg-emerald-500 rounded-full w-full"></div>
                            </div>
                            <p class="mt-3 text-[10px] text-slate-500 leading-tight">Keputusan ini diambil dengan tingkat akurasi tinggi berdasarkan dataset pertanian.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid gap-8 lg:grid-cols-2">
            <!-- Nutrisi Breakdown -->
            <div class="rounded-3xl border border-slate-200 bg-white p-8">
                <div class="flex items-center gap-3 mb-8">
                    <div class="flex h-10 w-10 items-center justify-center rounded-full bg-emerald-50 text-emerald-600">
                        <i class="hgi-stroke hgi-test-tube text-xl"></i>
                    </div>
                    <h3 class="font-outfit text-xl font-bold text-slate-900">Breakdown Nutrisi</h3>
                </div>

                <div class="space-y-6">
                    <!-- Nitrogen -->
                    <div class="group">
                        <div class="flex justify-between items-end mb-2">
                            <span class="text-sm font-bold text-slate-800">Nitrogen (N)</span>
                            <span class="font-outfit text-xl font-black text-emerald-600">{{ $prediction->N }}</span>
                        </div>
                        <div class="h-3 w-full bg-slate-50 rounded-full overflow-hidden border border-slate-100">
                            <div class="h-full bg-emerald-500 transition-all duration-1000" style="width: {{ min(($prediction->N / 150) * 100, 100) }}%"></div>
                        </div>
                    </div>
                    <!-- Phosphorus -->
                    <div class="group">
                        <div class="flex justify-between items-end mb-2">
                            <span class="text-sm font-bold text-slate-800">Phosphorus (P)</span>
                            <span class="font-outfit text-xl font-black text-emerald-600">{{ $prediction->P }}</span>
                        </div>
                        <div class="h-3 w-full bg-slate-50 rounded-full overflow-hidden border border-slate-100">
                            <div class="h-full bg-emerald-500 transition-all duration-1000" style="width: {{ min(($prediction->P / 150) * 100, 100) }}%"></div>
                        </div>
                    </div>
                    <!-- Potassium -->
                    <div class="group">
                        <div class="flex justify-between items-end mb-2">
                            <span class="text-sm font-bold text-slate-800">Potassium (K)</span>
                            <span class="font-outfit text-xl font-black text-emerald-600">{{ $prediction->K }}</span>
                        </div>
                        <div class="h-3 w-full bg-slate-50 rounded-full overflow-hidden border border-slate-100">
                            <div class="h-full bg-emerald-500 transition-all duration-1000" style="width: {{ min(($prediction->K / 150) * 100, 100) }}%"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Environment Breakdown -->
            <div class="rounded-3xl border border-slate-200 bg-white p-8">
                <div class="flex items-center gap-3 mb-8">
                    <div class="flex h-10 w-10 items-center justify-center rounded-full bg-emerald-50 text-emerald-600">
                        <i class="hgi-stroke hgi-mountain text-xl"></i>
                    </div>
                    <h3 class="font-outfit text-xl font-bold text-slate-900">Data Lingkungan</h3>
                </div>

                <div class="grid grid-cols-2 gap-6">
                    <div class="rounded-2xl bg-slate-50 p-4 border border-slate-100">
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Suhu</p>
                        <p class="mt-1 text-lg font-bold text-slate-900 font-outfit">{{ number_format($prediction->temperature, 1) }} °C</p>
                    </div>
                    <div class="rounded-2xl bg-slate-50 p-4 border border-slate-100">
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Kelembaban</p>
                        <p class="mt-1 text-lg font-bold text-slate-900 font-outfit">{{ number_format($prediction->humidity, 1) }} %</p>
                    </div>
                    <div class="rounded-2xl bg-slate-50 p-4 border border-slate-100">
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Keasaman (pH)</p>
                        <p class="mt-1 text-lg font-bold text-slate-900 font-outfit">{{ number_format($prediction->ph, 1) }}</p>
                    </div>
                    <div class="rounded-2xl bg-slate-50 p-4 border border-slate-100">
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Curah Hujan</p>
                        <p class="mt-1 text-lg font-bold text-slate-900 font-outfit">{{ number_format($prediction->rainfall, 1) }} mm</p>
                    </div>
                </div>
                
                <div class="mt-6 p-4 rounded-2xl bg-emerald-50 border border-emerald-100 flex gap-3 italic">
                    <i class="hgi-stroke hgi-info-circle text-emerald-600"></i>
                    <p class="text-xs text-emerald-800 leading-relaxed">Seluruh data lingkungan ini krusial bagi algoritma ML untuk membedakan antara lahan basah, kering, atau sedang.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <x-modal name="confirm-delete" focusable>
        <div class="p-6">
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
                <form action="{{ route('predictions.destroy', $prediction->id) }}" method="POST">
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
