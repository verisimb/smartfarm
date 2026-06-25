from fastapi import FastAPI
from pydantic import BaseModel
import joblib
import pandas as pd
import os

app = FastAPI(title="SmartFarm ML Service")

# Menggunakan absolute path agar model dapat dimuat terlepas dari tempat menjalankan server
BASE_DIR = os.path.dirname(os.path.abspath(__file__))
RF_MODEL_PATH = os.path.join(BASE_DIR, "random_forest_crop_recommendation.pkl")
KMEANS_MODEL_PATH = os.path.join(BASE_DIR, "kmeans_land_clustering.pkl")

# Load model bundles
rf_bundle = joblib.load(RF_MODEL_PATH)
kmeans_bundle = joblib.load(KMEANS_MODEL_PATH)

# Ekstraksi komponen Random Forest
rf_model = rf_bundle["model"]
rf_feature_columns = rf_bundle["feature_columns"]

# Ekstraksi komponen K-Means
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
    return {"message": "SmartFarm ML Service is running"}


@app.post("/predict")
def predict(data: PredictionRequest):
    # Buat dataframe awal dari data input
    input_data = pd.DataFrame([{
        "N": data.N,
        "P": data.P,
        "K": data.K,
        "temperature": data.temperature,
        "humidity": data.humidity,
        "ph": data.ph,
        "rainfall": data.rainfall,
    }])

    # 1. Prediksi Rekomendasi Tanaman dengan Random Forest
    rf_input = input_data[rf_feature_columns]
    recommended_crop = rf_model.predict(rf_input)[0]

    # 2. Prediksi Segmentasi Lahan dengan K-Means
    kmeans_input = input_data[kmeans_feature_columns]
    scaled_input = scaler.transform(kmeans_input)
    cluster = int(kmeans_model.predict(scaled_input)[0])
    land_type = cluster_label_map.get(cluster, "Tipe lahan tidak diketahui")

    return {
        "recommended_crop": recommended_crop,
        "cluster": cluster,
        "land_type": land_type
    }
