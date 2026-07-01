<x-app-layout>
    <x-slot name="header">
        Edit Data Prediksi
    </x-slot>

    <div class="space-y-6 animate-fade-in-up">
        <!-- Header Section -->
        <div>
            <h2 class="font-outfit text-2xl font-bold text-slate-900">Perbarui Parameter Lahan</h2>
            <p class="text-sm text-slate-500">Sesuaikan kembali nilai parameter jika terdapat kesalahan input untuk mendapatkan hasil prediksi yang lebih akurat.</p>
        </div>

        @if($errors->has('api_error'))
            <div class="mb-6 rounded-2xl bg-red-50 p-4 border border-red-100 flex items-start gap-3 animate-pulse">
                <i class="hgi-stroke hgi-alert-01 text-red-600 text-xl shrink-0"></i>
                <div class="text-sm text-red-700 font-medium">
                    {{ $errors->first('api_error') }}
                </div>
            </div>
        @endif

        <form action="{{ route('predictions.update', $prediction->id) }}" method="POST" class="space-y-6"
              x-data="{
                  isDirty: false,
                  checkDirty() {
                      const inputs = this.$el.querySelectorAll('input[name]');
                      let dirty = false;
                      inputs.forEach(input => {
                          if (input.type === 'hidden') return;
                          const defaultValue = input.getAttribute('data-default') || '';
                          if (input.value !== defaultValue) {
                              dirty = true;
                          }
                      });
                      this.isDirty = dirty;
                  }
              }"
              x-init="
                  $el.querySelectorAll('input[name]').forEach(input => {
                      if (input.type === 'hidden') return;
                      input.setAttribute('data-default', input.value);
                  });
              "
              @input="checkDirty()"
        >
            @csrf
            @method('PUT')
            
            <!-- Step Group 1: Hara Tanah -->
            <div class="rounded-3xl border border-slate-200 bg-white p-6 sm:p-8 shadow-sm">
                <div class="flex items-center gap-3 mb-6">
                    <div class="flex h-10 w-10 items-center justify-center rounded-full bg-emerald-50 text-emerald-600">
                        <i class="hgi-stroke hgi-test-tube text-xl"></i>
                    </div>
                    <div>
                        <h3 class="font-outfit text-lg font-bold text-slate-900">Kandungan Nutrisi (NPK)</h3>
                        <p class="text-xs text-slate-400 uppercase tracking-wider font-semibold">Grup 01 — Nutrisi Makro</p>
                    </div>
                </div>

                <div class="grid gap-6 sm:grid-cols-3">
                    <!-- Nitrogen -->
                    <div>
                        <label for="N" class="block text-xs font-bold text-slate-700 uppercase tracking-widest mb-2">Nitrogen (N)</label>
                        <div class="relative group">
                            <input type="number" step="any" name="N" id="N" value="{{ old('N', $prediction->N) }}" 
                                class="w-full rounded-2xl border-slate-200 bg-slate-50/50 px-4 py-3 text-sm transition-all focus:border-emerald-500 focus:bg-white focus:ring-4 focus:ring-emerald-500/10 @error('N') border-red-300 ring-red-500/10 @enderror" 
                                placeholder="Contoh: 90">
                            <i class="hgi-stroke hgi-leaf-01 absolute right-4 top-1/2 -translate-y-1/2 text-slate-300 group-focus-within:text-emerald-500 transition-colors"></i>
                        </div>
                        @error('N') <p class="mt-1.5 text-[11px] font-semibold text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <!-- Phosphorus -->
                    <div>
                        <label for="P" class="block text-xs font-bold text-slate-700 uppercase tracking-widest mb-2">Phosphorus (P)</label>
                        <div class="relative group">
                            <input type="number" step="any" name="P" id="P" value="{{ old('P', $prediction->P) }}" 
                                class="w-full rounded-2xl border-slate-200 bg-slate-50/50 px-4 py-3 text-sm transition-all focus:border-emerald-500 focus:bg-white focus:ring-4 focus:ring-emerald-500/10 @error('P') border-red-300 ring-red-500/10 @enderror" 
                                placeholder="Contoh: 42">
                            <i class="hgi-stroke hgi-leaf-02 absolute right-4 top-1/2 -translate-y-1/2 text-slate-300 group-focus-within:text-emerald-500 transition-colors"></i>
                        </div>
                        @error('P') <p class="mt-1.5 text-[11px] font-semibold text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <!-- Potassium -->
                    <div>
                        <label for="K" class="block text-xs font-bold text-slate-700 uppercase tracking-widest mb-2">Potassium (K)</label>
                        <div class="relative group">
                            <input type="number" step="any" name="K" id="K" value="{{ old('K', $prediction->K) }}" 
                                class="w-full rounded-2xl border-slate-200 bg-slate-50/50 px-4 py-3 text-sm transition-all focus:border-emerald-500 focus:bg-white focus:ring-4 focus:ring-emerald-500/10 @error('K') border-red-300 ring-red-500/10 @enderror" 
                                placeholder="Contoh: 43">
                            <i class="hgi-stroke hgi-leaf-03 absolute right-4 top-1/2 -translate-y-1/2 text-slate-300 group-focus-within:text-emerald-500 transition-colors"></i>
                        </div>
                        @error('K') <p class="mt-1.5 text-[11px] font-semibold text-red-500">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>

            <!-- Step Group 2: Lingkungan -->
            <div class="rounded-3xl border border-slate-200 bg-white p-6 sm:p-8 shadow-sm">
                <div class="flex items-center gap-3 mb-6">
                    <div class="flex h-10 w-10 items-center justify-center rounded-full bg-emerald-50 text-emerald-600">
                        <i class="hgi-stroke hgi-mountain text-xl"></i>
                    </div>
                    <div>
                        <h3 class="font-outfit text-lg font-bold text-slate-900">Parameter Lingkungan</h3>
                        <p class="text-xs text-slate-400 uppercase tracking-wider font-semibold">Grup 02 — Data Klimatologi</p>
                    </div>
                </div>

                <div class="grid gap-6 sm:grid-cols-2">
                    <!-- Temperature -->
                    <div>
                        <label for="temperature" class="block text-xs font-bold text-slate-700 uppercase tracking-widest mb-2">Suhu Rata-rata (°C)</label>
                        <input type="number" step="any" name="temperature" id="temperature" value="{{ old('temperature', $prediction->temperature) }}" 
                            class="w-full rounded-2xl border-slate-200 bg-slate-50/50 px-4 py-3 text-sm transition-all focus:border-emerald-500 focus:bg-white focus:ring-4 focus:ring-emerald-500/10 @error('temperature') border-red-300 ring-red-500/10 @enderror" 
                            placeholder="Contoh: 20.8">
                        @error('temperature') <p class="mt-1.5 text-[11px] font-semibold text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <!-- Humidity -->
                    <div>
                        <label for="humidity" class="block text-xs font-bold text-slate-700 uppercase tracking-widest mb-2">Kelembaban (%)</label>
                        <input type="number" step="any" name="humidity" id="humidity" value="{{ old('humidity', $prediction->humidity) }}" 
                            class="w-full rounded-2xl border-slate-200 bg-slate-50/50 px-4 py-3 text-sm transition-all focus:border-emerald-500 focus:bg-white focus:ring-4 focus:ring-emerald-500/10 @error('humidity') border-red-300 ring-red-500/10 @enderror" 
                            placeholder="Contoh: 82.0">
                        @error('humidity') <p class="mt-1.5 text-[11px] font-semibold text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <!-- pH -->
                    <div>
                        <label for="ph" class="block text-xs font-bold text-slate-700 uppercase tracking-widest mb-2">Tingkat Keasaman (pH)</label>
                        <input type="number" step="any" name="ph" id="ph" value="{{ old('ph', $prediction->ph) }}" 
                            class="w-full rounded-2xl border-slate-200 bg-slate-50/50 px-4 py-3 text-sm transition-all focus:border-emerald-500 focus:bg-white focus:ring-4 focus:ring-emerald-500/10 @error('ph') border-red-300 ring-red-500/10 @enderror" 
                            placeholder="Rentang 0 - 14">
                        @error('ph') <p class="mt-1.5 text-[11px] font-semibold text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <!-- Rainfall -->
                    <div>
                        <label for="rainfall" class="block text-xs font-bold text-slate-700 uppercase tracking-widest mb-2">Curah Hujan (mm)</label>
                        <input type="number" step="any" name="rainfall" id="rainfall" value="{{ old('rainfall', $prediction->rainfall) }}" 
                            class="w-full rounded-2xl border-slate-200 bg-slate-50/50 px-4 py-3 text-sm transition-all focus:border-emerald-500 focus:bg-white focus:ring-4 focus:ring-emerald-500/10 @error('rainfall') border-red-300 ring-red-500/10 @enderror" 
                            placeholder="Contoh: 202.9">
                        @error('rainfall') <p class="mt-1.5 text-[11px] font-semibold text-red-500">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row items-center justify-between gap-4 pt-4">
                <a href="{{ route('predictions.index') }}" 
                   @click="if (isDirty) { $event.preventDefault(); $dispatch('open-modal', 'confirm-cancel'); }"
                   class="text-sm font-bold text-slate-400 hover:text-slate-600 transition-colors uppercase tracking-widest">
                    Batal & Kembali
                </a>
                <button type="submit" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 bg-emerald-600 px-6 py-2.5 rounded-full text-sm font-bold text-white transition-all hover:bg-emerald-700 hover:shadow-lg shadow-emerald-600/20 active:scale-[0.98]">
                    Simpan Perubahan
                    <i class="hgi-stroke hgi-checkmark-circle-01"></i>
                </button>
            </div>
        </form>
    </div>

    <!-- Cancel Confirmation Modal -->
    <x-modal name="confirm-cancel" focusable>
        <div class="p-6 sm:p-8">
            <h2 class="text-lg font-bold font-outfit text-slate-900">
                Konfirmasi Batal
            </h2>
            <p class="mt-2 text-sm text-slate-500">
                Anda memiliki perubahan parameter lahan yang belum disimpan. Apakah Anda yakin ingin membatalkan dan membuang perubahan tersebut?
            </p>
            <div class="mt-6 flex justify-end gap-3">
                <button type="button" x-on:click="$dispatch('close-modal', 'confirm-cancel')" class="px-5 py-2.5 rounded-full border border-slate-200 hover:bg-slate-50 text-sm font-bold text-slate-500 transition-all">
                    Kembali Edit
                </button>
                <a href="{{ route('predictions.index') }}" class="px-5 py-2.5 rounded-full bg-red-600 hover:bg-red-700 text-sm font-bold text-white transition-all text-center inline-block">
                    Ya, Buang Perubahan
                </a>
            </div>
        </div>
    </x-modal>
</x-app-layout>
