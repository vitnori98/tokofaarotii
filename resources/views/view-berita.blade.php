<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Juliarti Safitri">
    <meta name="description" content="Portal Berita - Toko FAA Frozen Food & Bakery">
    <title>Portal Berita - FAA Frozen Food & Bakery</title>
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;0,900;1,700&family=Poppins:wght@300;400;500;600;700;800;900&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    
    <!-- CSS Assets -->
    <link href="{{ asset('template-sarab/css/bootstrap.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('template-sarab/css/aos.css') }}" rel="stylesheet"/>
    <link href="{{ asset('template-sarab/css/swiper-bundle.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('template-sarab/css/all.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('template-sarab/css/magnific-popup.css') }}" rel="stylesheet"/>
    <link href="{{ asset('template-sarab/css/style.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--light);
            color: var(--dark);
            overflow-x: hidden;
            padding-top: 85px;
        }

        /* ==============================
           HERO
        ============================== */
        .hero {
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
            background-image: url('https://images.unsplash.com/photo-1504674900247-0877df9cc836?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80');
            background-size: cover;
            background-position: center;
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

        .hero-tag {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(255,255,255,0.12);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255,255,255,0.2);
            color: white;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 3px;
            text-transform: uppercase;
            padding: 8px 20px;
            border-radius: 50px;
            margin-bottom: 20px;
        }

        .hero-tag::before {
            content: '';
            width: 6px;
            height: 6px;
            background: #f97316;
            border-radius: 50%;
            animation: pulse-dot 2s infinite;
            flex-shrink: 0;
        }

        @keyframes pulse-dot {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.5; transform: scale(1.6); }
        }

        .hero h1 {
            font-family: 'Playfair Display', serif;
            font-size: clamp(40px, 7vw, 78px);
            font-weight: 900;
            color: white;
            line-height: 1;
            letter-spacing: -2px;
            margin-bottom: 22px;
        }

        .hero h1 em {
            font-style: italic;
            color: #f97316;
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
        }

        .hero-breadcrumb a { color: #ffffff; text-decoration: none; transition: color 0.2s; opacity: 0.8; }
        .hero-breadcrumb a:hover { opacity: 1; }
        .hero-breadcrumb .crumb-active { color: #f97316; }
        .hero-breadcrumb .sep { color: rgba(255,255,255,0.25); }

        .hero-wave {
            position: absolute;
            bottom: -1px;
            left: 0;
            right: 0;
        }

        /* ==============================
           MAIN CONTENT
        ============================== */
        .main-content {
            max-width: 1280px;
            margin: 0 auto;
            padding: 48px 24px;
        }

        .section-tag {
            font-size: 10px;
            font-weight: 800;
            letter-spacing: 3px;
            text-transform: uppercase;
            color: #f97316;
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 10px;
        }

        .section-tag::before {
            content: '';
            display: block;
            width: 30px;
            height: 3px;
            background: #f97316;
            border-radius: 2px;
        }

        .section-title {
            font-family: 'Playfair Display', serif;
            font-size: clamp(26px, 4vw, 40px);
            font-weight: 900;
            color: var(--dark);
            line-height: 1.1;
            letter-spacing: -1px;
        }

        .section-title span { color: #f97316; }
        .section-desc { font-size: 13px; color: var(--gray); margin-top: 8px; }

        /* ==============================
           FEATURED GRID
        ============================== */
        .featured-grid {
            display: grid;
            grid-template-columns: 1fr 360px;
            gap: 24px;
            margin-bottom: 56px;
        }

        .section-header { margin-bottom: 28px; }

        /* Featured Big Card */
        .card-featured {
            background: white;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 10px 10px 30px rgba(0, 0, 0, 0.05), -5px -5px 20px rgba(255, 255, 255, 0.8);
            border: 1px solid rgba(229,9,20,0.05);
            transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            display: flex;
            flex-direction: column;
            position: relative;
        }

        .card-featured:hover {
            transform: translateY(-15px);
            box-shadow: 0 30px 60px rgba(229,9,20,0.15);
            border-color: rgba(229,9,20,0.2);
        }

        .card-featured::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(90deg, var(--red), #ff6b35);
            transform: scaleX(0);
            transition: transform 0.4s ease;
            transform-origin: left;
            z-index: 5;
        }

        .card-featured:hover::before {
            transform: scaleX(1);
        }

        .card-featured-img {
            position: relative;
            aspect-ratio: 16/9;
            overflow: hidden;
        }

        .card-featured-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 1.2s cubic-bezier(0.165, 0.84, 0.44, 1);
        }

        .card-featured:hover .card-featured-img img { transform: scale(1.1); }

        .img-badge-top {
            position: absolute;
            top: 20px;
            left: 20px;
            background: var(--red);
            color: white;
            font-family: 'Poppins', sans-serif;
            font-weight: 900;
            font-size: 9px;
            letter-spacing: 2px;
            text-transform: uppercase;
            padding: 6px 14px;
            border-radius: 6px;
            z-index: 2;
        }

        .img-date-badge {
            position: absolute;
            top: 20px;
            right: 20px;
            background: white;
            border-radius: 14px;
            padding: 10px 16px;
            text-align: center;
            box-shadow: 0 4px 20px rgba(0,0,0,0.14);
            z-index: 2;
        }

        .img-date-badge .day {
            display: block;
            font-family: 'Playfair Display', serif;
            font-size: 26px;
            font-weight: 900;
            color: var(--red);
            line-height: 1;
        }

        .img-date-badge .mon {
            display: block;
            font-size: 9px;
            font-weight: 700;
            color: var(--gray);
            text-transform: uppercase;
            letter-spacing: 1.5px;
            margin-top: 2px;
        }

        .card-featured-body {
            padding: 36px;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .card-meta {
            display: flex;
            align-items: center;
            gap: 14px;
            margin-bottom: 14px;
        }

        .meta-tag {
            font-size: 9px;
            font-weight: 800;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: var(--red);
            background: rgba(229,9,20,0.06);
            padding: 5px 12px;
            border-radius: 6px;
        }

        .meta-loc {
            font-size: 10px;
            color: var(--gray);
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .meta-loc i { color: var(--red); font-size: 9px; }

        .card-featured h3 {
            font-family: 'Playfair Display', serif;
            font-size: clamp(20px, 2.2vw, 26px);
            font-weight: 900;
            color: var(--dark);
            line-height: 1.3;
            margin-bottom: 12px;
            transition: color 0.3s;
        }

        .card-featured:hover h3 { color: var(--red); }

        .card-featured p {
            font-size: 14px;
            color: var(--gray);
            line-height: 1.8;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
            flex: 1;
        }

        .btn-read {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: var(--red);
            color: white;
            padding: 13px 28px;
            border-radius: 12px;
            font-size: 10px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 2px;
            text-decoration: none;
            margin-top: 22px;
            align-self: flex-start;
            transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            box-shadow: 0 6px 20px rgba(229,9,20,0.28);
        }

        .btn-read:hover {
            background: var(--red-dark);
            transform: translateX(10px);
            box-shadow: 0 10px 25px rgba(229,9,20,0.4);
            color: white;
        }

        /* Side Stack */
        .side-stack {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .card-side {
            background: white;
            border-radius: 18px;
            padding: 24px;
            border: 1px solid rgba(229,9,20,0.05);
            box-shadow: 8px 8px 20px rgba(0,0,0,0.03);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            flex: 1;
            display: flex;
            flex-direction: column;
            position: relative;
            overflow: hidden;
        }

        .card-side:hover {
            border-color: var(--red);
            box-shadow: 0 15px 35px rgba(229,9,20,0.12);
            transform: translateX(10px);
        }

        .card-side::after {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            width: 4px;
            height: 100%;
            background: var(--red);
            transform: scaleY(0);
            transition: transform 0.3s ease;
        }

        .card-side:hover::after {
            transform: scaleY(1);
        }

        .side-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }

        .side-badge {
            font-size: 8px;
            font-weight: 800;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: var(--red);
        }

        .side-date { font-size: 9px; color: var(--gray); font-weight: 600; }

        .card-side h4 {
            font-family: 'Poppins', sans-serif;
            font-size: 13px;
            font-weight: 700;
            color: var(--dark);
            line-height: 1.5;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            margin-bottom: 8px;
            transition: color 0.2s;
        }

        .card-side:hover h4 { color: var(--red); }

        .card-side p {
            font-size: 11px;
            color: var(--gray);
            line-height: 1.7;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            flex: 1;
        }

        .side-link {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 9px;
            font-weight: 800;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: var(--red);
            text-decoration: none;
            margin-top: 12px;
            transition: gap 0.2s;
        }

        .card-side:hover .side-link { gap: 10px; }

        .card-side-promo {
            background: linear-gradient(135deg, var(--red), #ff6b35);
            border-radius: 18px;
            padding: 28px 22px;
            color: white;
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            border: none;
            box-shadow: 0 10px 30px rgba(229,9,20,0.3);
            transition: transform 0.4s ease;
        }

        .card-side-promo:hover {
            transform: scale(1.03);
        }

        .card-side-promo i { font-size: 30px; opacity: 0.8; margin-bottom: 10px; animation: pulse 2s infinite; }

        @keyframes pulse {
            0% { transform: scale(1); opacity: 0.8; }
            50% { transform: scale(1.2); opacity: 1; }
            100% { transform: scale(1); opacity: 0.8; }
        }

        .card-side-promo h4 {
            font-family: 'Poppins', sans-serif;
            font-size: 12px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 6px;
            color: white;
        }

        .card-side-promo p { font-size: 11px; opacity: 0.9; color: white; }

        /* ==============================
           ALL NEWS
        ============================== */
        .all-news-header {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            margin-bottom: 28px;
            flex-wrap: wrap;
            gap: 16px;
        }

        .filter-tabs { display: flex; gap: 8px; flex-wrap: wrap; }

        .filter-tab {
            font-size: 9px;
            font-weight: 800;
            letter-spacing: 2px;
            text-transform: uppercase;
            padding: 8px 16px;
            border-radius: 8px;
            border: 1.5px solid var(--border);
            background: white;
            cursor: pointer;
            transition: all 0.3s;
            color: var(--gray);
            box-shadow: 2px 2px 5px rgba(0,0,0,0.05);
        }

        .filter-tab.active, .filter-tab:hover {
            background: var(--red);
            border-color: var(--red);
            color: white;
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(229,9,20,0.2);
        }

        .news-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
        }

        .card-news {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            border: 1px solid rgba(229,9,20,0.05);
            box-shadow: 5px 5px 15px rgba(0,0,0,0.05);
            transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            display: flex;
            flex-direction: column;
            position: relative;
        }

        .card-news:hover {
            transform: translateY(-12px);
            box-shadow: 0 25px 50px rgba(229,9,20,0.15);
            border-color: rgba(229,9,20,0.1);
        }

        .card-news::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: var(--red);
            transform: scaleX(0);
            transition: transform 0.4s ease;
            transform-origin: right;
        }

        .card-news:hover::after {
            transform: scaleX(1);
            transform-origin: left;
        }

        .card-news-img {
            position: relative;
            aspect-ratio: 4/3;
            overflow: hidden;
        }

        .card-news-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 1.2s cubic-bezier(0.165, 0.84, 0.44, 1);
        }

        .card-news:hover .card-news-img img { transform: scale(1.15); }

        .news-date-pill {
            position: absolute;
            top: 14px;
            right: 14px;
            background: rgba(255,255,255,0.95);
            backdrop-filter: blur(10px);
            font-size: 8px;
            font-weight: 800;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            color: var(--dark);
            padding: 6px 12px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            z-index: 2;
        }

        .news-number {
            position: absolute;
            bottom: 14px;
            left: 14px;
            width: 34px;
            height: 34px;
            background: var(--red);
            border-radius: 9px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Playfair Display', serif;
            font-size: 15px;
            font-weight: 900;
            color: white;
            box-shadow: 0 4px 14px rgba(229,9,20,0.4);
            z-index: 2;
        }

        .card-news-body {
            padding: 22px;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .news-source {
            font-size: 9px;
            font-weight: 800;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: var(--red);
            margin-bottom: 9px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .news-source::before {
            content: '';
            display: block;
            width: 18px;
            height: 2px;
            background: var(--red);
            border-radius: 1px;
        }

        .card-news h5 {
            font-family: 'Poppins', sans-serif;
            font-size: 13px;
            font-weight: 700;
            color: var(--dark);
            line-height: 1.5;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            margin-bottom: 8px;
            transition: color 0.3s;
            text-transform: uppercase;
        }

        .card-news:hover h5 { color: var(--red); }

        .card-news p {
            font-size: 12px;
            color: var(--gray);
            line-height: 1.8;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
            flex: 1;
        }

        .card-news p em {
            font-style: normal;
            font-weight: 700;
            color: var(--red);
        }

        .card-news-footer {
            margin-top: 18px;
            padding-top: 14px;
            border-top: 1px solid var(--light);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .btn-detail {
            font-size: 9px;
            font-weight: 800;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: var(--red);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 6px;
            transition: all 0.3s;
        }

        .card-news:hover .btn-detail { gap: 10px; color: var(--red-dark); }
        .news-read-time { font-size: 9px; color: var(--gray); font-weight: 500; }

        .empty-state {
            grid-column: 1 / -1;
            padding: 80px 20px;
            text-align: center;
        }

        .empty-state i { font-size: 48px; color: var(--border); display: block; margin-bottom: 14px; }
        .empty-state p { font-size: 11px; font-weight: 700; letter-spacing: 3px; text-transform: uppercase; color: var(--gray); }

        /* Fade In */
        .fade-in {
            opacity: 0;
            transform: translateY(24px);
            transition: opacity 0.65s ease, transform 0.65s ease;
        }
        .fade-in.visible { opacity: 1; transform: translateY(0); }

        /* ==============================
           RESPONSIVE
        ============================== */
        @media (max-width: 1100px) {
            .featured-grid { grid-template-columns: 1fr; }
            .side-stack { flex-direction: row; }
            .news-grid { grid-template-columns: repeat(2, 1fr); }
        }

        @media (max-width: 768px) {
            .hero { height: 300px; }
            .news-grid { grid-template-columns: 1fr; }
            .side-stack { flex-direction: column; }
            .all-news-header { flex-direction: column; align-items: flex-start; }
            .featured-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>

    @include('layouts.partials.navbar')

    <!-- ===========================
         HERO SECTION
    ============================ -->
    <section class="hero">
        <div class="hero-bg"></div>
        <div class="hero-overlay"></div>
        <div class="hero-grid"></div>

        <div class="hero-content fade-in">
            <div class="hero-tag">Portal Berita &amp; Kegiatan FAA</div>
            <h1>Berita <em>Kegiatan</em></h1>
            <nav class="hero-breadcrumb">
                <a href="{{ route('welcome') }}">Beranda</a>
                <span class="sep">/</span>
                <a href="{{ route('faq.public') }}">FAQ</a>
                <span class="sep">/</span>
                <span class="crumb-active">Berita</span>
            </nav>
        </div>

        <svg class="hero-wave" viewBox="0 0 1440 60" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
            <path d="M0 60 L0 30 Q360 0 720 30 Q1080 60 1440 30 L1440 60 Z" fill="#f8f8f6"/>
        </svg>
    </section>

    <!-- ===========================
         MAIN CONTENT
    ============================ -->
    <main class="main-content">

        <!-- SECTION: BERITA TERBARU -->
        <section style="margin-bottom: 80px;" class="fade-in">
            <div class="section-header">
                <div class="section-tag">Berita Terbaru</div>
                <h2 class="section-title">Update Terkini dari <span>Toko FAA</span></h2>
                <p class="section-desc">Ikuti terus perkembangan kegiatan, promo, dan informasi terbaru kami.</p>
            </div>

            @php
                $featured = $beritas->first();
                $sideItems = $beritas->skip(1)->take(2);
            @endphp

            @if($featured)
            <div class="featured-grid">
                <!-- FEATURED BIG CARD -->
                <div class="card-featured">
                    <div class="card-featured-img">
                        @if($featured->gambar)
                            <img src="{{ asset('storage/' . $featured->gambar) }}" alt="{{ $featured->judul }}">
                        @else
                            <img src="{{ asset('template-sarab/img/blog/1.jpg') }}" alt="Default">
                        @endif
                        <div class="img-badge-top">#Terupdate 1</div>
                        <div class="img-date-badge">
                            <span class="day">{{ \Carbon\Carbon::parse($featured->created_at)->translatedFormat('d') }}</span>
                            <span class="mon">{{ \Carbon\Carbon::parse($featured->created_at)->translatedFormat('M Y') }}</span>
                        </div>
                    </div>
                    <div class="card-featured-body">
                        <div class="card-meta">
                            <span class="meta-tag">Update Terkini</span>
                            <span class="meta-loc"><i class="fas fa-map-marker-alt"></i> Desa Karyamakmur</span>
                        </div>
                        <h3>{{ $featured->judul }}</h3>
                        <p>{{ strip_tags($featured->isi) }}</p>
                        <a href="{{ route('berita.show', $featured->id) }}" class="btn-read">
                            Baca Selengkapnya <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>

                <!-- SIDE STACK -->
                <div class="side-stack">
                    @foreach($sideItems as $side)
                    <div class="card-side">
                        <div class="side-top">
                            <span class="side-badge">Update</span>
                            <span class="side-date">{{ \Carbon\Carbon::parse($side->created_at)->translatedFormat('d M Y') }}</span>
                        </div>
                        <h4>{{ $side->judul }}</h4>
                        <p>{{ Str::limit(strip_tags($side->isi), 100) }}</p>
                        <a href="{{ route('berita.show', $side->id) }}" class="side-link">
                            Detail Berita <i class="fas fa-chevron-right"></i>
                        </a>
                    </div>
                    @endforeach

                    @if($sideItems->count() < 2)
                    <div class="card-side-promo">
                        <i class="fas fa-bell"></i>
                        <h4>Nantikan Info Lainnya</h4>
                        <p>Pantau terus portal ini untuk update terbaru dari FAA</p>
                    </div>
                    @endif
                </div>
            </div>
            @endif
        </section>

        <!-- SECTION: SEMUA BERITA -->
        <section id="semua-berita">
            <div class="all-news-header fade-in">
                <div>
                    <div class="section-tag">Arsip Lengkap</div>
                    <h2 class="section-title">Semua <span>Berita</span></h2>
                </div>
                <div class="filter-tabs">
                    <button class="filter-tab active" data-cat="all">Semua</button>
                    <button class="filter-tab" data-cat="bakery">Bakery</button>
                    <button class="filter-tab" data-cat="frozen">Frozen Food</button>
                    <button class="filter-tab" data-cat="promo">Promo</button>
                </div>
            </div>

            <div class="news-grid" id="newsGrid">
                @forelse($beritas as $index => $item)
                <div class="card-news news-item fade-in" data-cat="{{ $item->kategori ?? 'all' }}">
                    <div class="card-news-img">
                        @if($item->gambar)
                            <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->judul }}">
                        @else
                            <img src="{{ asset('template-sarab/img/blog/2.jpg') }}" alt="Default">
                        @endif
                        <div class="news-date-pill">{{ \Carbon\Carbon::parse($item->created_at)->translatedFormat('d M Y') }}</div>
                        <div class="news-number">{{ $loop->iteration }}</div>
                    </div>
                    <div class="card-news-body">
                        <div class="news-source">Kegiatan Toko</div>
                        <h5>{{ $item->judul }}</h5>
                        <p>
                            <em>Desa Karyamakmur, {{ \Carbon\Carbon::parse($item->created_at)->translatedFormat('d F Y') }}</em> — 
                            {{ Str::limit(strip_tags($item->isi), 120) }}
                        </p>
                        <div class="card-news-footer">
                            <a href="{{ route('berita.show', $item->id) }}" class="btn-detail">
                                Selengkapnya <i class="fas fa-arrow-right"></i>
                            </a>
                            <span class="news-read-time">3 menit baca</span>
                        </div>
                    </div>
                </div>
                @empty
                <div class="empty-state">
                    <i class="fas fa-newspaper"></i>
                    <p>Belum ada arsip berita saat ini.</p>
                </div>
                @endforelse
            </div>
        </section>

    </main>

    @include('layouts.partials.footer')

    <script>
    document.addEventListener('DOMContentLoaded', function () {

        // ── Fade In on Scroll ──────────────────────────
        const fadeEls = document.querySelectorAll('.fade-in');
        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry, i) => {
                if (entry.isIntersecting) {
                    setTimeout(() => entry.target.classList.add('visible'), i * 80);
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.08 });
        fadeEls.forEach(el => observer.observe(el));

        // ── Hero Parallax ──────────────────────────────
        const heroBg = document.querySelector('.hero-bg');
        window.addEventListener('scroll', () => {
            if (heroBg) heroBg.style.transform = `translateY(${window.scrollY * 0.28}px)`;
        });

        // ── Filter Tabs ────────────────────────────────
        document.querySelectorAll('.filter-tab').forEach(btn => {
            btn.addEventListener('click', function () {
                document.querySelectorAll('.filter-tab').forEach(b => b.classList.remove('active'));
                this.classList.add('active');
                const cat = this.dataset.cat;
                document.querySelectorAll('.news-item').forEach(card => {
                    const cardCat = card.dataset.cat || 'all';
                    card.style.display = (cat === 'all' || cardCat === cat) ? 'flex' : 'none';
                });
            });
        });

        // ── Inline Search Filter ───────────────────────
        const searchInput = document.getElementById('searchInput');
        if (searchInput) {
            searchInput.addEventListener('input', function () {
                const q = this.value.toLowerCase().trim();
                document.querySelectorAll('.news-item').forEach(card => {
                    const title = card.querySelector('h5')?.textContent.toLowerCase() || '';
                    const body  = card.querySelector('p')?.textContent.toLowerCase() || '';
                    card.style.display = (title.includes(q) || body.includes(q)) ? 'flex' : 'none';
                });
            });
        }

    });
    </script>

@include('chatbot') </body>
</html>