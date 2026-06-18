<!DOCTYPE html>
<html lang="id">
<head>
    <style>
        /* Hero Section Styling */
        .info-hero {
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
            background: url('{{ asset('template-sarab/img/roti-banner.jpg') }}') no-repeat center center / cover;
            will-change: transform;
        }

        .hero-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(0, 74, 173, 0.85) 0%, rgba(30, 41, 59, 0.75) 60%, rgba(249, 115, 22, 0.6) 100%);
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

        .info-hero h1 {
            font-family: 'Playfair Display', serif;
            font-size: clamp(40px, 7vw, 78px);
            font-weight: 900;
            color: #ffffff;
            line-height: 1;
            letter-spacing: -2px;
            margin-bottom: 22px;
        }

        .info-hero p {
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

        /* Info Card Styling */
        .info-card {
            background: #fff;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 8px 8px 20px rgba(0, 0, 0, 0.05), -5px -5px 15px rgba(255, 255, 255, 0.8);
            transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            border: 1px solid rgba(0, 0, 0, 0.02);
            cursor: pointer;
            height: 100%;
            position: relative;
        }

        .info-card:hover {
            transform: translateY(-12px) scale(1.02);
            box-shadow: 0 25px 50px rgba(229, 9, 20, 0.15);
            border-color: rgba(229, 9, 20, 0.1);
        }

        .info-img-wrapper {
            position: relative;
            overflow: hidden;
            background: #f8f9fa;
        }

        .info-img {
            width: 100%;
            height: auto;
            display: block;
            transition: transform 0.8s cubic-bezier(0.165, 0.84, 0.44, 1);
        }

        .info-card:hover .info-img {
            transform: scale(1.05);
        }

        .info-overlay {
            position: absolute;
            inset: 0;
            background: rgba(229, 9, 20, 0.7);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: all 0.4s ease;
            backdrop-filter: blur(4px);
        }

        .info-card:hover .info-overlay {
            opacity: 1;
        }

        .info-overlay i {
            color: #fff;
            font-size: 2.5rem;
            transform: scale(0.5);
            transition: transform 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .info-card:hover .info-overlay i {
            transform: scale(1);
        }

        .info-content {
            padding: 25px;
            text-align: center;
        }

        .info-content h5 {
            font-weight: 700;
            color: #333;
            margin-bottom: 5px;
        }
    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Infografis - FAA Frozen Food & Bakery</title>
    
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
    <section class="info-hero">
        <div class="hero-bg"></div>
        <div class="hero-overlay"></div>
        <div class="hero-grid"></div>

        <div class="hero-content" data-aos="fade-up">
            <h1>Infografis</h1>
            <p>Informasi menarik seputar gizi, cara penyajian, dan tips bermanfaat dari FAA Frozen Food & Bakery.</p>
            <nav class="hero-breadcrumb">
                <a href="{{ route('welcome') }}">Beranda</a>
                <span class="sep">/</span>
                <span class="crumb-active">Infografis</span>
            </nav>
        </div>

        <svg class="hero-wave" viewBox="0 0 1440 60" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
            <path d="M0 60 L0 30 Q360 0 720 30 Q1080 60 1440 30 L1440 60 Z" fill="#ffffff"/>
        </svg>
    </section>

    <!-- Info Grid Section -->
    <section class="info-section">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
                <h2 class="section-title">Galeri Infografis</h2>
                <p class="text-muted">Visualisasi informasi untuk gaya hidup yang lebih praktis dan sehat.</p>
            </div>
            
            <div class="row g-4 popup-gallery">
                @forelse($infografis as $info)
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}">
                    <a href="{{ asset('storage/' . $info->gambar) }}" class="info-card text-decoration-none d-block" title="{{ $info->judul }}">
                        <div class="info-img-wrapper">
                            <img src="{{ asset('storage/' . $info->gambar) }}" alt="{{ $info->judul }}" class="info-img">
                            <div class="info-overlay">
                                <i class="bi bi-zoom-in"></i>
                            </div>
                        </div>
                        <div class="info-content">
                            <h5>{{ $info->judul }}</h5>
                        </div>
                    </a>
                </div>
                @empty
                <div class="col-12 text-center py-5">
                    <div class="mb-3">
                        <i class="bi bi-bar-chart-line text-muted" style="font-size: 3rem;"></i>
                    </div>
                    <p class="text-muted">Belum ada data infografis yang tersedia.</p>
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
                    preload: [0,1]
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