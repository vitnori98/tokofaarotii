<!DOCTYPE html>
<html lang="id">
<head>
    <style>
        /* Hero Section Styling */
        .info-hero {
            position: relative;
            background: url('{{ asset('template-sarab/img/roti-banner.jpg') }}') no-repeat center center / cover;
            padding: 150px 0 100px;
            color: #ffffff;
            text-align: center;
        }

        .info-hero::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            z-index: 1;
        }

        .info-hero .container {
            position: relative;
            z-index: 2;
        }

        .info-hero h1 {
            font-family: 'Playfair Display', serif;
            font-size: clamp(2.5rem, 6vw, 4rem);
            font-weight: 900;
            text-shadow: 2px 2px 10px rgba(0,0,0,0.5);
            margin-bottom: 15px;
        }

        .info-hero p {
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

        /* Info Card Styling */
        .info-card {
            background: #fff;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
            transition: all 0.3s;
            border: 1px solid #f1f1f1;
            cursor: pointer;
            height: 100%;
        }

        .info-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(229, 9, 20, 0.15);
            border-color: #e50914;
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
            transition: transform 0.5s;
        }

        .info-card:hover .info-img {
            transform: scale(1.02);
        }

        .info-overlay {
            position: absolute;
            inset: 0;
            background: rgba(229, 9, 20, 0.8);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: all 0.3s;
        }

        .info-card:hover .info-overlay {
            opacity: 1;
        }

        .info-overlay i {
            color: #fff;
            font-size: 2.5rem;
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
    <div class="info-hero">
        <div class="container" data-aos="fade-up">
            <h1>Infografis</h1>
            <p>Informasi menarik seputar gizi, cara penyajian, dan tips bermanfaat dari FAA Frozen Food & Bakery.</p>
        </div>
    </div>

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