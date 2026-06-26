# Pembagian Tugas Kelompok Project SmartFarm (Very Hanya Fase 1)

Dokumen ini berisi pembagian tugas dan fase pengembangan untuk project **SmartFarm: Website Rekomendasi Tanaman dan Segmentasi Kondisi Lahan Berbasis Random Forest dan K-Means**.

Project ini dirancang secara **sekuensial (berurutan/non-paralel)** agar pengerjaan terstruktur, minim konflik Git, dan ramah bagi pemula. Sesuai arahan terbaru, **Very hanya bekerja di Fase 1 (Inisiasi)**. Logika integrasi API (HTTP Client) di Laravel dialihkan ke **Arisada** agar menyatu dengan tugas pembuatan metode `store()` dan `update()` di Controller.

---

## 📅 Alur Pengembangan Sekuensial (Linear Timeline)

```mermaid
gantt
    title Timeline Sekuensial SmartFarm (Very Hanya Fase 1)
    dateFormat  YYYY-MM-DD
    section Fase 1: Inisiasi (Very)
    Inisiasi Laravel, Landing Page & FastAPI :active, 2026-06-25, 4d
    section Fase 2: Database & Routing (Ayu)
    Migration, Models & Routing Setup       : 2026-06-29, 2d
    section Fase 3: Auth & CRUD Write + API (Arisada)
    Breeze, HTTP Client & Store/Update      : 2026-07-01, 3d
    section Fase 4: CRUD Read/Delete (Rama)
    Controller Index/Show/Delete Logic      : 2026-07-04, 2d
    section Fase 5: UI & Views Polish (Gede)
    Blade UI (Dashboard, Forms, History)    : 2026-07-06, 4d
```

---

## 👥 Rincian Fase & Penanggung Jawab

### 🚀 FASE 1: Inisiasi Project & FastAPI ML Service
*   **Penanggung Jawab**: **Very**
*   **Waktu**: Pertama kali (pembuka project).
*   **Deskripsi**: Very bertanggung jawab melakukan inisiasi repository Git kelompok, menyiapkan struktur project Laravel awal, membuat halaman Landing Page, serta membangun backend FastAPI ML Service. Setelah fase ini selesai, tugas Very selesai sepenuhnya.
*   **Daftar Tugas (Checklist)**:
    *   [x] Inisiasi Repository Git kelompok (GitHub/GitLab) dan buat project Laravel awal.
    *   [x] Membuat folder `ml-service/` terpisah di dalam project.
    *   [x] Menyiapkan script FastAPI (`main.py`) untuk memuat model `.pkl` (Random Forest & K-Means) dan membuka endpoint `/predict`.
    *   [x] Membuat file `welcome.blade.php` (Landing Page) di Laravel dengan visual yang informatif mengenai cara kerja SmartFarm, Random Forest, dan K-Means.
    *   [x] Melakukan *commit* dan *push* semua code awal ke Git agar dapat di-clone oleh anggota kelompok lain.

---

### 💾 FASE 2: Database Schema, Eloquent Model, & Routing (Tugas Ayu)
*   **Penanggung Jawab**: **Ayu**
*   **Waktu**: Dimulai setelah **Fase 1 selesai** (Very sudah melakukan push code inisiasi ke Git).
*   **Deskripsi**: Ayu bertugas menyalin kode boilerplate database dan route dari `plan.md` ke dalam project Laravel. Tugas ini sangat sederhana karena tinggal menyalin template kode yang sudah ada.
*   **Daftar Tugas (Checklist)**:
    *   [x] Menarik (*pull*) repository Git terbaru dari Very.
    *   [x] Mengonfigurasi file `.env` untuk menghubungkan ke MySQL database lokal.
    *   [x] Membuat file migration untuk tabel `land_predictions` dengan menyalin (*copy-paste*) kode skema database dari `plan.md` (baris 274-291).
    *   [x] Menjalankan perintah migration (`php artisan migrate`).
    *   [x] Membuat Eloquent Model `LandPrediction` dan menyalin kode fillable & relasi user dari `plan.md` (baris 304-327).
    *   [x] Menambahkan fungsi relasi `landPredictions()` pada file `User.php` dengan menyalin kode dari `plan.md` (baris 329-336).
    *   [x] Menyalin daftar route web yang sudah terdefinisi dari `plan.md` (baris 359-369) ke dalam file `routes/web.php`.
    *   [x] Melakukan *push* perubahan ke Git.

---

### 🔑 FASE 3: Sistem Autentikasi, Controller Write & Integrasi API
*   **Penanggung Jawab**: **Arisada**
*   **Waktu**: Dimulai setelah **Fase 2 selesai** (Ayu sudah menyelesaikan migrasi database dan routing).
*   **Deskripsi**: Arisada memasang sistem login/register, menyiapkan logika controller untuk proses input data, serta menembakkan data tersebut ke API FastAPI menggunakan HTTP Client Laravel.
*   **Daftar Tugas (Checklist)**:
    *   [x] Menarik (*pull*) repository Git terbaru.
    *   [x] Menginstal dan mengonfigurasi Laravel Breeze untuk otentikasi user (Login, Register, Logout).
    *   [x] Membuat controller `LandPredictionController` dengan method lengkap (`dashboard`, `index`, `create`, `store`, `show`, `edit`, `update`, `destroy`).
    *   [x] Menulis logika pada method `dashboard()` di controller untuk menghitung ringkasan data user (total prediksi, prediksi terbaru, dan tanaman terakhir yang direkomendasikan).
    *   [x] Menulis aturan validasi form input pada method `store()` dan `update()` sesuai spesifikasi (memastikan tipe data numerik dan bernilai positif).
    *   [x] Menambahkan setting `FASTAPI_URL` ke dalam `.env` dan mendaftarkannya di `config/services.php`.
    *   [x] Menggunakan Laravel HTTP Client (`Http::post`) pada method `store()` dan `update()` untuk mengirim data input ke FastAPI dan menangkap hasilnya (recommended_crop, cluster, land_type).
    *   [x] Menyimpan data gabungan (input form + hasil prediksi) ke database MySQL.
    *   [x] Menambahkan penanganan error (*graceful fallback*) jika API FastAPI mati.
    *   [x] Melakukan *push* perubahan ke Git.

---

### 🔌 FASE 4: Controller Read/Delete Logic
*   **Penanggung Jawab**: **Rama**
*   **Waktu**: Dimulai setelah **Fase 3 selesai** (Arisada sudah mengunggah integrasi API & store/update ke Git).
*   **Deskripsi**: Rama mengelola logika pengambilan dan penghapusan data riwayat prediksi di database.
*   **Daftar Tugas (Checklist)**:
    *   [x] Menarik (*pull*) repository Git terbaru.
    *   [x] Mengisi logika method `index()` pada controller untuk mengambil riwayat prediksi milik user yang sedang login (`LandPrediction::where('user_id', auth()->id())->latest()->get()`).
    *   [x] Mengisi logika method `show($id)` untuk menampilkan detail data input & output dari satu riwayat.
    *   [x] Mengisi logika method `destroy($id)` untuk menghapus riwayat prediksi tertentu (`$prediction->delete()`).
    *   [x] Melakukan *push* perubahan ke Git.

---

### 🎨 FASE 5: Pembuatan UI & Estetika Blade Views
*   **Penanggung Jawab**: **Gede**
*   **Waktu**: Dimulai setelah **Fase 4 selesai** (Seluruh integrasi backend dan database dari Rama sudah selesai).
*   **Deskripsi**: Gede bertugas mendesain seluruh tampilan halaman (*views*) agar tampak premium, bersih, responsif, dan konsisten.
*   **Daftar Tugas (Checklist)**:
    *   [x] Menarik (*pull*) repository Git terbaru.
    *   [x] Membuat Master Layout (`layouts/app.blade.php`) dengan sidebar/navbar navigasi yang konsisten.
    *   [x] Membuat UI Dashboard (`dashboard.blade.php`) yang menampilkan rangkuman statistik user.
    *   [x] Membuat UI Form Input Prediksi (`predictions/create.blade.php`) dan Form Edit (`predictions/edit.blade.php`) beserta penanganan error validasi visual.
    *   [x] Membuat UI tabel Riwayat Prediksi (`predictions/index.blade.php`) dan halaman detail hasil prediksi (`predictions/show.blade.php`).
    *   [x] Memoles CSS/Tailwind dengan skema warna pertanian modern (hijau segar), tombol interaktif, dan efek transisi/hover.
    *   [/] Melakukan *push* terakhir ke Git untuk pengujian kelompok secara menyeluruh.

---

## 🎨 Panduan & Standar Konsistensi UI (Wajib Diikuti Semua Anggota)

Untuk menjaga kualitas estetika dan keseragaman tampilan aplikasi SmartFarm, seluruh developer (terutama **Gede** di Fase 5) **wajib** mengikuti aturan desain berikut:

1. **Framework & Konfigurasi CSS**:
   - Aplikasi menggunakan **Tailwind CSS v4** dengan integrasi `@tailwindcss/vite`.
   - Seluruh kustomisasi tema dilakukan di file `resources/css/app.css` pada direktori `@theme` (bukan menggunakan file `tailwind.config.js` lama).
   - **DILARANG MERUSAK / DOWNGRADE DEPENDENSI CSS**: Ketika menginstal paket baru (misal: Laravel Breeze di Fase 3), pastikan versi `tailwindcss` di `package.json` tidak diturunkan (downgrade) ke versi `^3.1.0`. 
   - **TIDAK BOLEH MENIMPA app.css**: Jangan menimpa berkas `resources/css/app.css` kustom dengan format direktif Tailwind v3 (`@tailwind base;` dll.). Jika berkas tertimpa secara otomatis oleh Breeze, segera kembalikan ke konfigurasi `@import 'tailwindcss';` dan `@theme` kustom.
   - **DILARANG MENGGUNAKAN KONFIGURASI LAMA**: Jangan menggunakan/menambahkan berkas `tailwind.config.js` dan `postcss.config.js` ke dalam proyek karena akan bentrok dengan compiler Tailwind v4 di Vite. Jika berkas tersebut ter-generate otomatis, silakan langsung dihapus.

2. **Skema Warna Pertanian Modern (Fresh Green)**:
   - Warna hijau utama disepakati adalah **`#BAD284`** (di-map ke kelas `emerald-500` di `app.css`).
   - Warna teks/tombol hijau gelap menggunakan **`#9DB36E`** (di-map ke kelas `emerald-600`).
   - Gunakan selalu utilitas warna `emerald` (misal: `bg-emerald-600`, `text-emerald-700`, `border-emerald-200/50`) untuk warna hijau aplikasi agar warnanya presisi dan konsisten.

3. **Aturan Tipografi (Font System)**:
   - Font Body (Sans-serif): **Plus Jakarta Sans** (cukup panggil `font-sans` di HTML/Blade).
   - Font Angka/Statistik (Display): **Outfit** (panggil `font-outfit`).
   - Font Judul Khusus/Miring (Serif): **Instrument Serif** (panggil `font-serif italic`).

4. **Ikonografi (Ikon Hugeicons)**:
   - **Dilarang keras** menggunakan emotikon biasa (`😀`, `🌾`, `⚙️`) di dalam aplikasi.
   - Gunakan CDN Hugeicons yang sudah terpasang di layout utama.
   - Contoh penulisan ikon: `<i class="hgi-stroke hgi-leaf-01"></i>`.
   - Gunakan ikon yang terbukti aktif/valid:
     - Tanaman / Rekomendasi: `hgi-leaf-01`
     - Pengaturan / Manajemen: `hgi-settings-01`
     - Analisis / Statistik: `hgi-analytics-01`
     - Hara / Uji Lahan: `hgi-test-tube`
     - Riwayat / Log: `hgi-database-01` atau `hgi-note`
     - Lahan / Segmentasi: `hgi-mountain`

5. **Spesifikasi Tombol**:
   - Untuk menjaga kebersihan UI, tinggi tombol didesain ringkas. Gunakan kelas padding **`px-6 py-2.5 text-sm font-semibold rounded-full`** (bukan tombol besar `py-4 px-8 text-lg`).
   - Hindari penambahan ikon berlebihan pada tombol tindakan utama (seperti tombol "Mulai Sekarang" yang dibuat polos tanpa ikon).

6. **Desain Penomoran Langkah (Cara Kerja)**:
   - Mengikuti desain ala KosRank, nomor langkah (`01`, `02`, `03`) diletakkan secara absolut di sebelah kiri ikon pembungkus (`absolute top-1/2 right-full mr-2 -translate-y-1/2 text-4xl sm:text-5xl font-black font-outfit text-slate-400 select-none transition-colors duration-300 group-hover:text-emerald-500`).
   - Ikon pembungkus langkah berukuran `w-14 h-14 sm:w-16 sm:h-16 rounded-full bg-emerald-50`.

