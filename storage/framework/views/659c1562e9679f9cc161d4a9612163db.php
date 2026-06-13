<!DOCTYPE html>
<html lang="id">
<head>

    <?php $config = (new \LaravelPWA\Services\ManifestService)->generate(); echo $__env->make( 'laravelpwa::meta' , ['config' => $config])->render(); ?>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>VR Tour Guide AI</title>

    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body{
            background:#050816;
        }

        .glass{
            background:rgba(255,255,255,0.05);
            backdrop-filter:blur(10px);
            border:1px solid rgba(255,255,255,0.08);
        }

        .hero-gradient{
            background:
            radial-gradient(circle at top left,#2563eb33,transparent 30%),
            radial-gradient(circle at bottom right,#7c3aed33,transparent 30%);
        }

        .card-hover{
            transition:0.3s;
        }

        .card-hover:hover{
            transform:translateY(-5px);
        }

        html{
            scroll-behavior:smooth;
        }

        .admin-button{
            background:linear-gradient(135deg,#06b6d4,#3b82f6);
        }

        .recording{
            animation:pulse 1s infinite;
        }

        @keyframes pulse{
            0%{
                transform:scale(1);
            }
            50%{
                transform:scale(1.05);
            }
            100%{
                transform:scale(1);
            }
        }
    </style>
</head>

<body class="text-white">

<section class="hero-gradient min-h-screen">

    <nav class="w-full px-6 py-5 flex justify-between items-center sticky top-0 z-50 bg-black/30 backdrop-blur-xl border-b border-white/10">

        <h1 class="text-2xl font-bold">
            VR Tour Guide AI
        </h1>

        <div class="flex gap-5 items-center text-sm md:text-base">

            <a href="#panorama" class="hover:text-cyan-400 transition">
                Panorama
            </a>

            <a href="#jadwal" class="hover:text-cyan-400 transition">
                Jadwal OP
            </a>

            <a href="#ai-chat" class="hover:text-cyan-400 transition">
                AI Assistant
            </a>

            <a href="/admin"
               class="admin-button px-5 py-2 rounded-xl font-bold text-white shadow-lg hover:scale-105 transition">
                Dashboard Admin
            </a>

        </div>

    </nav>

    <div class="max-w-6xl mx-auto px-6 py-20">

        <div class="grid md:grid-cols-2 gap-10 items-center">

            <div>

                <p class="text-cyan-400 mb-4 font-semibold">
                    Intelligent VR Tour Guide
                </p>

                <h1 class="text-5xl md:text-6xl font-extrabold leading-tight">
                    Explore Campus & Tourism in
                    <span class="text-cyan-400">
                        360° Virtual Reality
                    </span>
                </h1>

                <p class="text-gray-400 mt-6 text-lg leading-relaxed">
                    Sistem VR Tour Guide berbasis AI menggunakan panorama 360,
                    ringan untuk laptop Axioo dan optimal di Samsung A07.
                </p>

                <div class="flex gap-4 mt-8">

                    <a href="#panorama"
                       class="bg-cyan-500 hover:bg-cyan-400 text-black px-6 py-3 rounded-xl font-bold transition">
                        Explore VR
                    </a>

                    <a href="#ai-chat"
                       class="glass px-6 py-3 rounded-xl hover:bg-white/10 transition">
                        AI Assistant
                    </a>

                </div>

            </div>

            <div>

                <div class="glass rounded-3xl p-5 shadow-2xl">

                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($locations) && $locations->count() > 0): ?>

                        <img src="<?php echo e(url('/get-locations-image/' . basename($locations->first()?->image_path))); ?>" 
                             class="rounded-2xl h-[400px] w-full object-cover">

                    <?php else: ?>

                        <div class="h-[400px] flex items-center justify-center text-gray-500">
                            Belum ada panorama
                        </div>

                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                </div>

            </div>

        </div>

    </div>

</section>

<section id="panorama" class="max-w-6xl mx-auto px-6 py-20">

    <div class="flex justify-between items-center mb-10">

        <div>

            <h2 class="text-4xl font-bold">
                Panorama 360
            </h2>

            <p class="text-gray-400 mt-2">
                Jelajahi lokasi VR interaktif berbasis panorama 360°
            </p>

        </div>

        <div class="glass px-4 py-2 rounded-xl text-sm">

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($locations)): ?>
                <?php echo e($locations->count()); ?> Lokasi
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        </div>

    </div>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($locations) && $locations->count() > 0): ?>

        <div class="grid md:grid-cols-3 gap-8">

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $locations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $location): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>

                <div class="glass rounded-3xl overflow-hidden card-hover shadow-xl">

                    <a href="/vr-location/<?php echo e($location->id); ?>">

                        <div class="relative">

                            <img src="<?php echo e(url('/get-locations-image/' . basename($location->image_path))); ?>"
                                 class="h-64 w-full object-cover">

                            <div class="absolute top-4 right-4 bg-black/60 text-xs px-3 py-1 rounded-full">
                                360°
                            </div>

                        </div>

                    </a>

                    <div class="p-5">

                        <div class="mb-3">
                            <h3 class="text-xl font-bold">
                                <?php echo e($location->name); ?>

                            </h3>
                        </div>

                        <p class="text-gray-400 text-sm leading-relaxed">
                            <?php echo e($location->ai_description); ?>

                        </p>

                        <div class="mt-6 space-y-3">

                            <button
                                id="btn-mic-<?php echo e($location->id); ?>"
                                onclick="startRecording(event, <?php echo e($location->id); ?>)"
                                class="recordBtn bg-red-500 hover:bg-red-400 w-full py-3 rounded-xl font-bold transition">

                                🎤 Tanya AI Dengan Suara

                            </button>

                            <div id="loading-<?php echo e($location->id); ?>"
                                 class="hidden text-yellow-400 text-sm">
                                AI sedang memproses suara...
                            </div>

                            <div id="response-<?php echo e($location->id); ?>"
                                 class="hidden bg-black/30 p-4 rounded-2xl space-y-3">

                                <div>
                                    <p class="text-cyan-400 font-semibold">
                                        Pertanyaan:
                                    </p>

                                    <p id="question-text-<?php echo e($location->id); ?>"></p>
                                </div>

                                <div>
                                    <p class="text-cyan-400 font-semibold">
                                        Jawaban AI:
                                    </p>

                                    <p id="answer-text-<?php echo e($location->id); ?>"></p>
                                </div>

                                <audio
                                    id="audio-player-<?php echo e($location->id); ?>"
                                    controls
                                    class="w-full mt-3">
                                </audio>

                            </div>

                        </div>

                    </div>

                </div>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>

        </div>

    <?php else: ?>

        <div class="glass rounded-3xl p-6 text-gray-400">
            Belum ada panorama tersedia.
        </div>

    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

</section>

<section id="jadwal" class="max-w-6xl mx-auto px-6 py-20">

    <div class="mb-10">

        <h2 class="text-4xl font-bold">
            Jadwal Open Trip
        </h2>

        <p class="text-gray-400 mt-2">
            Informasi jadwal operasional terbaru
        </p>

    </div>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($jadwals) && $jadwals->count() > 0): ?>

        <div class="grid md:grid-cols-2 gap-6">

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $jadwals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $jadwal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>

                <div class="glass rounded-3xl p-6 shadow-xl card-hover">

                    <div class="flex justify-between items-start">

                        <div>

                            <h3 class="text-2xl font-bold">
                                <?php echo e($jadwal->lokasi); ?>

                            </h3>

                            <p class="text-gray-400 mt-3">
                                <?php echo e($jadwal->kegiatan); ?>

                            </p>

                            <p class="text-cyan-400 mt-4 text-sm">
                                <?php echo e($jadwal->tanggal); ?>

                            </p>

                        </div>

                        <div class="bg-cyan-500 text-black text-xs px-3 py-1 rounded-xl font-bold">
                            <?php echo e($jadwal->status); ?>

                        </div>

                    </div>

                </div>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>

        </div>

    <?php else: ?>

        <div class="glass rounded-3xl p-6 text-gray-400">
            Belum ada jadwal operasional tersedia.
        </div>

    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

</section>

<section id="ai-chat" class="max-w-6xl mx-auto px-6 pb-20">

    <div class="mb-10">

        <h2 class="text-4xl font-bold">
            AI Assistant History
        </h2>

        <p class="text-gray-400 mt-2">
            Riwayat pertanyaan user ke AI Tour Guide
        </p>

    </div>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($queries) && $queries->count() > 0): ?>

        <div class="space-y-6">

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $queries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $query): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>

                <div class="glass rounded-3xl p-6 shadow-xl">

                    <div class="flex items-center gap-3 mb-5">

                        <div class="w-12 h-12 rounded-full bg-cyan-500 flex items-center justify-center text-black font-bold">
                            AI
                        </div>

                        <div>

                            <h3 class="font-bold">
                                <?php echo e($query->user_name ?? 'Guest User'); ?>

                            </h3>

                            <p class="text-gray-400 text-sm">
                                AI Tour Conversation
                            </p>

                        </div>

                    </div>

                    <div class="space-y-4">

                        <div class="bg-black/30 rounded-2xl p-4">

                            <p class="text-cyan-400 font-semibold mb-2">
                                Pertanyaan
                            </p>

                            <p>
                                <?php echo e($query->question); ?>

                            </p>

                        </div>

                        <div class="bg-cyan-500/10 rounded-2xl p-4">

                            <p class="text-cyan-400 font-semibold mb-2">
                                Jawaban AI
                            </p>

                            <p class="text-gray-300">
                                <?php echo e($query->ai_response); ?>

                            </p>

                        </div>

                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($query->audio_path): ?>

                            <audio controls class="w-full mt-3">
                                <source src="<?php echo e($query->audio_path); ?>" type="audio/mpeg">
                                Browser kamu tidak mendukung pemutar audio.
                            </audio>

                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                    </div>

                </div>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>

        </div>

    <?php else: ?>

        <div class="glass rounded-3xl p-6 text-gray-400">
            Belum ada riwayat AI Assistant.
        </div>

    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

</section>

<a href="/admin"
   class="fixed bottom-6 right-6 admin-button px-6 py-4 rounded-full shadow-2xl font-bold z-50 hover:scale-110 transition">
    Admin Panel
</a>

<footer class="border-t border-white/10 py-8">

    <div class="max-w-6xl mx-auto px-6 flex flex-col md:flex-row justify-between items-center gap-4">

        <div>

            <h2 class="font-bold text-xl">
                Intelligent VR Tour Guide
            </h2>

            <p class="text-gray-500 text-sm mt-2">
                Powered by Laravel + Filament + Pannellum + AI
            </p>

        </div>

        <div class="text-gray-500 text-sm">
            Optimized for Samsung A07 & Lightweight Devices
        </div>

    </div>

</footer>

<script>

let mediaRecorder;
let audioChunks = [];

async function startRecording(e, locationId)
{
    try{
        const button = e.currentTarget || e.target;

        const stream = await navigator.mediaDevices.getUserMedia({
            audio: true
        });

        mediaRecorder = new MediaRecorder(stream);
        audioChunks = [];

        mediaRecorder.ondataavailable = event => {
            if (event.data && event.data.size > 0) {
                audioChunks.push(event.data);
            }
        };

        mediaRecorder.start();

        button.innerHTML = '⏹️ Stop Recording';
        button.classList.add('recording');

        button.onclick = (event) => stopRecording(event, locationId, button);

    }catch(error){
        console.error(error);
        alert('Microphone tidak diizinkan atau gagal diakses.');
    }
}

async function stopRecording(e, locationId, button)
{
    if (!mediaRecorder || mediaRecorder.state === "inactive") return;

    mediaRecorder.stop();

    mediaRecorder.onstop = async () => {

        button.innerHTML = '🎤 Tanya AI Dengan Suara';
        button.classList.remove('recording');

        button.onclick = (event) => startRecording(event, locationId);

        document
            .getElementById('loading-' + locationId)
            .classList.remove('hidden');

        const audioBlob = new Blob(audioChunks, {
            type:'audio/webm'
        });

        const formData = new FormData();

        formData.append(
            'audio',
            audioBlob,
            'voice.webm'
        );

        formData.append(
            'location_id',
            locationId
        );

        try {
            const response = await fetch('/voice-ai', {
                method:'POST',
                headers:{
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body:formData
            });

            const data = await response.json();

            document.getElementById('loading-' + locationId).classList.add('hidden');

            if (data.success) {
                document.getElementById('response-' + locationId).classList.remove('hidden');
                
                document.getElementById('question-text-' + locationId).innerText = data.question || data.user_question;
                document.getElementById('answer-text-' + locationId).innerText = data.answer || data.ai_answer;
                
                const audioPlayer = document.getElementById('audio-player-' + locationId);
                
                audioPlayer.src = data.audio_url;
                audioPlayer.load();
                
                await audioPlayer.play().catch(err => console.log("Autoplay ditolak, butuh klik user.", err));

                // 🎯 REDIRECT PANORAMA OTOMATIS:
                if (data.detected_location_id) {
                    setTimeout(() => {
                        window.location.href = "/vr-location/" + data.detected_location_id;
                    }, 4000); // Tunggu 4 detik agar user sempat dengar intro audio bicaranya
                }

            } else {
                alert('AI Error: ' + (data.error || 'Terjadi kesalahan pemrosesan AI.'));
            }

        } catch (err) {
            console.error(err);
            alert('Gagal terhubung ke jaringan server.');
            document.getElementById('loading-' + locationId).classList.add('hidden');
        }
    };
}

// =====================================================
// 🎯 RADAR VOICE ACTIVATION DENGAN INTELLIGENT AUTO-STOP
// =====================================================
const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;

if (SpeechRecognition) {
    const recognition = new SpeechRecognition();
    recognition.continuous = true;
    recognition.lang = 'id-ID';
    recognition.interimResults = false;

    recognition.start();

    recognition.onresult = function(event) {
        const currentResultIndex = event.resultIndex;
        const textSpoken = event.results[currentResultIndex][0].transcript.toLowerCase();
        
        console.log("Suara terdeteksi radar: " + textSpoken);

        if (textSpoken.includes("ai kamu harus aktif dong") || textSpoken.includes("ai harus aktif dong")) {
            
            const firstButton = document.querySelector('.recordBtn');
            if (firstButton) {
                console.log("--> Wake Word Cocok! Memulai Perekaman Otomatis...");
                
                // Jika perekam sedang mati, jalankan perekaman otomatis
                if (!mediaRecorder || mediaRecorder.state === "inactive") {
                    firstButton.click(); // Menjalankan fungsi startRecording()
                    
                    // 🔥 AUTO-STOP 5 DETIK: Beri waktu user bicara, lalu kirim tanpa klik!
                    setTimeout(() => {
                        if (mediaRecorder && mediaRecorder.state === "recording") {
                            console.log("--> Durasi 5 detik habis! Mengirim audio secara otomatis...");
                            firstButton.click(); // Menjalankan fungsi stopRecording() otomatis!
                        }
                    }, 5000); 
                }
            }
        }
    };

    recognition.onend = function() {
        recognition.start();
    };
} else {
    console.log("Web Speech API tidak didukung browser.");
}

</script>

</body>
</html><?php /**PATH D:\laragon\www\WEB-VR\resources\views/vr/index.blade.php ENDPATH**/ ?>