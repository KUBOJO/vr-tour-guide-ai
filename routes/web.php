<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VRController;
use App\Http\Controllers\VoiceAIController;
use Illuminate\Support\Facades\Http;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Di sini adalah tempat mendaftarkan semua rute aplikasi VR Tour Guide Politani.
| Rute utama '/' dialihkan agar PWA di HP tidak memunculkan 404 Not Found.
|
*/

// FIX 404 PWA: Mengalihkan rute kosong ke halaman lokasi VR utama
Route::get('/', function () {
    return redirect('/vr-location');
});

// Menampilkan semua daftar lokasi VR
Route::get('/vr-location', [VRController::class, 'index']);

// Menampilkan satu lokasi spesifik berdasarkan ID (Pannellum 360 View)
Route::get('/vr-location/{id}', [VRController::class, 'show']);

// Menangani request rekaman suara dari frontend dan mengirim ke AI (RAG)
Route::post('/voice-ai', [VoiceAIController::class, 'process']);

Route::get('/get-ai-audio/{filename}', function ($filename) {
    // Tembak server FastAPI Python lo secara internal di port 8000 laptop
    $response = Http::get("http://127.0.0.1:8000/static_audio/" . $filename);
    
    if ($response->successful()) {
        return response($response->body(), 200)
            ->header('Content-Type', 'audio/mpeg')
            ->header('Access-Control-Allow-Origin', '*');
    }
    
    abort(404);
});

// Proxy Gambar untuk memotong gembok 403 Apache Laragon saat diakses via Ngrok
Route::get('/get-locations-image/{filename}', function ($filename) {
    $path = storage_path('app/public/locations-360/' . $filename);
    
    if (file_exists($path)) {
        return response()->file($path, [
            'Content-Type' => 'image/jpeg',
            'Access-Control-Allow-Origin' => '*'
        ]);
    }
    
    abort(404);
});