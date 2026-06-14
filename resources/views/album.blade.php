<!DOCTYPE html>
<html lang="id">
<head>
    <style>
        /* Hero Section Styling */
        .album-hero {
            position: relative;
            background: url('{{ asset('template-sarab/img/banner-img.jpg') }}') no-repeat center center / cover;
            padding: 150px 0 100px;
            color: #ffffff;
            text-align: center;
        }

        .album-hero::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            z-index: 1;
        }

        .album-hero .container {
            position: relative;
            z-index: 2;
        }

        .album-hero h1 {
            font-family: 'Playfair Display', serif;
            font-size: clamp(2.5rem, 6vw, 4rem);
            font-weight: 900;
            text-shadow: 2px 2px 10px rgba(0,0,0,0.5);
            margin-bottom: 15px;
        }

        .album-hero p {
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

        /* Album Card Styling */
        .album-card {
            background: #fff;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
            transition: all 0.3s;
            height: 100%;
            border: 1px solid #f1f1f1;
            cursor: pointer;
        }

        .album-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(229, 9, 20, 0.15);
            border-color: #e50914;
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
            transition: transform 0.5s;
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
    <div class="album-hero">
        <div class="container" data-aos="fade-up">
            <h1>Album Kegiatan</h1>
            <p>Kumpulan momen berharga dan dokumentasi berbagai kegiatan FAA Frozen Food & Bakery.</p>
        </div>
    </div>

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