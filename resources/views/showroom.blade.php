<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VR 3D Showroom - FAA Frozen Food & Bakery</title>
    <link href="{{ asset('template-sarab/css/bootstrap.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('template-sarab/css/style.css') }}" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body { background: #000; padding-top: 85px; height: 100vh; overflow: hidden; }
        .showroom-container { height: calc(100vh - 85px); width: 100%; position: relative; }
        .showroom-overlay { position: absolute; inset: 0; background: rgba(0,0,0,0.6); display: flex; flex-direction: column; align-items: center; justify-content: center; color: #fff; text-align: center; z-index: 10; padding: 20px; transition: opacity 0.5s; }
        .showroom-overlay.hidden { opacity: 0; pointer-events: none; }
        .btn-enter { background: #e50914; color: #fff; border: none; padding: 15px 40px; border-radius: 50px; font-weight: 800; text-transform: uppercase; letter-spacing: 2px; transition: all 0.3s; }
        .btn-enter:hover { background: #fff; color: #e50914; transform: scale(1.1); }
        #showroomFrame { width: 100%; height: 100%; border: none; }
    </style>
</head>
<body>
    @include('layouts.partials.navbar')

    <div class="showroom-container">
        <div class="showroom-overlay" id="overlay">
            <div class="mb-4">
                <i class="bi bi-unity" style="font-size: 4rem; color: #e50914;"></i>
            </div>
            <h1 class="fw-bold mb-3">Selamat Datang di VR 3D Showroom</h1>
            <p class="lead mb-4">Jelajahi toko kami secara virtual dan lihat produk-produk pilihan kami dalam tampilan 3D yang interaktif.</p>
            <button class="btn-enter" onclick="enterShowroom()">Masuk ke Showroom</button>
        </div>

        <!-- Placeholder for actual 3D content / Matterport / Unity WebGL -->
        <iframe id="showroomFrame" src="https://www.google.com/maps/embed?pb=!4v1717424400000!6m8!1m7!1sCAoSLEFGMVFpcE5mYlZqWG9vYjdfZl9OaU9uTV9vYjdfZl9OaU9uTV9vYjdfZl9OaU9u!2m2!1d-1.8504601!2d106.1104212!3f0!4f0!5f0.7820865974627469" allowfullscreen></iframe>
    </div>

    <script>
        function enterShowroom() {
            document.getElementById('overlay').classList.add('hidden');
        }
    </script>
</body>
</html>