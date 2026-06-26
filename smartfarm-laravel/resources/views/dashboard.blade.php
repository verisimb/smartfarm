<x-app-layout>
    <x-slot name="header">
        Ringkasan Dashboard
    </x-slot>

    <div class="space-y-8 animate-fade-in-up">
        <!-- Welcome Section -->
        <div class="relative overflow-hidden rounded-3xl bg-emerald-600 p-8 text-white">
            <div class="relative z-10 max-w-2xl">
                <h2 class="font-outfit text-2xl font-bold sm:text-3xl">Selamat Datang Kembali, {{ Auth::user()->name }}!</h2>
                <p class="mt-2 text-emerald-50 text-sm sm:text-base leading-relaxed opacity-90">
                    Sistem SmartFarm siap membantu Anda menganalisis kondisi lahan hari ini. Pantau perkembangan unsur hara dan dapatkan rekomendasi terbaik untuk hasil panen yang optimal.
                </p>
                <div class="mt-6 flex flex-wrap gap-3">
                    <a href="{{ route('predictions.create') }}" class="inline-flex items-center gap-2 rounded-full bg-white px-6 py-2.5 text-sm font-bold text-emerald-700 transition-all hover:bg-emerald-50 hover:-translate-y-0.5 active:translate-y-0">
                        <i class="hgi-stroke hgi-plus-01"></i>
                        Prediksi Baru
                    </a>
                </div>
            </div>
            
            <!-- Abstract background shapes -->
            <div class="absolute -right-8 -top-8 h-48 w-48 rounded-full bg-emerald-500/30 blur-3xl"></div>
            <div class="absolute right-12 bottom-0 h-24 w-24 rounded-full bg-white/10 blur-xl"></div>
            <i class="hgi-stroke hgi-sprout absolute -right-4 bottom-0 text-[180px] text-emerald-500/20 rotate-12 pointer-events-none"></i>
        </div>

        <!-- Stats Grid -->
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            <!-- Total Prediksi -->
            <div class="group rounded-3xl border border-slate-200 bg-white p-6 transition-all duration-300 hover:border-emerald-200">
                <div class="flex items-center justify-between">
                    <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-slate-50 text-slate-600 transition-colors group-hover:bg-emerald-50 group-hover:text-emerald-600">
                        <i class="hgi-stroke hgi-test-tube text-2xl"></i>
                    </div>
                    @if($totalPredictions > 0)
                        <span class="inline-flex items-center gap-1 text-[10px] font-bold text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded-full uppercase tracking-wider">Aktif</span>
                    @endif
                </div>
                <div class="mt-4">
                    <p class="font-outfit text-3xl font-black text-slate-900 sm:text-4xl">
                        {{ $totalPredictions }}
                    </p>
                    <p class="mt-1 text-xs font-semibold text-slate-400 uppercase tracking-tighter">Total Eksperimen Lahan</p>
                </div>
            </div>

            <!-- Rekomendasi Terakhir -->
            <div class="group rounded-3xl border border-slate-200 bg-white p-6 transition-all duration-300 hover:border-emerald-200 min-w-0">
                <div class="flex items-center justify-between">
                    <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-slate-50 text-slate-600 transition-colors group-hover:bg-emerald-50 group-hover:text-emerald-600">
                        <i class="hgi-stroke hgi-leaf-01 text-2xl"></i>
                    </div>
                    @if($latestCrop)
                        <span class="inline-flex items-center gap-1 text-[10px] font-bold text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded-full uppercase tracking-wider">Hasil Terbaru</span>
                    @endif
                </div>
                <div class="mt-4">
                    <p class="font-outfit text-3xl font-black text-slate-900 sm:text-4xl truncate">
                        {{ $latestCrop ?? '-' }}
                    </p>
                    <p class="mt-1 text-xs font-semibold text-slate-400 uppercase tracking-tighter">Rekomendasi Tanaman Terakhir</p>
                </div>
            </div>

            <!-- Main Land Type (Derived from latest) -->
            <div class="group rounded-3xl border border-slate-200 bg-white p-6 transition-all duration-300 hover:border-emerald-200 sm:col-span-2 lg:col-span-1 min-w-0">
                <div class="flex items-center justify-between">
                    <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-slate-50 text-slate-600 transition-colors group-hover:bg-emerald-50 group-hover:text-emerald-600">
                        <i class="hgi-stroke hgi-mountain text-2xl"></i>
                    </div>
                </div>
                <div class="mt-4">
                    <p class="font-outfit text-3xl font-black text-slate-900 sm:text-4xl truncate">
                        @php
                            $latestLand = $latestPredictions->first()?->land_type;
                        @endphp
                        {{ $latestLand ?? '-' }}
                    </p>
                    <p class="mt-1 text-xs font-semibold text-slate-400 uppercase tracking-tighter">Klasifikasi Lahan Terakhir</p>
                </div>
            </div>
        </div>

        <!-- Latest Table & Quick Actions -->
        <div class="grid gap-8 lg:grid-cols-12">
            <!-- Latest Predictions Table -->
            <div class="rounded-3xl border border-slate-200 bg-white lg:col-span-8 overflow-hidden">
                <div class="flex items-center justify-between border-b border-slate-100 px-6 py-5">
                    <div>
                        <h3 class="font-outfit text-lg font-bold text-slate-900">Riwayat Terkini</h3>
                        <p class="text-xs text-slate-400">Lima aktivitas terakhir pengujian lahan Anda</p>
                    </div>
                    <a href="{{ route('predictions.index') }}" class="text-xs font-bold text-emerald-600 hover:text-emerald-700 transition-colors">Lihat Semua</a>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead class="bg-slate-50/50">
                            <tr>
                                <th class="px-6 py-3 text-[10px] font-bold uppercase tracking-widest text-slate-400">Komposisi NPK</th>
                                <th class="px-6 py-3 text-[10px] font-bold uppercase tracking-widest text-slate-400">Rekomendasi</th>
                                <th class="px-6 py-3 text-[10px] font-bold uppercase tracking-widest text-slate-400">Tipe Lahan</th>
                                <th class="px-6 py-3 text-[10px] font-bold uppercase tracking-widest text-slate-400"></th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50">
                            @forelse($latestPredictions as $prediction)
                                <tr class="group hover:bg-slate-50/50 transition-colors">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-1.5 font-outfit text-sm font-semibold text-slate-700">
                                            <span class="text-xs text-slate-400">N:</span>{{ $prediction->N }}
                                            <span class="text-xs text-slate-400 font-normal">|</span>
                                            <span class="text-xs text-slate-400">P:</span>{{ $prediction->P }}
                                            <span class="text-xs text-slate-400 font-normal">|</span>
                                            <span class="text-xs text-slate-400">K:</span>{{ $prediction->K }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="inline-flex items-center gap-1.5 rounded-full bg-emerald-50 px-3 py-1 text-xs font-bold text-emerald-700">
                                            <i class="hgi-stroke hgi-sprout text-sm"></i>
                                            {{ $prediction->recommended_crop }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="text-xs font-semibold text-slate-500">{{ $prediction->land_type }}</span>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <a href="{{ route('predictions.show', $prediction->id) }}" class="inline-flex h-8 w-8 items-center justify-center rounded-full text-slate-400 hover:bg-white hover:text-emerald-600 border border-transparent hover:border-slate-100 transition-all">
                                            <i class="hgi-stroke hgi-arrow-right-01"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-12 text-center">
                                        <div class="flex flex-col items-center">
                                            <i class="hgi-stroke hgi-note-01 text-4xl text-slate-200 mb-2"></i>
                                            <p class="text-sm font-medium text-slate-400">Belum ada riwayat prediksi.</p>
                                            <a href="{{ route('predictions.create') }}" class="mt-3 text-xs font-bold text-emerald-600 hover:underline">Mulai prediksi pertama Anda</a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Side Info / Quick Tips -->
            <div class="space-y-6 lg:col-span-4">
                <div class="rounded-3xl border border-slate-200 bg-white p-6">
                    <h4 class="font-outfit text-sm font-bold uppercase tracking-wider text-slate-400">Tips Pertanian</h4>
                    <div class="mt-4 space-y-4">
                        <div class="flex gap-3">
                            <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-emerald-50 text-emerald-600">
                                <i class="hgi-stroke hgi-information-circle"></i>
                            </div>
                            <p class="text-xs leading-relaxed text-slate-500">
                                <strong>Nitrogen (N)</strong> yang cukup sangat penting untuk pertumbuhan daun pada tanaman Padi dan Jagung.
                            </p>
                        </div>
                        <div class="flex gap-3 pt-4 border-t border-slate-100">
                            <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-emerald-50 text-emerald-600">
                                <i class="hgi-stroke hgi-information-circle"></i>
                            </div>
                            <p class="text-xs leading-relaxed text-slate-500">
                                Pastikan <strong>pH tanah</strong> berada di kisaran 6.0 - 7.0 untuk penyerapan unsur hara yang maksimal.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Call to Action Card -->
                <div class="rounded-3xl border border-emerald-100 bg-emerald-50/50 p-6 border-dashed">
                    <h4 class="text-sm font-bold text-emerald-800">Lahan Baru Belum Terdaftar?</h4>
                    <p class="mt-2 text-xs text-emerald-700/70 leading-relaxed">Masukkan parameter tanah terbaru Anda sekarang untuk melihat rekomendasi machine learning.</p>
                    <a href="{{ route('predictions.create') }}" class="mt-4 flex w-full items-center justify-center gap-2 rounded-2xl bg-emerald-600 py-3 text-sm font-bold text-white transition-all hover:bg-emerald-700 active:scale-[0.98]">
                        Mulai Analisis <i class="hgi-stroke hgi-analytics-01"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
