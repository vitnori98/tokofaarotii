<!DOCTYPE html>
<html lang="id">
<head>
    <style>
        /* Hero Section Styling */
        .video-hero {
            position: relative;
            background: url('{{ asset('template-sarab/img/frozen-banner.jpg') }}') no-repeat center center / cover;
            padding: 150px 0 100px;
            color: #ffffff;
            text-align: center;
        }

        .video-hero::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            z-index: 1;
        }

        .video-hero .container {
            position: relative;
            z-index: 2;
        }

        .video-hero h1 {
            font-family: 'Playfair Display', serif;
            font-size: clamp(2.5rem, 6vw, 4rem);
            font-weight: 900;
            text-shadow: 2px 2px 10px rgba(0,0,0,0.5);
            margin-bottom: 15px;
        }

        .video-hero p {
            font-size: 1.2rem;
            max-width: 700px;
            margin: 0 auto;
            opacity: 0.9;
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
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
            transition: all 0.3s;
            height: 100%;
            border: 1px solid #f1f1f1;
        }

        .video-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(229, 9, 20, 0.15);
            border-color: #e50914;
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
            transition: opacity 0.3s;
        }

        .video-card:hover .video-thumb {
            opacity: 1;
        }

        .play-btn {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 60px;
            height: 60px;
            background: #e50914;
            color: #fff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            box-shadow: 0 0 20px rgba(229, 9, 20, 0.5);
            transition: all 0.3s;
            z-index: 2;
        }

        .video-card:hover .play-btn {
            transform: translate(-50%, -50%) scale(1.1);
            background: #ffffff;
            color: #e50914;
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
    <div class="video-hero">
        <div class="container" data-aos="fade-up">
            <h1>Video Dokumentasi</h1>
            <p>Saksikan berbagai keseruan kegiatan dan proses pembuatan produk terbaik dari FAA Frozen Food & Bakery.</p>
        </div>
    </div>

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