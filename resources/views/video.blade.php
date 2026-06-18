<!DOCTYPE html>
<html lang="id">
<head>
    <style>
        /* Hero Section Styling */
        .video-hero {
            position: relative;
            height: 420px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .hero-bg {
            position: absolute;
            inset: 0;
            background: url('{{ asset('template-sarab/img/frozen-banner.jpg') }}') no-repeat center center / cover;
            will-change: transform;
        }

        .hero-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(229,9,20,0.85) 0%, rgba(15,15,15,0.75) 60%, rgba(185,28,28,0.6) 100%);
        }

        .hero-grid {
            position: absolute;
            inset: 0;
            background-image:
                linear-gradient(rgba(255,255,255,0.04) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,0.04) 1px, transparent 1px);
            background-size: 60px 60px;
        }

        .hero-content {
            position: relative;
            z-index: 10;
            text-align: center;
            padding: 0 24px;
        }

        .video-hero h1 {
            font-family: 'Playfair Display', serif;
            font-size: clamp(40px, 7vw, 78px);
            font-weight: 900;
            color: #ffffff;
            line-height: 1;
            letter-spacing: -2px;
            margin-bottom: 22px;
        }

        .video-hero p {
            font-size: 1.1rem;
            max-width: 700px;
            margin: 0 auto;
            color: #ffffff !important;
            opacity: 0.9;
        }

        .hero-breadcrumb {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 2px;
            color: #ffffff;
            margin-top: 20px;
        }

        .hero-breadcrumb a { color: #ffffff; text-decoration: none; transition: color 0.2s; opacity: 0.8; }
        .hero-breadcrumb a:hover { opacity: 1; }
        .hero-breadcrumb .crumb-active { color: #f59e0b; }
        .hero-breadcrumb .sep { color: rgba(255,255,255,0.25); }

        .hero-wave {
            position: absolute;
            bottom: -1px;
            left: 0;
            right: 0;
        }

        /* Section Styling */
        section {
            padding: 80px 0;
        }

        .section-title {
            font-family: 'Playfair Display', serif;
            font-weight: 800;
            font-size: 2.5rem;
            color: #333;
            margin-bottom: 20px;
            position: relative;
            display: inline-block;
        }

        .section-title::after {
            content: "";
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 4px;
            background: #e50914;
            border-radius: 2px;
        }

        /* Video Card Styling */
        .video-card {
            background: #fff;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 8px 8px 20px rgba(0, 0, 0, 0.05), -5px -5px 15px rgba(255, 255, 255, 0.8);
            transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            height: 100%;
            border: 1px solid rgba(0, 0, 0, 0.02);
            position: relative;
        }

        .video-card:hover {
            transform: translateY(-15px);
            box-shadow: 0 25px 50px rgba(229, 9, 20, 0.15);
            border-color: rgba(229, 9, 20, 0.1);
        }

        .video-thumb-wrapper {
            position: relative;
            aspect-ratio: 16/9;
            overflow: hidden;
            background: #000;
        }

        .video-thumb {
            width: 100%;
            height: 100%;
            object-fit: cover;
            opacity: 0.8;
            transition: all 0.8s cubic-bezier(0.165, 0.84, 0.44, 1);
        }

        .video-card:hover .video-thumb {
            opacity: 1;
            transform: scale(1.1);
        }

        .play-btn {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 70px;
            height: 70px;
            background: #e50914;
            color: #fff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            box-shadow: 0 0 20px rgba(229, 9, 20, 0.5);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            z-index: 2;
            border: 3px solid #fff;
        }

        .video-card:hover .play-btn {
            transform: translate(-50%, -50%) scale(1.15) rotate(360deg);
            background: #ffffff;
            color: #e50914;
            box-shadow: 0 0 30px rgba(255, 255, 255, 0.4);
        }

        .video-info {
            padding: 25px;
        }

        .video-info h5 {
            font-weight: 700;
            color: #333;
            margin-bottom: 10px;
            line-height: 1.4;
        }

        .video-info p {
            color: #666;
            font-size: 0.9rem;
            margin-bottom: 0;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        /* Modal Customization */
        .modal-content {
            background: transparent;
            border: none;
        }

        .modal-body {
            padding: 0;
        }

        .btn-close-white {
            filter: invert(1) grayscale(100%) brightness(200%);
            position: absolute;
            right: -30px;
            top: -30px;
            opacity: 1;
        }

        @media (max-width: 768px) {
            .btn-close-white {
                right: 0;
                top: -40px;
            }
        }
    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Video Dokumentasi - FAA Frozen Food & Bakery</title>
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700;900&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet"/>
    
    <!-- CSS Assets -->
    <link href="{{ asset('template-sarab/css/bootstrap.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('template-sarab/css/aos.css') }}" rel="stylesheet"/>
    <link href="{{ asset('template-sarab/css/all.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('template-sarab/css/style.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>

    @include('layouts.partials.navbar')

    <!-- Hero Section -->
    <section class="video-hero">
        <div class="hero-bg"></div>
        <div class="hero-overlay"></div>
        <div class="hero-grid"></div>

        <div class="hero-content" data-aos="fade-up">
            <h1>Video Dokumentasi</h1>
            <p>Saksikan berbagai keseruan kegiatan dan proses pembuatan produk terbaik dari FAA Frozen Food & Bakery.</p>
            <nav class="hero-breadcrumb">
                <a href="{{ route('welcome') }}">Beranda</a>
                <span class="sep">/</span>
                <span class="crumb-active">Video</span>
            </nav>
        </div>

        <svg class="hero-wave" viewBox="0 0 1440 60" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
            <path d="M0 60 L0 30 Q360 0 720 30 Q1080 60 1440 30 L1440 60 Z" fill="#ffffff"/>
        </svg>
    </section>

    <!-- Video Gallery Section -->
    <section class="video-section">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
                <h2 class="section-title">Galeri Video</h2>
                <p class="text-muted">Koleksi dokumentasi kegiatan kami di YouTube.</p>
            </div>
            
            <div class="row g-4">
                @forelse($videos as $video)
                @php
                    // Extract YouTube Video ID for thumbnail
                    $videoID = '';
                    if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $video->url, $match)) {
                        $videoID = $match[1];
                    }
                    $thumbUrl = $videoID ? "https://img.youtube.com/vi/{$videoID}/maxresdefault.jpg" : asset('template-sarab/img/frozen-banner.jpg');
                @endphp
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}">
                    <div class="video-card">
                        <div class="video-thumb-wrapper">
                            <img src="{{ $thumbUrl }}" alt="{{ $video->judul }}" class="video-thumb">
                            <a href="#" class="play-btn" data-bs-toggle="modal" data-bs-target="#videoModal" data-url="{{ $video->url }}" data-title="{{ $video->judul }}">
                                <i class="bi bi-play-fill"></i>
                            </a>
                        </div>
                        <div class="video-info">
                            <h5>{{ $video->judul }}</h5>
                            <p>{{ $video->deskripsi }}</p>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12 text-center py-5">
                    <div class="mb-3">
                        <i class="bi bi-camera-video text-muted" style="font-size: 3rem;"></i>
                    </div>
                    <p class="text-muted">Belum ada video dokumentasi yang tersedia.</p>
                </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Video Modal -->
    <div class="modal fade" id="videoModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="ratio ratio-16x9">
                        <iframe id="videoIframe" src="" title="YouTube video" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('layouts.partials.footer')

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const videoModal = document.getElementById('videoModal');
            const videoIframe = document.getElementById('videoIframe');

            videoModal.addEventListener('show.bs.modal', function (event) {
                const button = event.relatedTarget;
                let url = button.getAttribute('data-url');
                
                // Convert YouTube watch URL to embed URL if needed
                if (url.includes('watch?v=')) {
                    url = url.replace('watch?v=', 'embed/');
                } else if (url.includes('youtu.be/')) {
                    url = url.replace('youtu.be/', 'youtube.com/embed/');
                }

                // Add autoplay
                if (url.includes('?')) {
                    url += '&autoplay=1';
                } else {
                    url += '?autoplay=1';
                }

                videoIframe.setAttribute('src', url);
            });

            videoModal.addEventListener('hide.bs.modal', function () {
                videoIframe.setAttribute('src', '');
            });
        });
    </script>

</body>
</html>