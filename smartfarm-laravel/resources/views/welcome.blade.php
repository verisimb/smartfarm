<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SmartFarm - Rekomendasi Tanaman & Segmentasi Lahan</title>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700;800&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary: #10b981; /* Emerald */
            --primary-dark: #059669;
            --primary-light: #e6fbf4;
            --secondary: #10b981;
            --dark: #0f172a; /* Slate 900 */
            --dark-light: #1e293b; /* Slate 800 */
            --light: #f8fafc; /* Slate 50 */
            --gray: #64748b; /* Slate 500 */
            --border: #e2e8f0; /* Slate 200 */
            --gradient: linear-gradient(135deg, #10b981 0%, #06b6d4 100%);
            --shadow: 0 10px 30px -10px rgba(16, 185, 129, 0.15);
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--light);
            color: var(--dark);
            line-height: 1.6;
            overflow-x: hidden;
        }

        h1, h2, h3, h4 {
            font-family: 'Outfit', sans-serif;
            font-weight: 700;
            color: var(--dark);
        }

        .container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        /* Navbar */
        nav {
            padding: 1.5rem 0;
            border-bottom: 1px solid var(--border);
            background: rgba(248, 250, 252, 0.8);
            backdrop-filter: blur(12px);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .nav-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            text-decoration: none;
            font-size: 1.5rem;
            font-weight: 800;
            background: var(--gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .logo-icon {
            color: var(--primary);
            font-size: 1.8rem;
        }

        .nav-buttons {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.75rem 1.5rem;
            border-radius: 50px;
            font-weight: 600;
            text-decoration: none;
            transition: var(--transition);
            cursor: pointer;
            font-size: 0.95rem;
        }

        .btn-text {
            color: var(--dark);
        }

        .btn-text:hover {
            color: var(--primary);
        }

        .btn-primary {
            background: var(--gradient);
            color: white;
            box-shadow: var(--shadow);
            border: none;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 30px -5px rgba(16, 185, 129, 0.3);
        }

        .btn-outline {
            border: 2px solid var(--primary);
            color: var(--primary);
            background: transparent;
        }

        .btn-outline:hover {
            background: var(--primary-light);
            transform: translateY(-2px);
        }

        /* Hero Section */
        .hero {
            padding: 6rem 0 4rem 0;
            text-align: center;
            position: relative;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: -10%;
            left: 50%;
            transform: translateX(-50%);
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(16, 185, 129, 0.08) 0%, rgba(248, 250, 252, 0) 70%);
            z-index: -1;
            border-radius: 50%;
        }

        .badge {
            background-color: var(--primary-light);
            color: var(--primary-dark);
            padding: 0.5rem 1.25rem;
            border-radius: 50px;
            font-size: 0.85rem;
            font-weight: 700;
            display: inline-block;
            margin-bottom: 1.5rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            border: 1px solid rgba(16, 185, 129, 0.2);
        }

        .hero h1 {
            font-size: 3.5rem;
            line-height: 1.2;
            margin-bottom: 1.5rem;
            letter-spacing: -1px;
        }

        .hero h1 span {
            background: var(--gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .hero p {
            font-size: 1.2rem;
            color: var(--gray);
            max-width: 700px;
            margin: 0 auto 2.5rem auto;
        }

        /* Cards Section */
        .features {
            padding: 4rem 0;
        }

        .section-title {
            text-align: center;
            margin-bottom: 3.5rem;
        }

        .section-title h2 {
            font-size: 2.25rem;
            margin-bottom: 0.75rem;
        }

        .section-title p {
            color: var(--gray);
            max-width: 600px;
            margin: 0 auto;
        }

        .grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 2rem;
        }

        @media (max-width: 768px) {
            .grid {
                grid-template-columns: 1fr;
            }
            .hero h1 {
                font-size: 2.5rem;
            }
        }

        .card {
            background: white;
            border-radius: 24px;
            padding: 2.5rem;
            border: 1px solid var(--border);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
            transition: var(--transition);
            position: relative;
            overflow: hidden;
        }

        .card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 6px;
            background: var(--gradient);
            opacity: 0;
            transition: var(--transition);
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow);
            border-color: rgba(16, 185, 129, 0.2);
        }

        .card:hover::before {
            opacity: 1;
        }

        .card-icon {
            width: 60px;
            height: 60px;
            border-radius: 16px;
            background: var(--primary-light);
            color: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.75rem;
            margin-bottom: 1.5rem;
        }

        .card h3 {
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }

        .card p {
            color: var(--gray);
            margin-bottom: 1.5rem;
            font-size: 0.95rem;
        }

        .card ul {
            list-style-type: none;
        }

        .card li {
            position: relative;
            padding-left: 1.5rem;
            margin-bottom: 0.75rem;
            font-size: 0.9rem;
            color: var(--dark-light);
        }

        .card li::before {
            content: '✓';
            position: absolute;
            left: 0;
            color: var(--primary);
            font-weight: bold;
        }

        /* Parameter Section */
        .parameters {
            background-color: white;
            padding: 6rem 0;
            border-top: 1px solid var(--border);
            border-bottom: 1px solid var(--border);
        }

        .params-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 1.5rem;
            margin-top: 3rem;
        }

        .param-item {
            padding: 1.5rem;
            border-radius: 16px;
            border: 1px solid var(--border);
            background-color: var(--light);
            transition: var(--transition);
        }

        .param-item:hover {
            background-color: white;
            border-color: var(--primary);
            transform: scale(1.02);
        }

        .param-name {
            font-weight: 700;
            color: var(--primary-dark);
            margin-bottom: 0.25rem;
            font-size: 1.1rem;
        }

        .param-desc {
            color: var(--gray);
            font-size: 0.85rem;
        }

        /* Footer */
        footer {
            padding: 4rem 0;
            text-align: center;
            background-color: var(--dark);
            color: #94a3b8; /* Slate 400 */
        }

        footer .logo {
            justify-content: center;
            margin-bottom: 1.5rem;
        }

        footer p {
            font-size: 0.9rem;
        }

        .footer-divider {
            height: 1px;
            background-color: #334155; /* Slate 700 */
            margin: 2rem 0;
        }
    </style>
</head>
<body>

    <!-- Navigation -->
    <nav>
        <div class="container nav-container">
            <a href="#" class="logo">
                <span class="logo-icon">🌿</span> SmartFarm
            </a>
            <div class="nav-buttons">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="btn btn-primary">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-text">Masuk</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn btn-primary">Daftar</a>
                        @endif
                    @endauth
                @else
                    <!-- Fallback jika belum install Laravel Breeze -->
                    <a href="#" class="btn btn-outline" onclick="alert('Halaman Login & Register akan tersedia setelah implementasi Laravel Breeze oleh Arisada.')">Masuk</a>
                    <a href="#" class="btn btn-primary" onclick="alert('Halaman Login & Register akan tersedia setelah implementasi Laravel Breeze oleh Arisada.')">Daftar</a>
                @endif
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <header class="hero">
        <div class="container">
            <span class="badge">Kecerdasan Buatan untuk Pertanian</span>
            <h1>Optimalkan Lahan Anda dengan <br><span>SmartFarm Decision Support</span></h1>
            <p>Dapatkan rekomendasi varietas tanaman terbaik dan analisis segmentasi kondisi tanah secara instan menggunakan teknologi Random Forest dan K-Means Clustering.</p>
            <a href="#" class="btn btn-primary" style="padding: 1rem 2.5rem; font-size: 1.1rem;" onclick="alert('Silakan login terlebih dahulu untuk mengakses menu prediksi.')">Mulai Prediksi Sekarang</a>
        </div>
    </header>

    <!-- Features Section -->
    <section class="features">
        <div class="container">
            <div class="section-title">
                <h2>Metode Machine Learning Kami</h2>
                <p>SmartFarm menggabungkan dua algoritma tangguh untuk memberikan hasil analisis yang akurat dan komprehensif bagi produktivitas pertanian Anda.</p>
            </div>
            
            <div class="grid">
                <!-- Card 1: Random Forest -->
                <div class="card">
                    <div class="card-icon">🌳</div>
                    <h3>Random Forest Classifier</h3>
                    <p>Digunakan untuk memprediksi rekomendasi jenis tanaman terbaik yang paling optimal untuk ditanam.</p>
                    <ul>
                        <li>Menggunakan kumpulan decision tree untuk hasil prediksi dengan akurasi tinggi.</li>
                        <li>Menganalisis keseimbangan unsur hara tanah (N, P, K).</li>
                        <li>Mempertimbangkan kondisi iklim sekitar (suhu, kelembaban, curah hujan).</li>
                        <li>Mencegah risiko gagal panen karena ketidakcocokan tanah.</li>
                    </ul>
                </div>

                <!-- Card 2: K-Means Clustering -->
                <div class="card">
                    <div class="card-icon">📊</div>
                    <h3>K-Means Land Clustering</h3>
                    <p>Digunakan untuk melakukan segmentasi dan kategorisasi jenis kondisi fisik lahan pertanian Anda.</p>
                    <ul>
                        <li>Mengelompokkan data tanah berdasarkan kesamaan karakteristik fisik.</li>
                        <li>Melakukan scaling fitur agar hasil pengelompokan presisi.</li>
                        <li>Menerapkan mapping cluster otomatis ke penjelasan tipe lahan (*land type*).</li>
                        <li>Membantu menentukan metode pemupukan dan pengairan yang sesuai.</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Parameters Section -->
    <section class="parameters">
        <div class="container">
            <div class="section-title">
                <h2>Parameter Analisis Tanah</h2>
                <p>Sistem kami membutuhkan 7 parameter input lingkungan berikut untuk memberikan hasil analisis lahan terbaik.</p>
            </div>

            <div class="params-grid">
                <div class="param-item">
                    <div class="param-name">Nitrogen (N)</div>
                    <div class="param-desc">Kandungan Nitrogen dalam tanah yang mendukung pertumbuhan vegetatif daun tanaman.</div>
                </div>
                <div class="param-item">
                    <div class="param-name">Phosphorus (P)</div>
                    <div class="param-desc">Kandungan Fosfor untuk merangsang pembentukan akar dan pembungaan tanaman.</div>
                </div>
                <div class="param-item">
                    <div class="param-name">Potassium (K)</div>
                    <div class="param-desc">Kandungan Kalium untuk meningkatkan daya tahan tanaman terhadap hama dan penyakit.</div>
                </div>
                <div class="param-item">
                    <div class="param-name">Suhu (°C)</div>
                    <div class="param-desc">Temperatur lingkungan sekitar lahan pertanian dalam derajat Celcius.</div>
                </div>
                <div class="param-item">
                    <div class="param-name">Kelembaban (%)</div>
                    <div class="param-desc">Tingkat kelembaban udara relatif di sekitar area persawahan/lahan.</div>
                </div>
                <div class="param-item">
                    <div class="param-name">Kadar Air / pH</div>
                    <div class="param-desc">Tingkat keasaman atau kebasaan tanah (skala ideal berkisar antara 0 - 14).</div>
                </div>
                <div class="param-item">
                    <div class="param-name">Curah Hujan (mm)</div>
                    <div class="param-desc">Intensitas curah hujan rata-rata di area tanah pertanian.</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <a href="#" class="logo" style="background: none; -webkit-text-fill-color: #10b981;">
                🌿 SmartFarm
            </a>
            <p>Platform Pendukung Keputusan Rekomendasi Tanaman & Segmentasi Lahan Berbasis Machine Learning.</p>
            <div class="footer-divider"></div>
            <p style="font-size: 0.8rem; color: #64748b;">&copy; 2026 Tugas Kelompok Pemrograman Web Framework. All rights reserved.</p>
        </div>
    </footer>

</body>
</html>
