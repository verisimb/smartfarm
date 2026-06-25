# Konteks Dasar Project Web Framework

## Nama Project

**SmartFarm: Website Rekomendasi Tanaman dan Segmentasi Kondisi Lahan Berbasis Random Forest dan K-Means**

## Latar Belakang Singkat

Project ini merupakan lanjutan dari project Data Mining yang sudah selesai. Pada project Data Mining, sudah dibuat dua model machine learning:

1. **Random Forest**
   - Digunakan untuk merekomendasikan jenis tanaman berdasarkan kondisi tanah dan lingkungan.

2. **K-Means**
   - Digunakan untuk melakukan clustering atau segmentasi jenis/kondisi lahan.

Website ini dibuat sebagai antarmuka web untuk menggunakan model tersebut. User dapat memasukkan data kondisi lahan, lalu sistem akan menampilkan rekomendasi tanaman dan tipe kondisi lahan.

Project ini dibuat untuk memenuhi tugas akhir mata kuliah **Pemrograman Web Framework**. Berdasarkan ketentuan, aplikasi boleh menggunakan **React dan/atau Laravel**, sehingga project ini akan menggunakan **Laravel saja** untuk bagian web, ditambah **FastAPI** sebagai service model machine learning.

## Stack Teknologi

Gunakan stack berikut:

- **Laravel Blade**
- **MySQL**
- **Laravel Breeze** untuk login/logout
- **FastAPI** untuk service machine learning
- **Python model files sesuai hasil notebook**:
  - `random_forest_crop_recommendation.pkl`
  - `kmeans_land_clustering.pkl`

Tidak perlu menggunakan React.

## Arsitektur Sistem

```text
User / Browser
     ↓
Laravel Blade Web
     ↓
Laravel Controller
     ↓
FastAPI ML Service
     ↓
Random Forest + K-Means + Scaler
     ↓
Laravel menerima hasil prediksi
     ↓
Laravel menyimpan hasil ke MySQL
     ↓
User melihat hasil dan riwayat prediksi
```

## Peran Laravel

Laravel digunakan untuk mengelola seluruh bagian aplikasi web, yaitu:

- Routing halaman
- Controller
- Model database
- Blade view/template
- Login dan logout
- Dashboard
- Form input kondisi lahan
- Validasi input
- Menyimpan hasil prediksi ke database
- Menampilkan riwayat prediksi
- CRUD data prediksi

## Peran FastAPI

FastAPI hanya digunakan untuk menjalankan model machine learning.

FastAPI menerima input:

- N
- P
- K
- temperature
- humidity
- ph
- rainfall

Lalu FastAPI mengembalikan output:

- `recommended_crop`
- `cluster`
- `land_type`

## Fitur Minimal Aplikasi

| Fitur | Keterangan |
|---|---|
| Landing Page | Halaman awal yang menjelaskan SmartCrop, Smart Farming, Random Forest, dan K-Means |
| Login dan Logout | Menggunakan Laravel Breeze |
| Dashboard | Menampilkan ringkasan jumlah prediksi dan riwayat terbaru |
| Form Prediksi Lahan | User menginput N, P, K, temperature, humidity, ph, dan rainfall |
| Proses Prediksi | Laravel mengirim data ke FastAPI dan menerima hasil prediksi |
| Hasil Prediksi | Menampilkan rekomendasi tanaman dan tipe kondisi lahan |
| Riwayat Prediksi | Menampilkan daftar hasil prediksi user |
| Detail Prediksi | Menampilkan detail input dan output prediksi |
| Edit Prediksi | User dapat mengubah data input, lalu sistem melakukan prediksi ulang |
| Hapus Prediksi | User dapat menghapus riwayat prediksi |
| Validasi Form | Semua input wajib angka dan tidak boleh kosong |

## Alur Utama Aplikasi

```text
User membuka website
↓
User login
↓
User masuk dashboard
↓
User klik menu Prediksi Lahan
↓
User mengisi form:
N, P, K, temperature, humidity, ph, rainfall
↓
Laravel memvalidasi input
↓
Laravel mengirim input ke FastAPI
↓
FastAPI menjalankan Random Forest dan K-Means
↓
FastAPI mengembalikan hasil:
recommended_crop, cluster, land_type
↓
Laravel menyimpan input dan hasil ke database
↓
User melihat halaman hasil prediksi
↓
User dapat melihat riwayat, detail, edit, atau hapus prediksi
```

## Endpoint FastAPI

Buat endpoint:

```text
POST /predict
```

Contoh request dari Laravel ke FastAPI:

```json
{
  "N": 90,
  "P": 42,
  "K": 43,
  "temperature": 20.8,
  "humidity": 82.0,
  "ph": 6.5,
  "rainfall": 202.9
}
```

Contoh response dari FastAPI:

```json
{
  "recommended_crop": "rice",
  "cluster": 2,
  "land_type": "Lahan Basah / Curah Hujan Tinggi"
}
```

## Catatan Penting Endpoint FastAPI Berdasarkan Notebook

File model dari notebook tidak berupa model mentah secara langsung, tetapi berupa dictionary/bundle.

Random Forest disimpan sebagai:

```text
random_forest_crop_recommendation.pkl
```

Isi bundle Random Forest:

```python
{
    "model": rf_model,
    "feature_columns": feature_columns,
    "target_column": target_column,
}
```

K-Means disimpan sebagai:

```text
kmeans_land_clustering.pkl
```

Isi bundle K-Means:

```python
{
    "model": kmeans_model,
    "scaler": scaler,
    "feature_columns": feature_columns,
    "cluster_label_map": cluster_label_map,
}
```

Jadi FastAPI jangan menggunakan nama file generic seperti:

```python
model_randomforest.pkl
model_kmeans.pkl
scaler.pkl
```

Gunakan nama file dan struktur bundle yang sesuai dengan notebook:

```python
rf_bundle = joblib.load("random_forest_crop_recommendation.pkl")
kmeans_bundle = joblib.load("kmeans_land_clustering.pkl")

rf_model = rf_bundle["model"]
rf_feature_columns = rf_bundle["feature_columns"]

kmeans_model = kmeans_bundle["model"]
scaler = kmeans_bundle["scaler"]
kmeans_feature_columns = kmeans_bundle["feature_columns"]
cluster_label_map = kmeans_bundle["cluster_label_map"]
```

Urutan fitur harus konsisten dengan notebook:

```python
["N", "P", "K", "temperature", "humidity", "ph", "rainfall"]
```

## Database

Gunakan tabel utama bernama:

```text
land_predictions
```

Struktur tabel:

```text
id
user_id
N
P
K
temperature
humidity
ph
rainfall
recommended_crop
cluster
land_type
created_at
updated_at
```

Relasi:

```text
users has many land_predictions
land_predictions belongs to users
```

## Migration Laravel

Buat migration untuk `land_predictions` dengan field:

```php
Schema::create('land_predictions', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained()->cascadeOnDelete();

    $table->float('N');
    $table->float('P');
    $table->float('K');
    $table->float('temperature');
    $table->float('humidity');
    $table->float('ph');
    $table->float('rainfall');

    $table->string('recommended_crop')->nullable();
    $table->integer('cluster')->nullable();
    $table->string('land_type')->nullable();

    $table->timestamps();
});
```

## Model Laravel

Buat model:

```text
LandPrediction
```

Isi `$fillable`:

```php
protected $fillable = [
    'user_id',
    'N',
    'P',
    'K',
    'temperature',
    'humidity',
    'ph',
    'rainfall',
    'recommended_crop',
    'cluster',
    'land_type',
];
```

Tambahkan relasi:

```php
public function user()
{
    return $this->belongsTo(User::class);
}
```

Tambahkan relasi di model `User`:

```php
public function landPredictions()
{
    return $this->hasMany(LandPrediction::class);
}
```

## Route Laravel

Gunakan route berikut:

```text
GET     /                     Landing page
GET     /dashboard             Dashboard
GET     /predictions           Riwayat prediksi
GET     /predictions/create    Form prediksi
POST    /predictions           Simpan dan proses prediksi
GET     /predictions/{id}      Detail hasil prediksi
GET     /predictions/{id}/edit Edit prediksi
PUT     /predictions/{id}      Update dan prediksi ulang
DELETE  /predictions/{id}      Hapus prediksi
```

Gunakan middleware `auth` untuk semua route selain landing page.

Contoh route:

```php
use App\Http\Controllers\LandPredictionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [LandPredictionController::class, 'dashboard'])->name('dashboard');
    Route::resource('predictions', LandPredictionController::class);
});
```

## Controller Laravel

Buat controller:

```text
LandPredictionController
```

Method yang dibutuhkan:

```text
dashboard()
index()
create()
store()
show()
edit()
update()
destroy()
```

Tugas utama method `store()`:

1. Validasi input.
2. Kirim data ke FastAPI endpoint `/predict`.
3. Ambil response dari FastAPI.
4. Simpan input dan hasil prediksi ke database.
5. Redirect ke halaman detail hasil prediksi.

Tugas utama method `update()`:

1. Validasi input baru.
2. Kirim ulang data ke FastAPI.
3. Update data input dan hasil prediksi di database.
4. Redirect ke halaman detail.

## Validasi Input

Gunakan validasi Laravel:

```php
$request->validate([
    'N' => ['required', 'numeric', 'min:0'],
    'P' => ['required', 'numeric', 'min:0'],
    'K' => ['required', 'numeric', 'min:0'],
    'temperature' => ['required', 'numeric'],
    'humidity' => ['required', 'numeric', 'min:0', 'max:100'],
    'ph' => ['required', 'numeric', 'min:0', 'max:14'],
    'rainfall' => ['required', 'numeric', 'min:0'],
]);
```

## Komunikasi Laravel ke FastAPI

Gunakan Laravel HTTP Client:

```php
use Illuminate\Support\Facades\Http;
```

Contoh:

```php
$response = Http::post(config('services.fastapi.url') . '/predict', [
    'N' => $validated['N'],
    'P' => $validated['P'],
    'K' => $validated['K'],
    'temperature' => $validated['temperature'],
    'humidity' => $validated['humidity'],
    'ph' => $validated['ph'],
    'rainfall' => $validated['rainfall'],
]);

if ($response->failed()) {
    return back()->withErrors([
        'prediction' => 'Gagal menghubungi service prediksi.'
    ])->withInput();
}

$result = $response->json();
```

Tambahkan konfigurasi di `.env`:

```env
FASTAPI_URL=http://127.0.0.1:8001
```

Tambahkan di `config/services.php`:

```php
'fastapi' => [
    'url' => env('FASTAPI_URL', 'http://127.0.0.1:8001'),
],
```

## Struktur View Blade

Buat halaman Blade berikut:

```text
resources/views/welcome.blade.php
resources/views/dashboard.blade.php
resources/views/predictions/index.blade.php
resources/views/predictions/create.blade.php
resources/views/predictions/show.blade.php
resources/views/predictions/edit.blade.php
```

## Isi Halaman

### Landing Page

Berisi:

- Nama aplikasi SmartCrop
- Deskripsi singkat
- Penjelasan bahwa sistem menggunakan Random Forest dan K-Means
- Tombol Login
- Tombol Register

### Dashboard

Berisi:

- Total prediksi user
- Prediksi terbaru
- Tanaman yang terakhir direkomendasikan
- Tombol “Buat Prediksi Baru”

### Form Prediksi

Field:

- N
- P
- K
- temperature
- humidity
- ph
- rainfall

Button:

- Submit / Prediksi

### Halaman Hasil

Tampilkan:

- Data input lahan
- Rekomendasi tanaman
- Cluster
- Tipe kondisi lahan
- Waktu prediksi
- Tombol kembali ke riwayat
- Tombol edit
- Tombol hapus

### Riwayat Prediksi

Tampilkan dalam tabel:

- Tanggal
- N
- P
- K
- temperature
- humidity
- ph
- rainfall
- recommended_crop
- land_type
- aksi detail/edit/hapus

## Struktur FastAPI App

Buat folder terpisah, misalnya:

```text
ml-service/
```

Isi minimal:

```text
ml-service/
├── main.py
├── random_forest_crop_recommendation.pkl
├── kmeans_land_clustering.pkl
└── requirements.txt
```

`requirements.txt`:

```text
fastapi
uvicorn
scikit-learn
joblib
pandas
numpy
pydantic
```

FastAPI harus:

1. Load bundle model saat aplikasi berjalan.
2. Menerima input dari Laravel.
3. Membuat DataFrame fitur sesuai urutan notebook:
   - N
   - P
   - K
   - temperature
   - humidity
   - ph
   - rainfall
4. Prediksi tanaman dengan Random Forest.
5. Scaling fitur dengan scaler dari bundle K-Means.
6. Prediksi cluster dengan K-Means.
7. Mapping cluster ke `land_type` menggunakan `cluster_label_map` dari bundle K-Means.
8. Return JSON.

## Contoh FastAPI yang Sesuai Notebook

```python
from fastapi import FastAPI
from pydantic import BaseModel
import joblib
import pandas as pd

app = FastAPI()

rf_bundle = joblib.load("random_forest_crop_recommendation.pkl")
kmeans_bundle = joblib.load("kmeans_land_clustering.pkl")

rf_model = rf_bundle["model"]
rf_feature_columns = rf_bundle["feature_columns"]

kmeans_model = kmeans_bundle["model"]
scaler = kmeans_bundle["scaler"]
kmeans_feature_columns = kmeans_bundle["feature_columns"]
cluster_label_map = kmeans_bundle["cluster_label_map"]


class PredictionRequest(BaseModel):
    N: float
    P: float
    K: float
    temperature: float
    humidity: float
    ph: float
    rainfall: float


@app.get("/")
def root():
    return {"message": "SmartCrop ML Service is running"}


@app.post("/predict")
def predict(data: PredictionRequest):
    input_data = pd.DataFrame([{
        "N": data.N,
        "P": data.P,
        "K": data.K,
        "temperature": data.temperature,
        "humidity": data.humidity,
        "ph": data.ph,
        "rainfall": data.rainfall,
    }])

    # Pastikan urutan fitur sesuai dengan model Random Forest dari notebook
    rf_input = input_data[rf_feature_columns]
    recommended_crop = rf_model.predict(rf_input)[0]

    # Pastikan urutan fitur sesuai dengan K-Means dari notebook
    kmeans_input = input_data[kmeans_feature_columns]
    scaled_input = scaler.transform(kmeans_input)

    cluster = int(kmeans_model.predict(scaled_input)[0])
    land_type = cluster_label_map.get(cluster, "Tipe lahan tidak diketahui")

    return {
        "recommended_crop": recommended_crop,
        "cluster": cluster,
        "land_type": land_type
    }
```

## Cara Menjalankan FastAPI

Masuk ke folder `ml-service`, lalu jalankan:

```bash
uvicorn main:app --reload --port 8001
```

Test endpoint:

```bash
curl -X POST http://127.0.0.1:8001/predict \
  -H "Content-Type: application/json" \
  -d '{
    "N": 90,
    "P": 42,
    "K": 43,
    "temperature": 20.8,
    "humidity": 82.0,
    "ph": 6.5,
    "rainfall": 202.9
  }'
```

Expected response:

```json
{
  "recommended_crop": "rice",
  "cluster": 2,
  "land_type": "Lahan Basah / Curah Hujan Tinggi"
}
```

Catatan: nilai `cluster` dan `land_type` dapat berbeda tergantung hasil model K-Means dan mapping `cluster_label_map` dari notebook. Gunakan mapping dari bundle model, bukan mapping manual hardcode di Laravel.

## Catatan Penting

- Jangan buat fitur terlalu kompleks.
- Fokus utama adalah aplikasi web bisa berjalan, user bisa login, input data, mendapat hasil prediksi, dan melihat riwayat.
- Tidak perlu membuat fitur training ulang model dari website.
- Tidak perlu upload CSV.
- Tidak perlu CRUD dataset penuh.
- Tidak perlu admin panel kompleks.
- FastAPI hanya menjadi service prediksi.
- Laravel menjadi aplikasi utama untuk user.
- Gunakan mapping `cluster_label_map` dari file `kmeans_land_clustering.pkl`.
- Pastikan nama file model sesuai dengan hasil notebook.
- Pastikan urutan fitur input sesuai dengan `feature_columns` dari bundle model.

## Output Akhir yang Diharapkan

Aplikasi akhir harus memiliki:

1. Website Laravel Blade yang bisa dijalankan.
2. Login dan logout.
3. Form input kondisi lahan.
4. Integrasi ke FastAPI.
5. Hasil rekomendasi tanaman dari Random Forest.
6. Hasil tipe kondisi lahan dari K-Means.
7. Data tersimpan di MySQL.
8. Riwayat prediksi.
9. CRUD riwayat prediksi.
10. Tampilan sederhana tetapi rapi dan mudah dipahami.
