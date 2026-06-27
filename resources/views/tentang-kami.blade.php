<!DOCTYPE html>
<html lang="id">
<head>
    <style>
        /* Efek Ngambang / Glowing pada Logo Bulat */
        .logo-floating-wrapper {
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            filter: drop-shadow(0 0 12px rgba(0, 74, 173, 0.6)); 
            animation: floatingEffect 3s ease-in-out infinite;
        }

        @keyframes floatingEffect {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-4px); }
            100% { transform: translateY(0px); }
        }

        /* Hero Section Styling */
        .about-hero {
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
            background: url('{{ asset('template-sarab/img/banner-toko-faa.png') }}') no-repeat center center / cover;
            will-change: transform;
        }

        .hero-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(0, 74, 173, 0.85) 0%, rgba(15, 15, 15, 0.75) 60%, rgba(3, 105, 161, 0.6) 100%);
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

        .about-hero h1 {
            font-family: 'Playfair Display', serif;
            font-size: clamp(40px, 7vw, 78px);
            font-weight: 900;
            color: #ffffff;
            line-height: 1;
            letter-spacing: -2px;
            margin-bottom: 22px;
        }

        .about-hero p {
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
            color: #1e293b;
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

        .history-img {
            border-radius: 20px;
            box-shadow: 0 15px 40px rgba(0, 74, 173, 0.1);
            width: 100%;
            transition: transform 0.3s;
        }

        .history-img:hover {
            transform: scale(1.02);
        }

        /* Vision & Mission Cards */
        .vm-card {
            background: #fff;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            height: 100%;
            border: 1px solid #e2e8f0;
            transition: all 0.3s;
        }

        .vm-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(0, 74, 173, 0.1);
            border-color: #004aad;
        }

        .vm-icon {
            width: 60px;
            height: 60px;
            background: rgba(0, 74, 173, 0.1);
            color: #004aad;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            border-radius: 15px;
            margin-bottom: 25px;
        }

        /* BSKM Style Structure Header */
        .structure-header {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
            margin-bottom: 5px;
        }

        .structure-header .line {
            height: 1px;
            width: 40px;
            background-color: #f97316; /* Orange */
        }

        .structure-header .accent-text {
            color: #f97316; /* Orange */
            font-weight: 700;
            font-size: 0.75rem;
            letter-spacing: 3px;
            text-transform: uppercase;
        }

        .section-title.bskm-title {
            color: #004aad; /* Biru sesuai tema */
            font-weight: 800;
            font-size: 2.25rem;
            margin-bottom: 10px;
        }

        .section-title.bskm-title::after {
            display: none;
        }

        /* Swiper Team Slider */
        .team-swiper {
            padding: 20px 0 50px;
        }

        /* Employee/Team Cards (BSKM Style) */
        .team-card {
            background: transparent;
            border: none;
            box-shadow: none;
            margin-bottom: 20px;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 100%;
        }

        .team-card:hover {
            transform: translateY(-5px);
            box-shadow: none;
        }

        .team-img-wrapper {
            width: 180px;
            height: 180px;
            border-radius: 50%;
            overflow: hidden;
            border: 2px solid #004aad; /* Biru sesuai tema */
            padding: 5px;
            background: #fff;
            margin-bottom: 15px;
            flex-shrink: 0;
            transition: all 0.3s;
        }

        .team-img {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            object-fit: cover;
        }

        .team-info {
            padding: 0;
            text-align: center;
        }

        .team-info h5 {
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 4px;
            font-size: 1.1rem;
        }

        .team-info p {
            color: #717171;
            font-size: 0.85rem;
            font-weight: 500;
            text-transform: capitalize;
            letter-spacing: 0;
            margin-bottom: 0;
        }

        /* Carousel Dots Indicators */
        .swiper-pagination-team {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-top: 30px;
        }

        .swiper-pagination-team .swiper-pagination-bullet {
            width: 10px;
            height: 10px;
            background-color: #cbd5e1;
            border-radius: 2px;
            opacity: 1;
            transition: all 0.3s;
            margin: 0 !important;
        }

        .swiper-pagination-team .swiper-pagination-bullet-active {
            background-color: #004aad; /* Biru aktif */
            width: 25px;
        }
    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tentang Kami - FAA Frozen Food & Bakery</title>
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700;900&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet"/>
    
    <!-- CSS Assets -->
    <link href="{{ asset('template-sarab/css/bootstrap.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('template-sarab/css/aos.css') }}" rel="stylesheet"/>
    <link href="{{ asset('template-sarab/css/all.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('template-sarab/css/style.css') }}" rel="stylesheet" />
    <!-- Swiper CSS -->
    <link href="{{ asset('template-sarab/css/swiper-bundle.min.css') }}" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>

    @include('layouts.partials.navbar')

    <!-- Hero Section -->
    <section class="about-hero">
        <div class="hero-bg"></div>
        <div class="hero-overlay"></div>
        <div class="hero-grid"></div>

        <div class="hero-content" data-aos="fade-up">
            <h1>Tentang Kami</h1>
            <p>Mengenal lebih dekat FAA Frozen Food & Bakery, penyedia hidangan lezat dan berkualitas untuk keluarga Anda.</p>
            <nav class="hero-breadcrumb">
                <a href="{{ route('welcome') }}">Beranda</a>
                <span class="sep">/</span>
                <span class="crumb-active">Tentang Kami</span>
            </nav>
        </div>

        <svg class="hero-wave" viewBox="0 0 1440 60" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
            <path d="M0 60 L0 30 Q360 0 720 30 Q1080 60 1440 30 L1440 60 Z" fill="#ffffff"/>
        </svg>
    </section>

    <!-- Sejarah Section -->
    <section class="history-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0" data-aos="fade-right">
                    <img src="{{ asset('template-sarab/img/banner-faa-new.jpeg') }}" alt="Sejarah FAA" class="history-img">
                </div>
                <div class="col-lg-6 ps-lg-5" data-aos="fade-left">
                    <h2 class="section-title">Sejarah Kami</h2>
                    <p class="lead text-primary fw-bold">Berawal dari cinta untuk hidangan berkualitas.</p>
                    <p>FAA Frozen Food & Bakery didirikan dengan misi sederhana: menyajikan kelezatan yang konsisten dan praktis bagi setiap keluarga. Berawal dari usaha rumahan di Sungai Liat, kami tumbuh dengan dedikasi pada bahan-bahan pilihan dan proses pembuatan yang higienis.</p>
                    <p>Seiring berjalannya waktu, kami terus berinovasi dalam menghadirkan berbagai varian roti segar yang dipanggang setiap hari serta produk frozen food yang telah menjadi favorit masyarakat sekitar. Kepercayaan pelanggan adalah motivasi terbesar kami untuk terus memberikan yang terbaik.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Visi Misi Section -->
    <section class="vm-section bg-light">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
                <h2 class="section-title">Visi & Misi</h2>
                <p class="text-muted">Komitmen kami dalam melayani Anda.</p>
            </div>
            <div class="row g-4">
                <div class="col-md-6" data-aos="zoom-in" data-aos-delay="100">
                    <div class="vm-card">
                        <div class="vm-icon">
                            <i class="bi bi-eye"></i>
                        </div>
                        <h3>Visi</h3>
                        <p>Menjadi pilihan utama masyarakat dalam memenuhi kebutuhan produk bakery dan frozen food yang lezat, sehat, dan berkualitas tinggi dengan standar internasional.</p>
                    </div>
                </div>
                <div class="col-md-6" data-aos="zoom-in" data-aos-delay="200">
                    <div class="vm-card">
                        <div class="vm-icon">
                            <i class="bi bi-bullseye"></i>
                        </div>
                        <h3>Misi</h3>
                        <ul class="list-unstyled">
                            <li class="mb-2"><i class="bi bi-check-circle-fill text-primary me-2"></i> Menggunakan bahan baku premium dan segar.</li>
                            <li class="mb-2"><i class="bi bi-check-circle-fill text-primary me-2"></i> Menjaga konsistensi rasa dan kualitas produk.</li>
                            <li class="mb-2"><i class="bi bi-check-circle-fill text-primary me-2"></i> Memberikan pelayanan yang ramah dan profesional.</li>
                            <li class="mb-2"><i class="bi bi-check-circle-fill text-primary me-2"></i> Terus berinovasi mengikuti selera pelanggan.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Tim Section -->
    <section class="team-section">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
                <div class="structure-header">
                    <span class="line"></span>
                    <span class="accent-text">STRUKTUR</span>
                    <span class="line"></span>
                </div>
                <h2 class="section-title bskm-title">Tim Kami</h2>
                <p class="text-muted">Orang-orang di balik kelezatan FAA Frozen Food & Bakery.</p>
            </div>
            
            <!-- Swiper Slider -->
            <div class="swiper team-swiper" data-aos="fade-up">
                <div class="swiper-wrapper">
                    @forelse($pegawais as $pegawai)
                    <div class="swiper-slide">
                        <div class="team-card">
                            <div class="team-img-wrapper">
                                @if($pegawai->foto)
                                    <img src="{{ asset('storage/' . $pegawai->foto) }}" alt="{{ $pegawai->nama }}" class="team-img">
                                @else
                                    <img src="{{ asset('template-sarab/img/chefs/1.jpg') }}" alt="Default" class="team-img">
                                @endif
                            </div>
                            <div class="team-info">
                                <h5>{{ $pegawai->nama }}</h5>
                                <p>{{ $pegawai->posisi }}</p>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="swiper-slide text-center">
                        <p class="text-muted">Data pegawai belum tersedia.</p>
                    </div>
                    @endforelse
                </div>
                <!-- Pagination Dots -->
                <div class="swiper-pagination-team"></div>
            </div>
        </div>
    </section>

    @include('layouts.partials.footer')

    <!-- Swiper JS -->
    <script src="{{ asset('template-sarab/js/swiper-bundle.min.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            new Swiper(".team-swiper", {
                slidesPerView: 1,
                spaceBetween: 30,
                loop: true,
                autoplay: {
                    delay: 3000,
                    disableOnInteraction: false,
                },
                pagination: {
                    el: ".swiper-pagination-team",
                    clickable: true,
                },
                breakpoints: {
                    576: { slidesPerView: 2 },
                    992: { slidesPerView: 4 },
                },
            });
        });
    </script>

</body>
</html>

@include('chatbot') </body>
</html>