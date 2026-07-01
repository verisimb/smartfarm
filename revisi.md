# Daftar Revisi & Perubahan Project SmartFarm

Berikut adalah daftar lengkap pembaruan, perbaikan visual, pelokalan bahasa, dan peningkatan interaktivitas yang telah diterapkan pada aplikasi web SmartFarm:

---

### 1. Landing Page (`welcome.blade.php`)
*   **Optimalisasi Spacing**: Mengurangi padding vertikal pada section Fitur Utama, Cara Kerja, dan CTA untuk mempersempit jarak antarkonten sehingga alur scroll halaman terasa lebih padat dan menyatu.
*   **Tipografi Judul**: Memperbesar ukuran font heading section utama dari `text-3xl` menjadi `text-4xl md:text-5xl` untuk memberikan penekanan visual yang lebih kuat.

### 2. Dashboard (`dashboard.blade.php`)
*   **Pembersihan Card Redundan**: Menghapus card pencarian/panduan "Lahan Baru Belum Terdaftar?" di kolom bawah untuk menghindari duplikasi fungsi tombol navigasi.
*   **Format Tipe Lahan (Anti-Overflow)**:
    *   Memotong teks klasifikasi panjang di card statistik utama secara dinamis sehingga hanya menampilkan tipe utama (misal: "Lahan Basah / Curah Hujan Tinggi" menjadi **"Lahan Basah"**).
    *   Mengubah pemisah garis miring `/` menjadi kurung tutup-buka di tabel riwayat (misal: **"Lahan Basah (Curah Hujan Tinggi)"**).
*   **Estetika Judul Card**: Mengubah format penulisan judul card statistik dari huruf besar semua (*uppercase*) menjadi huruf kapital awal saja (*Title Case*), serta memperlebar jarak huruf agar tulisan tidak berdempetan.
*   **Pembaruan Label Badge**: Mengubah badge status pada kartu statistik "Total Eksperimen Lahan" dari **"Aktif"** menjadi **"Riwayat"**.
*   **Desain Baru Card Greetings**:
    *   Mengganti latar belakang hijau solid dengan gambar mockup persawahan (`4096x1645.webp`).
    *   Menggunakan pemosisian kustom `object-[center_48%]` dan skala `scale-110` untuk memperlihatkan lanskap sawah secara optimal sekaligus memotong bagian tepi gelap dari gambar asli.
    *   Menerapkan gradasi bayangan hitam sinematik yang tipis (`from-black/85 via-black/35 to-transparent to-75%`) untuk menjaga keterbacaan teks putih.
    *   Mengubah warna tombol "Prediksi Baru" dari putih menjadi warna hijau tema utama (`bg-emerald-600 text-white`).

### 3. Formulir Prediksi Baru & Edit (`predictions/create.blade.php` & `predictions/edit.blade.php`)
*   **Konsistensi Layout**: Mengubah container form menjadi full-width rata kiri secara presisi, menyelaraskannya dengan layout halaman Dashboard dan Riwayat Lahan.
*   **Konfirmasi Batal Simpan**: Menambahkan deteksi *dirty state* Alpine.js pada form edit. Jika pengguna telah mengubah data parameter dan menekan tombol "Batal & Kembali", sistem akan menampilkan modal konfirmasi terlebih dahulu untuk mencegah kehilangan data secara tidak sengaja.

### 4. Layout Global & Sidebar (`layouts/app.blade.php`)
*   **Sidebar Fixed**: Mengubah positioning sidebar desktop dari `sticky` menjadi `fixed h-screen` agar sidebar tetap diam di posisinya dan tidak ikut tertinggal ke atas saat halaman di-scroll ke bawah.
*   **Symmetry Padding**: Menyelaraskan padding kontainer halaman utama menjadi simetris (`p-4 sm:p-6 lg:p-8`) di seluruh ukuran layar.

### 5. Halaman Profil (`profile/edit.blade.php` & Partials)
*   **Pelokalan Penuh**: Menerjemahkan seluruh teks antarmuka (judul, instruksi, form input, pesan sukses, tombol hapus akun) dari Bahasa Inggris bawaan Breeze ke Bahasa Indonesia.
*   **Penyelarasan Kartu**: Mengubah desain kotak panel form agar menggunakan sudut melengkung modern (`rounded-3xl border border-slate-200`) konsisten dengan bagian dashboard.

### 6. Optimasi Modal Konfirmasi (`components/modal.blade.php` & `profile/edit.blade.php`)
*   **Perbaikan Lag Blur**: Menyederhanakan penanganan backdrop modal dan mengganti transisi `transition-all` menjadi transisi spesifik `transition-opacity` untuk menghilangkan delay efek blur saat modal muncul.
*   **Posisi Tengah Simetris**: Memindahkan pemanggilan modal konfirmasi hapus akun ke tingkat root layout untuk memecahkan bug CSS transformasi animasi halaman, sehingga posisi modal terpusat simetris di tengah layar peramban.

---
*Catatan: Seluruh revisi di atas telah diterapkan dan diuji secara lokal.*
