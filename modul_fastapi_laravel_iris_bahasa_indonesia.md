# Modul Implementasi FastAPI + Laravel: Pengembangan Web Prediksi Bunga Iris

**Penulis:** Gede Aditra Pradnyana  
**Tanggal:** June 14, 2026

---

## 1. Pendahuluan

Modul ini membimbing mahasiswa dalam mengembangkan aplikasi web prediksi sederhana berbasis machine learning dengan menggunakan FastAPI sebagai layanan inferensi berbasis Python dan Laravel sebagai antarmuka web utama. Studi kasus yang digunakan adalah klasifikasi bunga Iris dengan model Multi-Layer Perceptron (MLP). Modul ini menekankan integrasi antara inferensi machine learning dan aplikasi web melalui API berbasis JSON, dengan pemisahan tanggung jawab yang jelas antara lapisan penyajian model dan lapisan aplikasi yang berinteraksi dengan pengguna.

## 2. Capaian Pembelajaran

Setelah menyelesaikan modul ini, mahasiswa diharapkan mampu:

1. Menjelaskan peran arsitektur berbasis API dalam mengintegrasikan model machine learning dengan aplikasi web.
2. Melatih model MLP sederhana menggunakan dataset Iris.
3. Menyimpan dan memuat model machine learning terlatih untuk proses inferensi.
4. Mengembangkan endpoint FastAPI untuk menerima data masukan dan mengembalikan hasil prediksi.
5. Mengembangkan formulir Laravel untuk mengumpulkan data masukan dari pengguna.
6. Menghubungkan Laravel dengan API prediksi FastAPI menggunakan permintaan HTTP.
7. Menginterpretasikan keluaran prediksi, termasuk kelas prediksi dan skor keyakinan.
8. Mengidentifikasi pertimbangan dasar untuk deployment aplikasi web berbasis machine learning.

## 3. Prasyarat Pengetahuan

Mahasiswa sebaiknya memiliki pengetahuan dasar tentang:

- Pemrograman Python;
- Dasar-dasar PHP dan Laravel;
- Konsep dasar machine learning, khususnya klasifikasi;
- Metode HTTP, terutama GET dan POST;
- Format data JSON;
- Penggunaan command line atau terminal.

## 4. Latar Belakang Konseptual

### 4.1 FastAPI

FastAPI adalah framework web Python modern yang dirancang untuk membangun API. FastAPI menggunakan type hints Python untuk mendefinisikan dan memvalidasi data masukan. Dalam deployment machine learning, FastAPI berguna karena model terlatih dapat diekspos melalui endpoint HTTP sehingga sistem lain, seperti Laravel, dapat meminta hasil prediksi.

### 4.2 Laravel

Laravel adalah framework web berbasis PHP yang banyak digunakan untuk membangun aplikasi web terstruktur. Dalam modul ini, Laravel bertanggung jawab terhadap interaksi pengguna, yaitu menampilkan formulir, memvalidasi input, mengirim data ke FastAPI, dan menyajikan hasil prediksi kepada pengguna.

### 4.3 Inferensi Machine Learning

Inferensi machine learning adalah proses menggunakan model yang telah dilatih untuk memprediksi keluaran dari data baru. Dalam modul ini, proses inferensi dipisahkan dari antarmuka web. FastAPI menangani inferensi, sedangkan Laravel menangani antarmuka pengguna.

### 4.4 Dataset Iris

Dataset Iris merupakan dataset klasik untuk kasus klasifikasi. Setiap sampel memiliki empat fitur numerik:

1. Panjang sepal;
2. Lebar sepal;
3. Panjang petal;
4. Lebar petal.

Kelas target pada dataset Iris adalah:

- Iris setosa;
- Iris versicolor;
- Iris virginica.

Dokumentasi dataset: <https://archive.ics.uci.edu/dataset/53/iris>

## 5. Arsitektur Sistem

Arsitektur sistem secara konseptual ditunjukkan sebagai berikut.

```text
Browser Pengguna
        ↓
Aplikasi Web Laravel
        ↓ JSON HTTP POST
API Prediksi FastAPI
        ↓
Model MLP Terlatih
        ↓ Hasil Prediksi
Halaman Hasil Laravel
```

Pemisahan tanggung jawab setiap komponen dirangkum pada Tabel 1.

**Tabel 1. Tanggung Jawab Setiap Komponen**

| Komponen | Tanggung Jawab |
|---|---|
| FastAPI | Memuat model terlatih dan mengembalikan hasil prediksi melalui endpoint API. |
| Laravel | Menyediakan antarmuka web, mengumpulkan input pengguna, mengirim permintaan HTTP, dan menampilkan hasil prediksi. |
| Model MLP | Melakukan klasifikasi berdasarkan empat ukuran bunga Iris. |
| JSON | Menjadi format komunikasi antara Laravel dan FastAPI. |

## 6. Bagian I: Mengembangkan Model Machine Learning di Google Colab

Pada bagian ini, proses pelatihan model machine learning dilakukan menggunakan Google Colab. Google Colab digunakan karena menyediakan lingkungan Python berbasis cloud sehingga mahasiswa tidak perlu melakukan instalasi Python dan dependensi machine learning secara manual pada komputer lokal. Setelah model selesai dilatih, model disimpan dalam format joblib dan diunduh untuk digunakan pada proyek FastAPI.

### 6.1 Persiapan Notebook Google Colab

Langkah awal yang dilakukan adalah membuat notebook baru pada Google Colab. Mahasiswa dapat membuka Google Colab melalui browser, kemudian memilih menu **New Notebook**. Pastikan runtime yang digunakan adalah Python.

Jika diperlukan, dependensi dapat dipasang melalui sel berikut.

**Kode 1. Instalasi dependensi pada Google Colab**

```bash
!pip install -q scikit-learn numpy joblib
```

Google Colab umumnya sudah menyediakan pustaka seperti `scikit-learn`, `numpy`, dan `joblib`. Namun, perintah instalasi di atas tetap dapat digunakan untuk memastikan bahwa seluruh dependensi yang diperlukan tersedia.

### 6.2 Melatih Model MLP pada Google Colab

Selanjutnya, model Multi-Layer Perceptron (MLP) dilatih menggunakan dataset Iris yang tersedia pada pustaka `scikit-learn`. Model disusun dalam bentuk pipeline yang terdiri atas `StandardScaler` dan `MLPClassifier`. Penggunaan pipeline penting karena proses standardisasi data akan ikut tersimpan bersama model sehingga tahap preprocessing dan prediksi dapat dilakukan secara konsisten.

**Kode 2. Pelatihan model MLP menggunakan dataset Iris pada Google Colab**

```python
from sklearn.datasets import load_iris
from sklearn.model_selection import train_test_split
from sklearn.preprocessing import StandardScaler
from sklearn.neural_network import MLPClassifier
from sklearn.pipeline import Pipeline
from sklearn.metrics import accuracy_score, classification_report
import joblib

# Memuat dataset Iris
iris = load_iris()
X = iris.data
y = iris.target

# Membagi data menjadi data latih dan data uji
X_train, X_test, y_train, y_test = train_test_split(
    X,
    y,
    test_size=0.2,
    random_state=42,
    stratify=y
)

# Membangun pipeline model
model = Pipeline([
    ("scaler", StandardScaler()),
    ("classifier", MLPClassifier(
        hidden_layer_sizes=(16, 8),
        activation="relu",
        solver="adam",
        max_iter=1000,
        random_state=42
    ))
])

# Melatih model
model.fit(X_train, y_train)

# Mengevaluasi model
y_pred = model.predict(X_test)
accuracy = accuracy_score(y_test, y_pred)

print("Akurasi:", accuracy)
print(classification_report(y_test, y_pred, target_names=iris.target_names))

# Menyimpan model beserta metadata
model_bundle = {
    "model": model,
    "target_names": iris.target_names.tolist(),
    "feature_names": iris.feature_names
}

joblib.dump(model_bundle, "iris_mlp_model.joblib")

print("Model berhasil disimpan sebagai iris_mlp_model.joblib")
```

### 6.3 Mengunduh Model dari Google Colab

Setelah model berhasil disimpan, file `iris_mlp_model.joblib` perlu diunduh dari Google Colab agar dapat digunakan pada proyek FastAPI.

**Kode 3. Mengunduh file model dari Google Colab**

```python
from google.colab import files

files.download("iris_mlp_model.joblib")
```

File `iris_mlp_model.joblib` yang telah diunduh kemudian dipindahkan ke folder proyek FastAPI.

### 6.4 Struktur Proyek FastAPI Setelah Model Diunduh

Setelah proses training selesai dilakukan di Google Colab, struktur proyek FastAPI pada komputer lokal atau server cukup berisi file utama aplikasi API, file dependensi, dan file model yang telah diunduh.

**Kode 4. Struktur proyek FastAPI setelah model diunduh**

```text
iris-fastapi-api/
|-- main.py
|-- requirements.txt
|-- iris_mlp_model.joblib
```

File `requirements.txt` untuk proyek FastAPI dapat berisi dependensi berikut.

**Kode 5. Isi file requirements.txt untuk proyek FastAPI**

```txt
fastapi
uvicorn
scikit-learn
numpy
joblib
```

Dependensi tersebut diperlukan agar FastAPI dapat berjalan dan model `joblib` yang dibuat di Google Colab dapat dimuat kembali pada saat proses prediksi.

### 6.5 Diskusi

Pada pendekatan ini, Google Colab digunakan hanya untuk proses pelatihan model. Setelah model selesai dilatih, model disimpan dalam format `joblib` dan diunduh untuk digunakan pada aplikasi FastAPI. Dengan demikian, FastAPI tidak perlu melakukan pelatihan ulang, tetapi hanya memuat model terlatih dan melakukan inferensi ketika menerima permintaan prediksi dari Laravel.

Model yang disimpan dalam file `iris_mlp_model.joblib` tidak hanya berisi classifier MLP, tetapi juga pipeline preprocessing berupa `StandardScaler`. Hal ini penting karena data input baru yang dikirim dari Laravel akan melalui proses standardisasi yang sama seperti data saat pelatihan. Dengan demikian, proses prediksi menjadi lebih konsisten dan mengurangi risiko perbedaan perlakuan antara data latih dan data prediksi.

## 7. Bagian II: Membangun Layanan Prediksi dengan FastAPI

### 7.1 Membuat API

Buat file `main.py`.

**Kode 6. API prediksi dengan FastAPI**

```python
from fastapi import FastAPI
from pydantic import BaseModel
import joblib
import numpy as np

app = FastAPI(title="API Prediksi Iris dengan MLP")

model_bundle = joblib.load("iris_mlp_model.joblib")
model = model_bundle["model"]
target_names = model_bundle["target_names"]
feature_names = model_bundle["feature_names"]


class IrisInput(BaseModel):
    sepal_length: float
    sepal_width: float
    petal_length: float
    petal_width: float


@app.get("/")
def root():
    return {
        "message": "API Prediksi Iris dengan MLP sedang berjalan",
        "features": feature_names,
        "classes": target_names
    }


@app.post("/predict")
def predict(data: IrisInput):
    features = np.array([[
        data.sepal_length,
        data.sepal_width,
        data.petal_length,
        data.petal_width
    ]])

    prediction_id = int(model.predict(features)[0])
    prediction_label = target_names[prediction_id]

    probabilities = model.predict_proba(features)[0]
    confidence = float(np.max(probabilities))

    return {
        "status": "success",
        "prediction_id": prediction_id,
        "prediction_label": prediction_label,
        "confidence": confidence,
        "probabilities": {
            target_names[i]: float(probabilities[i])
            for i in range(len(target_names))
        }
    }
```

### 7.2 Menjalankan FastAPI

Jalankan API menggunakan Uvicorn.

**Kode 7. Menjalankan aplikasi FastAPI**

```bash
uvicorn main:app --reload
```

API akan berjalan pada alamat:

**Kode 8. Alamat lokal FastAPI**

```text
http://127.0.0.1:8000
```

Dokumentasi API interaktif tersedia pada alamat:

**Kode 9. Alamat dokumentasi interaktif**

```text
http://127.0.0.1:8000/docs
```

### 7.3 Menguji API

Gunakan perintah berikut untuk menguji API.

**Kode 10. Pengujian API menggunakan curl**

```bash
curl -X POST http://127.0.0.1:8000/predict \
  -H "Content-Type: application/json" \
  -d '{"sepal_length":5.1,"sepal_width":3.5,"petal_length":1.4,"petal_width":0.2}'
```

Contoh hasil yang diharapkan:

**Kode 11. Contoh respons API**

```json
{
  "status": "success",
  "prediction_id": 0,
  "prediction_label": "setosa",
  "confidence": 0.99
}
```

## 8. Bagian III: Mengembangkan Aplikasi Web Laravel

### 8.1 Membuat Proyek Laravel

Buat proyek Laravel.

**Kode 12. Membuat proyek Laravel**

```bash
composer create-project laravel/laravel iris-laravel-app
cd iris-laravel-app
php artisan serve
```

Laravel biasanya berjalan pada alamat:

**Kode 13. Alamat lokal Laravel**

```text
http://127.0.0.1:8000
```

Namun, FastAPI telah menggunakan port 8000 pada modul ini. Oleh karena itu, jalankan Laravel menggunakan port lain.

**Kode 14. Menjalankan Laravel pada port 8080**

```bash
php artisan serve --port=8080
```

Laravel akan berjalan pada alamat:

**Kode 15. Alamat alternatif Laravel**

```text
http://127.0.0.1:8080
```

### 8.2 Mengonfigurasi URL FastAPI

Tambahkan variabel berikut pada file `.env` Laravel.

**Kode 16. Variabel lingkungan Laravel**

```env
FASTAPI_URL=http://127.0.0.1:8000
```

Buka file `config/services.php`, kemudian tambahkan konfigurasi berikut.

**Kode 17. Menambahkan konfigurasi FastAPI pada services.php**

```php
'fastapi' => [
    'url' => env('FASTAPI_URL', 'http://127.0.0.1:8000'),
],
```

### 8.3 Membuat Controller

Buat controller dengan perintah berikut.

**Kode 18. Membuat controller Laravel**

```bash
php artisan make:controller IrisPredictionController
```

Buka file `app/Http/Controllers/IrisPredictionController.php`.

**Kode 19. Controller Laravel untuk prediksi Iris**

```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class IrisPredictionController extends Controller
{
    public function index()
    {
        return view('iris.form');
    }

    public function predict(Request $request)
    {
        $validated = $request->validate([
            'sepal_length' => 'required|numeric|min:0|max:10',
            'sepal_width' => 'required|numeric|min:0|max:10',
            'petal_length' => 'required|numeric|min:0|max:10',
            'petal_width' => 'required|numeric|min:0|max:10',
        ]);

        $response = Http::timeout(10)->post(
            config('services.fastapi.url') . '/predict',
            [
                'sepal_length' => (float) $validated['sepal_length'],
                'sepal_width' => (float) $validated['sepal_width'],
                'petal_length' => (float) $validated['petal_length'],
                'petal_width' => (float) $validated['petal_width'],
            ]
        );

        if ($response->failed()) {
            return back()
                ->withInput()
                ->withErrors([
                    'prediction' => 'API prediksi tidak tersedia.'
                ]);
        }

        $result = $response->json();

        return view('iris.result', [
            'input' => $validated,
            'result' => $result
        ]);
    }
}
```

### 8.4 Mendefinisikan Route

Buka file `routes/web.php`.

**Kode 20. Route web Laravel**

```php
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IrisPredictionController;

Route::get('/', function () {
    return redirect()->route('iris.form');
});

Route::get('/iris', [IrisPredictionController::class, 'index'])
    ->name('iris.form');

Route::post('/iris/predict', [IrisPredictionController::class, 'predict'])
    ->name('iris.predict');
```

### 8.5 Membuat Tampilan Formulir

Buat folder berikut.

**Kode 21. Membuat folder view**

```bash
mkdir -p resources/views/iris
```

Buat file `resources/views/iris/form.blade.php`.

**Kode 22. Tampilan form Laravel Blade**

```php
<!DOCTYPE html>
<html>
<head>
    <title>Prediksi Iris</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; max-width: 700px; }
        label { display: block; margin-top: 12px; }
        input { width: 100%; padding: 8px; margin-top: 4px; }
        button { margin-top: 16px; padding: 10px 18px; }
        .error { color: red; }
        .example { background: #f5f5f5; padding: 12px; margin-top: 20px; }
    </style>
</head>
<body>

<h2>Prediksi Jenis Bunga Iris</h2>
<p>Masukkan ukuran bunga Iris, kemudian kirim formulir untuk memperoleh hasil prediksi.</p>

@if ($errors->any())
    <div class="error">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('iris.predict') }}">
    @csrf

    <label>Panjang Sepal</label>
    <input type="number" step="0.01" name="sepal_length"
           value="{{ old('sepal_length', 5.1) }}" required>

    <label>Lebar Sepal</label>
    <input type="number" step="0.01" name="sepal_width"
           value="{{ old('sepal_width', 3.5) }}" required>

    <label>Panjang Petal</label>
    <input type="number" step="0.01" name="petal_length"
           value="{{ old('petal_length', 1.4) }}" required>

    <label>Lebar Petal</label>
    <input type="number" step="0.01" name="petal_width"
           value="{{ old('petal_width', 0.2) }}" required>

    <button type="submit">Prediksi</button>
</form>

<div class="example">
    <h4>Contoh Input</h4>
    <p><strong>Setosa:</strong> 5.1, 3.5, 1.4, 0.2</p>
    <p><strong>Versicolor:</strong> 6.0, 2.9, 4.5, 1.5</p>
    <p><strong>Virginica:</strong> 6.5, 3.0, 5.8, 2.2</p>
</div>

</body>
</html>
```

### 8.6 Membuat Tampilan Hasil

Buat file `resources/views/iris/result.blade.php`.

**Kode 23. Tampilan hasil Laravel Blade**

```php
<!DOCTYPE html>
<html>
<head>
    <title>Hasil Prediksi Iris</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; max-width: 700px; }
        table { border-collapse: collapse; width: 100%; margin-top: 16px; }
        th, td { border: 1px solid #ddd; padding: 8px; }
        .result { background: #f5f5f5; padding: 16px; margin-top: 20px; }
    </style>
</head>
<body>

<h2>Hasil Prediksi</h2>

<div class="result">
    <p><strong>Kelas Prediksi:</strong> {{ $result['prediction_label'] }}</p>
    <p><strong>Confidence:</strong> {{ number_format($result['confidence'] * 100, 2) }}%</p>
</div>

<h3>Data Input</h3>
<table>
    <tr><th>Fitur</th><th>Nilai</th></tr>
    <tr><td>Panjang Sepal</td><td>{{ $input['sepal_length'] }}</td></tr>
    <tr><td>Lebar Sepal</td><td>{{ $input['sepal_width'] }}</td></tr>
    <tr><td>Panjang Petal</td><td>{{ $input['petal_length'] }}</td></tr>
    <tr><td>Lebar Petal</td><td>{{ $input['petal_width'] }}</td></tr>
</table>

<h3>Probabilitas Kelas</h3>
<table>
    <tr><th>Kelas</th><th>Probabilitas</th></tr>
    @foreach ($result['probabilities'] as $class => $probability)
        <tr>
            <td>{{ $class }}</td>
            <td>{{ number_format($probability * 100, 2) }}%</td>
        </tr>
    @endforeach
</table>

<p><a href="{{ route('iris.form') }}">Coba prediksi lain</a></p>

</body>
</html>
```

## 9. Bagian IV: Menjalankan Sistem Secara Lengkap

### 9.1 Menjalankan FastAPI

Buka terminal pertama.

**Kode 24. Menjalankan FastAPI**

```bash
cd iris-fastapi-api
source venv/bin/activate
uvicorn main:app --reload
```

FastAPI berjalan pada alamat:

**Kode 25. Alamat FastAPI**

```text
http://127.0.0.1:8000
```

### 9.2 Menjalankan Laravel

Buka terminal kedua.

**Kode 26. Menjalankan Laravel**

```bash
cd iris-laravel-app
php artisan serve --port=8080
```

Laravel berjalan pada alamat:

**Kode 27. Alamat Laravel**

```text
http://127.0.0.1:8080/iris
```

### 9.3 Alur Kerja yang Diharapkan

1. Pengguna membuka halaman Laravel.
2. Pengguna memasukkan empat ukuran bunga Iris.
3. Laravel memvalidasi data formulir.
4. Laravel mengirim data ke FastAPI melalui permintaan HTTP POST.
5. FastAPI memuat model dan melakukan prediksi.
6. FastAPI mengembalikan hasil prediksi dalam format JSON.
7. Laravel menampilkan hasil prediksi kepada pengguna.

## 10. Bagian V: Pertimbangan Production

Untuk pembelajaran lokal, perintah `uvicorn main:app --reload` sudah memadai. Untuk production, mode `reload` sebaiknya tidak digunakan. Deployment yang lebih sesuai untuk production dapat menggunakan Uvicorn atau Gunicorn di belakang reverse proxy seperti Nginx.

Contoh perintah yang lebih sesuai untuk production:

**Kode 28. Perintah Uvicorn untuk production sederhana**

```bash
uvicorn main:app --host 127.0.0.1 --port 8000
```

Arsitektur deployment yang umum adalah:

```text
Nginx / Apache
        ↓
Aplikasi Laravel
        ↓ Permintaan HTTP Internal
FastAPI + Uvicorn / Gunicorn
        ↓
Model ML Terlatih
```

Rekomendasi penting untuk production:

- Lakukan validasi input pada Laravel dan FastAPI.
- Jangan membuka API prediksi ke publik tanpa autentikasi.
- Gunakan HTTPS untuk endpoint publik.
- Catat log permintaan prediksi dan kesalahan sistem.
- Pantau penggunaan memori, terutama jika menggunakan model besar.
- Simpan file model pada direktori yang terlindungi.
- Hindari memuat file model dari sumber yang tidak tepercaya.

## 11. Referensi

1. FastAPI Documentation. <https://fastapi.tiangolo.com/>
2. Laravel Documentation: HTTP Client. <https://laravel.com/docs/13.x/http-client>
3. scikit-learn Documentation: MLPClassifier. <https://scikit-learn.org/stable/modules/generated/sklearn.neural_network.MLPClassifier.html>
4. scikit-learn Documentation: Pipeline. <https://scikit-learn.org/stable/modules/generated/sklearn.pipeline.Pipeline.html>
5. scikit-learn Documentation: StandardScaler. <https://scikit-learn.org/stable/modules/generated/sklearn.preprocessing.StandardScaler.html>
