# Checklist Kesesuaian Project Akhir Pemrograman Web Framework

Project: **Smart Farming Web App - Random Forest dan K-Means Crop Recommendation**  
Framework: **Laravel dan FastAPI**  
Tujuan file ini: digunakan oleh AI coding agent untuk mengecek apakah aplikasi web sudah memenuhi seluruh ketentuan tugas mata kuliah Pemrograman Web Framework.

---

## 1. Checklist Kesesuaian Topik dan Ruang Lingkup

- [x] Aplikasi web selaras dengan tema project Data Mining kelompok.
- [x] Topik aplikasi berada dalam konteks **Living Lab**.
- [x] Topik aplikasi berkaitan dengan **Smart Farming** atau **Smart Fisheries**.
- [x] Aplikasi mendukung kebutuhan nyata, data, proses bisnis, monitoring, pengelolaan informasi, atau sistem pendukung keputusan.
- [x] Aplikasi web digunakan sebagai antarmuka untuk menampilkan data, hasil analisis, hasil prediksi, visualisasi, atau rekomendasi dari project Data Mining.
- [x] Aplikasi memiliki fitur yang relevan dengan studi kasus Smart Farming.
- [x] Aplikasi tidak hanya berupa tampilan statis, tetapi memiliki alur data dan fitur yang berjalan.

### Catatan untuk SmartFarm

Pastikan aplikasi menjelaskan keterkaitan dengan project Data Mining:

- Dataset Crop Recommendation.
- Random Forest untuk rekomendasi jenis tanaman.
- K-Means untuk clustering kondisi lahan.
- Input kondisi tanah/lingkungan oleh pengguna.
- Output berupa rekomendasi tanaman dan/atau hasil cluster lahan.

---

## 2. Checklist Ketentuan Teknologi

Aplikasi wajib menggunakan framework yang sesuai dengan materi perkuliahan, yaitu **React dan/atau Laravel**.

- [x] Aplikasi menggunakan **Laravel** sebagai web framework utama.
- [x] Jika menggunakan frontend tambahan, pastikan masih terintegrasi dengan Laravel atau dijelaskan perannya.
- [x] Jika menggunakan FastAPI untuk model ML, pastikan posisinya dijelaskan sebagai service pendukung, bukan pengganti framework utama.
- [x] Laravel memiliki routing yang jelas.
- [x] Laravel memiliki controller untuk mengelola logika aplikasi.
- [x] Laravel memiliki model untuk merepresentasikan data.
- [x] Laravel memiliki view/template untuk menampilkan antarmuka pengguna.
- [x] Aplikasi menggunakan database untuk menyimpan dan mengelola data.
- [x] Aplikasi memiliki validasi input pada form.
- [x] Aplikasi memiliki autentikasi pengguna jika ada fitur dengan hak akses.
- [x] Aplikasi memiliki fitur CRUD sesuai kebutuhan aplikasi.

---

## 3. Checklist Komponen Web Framework

### 3.1 Routing

- [x] Terdapat route untuk landing page.
- [x] Terdapat route untuk login.
- [x] Terdapat route untuk logout.
- [x] Terdapat route untuk dashboard.
- [x] Terdapat route untuk manajemen data utama.
- [x] Terdapat route untuk tambah data.
- [x] Terdapat route untuk detail/tampil data.
- [x] Terdapat route untuk edit data.
- [x] Terdapat route untuk hapus data.
- [x] Terdapat route untuk prediksi/rekomendasi tanaman.
- [x] Terdapat route atau endpoint untuk komunikasi dengan service FastAPI jika digunakan.
- [x] Route yang membutuhkan login dilindungi middleware auth.
- [ ] Route admin dilindungi middleware role/authorization jika ada lebih dari satu peran. *(N/A - Hanya ada 1 peran user)*

### 3.2 Controller

- [x] Setiap fitur utama memiliki controller yang sesuai.
- [x] Controller tidak terlalu penuh dengan logika yang seharusnya berada di service/model.
- [x] Controller menangani request, validasi, proses data, dan response dengan jelas.
- [x] Controller untuk prediksi/rekomendasi memanggil service FastAPI atau logic ML dengan aman.
- [x] Controller mengembalikan pesan berhasil/gagal setelah proses create, update, delete, atau prediksi.

### 3.3 Model

- [x] Model dibuat untuk data utama aplikasi.
- [x] Model memiliki fillable/guarded yang sesuai.
- [x] Relasi antar model dibuat jika dibutuhkan.
- [x] Model digunakan dalam proses CRUD.
- [x] Model tidak hanya dibuat tetapi benar-benar dipakai di controller atau service.

### 3.4 View / Template / UI

- [x] Aplikasi memiliki tampilan landing page.
- [x] Aplikasi memiliki tampilan login.
- [x] Aplikasi memiliki tampilan dashboard.
- [x] Aplikasi memiliki tampilan daftar data.
- [x] Aplikasi memiliki tampilan form tambah data.
- [x] Aplikasi memiliki tampilan form edit data.
- [x] Aplikasi memiliki tampilan detail/hasil rekomendasi.
- [x] Tampilan responsif atau minimal rapi pada ukuran layar laptop.
- [x] UI mudah dipahami oleh pengguna.
- [x] Terdapat navigasi yang jelas antar halaman.

### 3.5 Database

- [x] Database digunakan untuk menyimpan data aplikasi.
- [x] Migration tersedia untuk tabel utama.
- [x] Tabel users tersedia untuk autentikasi.
- [x] Tabel data utama aplikasi tersedia.
- [x] Tabel riwayat prediksi/rekomendasi tersedia jika fitur tersebut digunakan.
- [x] Seeder tersedia jika aplikasi membutuhkan data awal.
- [x] Struktur database dijelaskan di laporan.
- [x] File database atau migration siap dikumpulkan.

### 3.6 Validasi Input

- [x] Form login divalidasi.
- [x] Form data utama divalidasi.
- [x] Form input rekomendasi/prediksi divalidasi.
- [x] Input numerik seperti N, P, K, temperature, humidity, ph, dan rainfall divalidasi sebagai angka.
- [x] Input memiliki batas nilai wajar jika memungkinkan.
- [x] Pesan error validasi tampil di UI.
- [x] Data tidak valid tidak boleh masuk ke database.

### 3.7 Autentikasi dan Otorisasi

- [x] Aplikasi memiliki fitur login.
- [x] Aplikasi memiliki fitur logout.
- [x] Halaman dashboard hanya bisa diakses setelah login.
- [ ] Jika ada role admin/user, setiap role memiliki hak akses yang jelas. *(N/A - Hanya ada 1 peran user)*
- [ ] User biasa tidak bisa mengakses fitur admin. *(N/A - Hanya ada 1 peran user)*
- [ ] Admin dapat mengelola data utama jika fitur ini dibuat. *(N/A - Hanya ada 1 peran user)*
- [ ] Mekanisme otorisasi dijelaskan di laporan jika digunakan. *(N/A - Hanya ada 1 peran user)*

---

## 4. Checklist Fitur Minimal Aplikasi

Berdasarkan ketentuan tugas, fitur minimal yang harus tersedia adalah sebagai berikut.

- [x] Halaman utama atau landing page tersedia.
- [x] Fitur login tersedia.
- [x] Fitur logout tersedia.
- [x] Manajemen data utama aplikasi tersedia.
- [x] Operasi tambah data tersedia.
- [x] Operasi tampil/lihat data tersedia.
- [x] Operasi ubah data tersedia.
- [x] Operasi hapus data tersedia.
- [x] Validasi form tersedia.
- [x] Pesan berhasil tampil setelah aksi sukses.
- [x] Pesan gagal/error tampil saat aksi gagal.
- [x] Daftar data ditampilkan dalam bentuk tabel, kartu, atau tampilan lain yang sesuai.
- [ ] Fitur pencarian, filter, atau pengurutan tersedia jika relevan.
- [x] Dashboard atau ringkasan informasi tersedia.
- [ ] Pengaturan hak akses pengguna tersedia jika terdapat lebih dari satu peran. *(N/A - Hanya ada 1 peran user)*

---

## 5. Checklist Fitur yang Disarankan untuk SmartFarm

Bagian ini bukan semua wajib dari dosen, tetapi sangat disarankan agar aplikasi terlihat relevan dengan project Data Mining.

### 5.1 Fitur Rekomendasi Tanaman

- [x] User dapat menginput nilai N.
- [x] User dapat menginput nilai P.
- [x] User dapat menginput nilai K.
- [x] User dapat menginput temperature.
- [x] User dapat menginput humidity.
- [x] User dapat menginput ph.
- [x] User dapat menginput rainfall.
- [x] Sistem mengirim input ke model Random Forest melalui FastAPI atau service ML.
- [x] Sistem menampilkan hasil rekomendasi tanaman.
- [ ] Sistem menampilkan confidence/probability jika tersedia. *(Model di FastAPI saat ini tidak mengembalikan confidence score)*
- [x] Sistem menyimpan riwayat rekomendasi ke database jika fitur riwayat dibuat.

### 5.2 Fitur Clustering Lahan

- [x] Sistem menggunakan input kondisi lahan untuk menentukan cluster.
- [x] Sistem menampilkan hasil cluster dari K-Means.
- [x] Sistem menjelaskan makna cluster secara sederhana.
- [x] Sistem menampilkan interpretasi cluster, misalnya lembap/basah, kering/panas, atau sedang/stabil sesuai hasil project.
- [x] Sistem menyimpan hasil clustering jika fitur riwayat dibuat.

### 5.3 Dashboard

- [x] Dashboard menampilkan jumlah data utama.
- [x] Dashboard menampilkan jumlah riwayat rekomendasi/prediksi jika ada.
- [ ] Dashboard menampilkan ringkasan tanaman yang sering direkomendasikan jika ada data. *(Hanya menampilkan tanaman terbaru dan daftar riwayat terkini)*
- [ ] Dashboard menampilkan ringkasan cluster lahan jika ada data. *(Hanya menampilkan klasifikasi terbaru dan daftar riwayat terkini)*
- [x] Dashboard memiliki tampilan yang rapi dan mudah dipahami.

### 5.4 Manajemen Data

- [x] Admin dapat menambah data utama. *(User bertindak sebagai admin datanya sendiri)*
- [x] Admin dapat melihat daftar data utama.
- [x] Admin dapat mengubah data utama.
- [x] Admin dapat menghapus data utama.
- [x] Data utama relevan dengan Smart Farming, misalnya data lahan, data tanaman, data input kondisi tanah, atau riwayat rekomendasi.

---

## 6. Checklist Integrasi Laravel dan FastAPI

Gunakan bagian ini jika aplikasi memakai Laravel sebagai web app dan FastAPI sebagai service machine learning.

- [x] Laravel tetap menjadi aplikasi web utama.
- [x] FastAPI hanya digunakan sebagai API/service model ML.
- [x] Endpoint FastAPI untuk prediksi Random Forest tersedia.
- [x] Endpoint FastAPI untuk clustering K-Means tersedia jika clustering digunakan.
- [x] Laravel dapat mengirim request ke FastAPI.
- [x] Laravel dapat menerima response dari FastAPI.
- [x] Error dari FastAPI ditangani di Laravel.
- [x] Jika FastAPI mati/error, UI menampilkan pesan gagal yang jelas.
- [x] URL FastAPI disimpan di file `.env`, bukan hardcoded di banyak tempat.
- [x] Dokumentasi endpoint FastAPI ditulis di README atau laporan.

---

## 7. Checklist Kualitas Aplikasi Web

Komponen ini penting karena kualitas aplikasi web memiliki bobot besar dalam penilaian.

- [x] Semua fitur utama berjalan tanpa error.
- [x] Alur aplikasi mudah dipahami.
- [x] Tidak ada halaman kosong atau broken link.
- [x] Tidak ada tombol yang tidak berfungsi.
- [x] Tidak ada route penting yang menghasilkan error 404/500.
- [x] Input user ditangani dengan aman.
- [x] Data berhasil tersimpan ke database.
- [x] Data berhasil diperbarui.
- [x] Data berhasil dihapus.
- [x] Data berhasil ditampilkan kembali setelah disimpan.
- [x] UI konsisten antar halaman.
- [x] Navigasi jelas.
- [x] Aplikasi dapat dijalankan dari repository dengan instruksi yang jelas.

---