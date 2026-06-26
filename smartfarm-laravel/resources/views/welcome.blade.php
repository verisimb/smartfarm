<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SmartFarm - Rekomendasi Tanaman & Segmentasi Lahan</title>
    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="{{ asset('LogoOnly.svg') }}">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&family=Outfit:wght@300;400;600;700;800&family=Instrument+Serif:ital@0;1&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Hugeicons Free Icon Font CDN -->
    <link rel="stylesheet" href="https://cdn.hugeicons.com/font/hgi-stroke-rounded.css" />
</head>
<body class="bg-slate-50 text-slate-900 font-sans antialiased selection:bg-emerald-500 selection:text-white">

    <!-- Navigation Header -->
    <header class="sticky top-0 z-50 w-full border-b border-slate-200/80 bg-white/80 backdrop-blur-md">
        <div class="mx-auto flex h-16 max-w-6xl items-center justify-between px-4 sm:px-6">
            <a href="#" class="flex items-center gap-2.5 group">
                <img src="{{ asset('Logo-text.svg') }}" alt="SmartFarm Logo" class="h-8 w-auto hidden md:block" />
                <img src="{{ asset('LogoOnly.svg') }}" alt="SmartFarm Logo" class="h-8 w-auto md:hidden" />
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

    <!-- Hero & Mockup Section Wrapper -->
    <div class="relative overflow-hidden bg-slate-50">
        <!-- Background Image with Fade -->
        <div class="absolute inset-x-0 bottom-0 top-[43%] sm:top-[39%] lg:top-[35%] xl:top-[33%] pointer-events-none z-0">
            <img src="{{ asset('4096x1645.png') }}" class="w-full h-full object-cover object-top opacity-90" />
            <!-- Top Fade to blend with bg-slate-50 -->
            <div class="absolute inset-x-0 top-0 h-65 bg-linear-to-b from-slate-50 via-slate-50/40 to-transparent"></div>
        </div>

        <!-- Hero Section -->
        <section class="relative overflow-hidden bg-transparent z-10">

        
        <div class="mx-auto max-w-6xl px-4 py-16 sm:px-6 sm:py-24 lg:py-32 relative">

            <div class="flex flex-col items-center text-center">
                <span class="mb-4 inline-flex items-center gap-1.5 bg-emerald-50 border border-emerald-200/50 px-3.5 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider text-emerald-700 shadow-sm">
                    <i class="hgi-stroke hgi-sparkles text-emerald-600"></i> Model Random Forest & K-Means
                </span>
                <h1 class="max-w-5xl text-4xl font-bold tracking-tight sm:text-5xl md:text-6xl font-outfit text-slate-900 leading-tight">
                    <span class="block">Optimalkan Hasil Lahan dengan</span>
                    <span class="font-serif font-normal italic text-emerald-600">
                        Keputusan yang Objektif
                    </span>
                </h1>
                <p class="mt-6 max-w-2xl text-base text-slate-500 sm:text-lg leading-relaxed">
                    SmartFarm membantu petani dan pengelola lahan menganalisis kandungan tanah secara instan, memberikan rekomendasi tanaman terbaik, serta melakukan segmentasi kondisi lahan secara akurat.
                </p>
                <div class="mt-8 flex w-full flex-col gap-3 sm:mt-10 sm:w-auto sm:flex-row sm:gap-4">
                    @if (Route::has('login') && Auth::check())
                        <a href="{{ url('/dashboard') }}" class="flex justify-center items-center gap-2 bg-emerald-600 hover:bg-emerald-700 hover:-translate-y-0.5 active:translate-y-0 text-white px-6 py-2.5 rounded-full font-semibold text-sm transition-all duration-300 shadow-md shadow-emerald-600/10">
                            Buka Dashboard <i class="hgi-stroke hgi-analytics-01 ml-1 text-sm"></i>
                        </a>
                    @else
                        <a href="{{ route('register') }}" class="flex justify-center items-center bg-emerald-600 hover:bg-emerald-700 hover:-translate-y-0.5 active:translate-y-0 text-white px-6 py-2.5 rounded-full font-semibold text-sm transition-all duration-300 shadow-md shadow-emerald-600/10">
                            Mulai Sekarang
                        </a>
                        <a href="{{ route('login') }}" class="flex justify-center items-center border border-slate-300 bg-white hover:bg-slate-50 text-slate-700 px-6 py-2.5 rounded-full font-semibold text-sm transition-all duration-300 shadow-sm">
                            Masuk
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- App Preview Mockup Section -->
    <section class="relative overflow-hidden pb-0 bg-transparent z-10">
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
                                smartfarm.yaelahver.dev/dashboard
                            </div>
                        </div>
                    </div>

                    <!-- Application Interface Mockup -->
                    <div class="flex bg-white text-slate-800 h-[380px] overflow-hidden">
                        <!-- Sidebar Mockup -->
                        <aside class="hidden sm:flex w-44 shrink-0 flex-col border-r border-slate-200 bg-white transition-all">
                            <!-- Sidebar Header Mockup -->
                            <div class="flex h-12 items-center px-3 border-b border-slate-100">
                                <img src="{{ asset('Logo-text.svg') }}" alt="SmartFarm Logo" class="h-5 w-auto hidden sm:block" />
                                <img src="{{ asset('LogoOnly.svg') }}" alt="SmartFarm Logo" class="h-5 w-auto sm:hidden" />
                            </div>
                            <!-- Sidebar Menu Mockup -->
                            <div class="flex-1 p-2 space-y-4">
                                <div>
                                    <span class="hidden sm:block px-2 text-[8px] font-semibold uppercase tracking-wider text-slate-400">Utama</span>
                                    <nav class="mt-1 space-y-1">
                                        <div class="flex items-center gap-2 rounded-lg bg-emerald-50 px-2.5 py-2 text-emerald-700 font-medium text-xs">
                                            <i class="hgi-stroke hgi-analytics-01 text-sm shrink-0"></i>
                                            <span class="hidden sm:inline">Dashboard</span>
                                        </div>
                                    </nav>
                                </div>
                                <div>
                                    <span class="hidden sm:block px-2 text-[8px] font-semibold uppercase tracking-wider text-slate-400">Prediksi Lahan</span>
                                    <nav class="mt-1 space-y-1">
                                        <div class="flex items-center gap-2 rounded-lg px-2.5 py-2 text-slate-500 hover:bg-slate-50 text-xs transition-colors">
                                            <i class="hgi-stroke hgi-test-tube text-sm shrink-0"></i>
                                            <span class="hidden sm:inline">Prediksi Baru</span>
                                        </div>
                                        <div class="flex items-center gap-2 rounded-lg px-2.5 py-2 text-slate-500 hover:bg-slate-50 text-xs transition-colors">
                                            <i class="hgi-stroke hgi-database-01 text-sm shrink-0"></i>
                                            <span class="hidden sm:inline">Riwayat Lahan</span>
                                        </div>
                                    </nav>
                                </div>
                            </div>
                            <!-- Sidebar Footer Mockup -->
                            <div class="border-t border-slate-100 p-2 mt-auto">
                                <div class="flex items-center gap-2 rounded-lg px-2.5 py-2 text-slate-500 hover:bg-slate-50 text-xs transition-colors">
                                    <i class="hgi-stroke hgi-user text-sm shrink-0"></i>
                                    <span class="hidden sm:inline">Profil Saya</span>
                                </div>
                            </div>
                        </aside>

                        <!-- Main Content Container Mockup -->
                        <div class="flex-1 flex flex-col min-w-0 bg-slate-50">
                            <!-- Top Header Mockup -->
                            <div class="flex h-12 shrink-0 items-center justify-between border-b border-slate-200/80 bg-white px-4">
                                <div class="flex items-center gap-2">
                                    <i class="hgi-stroke hgi-menu-01 text-base sm:hidden text-slate-700"></i>
                                    <h3 class="font-outfit font-bold text-slate-900 text-sm sm:text-base">Ringkasan Dashboard</h3>
                                </div>
                                <div class="flex items-center gap-2 px-2.5 py-1 rounded-full bg-slate-50 border border-slate-100 scale-90 sm:scale-100 origin-right">
                                    <div class="flex h-5 w-5 items-center justify-center rounded-full bg-emerald-100 text-emerald-700 font-bold text-[9px]">
                                        T
                                    </div>
                                    <div class="hidden sm:block text-left">
                                        <p class="text-[9px] font-bold text-slate-800 leading-none">Test User</p>
                                        <p class="text-[7px] text-slate-500 leading-none mt-0.5">Petani Modern</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Body Content Mockup -->
                            <main class="flex-1 p-4 sm:p-6 overflow-hidden">
                                <!-- Welcome Section (Mockup) -->
                                <div class="relative overflow-hidden rounded-2xl bg-emerald-600 p-4 text-white mb-6">
                                    <div class="relative z-10 max-w-md">
                                        <h4 class="font-outfit text-xs sm:text-sm font-bold">Selamat Datang Kembali, Test User!</h4>
                                        <p class="mt-1 text-[8px] sm:text-[10px] text-emerald-50 leading-relaxed opacity-95">
                                            Sistem SmartFarm siap membantu Anda menganalisis kondisi lahan hari ini. Pantau perkembangan unsur hara dan dapatkan rekomendasi terbaik.
                                        </p>
                                    </div>
                                    <div class="absolute -right-4 -top-4 h-20 w-20 rounded-full bg-emerald-500/30 blur-2xl"></div>
                                    <i class="hgi-stroke hgi-sprout absolute -right-2 bottom-0 text-7xl text-emerald-500/20 rotate-12 pointer-events-none"></i>
                                </div>

                                <!-- Stat Grid -->
                                <div class="grid grid-cols-3 gap-2 sm:gap-4 mb-6">
                                    <!-- Total Eksperimen Lahan -->
                                    <div class="rounded-2xl border border-slate-200 bg-white p-3 sm:p-4">
                                        <div class="flex items-center justify-between">
                                            <div class="flex h-7 w-7 sm:h-9 sm:w-9 items-center justify-center rounded-xl bg-slate-50 text-slate-600">
                                                <i class="hgi-stroke hgi-test-tube text-sm sm:text-lg"></i>
                                            </div>
                                            <span class="inline-flex items-center text-[7px] sm:text-[9px] font-bold text-emerald-600 bg-emerald-50 px-1.5 py-0.5 rounded-full uppercase tracking-wider scale-75 sm:scale-100">Aktif</span>
                                        </div>
                                        <div class="mt-2 sm:mt-3">
                                            <p class="font-outfit text-base sm:text-2xl font-black text-slate-900">12</p>
                                            <p class="text-[7px] sm:text-[9px] font-semibold text-slate-400 uppercase tracking-tighter mt-0.5">Total Eksperimen</p>
                                        </div>
                                    </div>

                                    <!-- Rekomendasi Terakhir -->
                                    <div class="rounded-2xl border border-slate-200 bg-white p-3 sm:p-4">
                                        <div class="flex items-center justify-between">
                                            <div class="flex h-7 w-7 sm:h-9 sm:w-9 items-center justify-center rounded-xl bg-slate-50 text-slate-600">
                                                <i class="hgi-stroke hgi-leaf-01 text-sm sm:text-lg"></i>
                                            </div>
                                            <span class="inline-flex items-center text-[7px] sm:text-[9px] font-bold text-emerald-600 bg-emerald-50 px-1.5 py-0.5 rounded-full uppercase tracking-wider scale-75 sm:scale-100">Hasil</span>
                                        </div>
                                        <div class="mt-2 sm:mt-3">
                                            <p class="font-outfit text-base sm:text-2xl font-black text-slate-900 truncate">Padi</p>
                                            <p class="text-[7px] sm:text-[9px] font-semibold text-slate-400 uppercase tracking-tighter mt-0.5">Rekomendasi Terakhir</p>
                                        </div>
                                    </div>

                                    <!-- Klasifikasi Lahan Terakhir -->
                                    <div class="rounded-2xl border border-slate-200 bg-white p-3 sm:p-4">
                                        <div class="flex items-center justify-between">
                                            <div class="flex h-7 w-7 sm:h-9 sm:w-9 items-center justify-center rounded-xl bg-slate-50 text-slate-600">
                                                <i class="hgi-stroke hgi-mountain text-sm sm:text-lg"></i>
                                            </div>
                                        </div>
                                        <div class="mt-2 sm:mt-3">
                                            <p class="font-outfit text-base sm:text-2xl font-black text-slate-900 truncate">Wet Land</p>
                                            <p class="text-[7px] sm:text-[9px] font-semibold text-slate-400 uppercase tracking-tighter mt-0.5">Klasifikasi Lahan</p>
                                        </div>
                                    </div>
                                </div>
                            </main>
                        </div>
                    </div>
                </div>
                <!-- Bottom fade out effect -->
                <div class="pointer-events-none absolute inset-x-0 bottom-0 h-28 bg-linear-to-t from-slate-50 to-transparent"></div>
            </div>
        </div>
    </section>
    </div>

    <!-- Features Section -->
    <section id="fitur" class="py-16 sm:py-24 lg:py-32 scroll-mt-16">
        <div class="mx-auto max-w-6xl px-4 sm:px-6">
            <div class="flex flex-col items-center text-center">
                <span class="inline-flex items-center gap-1.5 bg-emerald-50 text-emerald-700 border border-emerald-200/60 px-3.5 py-1 rounded-full text-xs font-bold uppercase tracking-wider mb-4 shadow-sm">
                    <i class="hgi-stroke hgi-star text-emerald-600"></i> Fitur Utama
                </span>
                <h2 class="font-serif text-3xl md:text-4xl tracking-tight italic text-slate-900 font-normal">
                    Semua yang Anda Butuhkan
                </h2>
                <p class="mt-4 max-w-2xl text-sm sm:text-base text-slate-500 leading-relaxed">
                    SmartFarm menyediakan alur lengkap dari pengumpulan parameter fisik lahan hingga visualisasi rekomendasi akhir untuk petani.
                </p>
            </div>

            <!-- Features Grid -->
            <div class="mt-12 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                <!-- Card 1: Rekomendasi Tanaman -->
                <div class="bg-white border border-slate-200/80 rounded-2xl p-6 transition-all duration-300 hover:shadow-md">
                    <div class="flex w-12 h-12 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600 text-xl border border-emerald-100/50"><i class="hgi-stroke hgi-leaf-01"></i></div>
                    <h3 class="mt-4 text-base font-bold text-slate-900 font-outfit">Rekomendasi Tanaman</h3>
                    <p class="mt-2 text-xs leading-relaxed text-slate-500 mb-4">Menganalisis keseimbangan unsur hara tanah menggunakan Random Forest demi kecocokan benih tanaman yang optimal.</p>
                    <ul class="list-disc pl-4 space-y-1.5 border-t border-slate-100 pt-3 text-[10px] text-slate-500">
                        <li>Akurasi Random Forest</li>
                        <li>Analisis N, P, K</li>
                        <li>Iklim & Lingkungan</li>
                    </ul>
                </div>
                <!-- Card 2: Segmentasi Lahan -->
                <div class="bg-white border border-slate-200/80 rounded-2xl p-6 transition-all duration-300 hover:shadow-md">
                    <div class="flex w-12 h-12 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600 text-xl border border-emerald-100/50"><i class="hgi-stroke hgi-mountain"></i></div>
                    <h3 class="mt-4 text-base font-bold text-slate-900 font-outfit">Segmentasi Lahan</h3>
                    <p class="mt-2 text-xs leading-relaxed text-slate-500 mb-4">Mengkategorikan jenis lahan Anda menggunakan model K-Means untuk pemeliharaan tanah yang spesifik.</p>
                    <ul class="list-disc pl-4 space-y-1.5 border-t border-slate-100 pt-3 text-[10px] text-slate-500">
                        <li>Clustering K-Means</li>
                        <li>Auto Mapping Lahan</li>
                        <li>Skalasi Fitur Presisi</li>
                    </ul>
                </div>
                <!-- Card 3: Riwayat Historis -->
                <div class="bg-white border border-slate-200/80 rounded-2xl p-6 transition-all duration-300 hover:shadow-md">
                    <div class="flex w-12 h-12 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600 text-xl border border-emerald-100/50"><i class="hgi-stroke hgi-database-01"></i></div>
                    <h3 class="mt-4 text-base font-bold text-slate-900 font-outfit">Riwayat Historis</h3>
                    <p class="mt-2 text-xs leading-relaxed text-slate-500 mb-4">Menyimpan dan mencatat seluruh hasil pengujian hara tanah Anda untuk melihat perkembangan kualitas lahan secara berkala.</p>
                    <ul class="list-disc pl-4 space-y-1.5 border-t border-slate-100 pt-3 text-[10px] text-slate-500">
                        <li>Penyimpanan Otomatis</li>
                        <li>Log Riwayat Teratur</li>
                        <li>Pantau Kualitas Lahan</li>
                    </ul>
                </div>
                <!-- Card 4: Manajemen Data -->
                <div class="bg-white border border-slate-200/80 rounded-2xl p-6 transition-all duration-300 hover:shadow-md">
                    <div class="flex w-12 h-12 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600 text-xl border border-emerald-100/50"><i class="hgi-stroke hgi-settings-01"></i></div>
                    <h3 class="mt-4 text-base font-bold text-slate-900 font-outfit">Manajemen Data</h3>
                    <p class="mt-2 text-xs leading-relaxed text-slate-500 mb-4">Edit parameter lahan dan jalankan prediksi ulang secara instan tanpa perlu mendaftar ulang dari awal.</p>
                    <ul class="list-disc pl-4 space-y-1.5 border-t border-slate-100 pt-3 text-[10px] text-slate-500">
                        <li>Edit Parameter Lahan</li>
                        <li>Prediksi Ulang Instan</li>
                        <li>Hapus Riwayat Lahan</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works Section -->
    <section id="cara-kerja" class="border-y border-slate-200 bg-slate-50/50 py-16 sm:py-24 lg:py-32 scroll-mt-16">
        <div class="mx-auto max-w-6xl px-4 sm:px-6">
            <div class="flex flex-col items-center text-center">
                <span class="inline-flex items-center gap-1.5 bg-emerald-50 text-emerald-700 border border-emerald-200/60 px-3.5 py-1 rounded-full text-xs font-bold uppercase tracking-wider mb-4 shadow-sm">
                    <i class="hgi-stroke hgi-settings-01 text-emerald-600"></i> Cara Kerja
                </span>
                <h2 class="font-serif text-3xl md:text-4xl tracking-tight italic text-slate-900 font-normal">
                    Tiga Langkah Mudah
                </h2>
                <p class="mt-4 max-w-2xl text-sm sm:text-base text-slate-500 leading-relaxed">
                    Alur sistem terpadu dari pengumpulan data lingkungan hingga penerimaan respon hasil analisis keputusan.
                </p>
            </div>

            <!-- Steps Grid -->
            <div class="mt-12 grid gap-10 md:grid-cols-3 md:gap-8">
                <!-- Step 01 -->
                <div class="flex flex-col items-center text-center group">
                    <div class="relative">
                        <span class="absolute top-1/2 right-full mr-2 -translate-y-1/2 text-4xl font-black text-slate-400 sm:mr-3 sm:text-5xl font-outfit select-none transition-colors duration-300 group-hover:text-emerald-500">
                            01
                        </span>
                        <div class="flex w-14 h-14 items-center justify-center rounded-full bg-emerald-50 border border-emerald-100/50 text-emerald-600 sm:w-16 sm:h-16 transition-all duration-300 group-hover:bg-emerald-100 group-hover:scale-105 shadow-sm">
                            <i class="hgi-stroke hgi-test-tube text-emerald-600 text-xl sm:text-2xl"></i>
                        </div>
                    </div>
                    <h3 class="mt-6 text-base font-bold text-slate-900 font-outfit">Atur Input Lahan</h3>
                    <p class="mt-2 text-xs leading-relaxed text-slate-500 max-w-xs">Isi formulir dengan parameter hara N, P, K serta kondisi lingkungan seperti suhu, kelembaban, pH, dan curah hujan.</p>
                </div>
                <!-- Step 02 -->
                <div class="flex flex-col items-center text-center group">
                    <div class="relative">
                        <span class="absolute top-1/2 right-full mr-2 -translate-y-1/2 text-4xl font-black text-slate-400 sm:mr-3 sm:text-5xl font-outfit select-none transition-colors duration-300 group-hover:text-emerald-500">
                            02
                        </span>
                        <div class="flex w-14 h-14 items-center justify-center rounded-full bg-emerald-50 border border-emerald-100/50 text-emerald-600 sm:w-16 sm:h-16 transition-all duration-300 group-hover:bg-emerald-100 group-hover:scale-105 shadow-sm">
                            <i class="hgi-stroke hgi-settings-01 text-emerald-600 text-xl sm:text-2xl"></i>
                        </div>
                    </div>
                    <h3 class="mt-6 text-base font-bold text-slate-900 font-outfit">Proses Machine Learning</h3>
                    <p class="mt-2 text-xs leading-relaxed text-slate-500 max-w-xs">Sistem menganalisis data hara dan kondisi lingkungan secara aman menggunakan model Random Forest dan K-Means.</p>
                </div>
                <!-- Step 03 -->
                <div class="flex flex-col items-center text-center group">
                    <div class="relative">
                        <span class="absolute top-1/2 right-full mr-2 -translate-y-1/2 text-4xl font-black text-slate-400 sm:mr-3 sm:text-5xl font-outfit select-none transition-colors duration-300 group-hover:text-emerald-500">
                            03
                        </span>
                        <div class="flex w-14 h-14 items-center justify-center rounded-full bg-emerald-50 border border-emerald-100/50 text-emerald-600 sm:w-16 sm:h-16 transition-all duration-300 group-hover:bg-emerald-100 group-hover:scale-105 shadow-sm">
                            <i class="hgi-stroke hgi-analytics-01 text-emerald-600 text-xl sm:text-2xl"></i>
                        </div>
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
                        <i class="hgi-stroke hgi-checkmark-circle-01 text-emerald-500 text-sm"></i> Analisis Real-Time
                    </li>
                    <li class="flex items-center justify-center gap-1.5">
                        <i class="hgi-stroke hgi-checkmark-circle-01 text-emerald-500 text-sm"></i> Hasil Akurat & Teruji
                    </li>
                    <li class="flex items-center justify-center gap-1.5">
                        <i class="hgi-stroke hgi-checkmark-circle-01 text-emerald-500 text-sm"></i> Kemudahan Akses
                    </li>
                </ul>

                <div class="mt-8 flex w-full flex-col gap-4 sm:w-auto sm:flex-row">
                    @if (Route::has('login') && Auth::check())
                        <a href="{{ url('/dashboard') }}" class="flex justify-center items-center gap-2 bg-emerald-600 hover:bg-emerald-700 hover:-translate-y-0.5 active:translate-y-0 text-white px-6 py-2.5 rounded-full font-semibold text-sm transition-all duration-300 shadow-md shadow-emerald-600/10">
                            Buka Dashboard <i class="hgi-stroke hgi-analytics-01 ml-1 text-sm"></i>
                        </a>
                    @else
                        <a href="{{ route('register') }}" class="flex justify-center items-center bg-emerald-600 hover:bg-emerald-700 hover:-translate-y-0.5 active:translate-y-0 text-white px-6 py-2.5 rounded-full font-semibold text-sm transition-all duration-300 shadow-md shadow-emerald-600/10">
                            Mulai Sekarang
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="border-t border-emerald-500/30 bg-emerald-600 text-white">
        <div class="mx-auto max-w-6xl px-4 py-10 sm:px-6 sm:py-12">
            <div class="grid grid-cols-2 gap-8 md:grid-cols-4">
                <div class="col-span-2 md:col-span-2">
                    <a href="#" class="flex items-center gap-2">
                        <img src="{{ asset('Logo-text.svg') }}" alt="SmartFarm Logo" class="h-7 w-auto brightness-0 invert" />
                    </a>
                    <p class="mt-3 max-w-sm text-sm leading-relaxed text-emerald-50/90">
                        Sistem Pendukung Keputusan optimasi varietas benih dan pengelompokan lahan pertanian berbasis Random Forest dan K-Means.
                    </p>
                </div>
                <div>
                    <h4 class="text-xs font-bold text-white uppercase tracking-wider font-outfit">Navigasi</h4>
                    <ul class="mt-3 space-y-2 text-sm text-emerald-100/90">
                        <li><a href="#fitur" class="hover:text-white transition-colors">Fitur</a></li>
                        <li><a href="#cara-kerja" class="hover:text-white transition-colors">Cara Kerja</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-xs font-bold text-white uppercase tracking-wider font-outfit">Akun</h4>
                    <ul class="mt-3 space-y-2 text-sm text-emerald-100/90">
                        @if (Route::has('login'))
                            <li><a href="{{ route('login') }}" class="hover:text-white transition-colors">Masuk</a></li>
                            <li><a href="{{ route('register') }}" class="hover:text-white transition-colors">Daftar</a></li>
                        @else
                            <li><a href="#" class="hover:text-white transition-colors" onclick="alert('Halaman login tersedia setelah setup Breeze.')">Masuk</a></li>
                            <li><a href="#" class="hover:text-white transition-colors" onclick="alert('Halaman daftar tersedia setelah setup Breeze.')">Daftar</a></li>
                        @endif
                    </ul>
                </div>
            </div>
            <div class="h-px bg-white/10 my-6 sm:my-8"></div>
            <p class="text-center text-xs text-emerald-100/75 sm:text-sm">
                © 2026 SmartFarm — Tugas Akhir Pemrograman Web Framework.
            </p>
        </div>
    </footer>

</body>
</html>
