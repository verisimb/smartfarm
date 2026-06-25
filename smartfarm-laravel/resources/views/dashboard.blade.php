<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-full bg-emerald-100 flex items-center justify-center">
                    <i class="hgi-stroke hgi-analytics-01 text-emerald-700 text-lg"></i>
                </div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
            </div>
            <a href="{{ route('predictions.create') }}"
               id="btn-dashboard-new"
               class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white px-6 py-2.5 text-sm font-semibold rounded-full transition-all duration-200 hover:shadow-lg hover:-translate-y-0.5">
                <i class="hgi-stroke hgi-leaf-01"></i>
                Analisis Lahan
            </a>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            {{-- Greeting --}}
            <div>
                <h1 class="text-2xl font-bold text-gray-800">
                    Selamat datang, <span class="text-emerald-600">{{ auth()->user()->name }}</span>!
                </h1>
                <p class="text-sm text-gray-400 mt-1">Berikut ringkasan analisis lahan pertanian Anda.</p>
            </div>

            {{-- Stats Cards --}}
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
                {{-- Total Prediksi --}}
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 flex items-center gap-4 hover:shadow-md transition-shadow duration-200">
                    <div class="w-14 h-14 rounded-2xl bg-emerald-100 flex items-center justify-center flex-shrink-0">
                        <i class="hgi-stroke hgi-database-01 text-emerald-600 text-2xl"></i>
                    </div>
                    <div>
                        <p class="text-xs font-medium text-gray-400 uppercase tracking-wider">Total Analisis</p>
                        <p class="text-3xl font-bold font-outfit text-gray-800 mt-1">{{ $totalPredictions }}</p>
                    </div>
                </div>

                {{-- Tanaman Terakhir --}}
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 flex items-center gap-4 hover:shadow-md transition-shadow duration-200">
                    <div class="w-14 h-14 rounded-2xl bg-emerald-100 flex items-center justify-center flex-shrink-0">
                        <i class="hgi-stroke hgi-leaf-01 text-emerald-600 text-2xl"></i>
                    </div>
                    <div class="min-w-0">
                        <p class="text-xs font-medium text-gray-400 uppercase tracking-wider">Tanaman Terakhir</p>
                        <p class="text-xl font-bold text-gray-800 mt-1 capitalize truncate">
                            {{ $latestCrop ?? '—' }}
                        </p>
                    </div>
                </div>

                {{-- Link ke Riwayat --}}
                <a href="{{ route('predictions.index') }}"
                   id="stat-history-link"
                   class="bg-gradient-to-br from-emerald-600 to-emerald-700 rounded-2xl border border-emerald-700 shadow-sm p-6 flex items-center gap-4 hover:shadow-xl transition-all duration-200 hover:-translate-y-0.5 group">
                    <div class="w-14 h-14 rounded-2xl bg-white/15 flex items-center justify-center flex-shrink-0">
                        <i class="hgi-stroke hgi-note text-white text-2xl"></i>
                    </div>
                    <div>
                        <p class="text-xs font-medium text-emerald-200 uppercase tracking-wider">Lihat Semua</p>
                        <p class="text-xl font-bold text-white mt-1">Riwayat Analisis</p>
                    </div>
                    <i class="hgi-stroke hgi-arrow-right-01 text-white/60 ml-auto group-hover:translate-x-1 transition-transform duration-200"></i>
                </a>
            </div>

            {{-- Latest Predictions Table --}}
            @if($latestPredictions->isNotEmpty())
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="px-6 py-5 border-b border-gray-50 flex items-center justify-between">
                        <div class="flex items-center gap-2.5">
                            <div class="w-7 h-7 rounded-lg bg-emerald-50 flex items-center justify-center">
                                <i class="hgi-stroke hgi-note text-emerald-600 text-sm"></i>
                            </div>
                            <h3 class="text-base font-semibold text-gray-800">Analisis Terbaru</h3>
                        </div>
                        <a href="{{ route('predictions.index') }}" class="text-xs text-emerald-600 hover:text-emerald-700 font-semibold transition-colors duration-200">
                            Lihat Semua &rarr;
                        </a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm">
                            <thead>
                                <tr class="bg-gray-50 text-left">
                                    <th class="px-6 py-3.5 text-xs font-semibold text-gray-500 uppercase tracking-wider">Tanaman</th>
                                    <th class="px-6 py-3.5 text-xs font-semibold text-gray-500 uppercase tracking-wider">Tipe Lahan</th>
                                    <th class="px-6 py-3.5 text-xs font-semibold text-gray-500 uppercase tracking-wider">Cluster</th>
                                    <th class="px-6 py-3.5 text-xs font-semibold text-gray-500 uppercase tracking-wider">Tanggal</th>
                                    <th class="px-6 py-3.5 text-xs font-semibold text-gray-500 uppercase tracking-wider"></th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-50">
                                @foreach($latestPredictions as $prediction)
                                    <tr class="hover:bg-emerald-50/40 transition-colors duration-150 group">
                                        <td class="px-6 py-4">
                                            <div class="flex items-center gap-2.5">
                                                <div class="w-8 h-8 rounded-full bg-emerald-100 flex items-center justify-center flex-shrink-0">
                                                    <i class="hgi-stroke hgi-leaf-01 text-emerald-600 text-sm"></i>
                                                </div>
                                                <span class="font-semibold text-gray-800 capitalize">{{ $prediction->recommended_crop }}</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-emerald-100 text-emerald-700">
                                                {{ $prediction->land_type }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4">
                                            <span class="text-xs text-gray-400 font-outfit">Cluster {{ $prediction->cluster }}</span>
                                        </td>
                                        <td class="px-6 py-4 text-gray-400 text-xs">
                                            {{ $prediction->created_at->format('d M Y') }}
                                        </td>
                                        <td class="px-6 py-4">
                                            <a href="{{ route('predictions.show', $prediction->id) }}"
                                               id="dashboard-show-{{ $prediction->id }}"
                                               class="opacity-0 group-hover:opacity-100 text-xs text-emerald-600 hover:text-emerald-700 font-semibold transition-all duration-150">
                                                Detail &rarr;
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @else
                {{-- Empty State --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-12 text-center">
                    <div class="w-16 h-16 rounded-full bg-emerald-50 flex items-center justify-center mx-auto mb-4">
                        <i class="hgi-stroke hgi-mountain text-3xl text-emerald-300"></i>
                    </div>
                    <h3 class="text-base font-semibold text-gray-600 mb-2">Belum ada analisis lahan</h3>
                    <p class="text-sm text-gray-400 mb-6">Mulai dengan menganalisis kondisi lahan pertanian Anda.</p>
                    <a href="{{ route('predictions.create') }}"
                       id="btn-empty-start"
                       class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white px-6 py-2.5 text-sm font-semibold rounded-full transition-all duration-200 hover:shadow-lg">
                        <i class="hgi-stroke hgi-leaf-01"></i>
                        Mulai Analisis
                    </a>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
