<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('predictions.index') }}"
               class="w-9 h-9 rounded-full bg-gray-100 hover:bg-emerald-100 flex items-center justify-center text-gray-500 hover:text-emerald-700 transition-all duration-200">
                <i class="hgi-stroke hgi-arrow-left-01 text-base"></i>
            </a>
            <div class="w-9 h-9 rounded-full bg-emerald-100 flex items-center justify-center">
                <i class="hgi-stroke hgi-analytics-01 text-emerald-700 text-lg"></i>
            </div>
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Detail Hasil Prediksi</h2>
                <p class="text-xs text-gray-400">ID #{{ $prediction->id }} &mdash; {{ $prediction->created_at->format('d M Y, H:i') }}</p>
            </div>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Flash --}}
            @if(session('success'))
                <div id="flash-success" class="flex items-center gap-3 bg-emerald-50 border border-emerald-200 text-emerald-800 px-5 py-4 rounded-xl text-sm font-medium shadow-sm">
                    <i class="hgi-stroke hgi-checkmark-circle-01 text-emerald-600 text-base flex-shrink-0"></i>
                    {{ session('success') }}
                </div>
            @endif

            {{-- Hero Result Card --}}
            <div class="bg-gradient-to-br from-emerald-600 to-emerald-800 rounded-2xl p-8 text-white shadow-xl relative overflow-hidden">
                {{-- Decorative blob --}}
                <div class="absolute top-0 right-0 w-48 h-48 bg-white/5 rounded-full -translate-y-1/4 translate-x-1/4"></div>
                <div class="absolute bottom-0 left-0 w-32 h-32 bg-white/5 rounded-full translate-y-1/4 -translate-x-1/4"></div>

                <div class="relative z-10 flex flex-col sm:flex-row sm:items-center gap-6">
                    <div class="w-20 h-20 rounded-2xl bg-white/15 backdrop-blur-sm flex items-center justify-center flex-shrink-0">
                        <i class="hgi-stroke hgi-leaf-01 text-4xl text-white"></i>
                    </div>
                    <div class="flex-1">
                        <p class="text-emerald-200 text-xs font-semibold uppercase tracking-widest mb-1">Rekomendasi Tanaman</p>
                        <h1 class="text-3xl sm:text-4xl font-bold font-outfit capitalize mb-3">
                            {{ $prediction->recommended_crop }}
                        </h1>
                        <div class="flex flex-wrap gap-3">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-white/15 text-white text-xs font-medium">
                                <i class="hgi-stroke hgi-mountain text-white/70"></i>
                                {{ $prediction->land_type }}
                            </span>
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-white/15 text-white text-xs font-medium font-outfit">
                                <i class="hgi-stroke hgi-database-01 text-white/70"></i>
                                Cluster {{ $prediction->cluster }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Input Parameters Grid --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-5 border-b border-gray-50">
                    <div class="flex items-center gap-2.5">
                        <div class="w-7 h-7 rounded-lg bg-emerald-50 flex items-center justify-center">
                            <i class="hgi-stroke hgi-test-tube text-emerald-600 text-sm"></i>
                        </div>
                        <h3 class="text-base font-semibold text-gray-800">Parameter Input Lahan</h3>
                    </div>
                </div>
                <div class="p-6 grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">
                    @php
                        $params = [
                            ['label' => 'Nitrogen (N)', 'value' => $prediction->N, 'unit' => 'mg/kg', 'icon' => 'hgi-test-tube'],
                            ['label' => 'Fosfor (P)', 'value' => $prediction->P, 'unit' => 'mg/kg', 'icon' => 'hgi-test-tube'],
                            ['label' => 'Kalium (K)', 'value' => $prediction->K, 'unit' => 'mg/kg', 'icon' => 'hgi-test-tube'],
                            ['label' => 'Suhu', 'value' => $prediction->temperature, 'unit' => '°C', 'icon' => 'hgi-temperature'],
                            ['label' => 'Kelembaban', 'value' => $prediction->humidity, 'unit' => '%', 'icon' => 'hgi-humidity'],
                            ['label' => 'pH Tanah', 'value' => $prediction->ph, 'unit' => 'pH', 'icon' => 'hgi-note'],
                            ['label' => 'Curah Hujan', 'value' => $prediction->rainfall, 'unit' => 'mm', 'icon' => 'hgi-rain'],
                        ];
                    @endphp
                    @foreach($params as $param)
                        <div class="group bg-gray-50 hover:bg-emerald-50 rounded-xl p-4 transition-colors duration-200">
                            <div class="flex items-center gap-2 mb-2">
                                <i class="hgi-stroke {{ $param['icon'] }} text-gray-400 group-hover:text-emerald-500 text-sm transition-colors duration-200"></i>
                                <p class="text-xs text-gray-400 font-medium">{{ $param['label'] }}</p>
                            </div>
                            <p class="text-xl font-bold font-outfit text-gray-800">
                                {{ number_format($param['value'], 2) }}
                                <span class="text-xs font-normal text-gray-400 ml-0.5">{{ $param['unit'] }}</span>
                            </p>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Actions --}}
            <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3">
                <a href="{{ route('predictions.edit', $prediction->id) }}"
                   id="btn-edit-prediction"
                   class="flex-1 sm:flex-none inline-flex items-center justify-center gap-2 bg-slate-100 hover:bg-slate-200 text-slate-700 px-6 py-2.5 text-sm font-semibold rounded-full transition-all duration-200">
                    <i class="hgi-stroke hgi-settings-01"></i>
                    Edit Prediksi
                </a>
                <a href="{{ route('predictions.create') }}"
                   id="btn-new-from-show"
                   class="flex-1 sm:flex-none inline-flex items-center justify-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white px-6 py-2.5 text-sm font-semibold rounded-full transition-all duration-200 hover:shadow-lg">
                    <i class="hgi-stroke hgi-leaf-01"></i>
                    Prediksi Lahan Baru
                </a>
                <form method="POST" action="{{ route('predictions.destroy', $prediction->id) }}"
                      class="flex-1 sm:flex-none"
                      onsubmit="return confirm('Yakin ingin menghapus prediksi ini? Data tidak dapat dikembalikan.')">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            id="btn-delete-prediction"
                            class="w-full inline-flex items-center justify-center gap-2 bg-red-50 hover:bg-red-100 text-red-500 hover:text-red-700 px-6 py-2.5 text-sm font-semibold rounded-full transition-all duration-200">
                        <i class="hgi-stroke hgi-delete-02"></i>
                        Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
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
