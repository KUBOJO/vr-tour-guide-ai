<?php

namespace App\Http\Controllers;

use App\Models\Location360;
use App\Models\UserQuery;
use App\Models\JadwalOp; // 🎯 Tambahan: Panggil model Jadwal OP lo untuk RAG Terpusat

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class VoiceAIController extends Controller
{
    public function process(Request $request)
    {
        // VALIDASI
        $request->validate([
            'audio' => 'required|file',
            'location_id' => 'required',
        ]);

        /*
        |--------------------------------------------------------------------------
        | 1. SIMPAN AUDIO USER (SEMENTARA DI LOKAL LARAVEL)
        |--------------------------------------------------------------------------
        */
        $audioPath = $request->file('audio')->store(
            'voice-records',
            'public'
        );

        $audioFullPath = storage_path(
            'app/public/' . $audioPath
        );

        /*
        |--------------------------------------------------------------------------
        | 2. AMBIL DATA JADWAL OP (RAG UTAMA) & LOKASI VR KOORDINAT
        |--------------------------------------------------------------------------
        */
        $location = Location360::findOrFail(
            $request->location_id
        );

        // 🎯 AMUNISI RAG: Ambil semua data jadwal kegiatan OP yang ada di database Filament lo
        $allJadwal = JadwalOp::all();
        
        // Kita gabungkan data jadwalnya menjadi satu string terstruktur agar mudah dibaca Ollama
        $jadwalText = "DATA JADWAL OPERATIONAL ORIENTATION TRIP 2026:\n";
        foreach ($allJadwal as $j) {
            $jadwalText .= "- Tanggal: {$j->tanggal} | Lokasi: {$j->lokasi} | Kegiatan: {$j->kegiatan} | Status: {$j->status}\n";
        }

        /*
        |--------------------------------------------------------------------------
        | 3. TEMBAK PIPELINE LOKAL AI SERVER (FASTAPI PORT 8000)
        |--------------------------------------------------------------------------
        */
        try {
            // Kita tembak endpoint FastAPI lokal lo dengan membawa data gabungan jadwal OP
            $localAIResponse = Http::timeout(300)
                ->withoutVerifying() // Tetap jaga-jaga dari blocker SSL lokal
                ->attach(
                    'audio',
                    fopen($audioFullPath, 'r'),
                    'voice.webm',
                    ['Content-Type' => 'audio/webm']
                )
                ->post('http://127.0.0.1:8000/api/local-voice-ai', [
                    // 🎯 SEKARANG KITA KUNCI DATANYA MENGGUNAKAN JADWAL OP DARI FILAMENT
                    'location_desc' => $jadwalText 
                ]);

            if ($localAIResponse->failed()) {
                Log::error('Local AI Server Error: ' . $localAIResponse->body());
                return response()->json(['success' => false, 'error' => 'Server AI lokal gagal memproses permintaan.'], 500);
            }

            // Ambil data hasil eksekusi dari FastAPI
            $aiData = $localAIResponse->json();

            if (!isset($aiData['success']) || !$aiData['success']) {
                return response()->json(['success' => false, 'error' => $aiData['error'] ?? 'Terjadi kesalahan sistem AI.'], 500);
            }

            $questionText = $aiData['user_question'];
            $aiText = $aiData['ai_answer'];
            
            // 🎯 AMBIL ID LOKASI OTOMATIS: Hasil ekstraksi JSON dari Ollama Python
            $detectedLocationId = $aiData['detected_location_id'] ?? null;
            
            // Ekstrak nama file mp3 saja dari return Python lo
            $rawAudioUrl = $aiData['audio_url'];
            $filename = basename(parse_url($rawAudioUrl, PHP_URL_PATH));

            // Ubah jalurnya menjadi HTTPS lokal Laravel melalui Proxy
            $secureAudioUrl = "/get-ai-audio/" . $filename;

        } catch (\Exception $e) {
            Log::error('Local AI Pipeline Exception: ' . $e->getMessage());
            return response()->json(['success' => false, 'error' => 'Koneksi ke server AI lokal (Port 8000) terputus, pastikan app.py sudah dinyalakan Jhon!'], 500);
        }

        /*
        |--------------------------------------------------------------------------
        | 4. SIMPAN KE DATABASE (Menggunakan Jalur HTTPS Proxy yang Aman)
        |--------------------------------------------------------------------------
        */
        $query = UserQuery::create([
            'user_name' => 'Guest User',
            'question' => $questionText,
            'ai_response' => $aiText,
            'audio_path' => $secureAudioUrl, // Tersimpan aman sebagai "/get-ai-audio/response_xxxx.mp3"
            'location_id' => $location->id,
            'status' => 'answered',
        ]);

        /*
        |--------------------------------------------------------------------------
        | 5. RESPONSE KE FRONTEND HP SAMSUNG LO (100% Bebas dari Gembok Mixed Content)
        |--------------------------------------------------------------------------
        */
        return response()->json([
            'success' => true,
            'question' => $questionText,
            'answer' => $aiText,
            'audio_url' => $secureAudioUrl, // Dilempar aman ke JavaScript Frontend
            'location' => $location->name,
            'query_id' => $query->id,
            // 🎯 KUNCI INTERAKTIF: Loloskan ID ini ke JavaScript Blade agar layar otomatis bergeser sendiri tanpa klik!
            'detected_location_id' => $detectedLocationId 
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | 🎯 PROXY JALUR TALANG EMAS HTTPS
    |--------------------------------------------------------------------------
    */
    public function getAudioProxy($filename)
    {
        try {
            // Jemput file mp3 dari folder statis FastAPI secara lokal di laptop lo
            $response = Http::get("http://127.0.0.1:8000/static_audio/" . $filename);

            if ($response->successful()) {
                return response($response->body(), 200)
                    ->header('Content-Type', 'audio/mpeg')
                    ->header('Cache-Control', 'no-cache, no-store, must-revalidate')
                    ->header('Access-Control-Allow-Origin', '*');
            }
        } catch (\Exception $e) {
            Log::error("Proxy Audio Gagal menjemput file: " . $e->getMessage());
        }

        abort(404, 'File audio tidak ditemukan atau Server Python mati.');
    }
}