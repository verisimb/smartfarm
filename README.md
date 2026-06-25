# SmartFarm: Rekomendasi Tanaman & Segmentasi Lahan (Monorepo)

Monorepo ini berisi seluruh kode untuk project kelompok **SmartFarm**, yang terdiri dari dua layanan utama:
1. **FastAPI ML Service (`ml-service/`)**: API berbasis Python untuk memuat model Machine Learning (Random Forest & K-Means) dan memberikan prediksi rekomendasi tanaman serta klasifikasi kondisi tanah.
2. **Laravel Web Application (`smartfarm-laravel/`)**: Aplikasi web utama berbasis Laravel (PHP) untuk mengelola data, visualisasi dasbor, riwayat pengujian, dan manajemen pengguna.

Untuk pembagian tugas dan penanggung jawab per fase pengembangan sekuensial, silakan merujuk pada file [pembagian_tugas.md](pembagian_tugas.md).

---

## 📂 Struktur Repositori

```text
├── ml-service/              # Backend Python (FastAPI + ML Models)
│   ├── main.py              # Main entrypoint & route API
│   ├── requirements.txt     # Dependensi Python
│   ├── venv/                # Virtual environment (di-ignore dari git)
│   └── *.pkl                # File model Machine Learning (Random Forest & K-Means)
│
├── smartfarm-laravel/       # Frontend & Web App (Laravel v11 + Tailwind CSS v4)
│   ├── app/                 # Laravel core classes (Controllers, Models, dsb.)
│   ├── resources/           # Blade views, CSS/JS assets (Tailwind v4)
│   ├── routes/              # Web & API routes
│   └── ...
│
└── pembagian_tugas.md       # Rincian pembagian tugas anggota kelompok
```

---

## 🛠️ Prasyarat (Prerequisites)

Sebelum menjalankan project, pastikan perangkat Anda telah terinstal:
- **PHP** (minimal v8.2) & **Composer**
- **Node.js** & **NPM** (minimal v18)
- **Python** (minimal v3.9) & **pip / virtualenv**
- **MySQL** Database Server (Laragon / XAMPP / Local MySQL) -> *Pastikan server database ini (terutama Laragon) sudah dijalankan/Running.*

---

## 🚀 Panduan Menjalankan Project

Ikuti langkah-langkah di bawah ini secara berurutan untuk menjalankan kedua layanan di lokal komputer Anda:

### Bagian 0: Clone Repositori

1. Clone repositori ini ke komputer lokal Anda:
   ```bash
   git clone https://github.com/verisimb/smartfarm.git
   ```

2. Masuk ke dalam direktori project utama:
   ```bash
   cd smartfarm
   ```

### Bagian 1: Setup & Jalankan FastAPI ML Service

1. Buka terminal baru dan masuk ke direktori `ml-service/`:
   ```bash
   cd ml-service
   ```

2. Buat Virtual Environment Python baru:
   ```bash
   python -m venv venv
   ```

3. Aktifkan Virtual Environment tersebut:
   - **macOS / Linux**:
     ```bash
     source venv/bin/activate
     ```
   - **Windows (Command Prompt)**:
     ```cmd
     venv\Scripts\activate.bat
     ```
   - **Windows (PowerShell)**:
     ```powershell
     venv\Scripts\Activate.ps1
     ```

4. Instal seluruh library Python yang dibutuhkan:
   ```bash
   pip install -r requirements.txt
   ```

5. Jalankan server FastAPI menggunakan Uvicorn di port `8001`:
   ```bash
   uvicorn main:app --host 127.0.0.1 --port 8001 --reload
   ```
   *FastAPI ML Service sekarang berjalan di: **`http://127.0.0.1:8001`***. Anda bisa membuka dokumentasi API interaktif di `http://127.0.0.1:8001/docs`.

---

### Bagian 2: Setup & Jalankan Laravel Web Application

1. Buka terminal baru (jangan menutup terminal FastAPI yang sedang berjalan) dan masuk ke direktori `smartfarm-laravel/`:
   ```bash
   cd smartfarm-laravel
   ```

2. Instal seluruh dependensi PHP (Composer) & Node.js (NPM):
   ```bash
   composer install
   npm install
   ```

3. Salin file environment configuration:
   ```bash
   cp .env.example .env
   ```

4. Buat Application Key baru:
   ```bash
   php artisan key:generate
   ```

5. Konfigurasikan Database dan Integrasi ML Service di file `.env`:
   - Buka file `.env` di text editor.
   - Atur nama database Anda di bagian:
     ```env
     DB_DATABASE=smartfarm
     DB_USERNAME=root
     DB_PASSWORD=
     ```
   - Pastikan juga URL FastAPI terkonfigurasi dengan benar (digunakan di Fase 3 oleh Arisada):
     ```env
     FASTAPI_URL=http://127.0.0.1:8001
     ```

6. Pastikan server database lokal Anda (**Laragon** / XAMPP) sudah dalam keadaan berjalan (*Start All*). Kemudian, buat database baru bernama `smartfarm` melalui phpMyAdmin atau MySQL Client pilihan Anda.

7. Jalankan migrasi tabel database (Akan dikerjakan oleh **Ayu** di Fase 2):
   ```bash
   php artisan migrate
   ```

8. Jalankan web server Laravel lokal:
   ```bash
   php artisan serve
   ```
   *Aplikasi Laravel sekarang berjalan di: **`http://127.0.0.1:8000`***.

9. Jalankan compiler aset frontend Vite (untuk hot-reload CSS Tailwind v4):
   ```bash
   npm run dev
   ```
   *Vite asset bundler sekarang memantau perubahan style di: **`http://localhost:5173`***.

Sekarang project kelompok SmartFarm sudah sepenuhnya aktif di komputer Anda!
