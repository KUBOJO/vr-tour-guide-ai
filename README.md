# 🤖 VR Tour Guide AI - Intelligent 360° Virtual Reality

Aplikasi asisten tur virtual berbasis Kecerdasan Buatan (AI) yang dirancang khusus untuk memandu jalannya kegiatan **Orientation Trip (OP) Kampus Politani Samarinda 2026** menuju Malang - Bromo.

---

## 📌 Latar Belakang & Alasan Pembuatan Proyek

Proyek ini dikembangkan sebagai solusi inovatif dalam memodernisasi penyampaian informasi operasional trip kampus. Alasan utama pengembangan sistem ini antara lain:
1. **Efisiensi Informasi Operasional:** Menggantikan selebaran jadwal konvensional yang kaku menjadi asisten pintar yang interaktif dan dapat merespons pertanyaan mahasiswa secara *real-time*.
2. **Implementasi Local AI System (RAG):** Mengunci basis pengetahuan AI (*Retrieval-Augmented Generation*) menggunakan model LLM lokal (`qwen2.5:1.5b` via Ollama) agar sistem tetap aman, bebas biaya API, dan jawaban mutlak terkunci hanya pada dokumen jadwal resmi OP tanpa halusinasi data.
3. **Optimasi Perangkat Ringan:** Membuktikan bahwa teknologi AI tingkat tinggi (STT Whisper + LLM + TTS) tetap dapat dijalankan secara lancar (*lightweight*) di laptop spesifikasi lokal (Axioo Intel Celeron) dan optimal saat diakses oleh gawai mahasiswa (Samsung A07).

---

## ⚠️ Batasan Sistem & Penjelasan Teknis (Keterbatasan Realitas Virtual Sepenuhnya)

Sebagai bentuk evaluasi ilmiah yang jujur, proyek ini **belum mengimplementasikan ekosistem Virtual Reality (VR) sepenuhnya** menggunakan teknologi *Immersive VR* (seperti WebXR API, Unity/Unreal Engine, atau dukungan penuh *Head-Mounted Display* seperti Meta Quest/Google Cardboard). 

Keterbatasan ini didasari oleh beberapa faktor teknis dan efisiensi di lapangan:
1. **Pendekatan Praktis Berbasis Gawai Mahasiswa:** Mahasiswa di lapangan mayoritas mengakses informasi melalui *smartphone* standar tanpa alat bantu kacamata VR. Oleh karena itu, sistem difokuskan pada **Desktop/Mobile Web 360° Panorama** menggunakan library `Pannellum`.
2. **Keterbatasan Komputasi Perangkat Lokal:** Pembuatan aset *Full 3D Immersive VR Room* memerlukan spesifikasi perangkat keras (GPU) yang sangat besar untuk proses rendering. Sistem ini sengaja dirancang seringkas mungkin agar beban komputasi laptop Axioo dan server tetap terjaga di bawah 4 detik per request suara.
3. **Fokus pada Core Intelligent Interaction:** Esensi utama dari proyek PBL ini adalah membangun jembatan interaksi suara cerdas antara manusia dan panorama 360° melalui fitur *Auto-Redirect VR* berbasis pengenalan perintah vokal (*Voice Activation*), bukan pada kedalaman grafis VR itu sendiri.

---

## 🛠️ Fitur Utama Sistem
* 🎤 **Voice Activation / Wake Word:** Cukup ucapkan *"AI kamu harus aktif dong"*, radar mic akan mendengarkan secara otomatis di latar belakang.
* 🤖 **RAG Scheduled System:** AI mengunci jawaban dari database jadwal operasional Filament Laravel.
* 🔄 **Auto-Redirect VR:** Layar web akan bergeser dan memuat panorama lokasi baru secara otomatis tanpa klik jika AI mendeteksi permintaan user lewat suara.



---

## 🚀 Panduan Instalasi Model AI (Untuk Dosen Penguji)

Untuk menjalankan Pipeline AI Lokal di perangkat Anda, silakan ikuti langkah ringkas berikut:

1. **Instalasi Ollama:** Unduh dan instal Ollama melalui situs resmi [ollama.com](https://ollama.com).
2. **Download Model LLM:** Buka CMD/Terminal Anda, lalu jalankan perintah berikut untuk mengunduh model secara otomatis dari server:
   ```bash
   ollama run qwen2.5:1.5b
