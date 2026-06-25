<?php

namespace App\Http\Controllers;

use App\Models\LandPrediction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class LandPredictionController extends Controller
{
    /**
     * Display the dashboard with user stats.
     */
    public function dashboard()
    {
        $userId = auth()->id();
        
        $totalPredictions = LandPrediction::where('user_id', $userId)->count();
        $latestPredictions = LandPrediction::where('user_id', $userId)->latest()->take(5)->get();
        
        $latestPrediction = LandPrediction::where('user_id', $userId)->latest()->first();
        $latestCrop = $latestPrediction ? $latestPrediction->recommended_crop : null;

        return view('dashboard', compact('totalPredictions', 'latestPredictions', 'latestCrop'));
    }

    /**
     * Display a listing of the predictions.
     */
    public function index()
    {
        $predictions = LandPrediction::where('user_id', auth()->id())->latest()->get();
        return view('predictions.index', compact('predictions'));
    }

    /**
     * Show the form for creating a new prediction.
     */
    public function create()
    {
        return view('predictions.create');
    }

    /**
     * Store a newly created prediction in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'N' => ['required', 'numeric', 'min:0'],
            'P' => ['required', 'numeric', 'min:0'],
            'K' => ['required', 'numeric', 'min:0'],
            'temperature' => ['required', 'numeric'],
            'humidity' => ['required', 'numeric', 'min:0', 'max:100'],
            'ph' => ['required', 'numeric', 'min:0', 'max:14'],
            'rainfall' => ['required', 'numeric', 'min:0'],
        ]);

        $apiUrl = config('services.fastapi.url', 'http://127.0.0.1:8001') . '/predict';

        try {
            $response = Http::timeout(5)->post($apiUrl, [
                'N' => (float) $validated['N'],
                'P' => (float) $validated['P'],
                'K' => (float) $validated['K'],
                'temperature' => (float) $validated['temperature'],
                'humidity' => (float) $validated['humidity'],
                'ph' => (float) $validated['ph'],
                'rainfall' => (float) $validated['rainfall'],
            ]);

            if ($response->failed()) {
                Log::error('FastAPI prediction service failed response', ['status' => $response->status(), 'body' => $response->body()]);
                return back()->withErrors([
                    'api_error' => 'Gagal menghubungi service prediksi. Silakan coba beberapa saat lagi.'
                ])->withInput();
            }

            $result = $response->json();
        } catch (\Exception $e) {
            Log::error('FastAPI connection exception', ['message' => $e->getMessage()]);
            return back()->withErrors([
                'api_error' => 'Koneksi ke service prediksi terputus. Pastikan FastAPI ML Service dalam keadaan aktif.'
            ])->withInput();
        }

        $prediction = auth()->user()->landPredictions()->create([
            'N' => $validated['N'],
            'P' => $validated['P'],
            'K' => $validated['K'],
            'temperature' => $validated['temperature'],
            'humidity' => $validated['humidity'],
            'ph' => $validated['ph'],
            'rainfall' => $validated['rainfall'],
            'recommended_crop' => $result['recommended_crop'] ?? 'Unknown',
            'cluster' => $result['cluster'] ?? 0,
            'land_type' => $result['land_type'] ?? 'Unknown',
        ]);

        return redirect()->route('predictions.show', $prediction->id)
            ->with('success', 'Prediksi berhasil dibuat.');
    }

    /**
     * Display the specified prediction.
     */
    public function show(string $id)
    {
        $prediction = LandPrediction::where('user_id', auth()->id())->findOrFail($id);
        return view('predictions.show', compact('prediction'));
    }

    /**
     * Show the form for editing the specified prediction.
     */
    public function edit(string $id)
    {
        $prediction = LandPrediction::where('user_id', auth()->id())->findOrFail($id);
        return view('predictions.edit', compact('prediction'));
    }

    /**
     * Update the specified prediction in storage.
     */
    public function update(Request $request, string $id)
    {
        $prediction = LandPrediction::where('user_id', auth()->id())->findOrFail($id);

        $validated = $request->validate([
            'N' => ['required', 'numeric', 'min:0'],
            'P' => ['required', 'numeric', 'min:0'],
            'K' => ['required', 'numeric', 'min:0'],
            'temperature' => ['required', 'numeric'],
            'humidity' => ['required', 'numeric', 'min:0', 'max:100'],
            'ph' => ['required', 'numeric', 'min:0', 'max:14'],
            'rainfall' => ['required', 'numeric', 'min:0'],
        ]);

        $apiUrl = config('services.fastapi.url', 'http://127.0.0.1:8001') . '/predict';

        try {
            $response = Http::timeout(5)->post($apiUrl, [
                'N' => (float) $validated['N'],
                'P' => (float) $validated['P'],
                'K' => (float) $validated['K'],
                'temperature' => (float) $validated['temperature'],
                'humidity' => (float) $validated['humidity'],
                'ph' => (float) $validated['ph'],
                'rainfall' => (float) $validated['rainfall'],
            ]);

            if ($response->failed()) {
                Log::error('FastAPI prediction service failed response on update', ['status' => $response->status(), 'body' => $response->body()]);
                return back()->withErrors([
                    'api_error' => 'Gagal menghubungi service prediksi. Silakan coba beberapa saat lagi.'
                ])->withInput();
            }

            $result = $response->json();
        } catch (\Exception $e) {
            Log::error('FastAPI connection exception on update', ['message' => $e->getMessage()]);
            return back()->withErrors([
                'api_error' => 'Koneksi ke service prediksi terputus. Pastikan FastAPI ML Service dalam keadaan aktif.'
            ])->withInput();
        }

        $prediction->update([
            'N' => $validated['N'],
            'P' => $validated['P'],
            'K' => $validated['K'],
            'temperature' => $validated['temperature'],
            'humidity' => $validated['humidity'],
            'ph' => $validated['ph'],
            'rainfall' => $validated['rainfall'],
            'recommended_crop' => $result['recommended_crop'] ?? 'Unknown',
            'cluster' => $result['cluster'] ?? 0,
            'land_type' => $result['land_type'] ?? 'Unknown',
        ]);

        return redirect()->route('predictions.show', $prediction->id)
            ->with('success', 'Prediksi berhasil diperbarui.');
    }

    /**
     * Remove the specified prediction from storage.
     */
    public function destroy(string $id)
    {
        $prediction = LandPrediction::where('user_id', auth()->id())->findOrFail($id);
        $prediction->delete();

        return redirect()->route('predictions.index')
            ->with('success', 'Prediksi berhasil dihapus.');
    }
}
