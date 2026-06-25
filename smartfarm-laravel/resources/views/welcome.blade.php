<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SmartFarm - Rekomendasi Tanaman & Segmentasi Lahan</title>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&family=Outfit:wght@300;400;600;700;800&family=Playfair+Display:ital,wght@1,400;1,600&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 text-slate-900 font-sans antialiased selection:bg-emerald-500 selection:text-white">

    <!-- Navigation Header -->
    <header class="sticky top-0 z-50 w-full border-b border-slate-200/80 bg-white/80 backdrop-blur-md">
        <div class="mx-auto flex h-16 max-w-6xl items-center justify-between px-4 sm:px-6">
            <a href="#" class="flex items-center gap-2.5 text-2xl font-extrabold text-slate-900 tracking-tight group">
                <span class="text-3xl transition-transform duration-300 group-hover:rotate-12">🌿</span>
                <span class="font-outfit text-emerald-600">Smart<span class="text-slate-900">Farm</span></span>
            </a>
            
            <!-- Shortcut Nav Links -->
            <nav class="hidden items-center gap-6 md:flex">
                <a href="#fitur" class="text-sm font-medium text-slate-500 hover:text-slate-900 transition-colors">
                    Fitur
                </a>
                <a href="#cara-kerja" class="text-sm font-medium text-slate-500 hover:text-slate-900 transition-colors">
                    Cara Kerja
                </a>
            </nav>

            <div class="flex items-center gap-2 sm:gap-3">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="bg-emerald-600 hover:bg-emerald-700 hover:-translate-y-0.5 active:translate-y-0 shadow-sm text-white px-5 py-2 rounded-full text-sm font-semibold transition-all duration-300">
                            Buka Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm text-slate-600 hover:text-slate-900 font-medium px-3 py-2 transition-all duration-300">
                            Masuk
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="bg-emerald-600 hover:bg-emerald-700 hover:-translate-y-0.5 active:translate-y-0 shadow-sm text-white px-5 py-2 rounded-full text-sm font-semibold transition-all duration-300">
                                Daftar
                            </a>
                        @endif
                    @endauth
                @else
                    <!-- Fallback jika Breeze belum di-install -->
                    <a href="#" class="text-sm text-slate-600 hover:text-slate-900 font-medium px-3 py-2 transition-all duration-300" onclick="alert('Halaman Login & Register akan tersedia setelah implementasi Laravel Breeze oleh Arisada.')">
                        Masuk
                    </a>
                    <a href="#" class="bg-emerald-600 hover:bg-emerald-700 hover:-translate-y-0.5 active:translate-y-0 shadow-sm text-white px-5 py-2 rounded-full text-sm font-semibold transition-all duration-300" onclick="alert('Halaman Login & Register akan tersedia setelah implementasi Laravel Breeze oleh Arisada.')">
                        Daftar
                    </a>
                @endif
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="relative overflow-hidden">
        <!-- Radial gradient background glow -->
        <div class="absolute inset-0 -z-10 bg-[radial-gradient(ellipse_at_top,_var(--color-emerald-100/30),_transparent_70%)]" style="background-color: var(--color-slate-50);"></div>
        
        <div class="mx-auto max-w-6xl px-4 py-16 sm:px-6 sm:py-24 lg:py-32">
            <div class="flex flex-col items-center text-center">
                <span class="mb-4 inline-flex items-center gap-1.5 bg-emerald-50 border border-emerald-200/50 px-3.5 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider text-emerald-700 shadow-sm">
                    ✨ Model Random Forest & K-Means
                </span>
                <h1 class="max-w-3xl text-4xl font-bold tracking-tight sm:text-5xl md:text-6xl font-outfit text-slate-900 leading-tight">
                    Optimalkan Hasil Lahan dengan
                    <span class="font-serif font-normal italic text-emerald-600">
                        Keputusan yang Objektif
                    </span>
                </h1>
                <p class="mt-6 max-w-2xl text-base text-slate-500 sm:text-lg leading-relaxed">
                    SmartFarm membantu petani dan pengelola lahan menganalisis kandungan tanah secara instan, memberikan rekomendasi tanaman terbaik, serta melakukan segmentasi kondisi lahan secara akurat.
                </p>
                <div class="mt-8 flex w-full flex-col gap-3 sm:mt-10 sm:w-auto sm:flex-row sm:gap-4">
                    @if (Route::has('login') && Auth::check())
                        <a href="{{ url('/dashboard') }}" class="flex justify-center items-center gap-2 bg-emerald-600 hover:bg-emerald-700 hover:-translate-y-1 active:translate-y-0 text-white px-8 py-4 rounded-full font-semibold text-lg transition-all duration-300 shadow-md shadow-emerald-600/10">
                            Buka Dashboard 📊
                        </a>
                    @else
                        <a href="#" class="flex justify-center items-center gap-2 bg-emerald-600 hover:bg-emerald-700 hover:-translate-y-1 active:translate-y-0 text-white px-8 py-4 rounded-full font-semibold text-lg transition-all duration-300 shadow-md shadow-emerald-600/10" onclick="alert('Silakan login terlebih dahulu untuk mengakses menu prediksi.')">
                            Mulai Sekarang ➜
                        </a>
                        <a href="#" class="flex justify-center items-center border border-slate-300 bg-white hover:bg-slate-50 text-slate-700 px-8 py-4 rounded-full font-semibold text-lg transition-all duration-300 shadow-sm" onclick="alert('Silakan login terlebih dahulu untuk mengakses menu prediksi.')">
                            Masuk
                        </a>
                    @endif
                </div>
                <p class="mt-4 text-xs text-slate-400 sm:text-sm">
                    Akurat • Instan • Mudah Digunakan
                </p>
            </div>
        </div>
    </section>

    <!-- App Preview Mockup Section -->
    <section class="relative overflow-hidden pb-0 bg-slate-50/50">
        <div class="mx-auto max-w-5xl px-4 sm:px-6">
            <div class="relative">
                <div class="overflow-hidden rounded-t-xl border border-slate-200/80 bg-white shadow-2xl sm:rounded-t-2xl">
                    <!-- Browser Chrome Header -->
                    <div class="flex items-center gap-2 border-b border-slate-200/60 bg-slate-50 px-3 py-2 sm:px-4 sm:py-3">
                        <div class="flex gap-1.5">
                            <span class="w-2.5 h-2.5 rounded-full bg-red-400"></span>
                            <span class="w-2.5 h-2.5 rounded-full bg-yellow-400"></span>
                            <span class="w-2.5 h-2.5 rounded-full bg-green-400"></span>
                        </div>
                        <div class="ml-2 flex-1">
                            <div class="mx-auto h-5 max-w-xs rounded-md bg-slate-100 px-3 text-center text-[10px] leading-5 text-slate-400 select-none">
                                smartfarm.test/dashboard
                            </div>
                        </div>
                    </div>

                    <!-- Application Interface Mockup -->
                    <div class="flex bg-white text-slate-800">
                        <!-- Sidebar Mockup -->
                        <aside class="flex w-14 shrink-0 flex-col border-r border-slate-200 bg-slate-50/50 p-2 sm:w-44">
                            <div class="flex items-center gap-2 px-2 py-3">
                                <span class="text-xl">🌿</span>
                                <span class="hidden font-outfit font-bold text-emerald-600 sm:inline text-sm">SmartFarm</span>
                            </div>
                            <nav class="mt-4 space-y-1.5">
                                <div class="flex items-center gap-2 rounded-lg bg-emerald-50 px-2 py-2 text-emerald-600 font-medium text-xs">
                                    <span class="text-base">📊</span>
                                    <span class="hidden sm:inline">Dashboard</span>
                                </div>
                                <div class="flex items-center gap-2 rounded-lg px-2 py-2 text-slate-500 hover:bg-slate-100 text-xs transition-colors">
                                    <span class="text-base">🧪</span>
                                    <span class="hidden sm:inline">Prediksi Baru</span>
                                </div>
                                <div class="flex items-center gap-2 rounded-lg px-2 py-2 text-slate-500 hover:bg-slate-100 text-xs transition-colors">
                                    <span class="text-base">📜</span>
                                    <span class="hidden sm:inline">Riwayat Lahan</span>
                                </div>
                            </nav>
                        </aside>

                        <!-- Main Content Mockup -->
                        <main class="flex-1 bg-white p-3 sm:p-6">
                            <div class="flex items-center justify-between border-b border-slate-200 pb-3 mb-4">
                                <h3 class="font-outfit font-bold text-slate-900 text-sm sm:text-base">Ringkasan Lahan</h3>
                                <span class="bg-emerald-50 text-emerald-700 px-2.5 py-0.5 rounded-full text-[10px] font-bold">Aktif</span>
                            </div>

                            <!-- Stat Grid -->
                            <div class="grid grid-cols-3 gap-2 sm:gap-4 mb-4">
                                <div class="rounded-xl border border-slate-100 bg-slate-50/50 p-2 sm:p-4">
                                    <span class="text-lg">🧪</span>
                                    <div class="text-xs font-bold text-slate-900 mt-2 sm:text-lg">18</div>
                                    <div class="text-[8px] text-slate-400 sm:text-xs">Total Prediksi</div>
                                </div>
                                <div class="rounded-xl border border-slate-100 bg-slate-50/50 p-2 sm:p-4">
                                    <span class="text-lg">🌾</span>
                                    <div class="text-xs font-bold text-slate-900 mt-2 sm:text-lg">Padi</div>
                                    <div class="text-[8px] text-slate-400 sm:text-xs">Rekomendasi Terakhir</div>
                                </div>
                                <div class="rounded-xl border border-slate-100 bg-slate-50/50 p-2 sm:p-4">
                                    <span class="text-lg">⛰️</span>
                                    <div class="text-xs font-bold text-slate-900 mt-2 sm:text-lg">Wet Land</div>
                                    <div class="text-[8px] text-slate-400 sm:text-xs">Tipe Lahan Utama</div>
                                </div>
                            </div>

                            <!-- Detail Data & Chart Mockup -->
                            <div class="grid gap-4 lg:grid-cols-7">
                                <!-- Table Column -->
                                <div class="rounded-xl border border-slate-200/80 p-3 lg:col-span-4">
                                    <div class="text-xs font-bold text-slate-900 sm:text-sm">Riwayat Prediksi Terbaru</div>
                                    <div class="text-[8px] text-slate-400 sm:text-xs mb-3">Hasil klasifikasi & segmentasi terkini</div>
                                    <div class="space-y-2">
                                        <div class="flex items-center gap-2 rounded-lg border border-slate-100 p-2 bg-emerald-50/40">
                                            <span class="w-2.5 h-2.5 rounded-full bg-emerald-500"></span>
                                            <span class="flex-1 truncate text-[9px] font-medium sm:text-xs text-slate-700">Lahan A - N:90 P:42 K:43</span>
                                            <span class="rounded bg-emerald-100 px-1.5 py-0.5 text-[8px] font-medium text-emerald-700">Padi</span>
                                        </div>
                                        <div class="flex items-center gap-2 rounded-lg border border-slate-100 p-2">
                                            <span class="w-2.5 h-2.5 rounded-full bg-slate-300"></span>
                                            <span class="flex-1 truncate text-[9px] font-medium sm:text-xs text-slate-700">Lahan B - N:20 P:55 K:60</span>
                                            <span class="rounded bg-slate-100 px-1.5 py-0.5 text-[8px] font-medium text-slate-600">Jagung</span>
                                        </div>
                                    </div>
                                </div>
                                <!-- Chart Column -->
                                <div class="hidden rounded-xl border border-slate-200/80 p-3 lg:col-span-3 sm:block">
                                    <div class="text-xs font-bold text-slate-900 sm:text-sm">Keseimbangan Hara</div>
                                    <div class="text-[8px] text-slate-400 sm:text-xs mb-3">Rata-rata unsur N, P, K</div>
                                    <div class="space-y-2.5">
                                        <div class="space-y-1">
                                            <div class="flex justify-between text-[10px] text-slate-600"><span>Nitrogen (N)</span><span>82%</span></div>
                                            <div class="h-1.5 w-full rounded-full bg-slate-100 overflow-hidden"><div class="h-full bg-emerald-500 rounded-full" style="width: 82%"></div></div>
                                        </div>
                                        <div class="space-y-1">
                                            <div class="flex justify-between text-[10px] text-slate-600"><span>Phosphorus (P)</span><span>48%</span></div>
                                            <div class="h-1.5 w-full rounded-full bg-slate-100 overflow-hidden"><div class="h-full bg-emerald-500 rounded-full" style="width: 48%"></div></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </main>
                    </div>
                </div>
                <!-- Bottom fade out effect -->
                <div class="pointer-events-none absolute inset-x-0 bottom-0 h-28 bg-gradient-to-t from-slate-50 to-transparent"></div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="fitur" class="py-16 sm:py-24 lg:py-32 scroll-mt-16">
        <div class="mx-auto max-w-6xl px-4 sm:px-6">
            <div class="flex flex-col items-center text-center">
                <span class="bg-emerald-50 text-emerald-700 border border-emerald-200/60 px-3.5 py-1 rounded-full text-xs font-bold uppercase tracking-wider mb-4 shadow-sm">
                    Fitur Utama
                </span>
                <h2 class="font-serif text-3xl md:text-4xl tracking-tight italic text-slate-900 font-normal">
                    Optimasi Pertanian dengan <span class="text-emerald-600 font-semibold not-italic font-outfit">Satu Dasbor Terintegrasi</span>
                </h2>
                <p class="mt-4 max-w-2xl text-sm sm:text-base text-slate-500 leading-relaxed">
                    SmartFarm menyediakan alur lengkap dari pengumpulan parameter fisik lahan hingga visualisasi rekomendasi akhir untuk petani.
                </p>
            </div>

            <!-- Features Grid -->
            <div class="mt-12 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                <div class="bg-white border border-slate-200/80 rounded-2xl p-6 transition-all duration-300 hover:shadow-md">
                    <div class="flex w-12 h-12 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600 text-xl border border-emerald-100/50">🌾</div>
                    <h3 class="mt-4 text-base font-bold text-slate-900 font-outfit">Rekomendasi Tanaman</h3>
                    <p class="mt-2 text-xs leading-relaxed text-slate-500">Menganalisis keseimbangan unsur hara tanah menggunakan Random Forest demi kecocokan benih tanaman yang optimal.</p>
                </div>
                <div class="bg-white border border-slate-200/80 rounded-2xl p-6 transition-all duration-300 hover:shadow-md">
                    <div class="flex w-12 h-12 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600 text-xl border border-emerald-100/50">⛰️</div>
                    <h3 class="mt-4 text-base font-bold text-slate-900 font-outfit">Segmentasi Lahan</h3>
                    <p class="mt-2 text-xs leading-relaxed text-slate-500">Mengkategorikan jenis lahan Anda menggunakan model K-Means untuk pemeliharaan tanah yang spesifik.</p>
                </div>
                <div class="bg-white border border-slate-200/80 rounded-2xl p-6 transition-all duration-300 hover:shadow-md">
                    <div class="flex w-12 h-12 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600 text-xl border border-emerald-100/50">📜</div>
                    <h3 class="mt-4 text-base font-bold text-slate-900 font-outfit">Riwayat Historis</h3>
                    <p class="mt-2 text-xs leading-relaxed text-slate-500">Menyimpan dan mencatat seluruh hasil pengujian hara tanah Anda untuk melihat perkembangan kualitas lahan secara berkala.</p>
                </div>
                <div class="bg-white border border-slate-200/80 rounded-2xl p-6 transition-all duration-300 hover:shadow-md">
                    <div class="flex w-12 h-12 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600 text-xl border border-emerald-100/50">🛠️</div>
                    <h3 class="mt-4 text-base font-bold text-slate-900 font-outfit">Manajemen Data</h3>
                    <p class="mt-2 text-xs leading-relaxed text-slate-500">Edit parameter lahan dan jalankan prediksi ulang secara instan tanpa perlu mendaftar ulang dari awal.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works Section -->
    <section id="cara-kerja" class="border-y border-slate-200 bg-slate-50/50 py-16 sm:py-24 lg:py-32 scroll-mt-16">
        <div class="mx-auto max-w-6xl px-4 sm:px-6">
            <div class="flex flex-col items-center text-center">
                <span class="bg-emerald-50 text-emerald-700 border border-emerald-200/60 px-3.5 py-1 rounded-full text-xs font-bold uppercase tracking-wider mb-4 shadow-sm">
                    Cara Kerja
                </span>
                <h2 class="font-serif text-3xl md:text-4xl tracking-tight italic text-slate-900 font-normal">
                    Tiga Langkah Mudah <span class="text-emerald-600 font-semibold not-italic font-outfit">Menganalisis Tanah</span>
                </h2>
                <p class="mt-4 max-w-2xl text-sm sm:text-base text-slate-500 leading-relaxed">
                    Alur sistem terpadu dari pengumpulan data lingkungan hingga penerimaan respon hasil analisis keputusan.
                </p>
            </div>

            <!-- Steps Grid -->
            <div class="mt-12 grid gap-10 md:grid-cols-3 md:gap-8">
                <div class="flex flex-col items-center text-center">
                    <div class="relative">
                        <span class="absolute top-1/2 right-full mr-2.5 -translate-y-1/2 text-4xl font-extrabold text-slate-200/80 font-outfit sm:text-5xl">01</span>
                        <div class="flex w-14 h-14 items-center justify-center rounded-full bg-emerald-50 text-emerald-600 border border-emerald-100/50">🧪</div>
                    </div>
                    <h3 class="mt-6 text-base font-bold text-slate-900 font-outfit">Atur Input Lahan</h3>
                    <p class="mt-2 text-xs leading-relaxed text-slate-500 max-w-xs">Isi formulir dengan parameter hara N, P, K serta kondisi lingkungan seperti suhu, kelembaban, pH, dan curah hujan.</p>
                </div>
                <div class="flex flex-col items-center text-center">
                    <div class="relative">
                        <span class="absolute top-1/2 right-full mr-2.5 -translate-y-1/2 text-4xl font-extrabold text-slate-200/80 font-outfit sm:text-5xl">02</span>
                        <div class="flex w-14 h-14 items-center justify-center rounded-full bg-emerald-50 text-emerald-600 border border-emerald-100/50">⚙️</div>
                    </div>
                    <h3 class="mt-6 text-base font-bold text-slate-900 font-outfit">Proses API Real-Time</h3>
                    <p class="mt-2 text-xs leading-relaxed text-slate-500 max-w-xs">Laravel mengirim data form ke REST API FastAPI secara aman, memproses input lewat model Random Forest dan K-Means.</p>
                </div>
                <div class="flex flex-col items-center text-center">
                    <div class="relative">
                        <span class="absolute top-1/2 right-full mr-2.5 -translate-y-1/2 text-4xl font-extrabold text-slate-200/80 font-outfit sm:text-5xl">03</span>
                        <div class="flex w-14 h-14 items-center justify-center rounded-full bg-emerald-50 text-emerald-600 border border-emerald-100/50">📊</div>
                    </div>
                    <h3 class="mt-6 text-base font-bold text-slate-900 font-outfit">Dapatkan Hasil & Rekomendasi</h3>
                    <p class="mt-2 text-xs leading-relaxed text-slate-500 max-w-xs">Simpan riwayat dan dapatkan varietas tanaman terbaik beserta pemetaan tipe kondisi lahan secara visual di dasbor.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action Section -->
    <section class="py-16 sm:py-24 lg:py-32 bg-white">
        <div class="mx-auto max-w-6xl px-4 sm:px-6">
            <div class="flex flex-col items-center text-center">
                <h2 class="font-serif text-3xl md:text-4xl tracking-tight italic text-slate-900 font-normal">
                    Siap Mengoptimalkan Lahan Pertanian Anda?
                </h2>
                <p class="mt-4 max-w-xl text-sm sm:text-base text-slate-500 leading-relaxed">
                    Mulai bandingkan parameter tanah secara objektif dengan metode Machine Learning terpadu sekarang juga.
                </p>
                
                <ul class="mt-6 flex flex-col gap-2 text-xs text-slate-500 sm:flex-row sm:gap-6 sm:text-sm">
                    <li class="flex items-center justify-center gap-1.5">
                        <span class="text-emerald-500 font-bold">✓</span> Analisis Real-Time
                    </li>
                    <li class="flex items-center justify-center gap-1.5">
                        <span class="text-emerald-500 font-bold">✓</span> Hasil Akurat & Teruji
                    </li>
                    <li class="flex items-center justify-center gap-1.5">
                        <span class="text-emerald-500 font-bold">✓</span> Kemudahan Akses
                    </li>
                </ul>

                <div class="mt-8 flex w-full flex-col gap-4 sm:w-auto sm:flex-row">
                    @if (Route::has('login') && Auth::check())
                        <a href="{{ url('/dashboard') }}" class="flex justify-center items-center gap-2 bg-emerald-600 hover:bg-emerald-700 hover:-translate-y-1 active:translate-y-0 text-white px-8 py-4 rounded-full font-semibold text-lg transition-all duration-300 shadow-md shadow-emerald-600/10">
                            Buka Dashboard 📊
                        </a>
                    @else
                        <a href="#" class="flex justify-center items-center gap-2 bg-emerald-600 hover:bg-emerald-700 hover:-translate-y-1 active:translate-y-0 text-white px-8 py-4 rounded-full font-semibold text-lg transition-all duration-300 shadow-md shadow-emerald-600/10" onclick="alert('Silakan login terlebih dahulu untuk mengakses menu prediksi.')">
                            Mulai Sekarang ➜
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="border-t border-slate-200 bg-white">
        <div class="mx-auto max-w-6xl px-4 py-10 sm:px-6 sm:py-12">
            <div class="grid grid-cols-2 gap-8 md:grid-cols-4">
                <div class="col-span-2 md:col-span-2">
                    <a href="#" class="flex items-center gap-2 text-xl font-extrabold text-slate-900 tracking-tight">
                        <span>🌿</span> SmartFarm
                    </a>
                    <p class="mt-3 max-w-sm text-sm leading-relaxed text-slate-500">
                        Sistem Pendukung Keputusan optimasi varietas benih dan pengelompokan lahan pertanian berbasis Random Forest dan K-Means.
                    </p>
                </div>
                <div>
                    <h4 class="text-xs font-bold text-slate-800 uppercase tracking-wider font-outfit">Navigasi</h4>
                    <ul class="mt-3 space-y-2 text-sm text-slate-500">
                        <li><a href="#fitur" class="hover:text-slate-900 transition-colors">Fitur</a></li>
                        <li><a href="#cara-kerja" class="hover:text-slate-900 transition-colors">Cara Kerja</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-xs font-bold text-slate-800 uppercase tracking-wider font-outfit">Akun</h4>
                    <ul class="mt-3 space-y-2 text-sm text-slate-500">
                        @if (Route::has('login'))
                            <li><a href="{{ route('login') }}" class="hover:text-slate-900 transition-colors">Masuk</a></li>
                            <li><a href="{{ route('register') }}" class="hover:text-slate-900 transition-colors">Daftar</a></li>
                        @else
                            <li><a href="#" class="hover:text-slate-900 transition-colors" onclick="alert('Halaman login tersedia setelah setup Breeze.')">Masuk</a></li>
                            <li><a href="#" class="hover:text-slate-900 transition-colors" onclick="alert('Halaman daftar tersedia setelah setup Breeze.')">Daftar</a></li>
                        @endif
                    </ul>
                </div>
            </div>
            <div class="h-px bg-slate-200/80 my-6 sm:my-8"></div>
            <p class="text-center text-xs text-slate-500 sm:text-sm">
                © 2026 SmartFarm — Tugas Akhir Pemrograman Web Framework.
            </p>
        </div>
    </footer>

</body>
</html>
