<!DOCTYPE html>
<html lang="id">
<head>
    <style>
        /* Hero Section Styling */
        .album-hero {
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
            background: url('{{ asset('template-sarab/img/banner-img.jpg') }}') no-repeat center center / cover;
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

        .album-hero h1 {
            font-family: 'Playfair Display', serif;
            font-size: clamp(40px, 7vw, 78px);
            font-weight: 900;
            color: #ffffff;
            line-height: 1;
            letter-spacing: -2px;
            margin-bottom: 22px;
        }

        .album-hero p {
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
            background: #004aad;
            border-radius: 2px;
        }

        /* Album Card Styling */
        .album-card {
            background: #fff;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 8px 8px 20px rgba(0, 0, 0, 0.05), -5px -5px 15px rgba(255, 255, 255, 0.8);
            transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            height: 100%;
            border: 1px solid rgba(0, 0, 0, 0.02);
            cursor: pointer;
            position: relative;
        }

        .album-card:hover {
            transform: translateY(-15px) scale(1.02);
            box-shadow: 0 25px 50px rgba(229, 9, 20, 0.15);
            border-color: rgba(229, 9, 20, 0.1);
        }

        .album-card::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: #e50914;
            transform: scaleX(0);
            transition: transform 0.4s ease;
            transform-origin: left;
        }

        .album-card:hover::after {
            transform: scaleX(1);
        }

        .album-img-wrapper {
            position: relative;
            aspect-ratio: 4/3;
            overflow: hidden;
        }

        .album-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.8s cubic-bezier(0.165, 0.84, 0.44, 1);
        }

        .album-card:hover .album-img {
            transform: scale(1.1);
        }

        .album-info {
            padding: 25px;
        }

        .album-info h5 {
            font-weight: 700;
            color: #333;
            margin-bottom: 8px;
            line-height: 1.4;
        }

        .album-info p {
            color: #666;
            font-size: 0.9rem;
            margin-bottom: 12px;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .album-date {
            font-size: 0.8rem;
            color: #e50914;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 5px;
        }
    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Album Kegiatan - FAA Frozen Food & Bakery</title>
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700;900&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet"/>
    
    <!-- CSS Assets -->
    <link href="{{ asset('template-sarab/css/bootstrap.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('template-sarab/css/aos.css') }}" rel="stylesheet"/>
    <link href="{{ asset('template-sarab/css/all.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('template-sarab/css/magnific-popup.css') }}" rel="stylesheet"/>
    <link href="{{ asset('template-sarab/css/style.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>

    @include('layouts.partials.navbar')

    <!-- Hero Section -->
    <section class="album-hero">
        <div class="hero-bg"></div>
        <div class="hero-overlay"></div>
        <div class="hero-grid"></div>

        <div class="hero-content" data-aos="fade-up">
            <h1>Album Kegiatan</h1>
            <p>Kumpulan momen berharga dan dokumentasi berbagai kegiatan FAA Frozen Food & Bakery.</p>
            <nav class="hero-breadcrumb">
                <a href="{{ route('welcome') }}">Beranda</a>
                <span class="sep">/</span>
                <span class="crumb-active">Album</span>
            </nav>
        </div>

        <svg class="hero-wave" viewBox="0 0 1440 60" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
            <path d="M0 60 L0 30 Q360 0 720 30 Q1080 60 1440 30 L1440 60 Z" fill="#ffffff"/>
        </svg>
    </section>

    <!-- Album Grid Section -->
    <section class="album-section">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
                <h2 class="section-title">Galeri Foto</h2>
                <p class="text-muted">Melihat kembali jejak langkah dan kebersamaan kami.</p>
            </div>
            
            <div class="row g-4 popup-gallery">
                @forelse($albums as $album)
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}">
                    <a href="{{ asset('storage/' . $album->gambar) }}" class="album-card text-decoration-none d-block" title="{{ $album->judul }}">
                        <div class="album-img-wrapper">
                            <img src="{{ asset('storage/' . $album->gambar) }}" alt="{{ $album->judul }}" class="album-img">
                        </div>
                        <div class="album-info">
                            <h5>{{ $album->judul }}</h5>
                            <p>{{ $album->deskripsi }}</p>
                            <div class="album-date">
                                <i class="bi bi-calendar3"></i> 
                                {{ $album->tanggal ? \Carbon\Carbon::parse($album->tanggal)->translatedFormat('d F Y') : \Carbon\Carbon::parse($album->created_at)->translatedFormat('d F Y') }}
                            </div>
                        </div>
                    </a>
                </div>
                @empty
                <div class="col-12 text-center py-5">
                    <div class="mb-3">
                        <i class="bi bi-images text-muted" style="font-size: 3rem;"></i>
                    </div>
                    <p class="text-muted">Belum ada album kegiatan yang tersedia.</p>
                </div>
                @endforelse
            </div>
        </div>
    </section>

    @include('layouts.partials.footer')

    <script>
        $(document).ready(function() {
            $('.popup-gallery').magnificPopup({
                delegate: 'a',
                type: 'image',
                tLoading: 'Loading image #%curr%...',
                mainClass: 'mfp-img-mobile',
                gallery: {
                    enabled: true,
                    navigateByImgClick: true,
                    preload: [0,1] // Will preload 0 - before current, and 1 after the current image
                },
                image: {
                    tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
                    titleSrc: function(item) {
                        return item.el.attr('title');
                    }
                }
            });
        });
    </script>

</body>
</html>