<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SmartFarm - Rekomendasi Tanaman & Segmentasi Lahan</title>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&family=Outfit:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 text-slate-900 font-sans antialiased">
    <!-- Navigation -->
    <nav class="sticky top-0 z-50 backdrop-blur-md bg-slate-50/80 border-b border-slate-200 py-4">
        <div class="max-w-7xl mx-auto px-6 flex justify-between items-center">
            <a href="#" class="flex items-center gap-2 text-2xl font-extrabold text-emerald-600">
                <span class="text-3xl">🌿</span> SmartFarm
            </a>
            <div class="flex items-center gap-4">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="bg-emerald-600 hover:bg-emerald-700 hover:scale-105 shadow-md shadow-emerald-500/10 text-white px-6 py-2.5 rounded-full font-semibold transition-all">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-slate-600 hover:text-emerald-500 font-semibold transition-all">Masuk</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="bg-emerald-600 hover:bg-emerald-700 hover:scale-105 shadow-md shadow-emerald-500/10 text-white px-6 py-2.5 rounded-full font-semibold transition-all">Daftar</a>
                        @endif
                    @endauth
                @else
                    <a href="#" class="border-2 border-emerald-500 text-emerald-500 hover:bg-emerald-50 px-6 py-2.5 rounded-full font-semibold transition-all" onclick="alert('Halaman Login & Register akan tersedia setelah implementasi Laravel Breeze oleh Arisada.')">Masuk</a>
                    <a href="#" class="bg-emerald-600 hover:bg-emerald-700 hover:scale-105 shadow-md shadow-emerald-500/10 text-white px-6 py-2.5 rounded-full font-semibold transition-all" onclick="alert('Halaman Login & Register akan tersedia setelah implementasi Laravel Breeze oleh Arisada.')">Daftar</a>
                @endif
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <header class="py-24 text-center relative max-w-4xl mx-auto px-6">
        <!-- Background blob -->
        <div class="absolute -top-20 left-1/2 -translate-x-1/2 w-96 h-96 bg-emerald-500/5 blur-[120px] rounded-full -z-10"></div>
        
        <span class="bg-emerald-50 text-emerald-700 border border-emerald-200 px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider inline-block mb-6">
            Kecerdasan Buatan untuk Pertanian
        </span>
        <h1 class="text-4xl md:text-6xl font-extrabold tracking-tight text-slate-900 mb-6 leading-tight font-outfit">
            Optimalkan Lahan Anda dengan <br>
            <span class="text-emerald-600">SmartFarm Decision Support</span>
        </h1>
        <p class="text-base md:text-lg text-slate-500 mb-10 max-w-2xl mx-auto leading-relaxed">
            Dapatkan rekomendasi varietas tanaman terbaik dan analisis segmentasi kondisi tanah secara instan menggunakan teknologi Random Forest dan K-Means Clustering.
        </p>
        <a href="#" class="bg-emerald-600 hover:bg-emerald-700 hover:scale-105 hover:shadow-lg hover:shadow-emerald-500/20 text-white px-8 py-4 rounded-full font-semibold text-lg transition-all shadow-md shadow-emerald-500/10 inline-block" onclick="alert('Silakan login terlebih dahulu untuk mengakses menu prediksi.')">
            Mulai Prediksi Sekarang
        </a>
    </header>

    <!-- Features Section -->
    <section class="py-16 bg-white border-y border-slate-200">
        <div class="max-w-6xl mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold font-outfit text-slate-900 mb-4">Metode Machine Learning Kami</h2>
                <p class="text-slate-500 max-w-2xl mx-auto">SmartFarm menggabungkan dua algoritma tangguh untuk memberikan hasil analisis yang akurat dan komprehensif bagi produktivitas pertanian Anda.</p>
            </div>
            
            <div class="grid md:grid-cols-2 gap-8">
                <!-- Card 1: Random Forest -->
                <div class="bg-slate-50 rounded-3xl p-8 border border-slate-200 hover:shadow-xl hover:border-emerald-500/20 hover:-translate-y-1 transition-all relative overflow-hidden group">
                    <div class="absolute top-0 left-0 w-full h-1.5 bg-emerald-500 opacity-0 group-hover:opacity-100 transition-all"></div>
                    <div class="w-14 h-14 rounded-2xl bg-emerald-100/50 text-emerald-600 flex items-center justify-center text-2xl mb-6">🌳</div>
                    <h3 class="text-xl font-bold font-outfit text-slate-900 mb-4">Random Forest Classifier</h3>
                    <p class="text-slate-500 mb-6 text-sm leading-relaxed">Digunakan untuk memprediksi rekomendasi jenis tanaman terbaik yang paling optimal untuk ditanam.</p>
                    <ul class="space-y-3 text-slate-600 text-sm">
                        <li class="flex items-start gap-2.5"><span class="text-emerald-500 font-bold">✓</span> Menggunakan kumpulan decision tree untuk hasil prediksi dengan akurasi tinggi.</li>
                        <li class="flex items-start gap-2.5"><span class="text-emerald-500 font-bold">✓</span> Menganalisis keseimbangan unsur hara tanah (N, P, K).</li>
                        <li class="flex items-start gap-2.5"><span class="text-emerald-500 font-bold">✓</span> Mempertimbangkan kondisi iklim sekitar (suhu, kelembaban, curah hujan).</li>
                        <li class="flex items-start gap-2.5"><span class="text-emerald-500 font-bold">✓</span> Mencegah risiko gagal panen karena ketidakcocokan tanah.</li>
                    </ul>
                </div>

                <!-- Card 2: K-Means Clustering -->
                <div class="bg-slate-50 rounded-3xl p-8 border border-slate-200 hover:shadow-xl hover:border-emerald-500/20 hover:-translate-y-1 transition-all relative overflow-hidden group">
                    <div class="absolute top-0 left-0 w-full h-1.5 bg-emerald-500 opacity-0 group-hover:opacity-100 transition-all"></div>
                    <div class="w-14 h-14 rounded-2xl bg-cyan-100/50 text-cyan-600 flex items-center justify-center text-2xl mb-6">📊</div>
                    <h3 class="text-xl font-bold font-outfit text-slate-900 mb-4">K-Means Land Clustering</h3>
                    <p class="text-slate-500 mb-6 text-sm leading-relaxed">Digunakan untuk melakukan segmentasi dan kategorisasi jenis kondisi fisik lahan pertanian Anda.</p>
                    <ul class="space-y-3 text-slate-600 text-sm">
                        <li class="flex items-start gap-2.5"><span class="text-emerald-500 font-bold">✓</span> Mengelompokkan data tanah berdasarkan kesamaan karakteristik fisik.</li>
                        <li class="flex items-start gap-2.5"><span class="text-emerald-500 font-bold">✓</span> Melakukan scaling fitur agar hasil pengelompokan presisi.</li>
                        <li class="flex items-start gap-2.5"><span class="text-emerald-500 font-bold">✓</span> Menerapkan mapping cluster otomatis ke penjelasan tipe lahan (*land type*).</li>
                        <li class="flex items-start gap-2.5"><span class="text-emerald-500 font-bold">✓</span> Membantu menentukan metode pemupukan dan pengairan yang sesuai.</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Parameters Section -->
    <section class="py-20 bg-slate-50">
        <div class="max-w-6xl mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold font-outfit text-slate-900 mb-4">Parameter Analisis Tanah</h2>
                <p class="text-slate-500 max-w-2xl mx-auto">Sistem kami membutuhkan 7 parameter input lingkungan berikut untuk memberikan hasil analisis lahan terbaik.</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                <div class="bg-white p-6 rounded-2xl border border-slate-200 hover:border-emerald-500/30 hover:scale-[1.02] transition-all">
                    <div class="font-bold text-emerald-600 text-lg mb-1.5">Nitrogen (N)</div>
                    <p class="text-slate-550 text-xs leading-relaxed">Kandungan Nitrogen dalam tanah yang mendukung pertumbuhan vegetatif daun tanaman.</p>
                </div>
                <div class="bg-white p-6 rounded-2xl border border-slate-200 hover:border-emerald-500/30 hover:scale-[1.02] transition-all">
                    <div class="font-bold text-emerald-600 text-lg mb-1.5">Phosphorus (P)</div>
                    <p class="text-slate-550 text-xs leading-relaxed">Kandungan Fosfor untuk merangsang pembentukan akar dan pembungaan tanaman.</p>
                </div>
                <div class="bg-white p-6 rounded-2xl border border-slate-200 hover:border-emerald-500/30 hover:scale-[1.02] transition-all">
                    <div class="font-bold text-emerald-600 text-lg mb-1.5">Potassium (K)</div>
                    <p class="text-slate-550 text-xs leading-relaxed">Kandungan Kalium untuk meningkatkan daya tahan tanaman terhadap hama dan penyakit.</p>
                </div>
                <div class="bg-white p-6 rounded-2xl border border-slate-200 hover:border-emerald-500/30 hover:scale-[1.02] transition-all">
                    <div class="font-bold text-emerald-600 text-lg mb-1.5">Suhu (°C)</div>
                    <p class="text-slate-550 text-xs leading-relaxed">Temperatur lingkungan sekitar lahan pertanian dalam derajat Celcius.</p>
                </div>
                <div class="bg-white p-6 rounded-2xl border border-slate-200 hover:border-emerald-500/30 hover:scale-[1.02] transition-all">
                    <div class="font-bold text-emerald-600 text-lg mb-1.5">Kelembaban (%)</div>
                    <p class="text-slate-550 text-xs leading-relaxed">Tingkat kelembaban udara relatif di sekitar area persawahan/lahan.</p>
                </div>
                <div class="bg-white p-6 rounded-2xl border border-slate-200 hover:border-emerald-500/30 hover:scale-[1.02] transition-all">
                    <div class="font-bold text-emerald-600 text-lg mb-1.5">Kadar Air / pH</div>
                    <p class="text-slate-550 text-xs leading-relaxed">Tingkat keasaman atau kebasaan tanah (skala ideal berkisar antara 0 - 14).</p>
                </div>
                <div class="bg-white p-6 rounded-2xl border border-slate-200 hover:border-emerald-500/30 hover:scale-[1.02] transition-all">
                    <div class="font-bold text-emerald-600 text-lg mb-1.5">Curah Hujan (mm)</div>
                    <p class="text-slate-550 text-xs leading-relaxed">Intensitas curah hujan rata-rata di area tanah pertanian.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-slate-950 text-slate-400 py-16 text-center border-t border-slate-900">
        <div class="max-w-6xl mx-auto px-6">
            <span class="text-2xl font-extrabold text-emerald-500 inline-block mb-4">🌿 SmartFarm</span>
            <p class="text-slate-500 text-sm mb-8">Platform Pendukung Keputusan Rekomendasi Tanaman & Segmentasi Lahan Berbasis Machine Learning.</p>
            <div class="w-full h-px bg-slate-800 my-8"></div>
            <p class="text-xs text-slate-600">&copy; 2026 Tugas Kelompok Pemrograman Web Framework. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
