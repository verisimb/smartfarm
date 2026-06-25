<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('predictions.index') }}"
               class="w-9 h-9 rounded-full bg-gray-100 hover:bg-emerald-100 flex items-center justify-center text-gray-500 hover:text-emerald-700 transition-all duration-200">
                <i class="hgi-stroke hgi-arrow-left-01 text-base"></i>
            </a>
            <div class="w-9 h-9 rounded-full bg-emerald-100 flex items-center justify-center">
                <i class="hgi-stroke hgi-leaf-01 text-emerald-700 text-lg"></i>
            </div>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Analisis Lahan Baru</h2>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">

            {{-- API Error Alert --}}
            @if($errors->has('api_error'))
                <div class="mb-6 flex items-start gap-3 bg-red-50 border border-red-200 text-red-800 px-5 py-4 rounded-xl text-sm shadow-sm">
                    <i class="hgi-stroke hgi-alert-circle text-red-500 text-base mt-0.5 flex-shrink-0"></i>
                    <div>
                        <p class="font-semibold mb-0.5">Gagal Terhubung ke ML Service</p>
                        <p class="text-red-600">{{ $errors->first('api_error') }}</p>
                    </div>
                </div>
            @endif

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                {{-- Card Header --}}
                <div class="px-8 pt-8 pb-6 border-b border-gray-50">
                    <h3 class="text-lg font-semibold text-gray-800">Data Parameter Lahan</h3>
                    <p class="text-sm text-gray-400 mt-1">Isi nilai kandungan tanah dan kondisi iklim untuk mendapatkan rekomendasi tanaman terbaik.</p>
                </div>

                <form method="POST" action="{{ route('predictions.store') }}" id="form-create-prediction" class="px-8 py-6 space-y-6">
                    @csrf

                    {{-- NPK Section --}}
                    <div>
                        <div class="flex items-center gap-2 mb-4">
                            <div class="w-6 h-6 rounded-md bg-emerald-100 flex items-center justify-center">
                                <i class="hgi-stroke hgi-test-tube text-emerald-600 text-xs"></i>
                            </div>
                            <h4 class="text-sm font-semibold text-gray-700">Kandungan Hara Tanah (NPK)</h4>
                        </div>
                        <div class="grid grid-cols-3 gap-4">
                            {{-- N --}}
                            <div>
                                <label for="N" class="block text-xs font-medium text-gray-500 mb-1.5">Nitrogen (N) <span class="text-red-400">*</span></label>
                                <div class="relative">
                                    <input type="number" step="0.01" min="0" name="N" id="N"
                                           value="{{ old('N') }}"
                                           placeholder="0.00"
                                           class="w-full bg-gray-50 border {{ $errors->has('N') ? 'border-red-300 bg-red-50' : 'border-gray-200' }} text-gray-800 text-sm rounded-xl px-4 py-3 pr-14 focus:outline-none focus:ring-2 focus:ring-emerald-400 focus:border-transparent transition-all duration-200">
                                    <span class="absolute right-3 top-1/2 -translate-y-1/2 text-xs text-gray-300 font-medium">mg/kg</span>
                                </div>
                                @error('N') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                            {{-- P --}}
                            <div>
                                <label for="P" class="block text-xs font-medium text-gray-500 mb-1.5">Fosfor (P) <span class="text-red-400">*</span></label>
                                <div class="relative">
                                    <input type="number" step="0.01" min="0" name="P" id="P"
                                           value="{{ old('P') }}"
                                           placeholder="0.00"
                                           class="w-full bg-gray-50 border {{ $errors->has('P') ? 'border-red-300 bg-red-50' : 'border-gray-200' }} text-gray-800 text-sm rounded-xl px-4 py-3 pr-14 focus:outline-none focus:ring-2 focus:ring-emerald-400 focus:border-transparent transition-all duration-200">
                                    <span class="absolute right-3 top-1/2 -translate-y-1/2 text-xs text-gray-300 font-medium">mg/kg</span>
                                </div>
                                @error('P') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                            {{-- K --}}
                            <div>
                                <label for="K" class="block text-xs font-medium text-gray-500 mb-1.5">Kalium (K) <span class="text-red-400">*</span></label>
                                <div class="relative">
                                    <input type="number" step="0.01" min="0" name="K" id="K"
                                           value="{{ old('K') }}"
                                           placeholder="0.00"
                                           class="w-full bg-gray-50 border {{ $errors->has('K') ? 'border-red-300 bg-red-50' : 'border-gray-200' }} text-gray-800 text-sm rounded-xl px-4 py-3 pr-14 focus:outline-none focus:ring-2 focus:ring-emerald-400 focus:border-transparent transition-all duration-200">
                                    <span class="absolute right-3 top-1/2 -translate-y-1/2 text-xs text-gray-300 font-medium">mg/kg</span>
                                </div>
                                @error('K') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>
                    </div>

                    <hr class="border-gray-50">

                    {{-- Iklim Section --}}
                    <div>
                        <div class="flex items-center gap-2 mb-4">
                            <div class="w-6 h-6 rounded-md bg-blue-100 flex items-center justify-center">
                                <i class="hgi-stroke hgi-humidity text-blue-500 text-xs"></i>
                            </div>
                            <h4 class="text-sm font-semibold text-gray-700">Kondisi Iklim &amp; Tanah</h4>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            {{-- Temperature --}}
                            <div>
                                <label for="temperature" class="block text-xs font-medium text-gray-500 mb-1.5">Suhu <span class="text-red-400">*</span></label>
                                <div class="relative">
                                    <input type="number" step="0.01" name="temperature" id="temperature"
                                           value="{{ old('temperature') }}"
                                           placeholder="25.00"
                                           class="w-full bg-gray-50 border {{ $errors->has('temperature') ? 'border-red-300 bg-red-50' : 'border-gray-200' }} text-gray-800 text-sm rounded-xl px-4 py-3 pr-10 focus:outline-none focus:ring-2 focus:ring-emerald-400 focus:border-transparent transition-all duration-200">
                                    <span class="absolute right-3 top-1/2 -translate-y-1/2 text-xs text-gray-300 font-medium">°C</span>
                                </div>
                                @error('temperature') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                            {{-- Humidity --}}
                            <div>
                                <label for="humidity" class="block text-xs font-medium text-gray-500 mb-1.5">Kelembaban <span class="text-red-400">*</span></label>
                                <div class="relative">
                                    <input type="number" step="0.01" min="0" max="100" name="humidity" id="humidity"
                                           value="{{ old('humidity') }}"
                                           placeholder="80.00"
                                           class="w-full bg-gray-50 border {{ $errors->has('humidity') ? 'border-red-300 bg-red-50' : 'border-gray-200' }} text-gray-800 text-sm rounded-xl px-4 py-3 pr-8 focus:outline-none focus:ring-2 focus:ring-emerald-400 focus:border-transparent transition-all duration-200">
                                    <span class="absolute right-3 top-1/2 -translate-y-1/2 text-xs text-gray-300 font-medium">%</span>
                                </div>
                                @error('humidity') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                            {{-- pH --}}
                            <div>
                                <label for="ph" class="block text-xs font-medium text-gray-500 mb-1.5">pH Tanah <span class="text-red-400">*</span></label>
                                <div class="relative">
                                    <input type="number" step="0.01" min="0" max="14" name="ph" id="ph"
                                           value="{{ old('ph') }}"
                                           placeholder="6.50"
                                           class="w-full bg-gray-50 border {{ $errors->has('ph') ? 'border-red-300 bg-red-50' : 'border-gray-200' }} text-gray-800 text-sm rounded-xl px-4 py-3 pr-10 focus:outline-none focus:ring-2 focus:ring-emerald-400 focus:border-transparent transition-all duration-200">
                                    <span class="absolute right-3 top-1/2 -translate-y-1/2 text-xs text-gray-300 font-medium">pH</span>
                                </div>
                                @error('ph') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                            {{-- Rainfall --}}
                            <div>
                                <label for="rainfall" class="block text-xs font-medium text-gray-500 mb-1.5">Curah Hujan <span class="text-red-400">*</span></label>
                                <div class="relative">
                                    <input type="number" step="0.01" min="0" name="rainfall" id="rainfall"
                                           value="{{ old('rainfall') }}"
                                           placeholder="200.00"
                                           class="w-full bg-gray-50 border {{ $errors->has('rainfall') ? 'border-red-300 bg-red-50' : 'border-gray-200' }} text-gray-800 text-sm rounded-xl px-4 py-3 pr-10 focus:outline-none focus:ring-2 focus:ring-emerald-400 focus:border-transparent transition-all duration-200">
                                    <span class="absolute right-3 top-1/2 -translate-y-1/2 text-xs text-gray-300 font-medium">mm</span>
                                </div>
                                @error('rainfall') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>
                    </div>

                    {{-- Submit --}}
                    <div class="pt-2 flex items-center gap-3">
                        <button type="submit"
                                id="btn-submit-prediction"
                                class="flex-1 sm:flex-none inline-flex items-center justify-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white px-8 py-2.5 text-sm font-semibold rounded-full transition-all duration-200 hover:shadow-lg hover:-translate-y-0.5 active:translate-y-0">
                            <i class="hgi-stroke hgi-leaf-01"></i>
                            Analisis Lahan
                        </button>
                        <a href="{{ route('predictions.index') }}"
                           class="inline-flex items-center gap-2 text-gray-400 hover:text-gray-600 text-sm font-medium transition-colors duration-200">
                            Batal
                        </a>
                    </div>
                </form>
            </div>

            {{-- Info Box --}}
            <div class="mt-4 flex items-start gap-3 bg-emerald-50 border border-emerald-100 rounded-xl px-5 py-4 text-sm text-emerald-700">
                <i class="hgi-stroke hgi-information-circle text-emerald-500 text-base mt-0.5 flex-shrink-0"></i>
                <p>Hasil prediksi dihitung menggunakan model <strong>Random Forest</strong> untuk rekomendasi tanaman dan <strong>K-Means Clustering</strong> untuk segmentasi kondisi lahan.</p>
            </div>
        </div>
    </div>
</x-app-layout>
