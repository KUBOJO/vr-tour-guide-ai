<!DOCTYPE html>
<html>
<head>
    <title><?php echo e($location->name); ?></title>

    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/pannellum@2.5.6/build/pannellum.css"/>

    <script src="https://cdn.jsdelivr.net/npm/pannellum@2.5.6/build/pannellum.js"></script>

    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        html, body {
            margin: 0;
            height: 100%;
            overflow: hidden;
            background: black;
        }

        #panorama {
            width: 100%;
            height: 100vh;
        }

        .info-box {
            position: absolute;
            top: 20px;
            left: 20px;
            z-index: 999;
            background: rgba(0,0,0,0.6);
            padding: 15px;
            border-radius: 12px;
            color: white;
            max-width: 320px;
        }
    </style>
</head>
<body>

    <div class="info-box">

        <h1 class="text-2xl font-bold">
            <?php echo e($location->name); ?>

        </h1>

        <p class="mt-3 text-sm">
            <?php echo e($location->ai_description); ?>

        </p>

        <a href="/vr-location"
           class="inline-block mt-4 bg-white text-black px-4 py-2 rounded-lg">
            Kembali
        </a>

    </div>

    <div id="panorama"></div>

    <script>
        pannellum.viewer('panorama', {
            type: 'equirectangular',

            // 🎯 BYPASS SUKSES: Paksa Pannellum mengambil gambar lewat rute proxy internal Laravel 
            // untuk mengalirkan file biner 'bromo.jpg' / 'politani.jpg' melewati gembok 403 Apache!
            panorama: "<?php echo e(url('/get-locations-image/' . basename($location->image_path))); ?>",

            autoLoad: true,

            showZoomCtrl: true,

            compass: false,

            autoRotate: -2,

            draggable: true,

            mouseZoom: true,

            showFullscreenCtrl: true,

            orientationOnByDefault: true
        });
    </script>

</body>
</html><?php /**PATH D:\laragon\www\WEB-VR\resources\views/vr/show.blade.php ENDPATH**/ ?>