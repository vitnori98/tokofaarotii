<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="FAA Frozen Food & Bakery">
    <meta name="description" content="Katalog Produk FAA Frozen Food & Bakery - Menyediakan berbagai pilihan roti segar premium dan makanan beku berkualitas tinggi di Sungai Liat.">
    <title>Produk Makanan - FAA Frozen Food & Bakery</title>

    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700;900&family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet"/>
    <link href="{{ asset('template-sarab/css/bootstrap.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('template-sarab/css/aos.css') }}" rel="stylesheet"/>
    <link href="{{ asset('template-sarab/css/swiper-bundle.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('template-sarab/css/all.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('template-sarab/css/magnific-popup.css') }}" rel="stylesheet"/>
    <link href="{{ asset('template-sarab/css/style.css') }}" rel="stylesheet"/>

    <style>
        /* =============================================
           CSS VARIABLES & BASE
        ============================================= */
        :root {
            --red:        #e50914;
            --red-dark:   #b80710;
            --red-light:  #ff4d5a;
            --gold:       #ff8a00;
            --dark:       #111111;
            --dark-2:     #1a1a1a;
            --grey:       #6b7280;
            --grey-light: #f5f5f5;
            --white:      #ffffff;
            --shadow-sm:  0 4px 12px rgba(0,0,0,0.07);
            --shadow-md:  0 10px 30px rgba(0,0,0,0.10);
            --shadow-lg:  0 20px 50px rgba(0,0,0,0.14);
            --radius-sm:  10px;
            --radius-md:  18px;
            --radius-lg:  28px;
            --border: #e5e7eb;
        }

        *, *::before, *::after { box-sizing: border-box; }

        body {
            font-family: 'Poppins', sans-serif;
            background: #fafafa;
            color: var(--dark-2);
        }

        /* =============================================
           LOGO & NAVBAR
        ============================================= */
        .logo-floating-wrapper {
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            filter: drop-shadow(0 0 10px rgba(229,9,20,0.5));
            animation: floatLogo 3s ease-in-out infinite;
        }

        @keyframes floatLogo {
            0%, 100% { transform: translateY(0); }
            50%       { transform: translateY(-4px); }
        }

        .text-faa {
            font-family: 'Poppins', sans-serif;
            font-weight: 800;
            letter-spacing: 1.5px;
        }
        .text-faa .text-red  { color: var(--red); }
        .text-faa .text-blue { color: #0056b3; }

        .navbar {
            background: var(--white);
            border-bottom: 2px solid var(--red);
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 2px 20px rgba(229,9,20,0.08);
        }

        .navbar-inner {
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 70px;
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
        }

        .brand-logo-img {
            height: 50px;
            width: auto;
            animation: float 3s ease-in-out infinite;
            filter: drop-shadow(0 4px 12px rgba(229,9,20,0.35));
        }

        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-4px); }
        }

        .brand-text {
            font-family: 'Poppins', sans-serif;
            font-weight: 900;
            font-size: 22px;
            color: var(--red);
            letter-spacing: -0.5px;
            line-height: 1;
        }

        .brand-sub {
            display: block;
            font-size: 9px;
            font-weight: 600;
            color: var(--gray);
            letter-spacing: 2px;
            text-transform: uppercase;
            margin-top: 2px;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 2px;
            list-style: none;
        }

        .nav-links a {
            text-decoration: none;
            font-size: 11.5px;
            font-weight: 600;
            color: var(--dark);
            padding: 8px 13px;
            border-radius: 8px;
            text-transform: uppercase;
            letter-spacing: 0.7px;
            transition: all 0.2s;
            white-space: nowrap;
        }

        .nav-links a:hover { background: var(--light); color: var(--red); }
        .nav-links a.active { color: var(--red); background: rgba(229,9,20,0.06); }

        .nav-actions {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .btn-nav-icon {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            border: 1.5px solid var(--border);
            background: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--dark);
            transition: all 0.2s;
            position: relative;
            text-decoration: none;
            font-size: 13px;
        }

        .btn-nav-icon:hover { border-color: var(--red); color: var(--red); }

        .cart-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            width: 17px;
            height: 17px;
            background: var(--red);
            border-radius: 50%;
            font-size: 8px;
            font-weight: 800;
            color: white;
            display:flex;
            align-items:center;
            justify-content:center;
        }

        .btn-login {
            background: var(--red);
            color: white !important;
            padding: 9px 18px;
            border-radius: 10px;
            font-size: 11px;
            font-weight: 700;
            text-decoration: none;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .btn-login:hover { background: var(--red-dark); transform: translateY(-1px); }

        .btn-dashboard {
            background: transparent;
            color: var(--red) !important;
            border: 1.5px solid var(--red);
            padding: 8px 18px;
            border-radius: 10px;
            font-size: 11px;
            font-weight: 700;
            text-decoration: none;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .btn-dashboard:hover { background: var(--red); color: white !important; }

        .navbar-toggler {
            display: none;
            background: none;
            border: 1.5px solid var(--border);
            border-radius: 8px;
            width: 40px;
            height: 40px;
            cursor: pointer;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            gap: 5px;
            padding: 8px;
        }

        .navbar-toggler span {
            display: block;
            width: 20px;
            height: 2px;
            background: var(--dark);
            border-radius: 2px;
            transition: all 0.3s;
        }

        @media (max-width: 900px) {
            .nav-links { display: none; }
            .navbar-toggler { display: flex; }
        }

        /* =============================================
           HERO / PRODUCT HEADER
        ============================================= */
        .product-header {
            position: relative;
            background: url("{{ asset('template-sarab/img/banner-img.jpg') }}") no-repeat center center / cover;
            padding: 120px 0 100px;
            color: var(--white);
            text-align: center;
            overflow: hidden;
        }

        .product-header::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(0,0,0,0.72) 0%, rgba(229,9,20,0.30) 100%);
        }

        .product-header .container { position: relative; z-index: 2; }

        .product-header h1 {
            font-family: 'Playfair Display', serif;
            font-size: clamp(2rem, 5vw, 3.5rem);
            font-weight: 900;
            line-height: 1.15;
            margin-bottom: 14px;
            text-shadow: 0 3px 12px rgba(0,0,0,0.4);
        }

        .product-header .lead {
            font-size: clamp(0.95rem, 2vw, 1.15rem);
            opacity: .88;
            font-weight: 400;
            letter-spacing: .3px;
        }

        .hero-badge {
            display: inline-block;
            background: var(--red);
            color: #fff;
            font-size: .72rem;
            font-weight: 700;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            padding: 5px 16px;
            border-radius: 50px;
            margin-bottom: 18px;
        }

        /* Scroll indicator */
        .scroll-cue {
            position: absolute;
            bottom: 24px;
            left: 50%;
            transform: translateX(-50%);
            width: 26px;
            height: 42px;
            border: 2px solid rgba(255,255,255,.5);
            border-radius: 13px;
            z-index: 2;
        }
        .scroll-cue::after {
            content: '';
            position: absolute;
            top: 6px;
            left: 50%;
            transform: translateX(-50%);
            width: 4px;
            height: 8px;
            background: rgba(255,255,255,.8);
            border-radius: 2px;
            animation: scrollDot 1.6s ease-in-out infinite;
        }
        @keyframes scrollDot {
            0%, 100% { opacity: 1; top: 6px; }
            50%       { opacity: 0; top: 18px; }
        }

        /* =============================================
           SEARCH BAR
        ============================================= */
        .search-wrap {
            max-width: 520px;
            margin: 0 auto;
        }

        .search-wrap .input-group {
            border-radius: 50px;
            overflow: hidden;
            box-shadow: var(--shadow-md);
            border: 2px solid transparent;
            transition: border-color .25s;
        }

        .search-wrap .input-group:focus-within {
            border-color: var(--red);
        }

        .search-wrap .input-group-text {
            background: var(--white);
            border: none;
            padding-left: 20px;
            color: var(--grey);
        }

        .search-wrap .form-control {
            border: none;
            padding: 14px 8px;
            font-size: .92rem;
            background: var(--white);
        }
        .search-wrap .form-control:focus {
            box-shadow: none;
        }

        /* =============================================
           FILTER BUTTONS
        ============================================= */
        .filter-bar {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 10px;
        }

        .filtbtn {
            border: 2px solid #e0e0e0;
            background: var(--white);
            color: var(--grey);
            font-size: .82rem;
            font-weight: 600;
            padding: 8px 22px;
            border-radius: 50px;
            cursor: pointer;
            transition: all .22s ease;
            letter-spacing: .3px;
        }

        .filtbtn:hover {
            border-color: var(--red);
            color: var(--red);
            background: #fff5f5;
        }

        .filtbtn.active {
            background: var(--red);
            border-color: var(--red);
            color: var(--white);
            box-shadow: 0 4px 14px rgba(229,9,20,.35);
        }

        /* =============================================
           PRODUCT CARDS
        ============================================= */
        .section-label {
            font-size: .72rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 2.5px;
            color: var(--red);
            margin-bottom: 6px;
        }

        .section-title {
            font-family: 'Playfair Display', serif;
            font-size: clamp(1.5rem, 3vw, 2.2rem);
            font-weight: 700;
            color: var(--dark);
            line-height: 1.2;
        }

        .mcard {
            border-radius: var(--radius-md) !important;
            overflow: hidden;
            box-shadow: 0 6px 24px rgba(0,0,0,0.09) !important;
            border: 1px solid rgba(0,0,0,0.04) !important;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            background: var(--white);
            position: relative;
        }

        .mcard:hover {
            transform: translateY(-12px);
            box-shadow: 0 20px 60px rgba(229,9,20,0.16) !important;
            border-color: transparent !important;
        }

        .card-img-wrapper {
            position: relative;
            overflow: hidden;
            height: 220px;
        }

        .mcard .card-img-top {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform .55s ease;
        }

        .mcard:hover .card-img-top {
            transform: scale(1.06);
        }

        /* Category ribbon on image */
        .card-ribbon {
            position: absolute;
            top: 14px;
            left: 14px;
            background: rgba(255,255,255,.95);
            backdrop-filter: blur(6px);
            color: var(--gold);
            font-size: .68rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: .8px;
            padding: 4px 12px;
            border-radius: 50px;
            box-shadow: 0 2px 8px rgba(0,0,0,.1);
            z-index: 1;
        }

        /* Wishlist button on image */
        .card-wish {
            position: absolute;
            top: 12px;
            right: 12px;
            width: 34px;
            height: 34px;
            border-radius: 50%;
            background: rgba(255,255,255,.95);
            backdrop-filter: blur(6px);
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #ccc;
            font-size: .85rem;
            cursor: pointer;
            transition: color .2s, transform .2s;
            box-shadow: 0 2px 8px rgba(0,0,0,.1);
            z-index: 1;
        }
        .card-wish:hover { color: var(--red); transform: scale(1.1); }
        .card-wish.active { color: var(--red); }

        .mcard .card-body {
            padding: 18px 20px 20px !important;
            display: flex;
            flex-direction: column;
        }

        .mcard .card-title {
            font-size: 1rem;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 8px;
            line-height: 1.35;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            transition: color 0.3s;
        }

        .mcard:hover .card-title {
            color: var(--red);
        }

        .product-short-desc {
            font-size: .82rem;
            color: var(--grey);
            line-height: 1.5;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            margin-bottom: 14px;
            flex-grow: 1;
        }

        .card-action-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: auto;
            padding-top: 12px;
            border-top: 1px solid #f0f0f0;
        }

        .product-price-display {
            font-size: 1.15rem;
            font-weight: 800;
            color: var(--red);
            margin: 0;
        }

        .btn-circle-add {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: var(--red);
            color: var(--white);
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
            box-shadow: 0 4px 14px rgba(229,9,20,.4);
            cursor: pointer;
            transition: all .22s ease;
            flex-shrink: 0;
        }

        .btn-circle-add:hover {
            background: var(--red-dark);
            transform: scale(1.1) rotate(90deg);
            box-shadow: 0 6px 18px rgba(229,9,20,.5);
        }

        /* Empty state */
        .empty-state {
            padding: 80px 20px;
            text-align: center;
        }
        .empty-state i {
            font-size: 3.5rem;
            color: #ddd;
            margin-bottom: 16px;
            display: block;
        }
        .empty-state p {
            font-size: 1rem;
            color: var(--grey);
        }

        /* Result counter */
        .result-count {
            font-size: .82rem;
            color: var(--grey);
            margin-top: 4px;
        }
        .result-count strong { color: var(--dark); }

        /* =============================================
           MODAL DETAIL
        ============================================= */
        #menuPop {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(10,10,10,.75);
            backdrop-filter: blur(6px);
            z-index: 10000;
            justify-content: center;
            align-items: center;
            padding: 16px;
        }
        #menuPop.active { display: flex !important; }

        .mpbox {
            background: var(--white);
            border-radius: var(--radius-lg);
            max-width: 520px;
            width: 100%;
            position: relative;
            overflow: hidden;
            box-shadow: 0 30px 80px rgba(0,0,0,.25);
            animation: popIn .3s cubic-bezier(.34,1.56,.64,1) both;
        }

        @keyframes popIn {
            from { transform: scale(.88); opacity: 0; }
            to   { transform: scale(1);   opacity: 1; }
        }

        .mpimg-wrap {
            position: relative;
            height: 240px;
            overflow: hidden;
        }
        .mpimg-wrap img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .mpimg-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(0,0,0,.5) 0%, transparent 50%);
        }

        #mpClose {
            position: absolute;
            top: 14px;
            right: 14px;
            width: 34px;
            height: 34px;
            border-radius: 50%;
            background: rgba(255,255,255,.9);
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: .9rem;
            cursor: pointer;
            color: var(--dark);
            z-index: 5;
            transition: background .2s, transform .2s;
            box-shadow: 0 2px 8px rgba(0,0,0,.15);
        }
        #mpClose:hover { background: var(--white); transform: rotate(90deg); }

        .mpbody { padding: 24px 26px 28px; }

        #mpCat {
            display: inline-block;
            background: #fff3f3;
            color: var(--red);
            font-size: .7rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            padding: 4px 12px;
            border-radius: 50px;
            margin-bottom: 10px;
        }

        #mpTitle {
            font-family: 'Playfair Display', serif;
            font-size: 1.45rem;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 8px;
            line-height: 1.25;
        }

        #mpDesc {
            font-size: .88rem;
            color: var(--grey);
            line-height: 1.6;
            margin-bottom: 14px;
        }

        #mpPrice {
            font-size: 1.55rem;
            font-weight: 800;
            color: var(--red);
            margin-bottom: 16px;
        }

        .mp-meta {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: .8rem;
            color: var(--grey);
            background: var(--grey-light);
            border-radius: var(--radius-sm);
            padding: 8px 14px;
            margin-bottom: 20px;
        }
        .mp-meta i { color: var(--gold); }

        #waOrder {
            background: #25d366;
            border: none;
            border-radius: 50px;
            color: #fff;
            font-size: .92rem;
            font-weight: 600;
            padding: 13px 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            text-decoration: none;
            transition: background .2s, transform .2s, box-shadow .2s;
            box-shadow: 0 6px 20px rgba(37,211,102,.35);
        }
        #waOrder:hover {
            background: #1ebe5d;
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(37,211,102,.45);
        }

        /* =============================================
           BACK TO TOP
        ============================================= */
        #btt {
            position: fixed;
            bottom: 30px;
            right: 30px;
            z-index: 9999;
            background: var(--red);
            color: var(--white);
            border: none;
            width: 44px;
            height: 44px;
            border-radius: var(--radius-sm);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 14px rgba(229,9,20,.4);
            transition: all .3s ease;
            opacity: 0;
            visibility: hidden;
            transform: translateY(20px);
        }
        #btt.show { opacity: 1; visibility: visible; transform: translateY(0); }
        #btt:hover { background: var(--red-dark); transform: translateY(-3px); }

        /* =============================================
           SEARCH OVERLAY (inherited from template)
        ============================================= */
        #searchOv .ttag { cursor: pointer; }

        /* =============================================
           RESPONSIVENESS
        ============================================= */
        @media (max-width: 576px) {
            .product-header { padding: 90px 0 75px; }
            .mpbox { border-radius: 20px; }
            .mpimg-wrap { height: 190px; }
            .mpbody { padding: 18px 18px 22px; }
        }
    </style>
</head>
<body>

    <!-- =============================================
         SEARCH OVERLAY
    ============================================= -->
    <div id="searchOv">
        <button id="searchClose" class="sovclose"><i class="fas fa-times"></i></button>
        <div class="sovbox">
            <h4>Apa yang Anda dambakan hari ini?</h4>
            <div class="sovinput">
                <input type="text" id="searchInput" placeholder="Cari roti, frozen food...">
                <button><i class="fas fa-search"></i></button>
            </div>
            <div class="sovtrend">
                <p>🔥 Pencarian yang Sedang Tren</p>
                <span class="ttag">Roti O Coklat</span>
                <span class="ttag">Bakso Ayam</span>
                <span class="ttag">Visi &amp; Misi Toko FAA</span>
            </div>
        </div>
    </div>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom py-3 fixed-top">
        <div class="container-fluid px-lg-4">
            
            <a class="navbar-brand d-flex align-items-center gap-2 text-decoration-none me-4" href="{{ route('welcome') }}">
                <img src="{{ asset('template-sarab/img/logo-toko-faa.png') }}" alt="Logo FAA" class="brand-logo-img" style="height: 40px; object-fit: contain;">
                <div class="d-flex flex-column lh-sm">
                    <span class="brand-text fw-bold text-dark m-0" style="font-size: 1.25rem; letter-spacing: 0.5px;">FAA</span>
                </div>
            </a>

            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <div class="d-flex flex-column flex-lg-row align-items-lg-center justify-content-between w-100 gap-3 mt-3 mt-lg-0">
                    
                    <ul class="nav-links d-flex flex-column flex-lg-row align-items-lg-center list-unstyled gap-3 gap-lg-4 m-0 flex-shrink-0">
                        <li><a href="{{ route('welcome') }}">Beranda</a></li>
                        <li><a href="{{ url('/#categories') }}">Tentang Kami</a></li>
                        
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" 
                                href="#" 
                                id="navbarDropdown" 
                                role="button" 
                                data-bs-toggle="dropdown" 
                                aria-expanded="false"
                                style="background-color: #f1f5f9; color: #1e293b; border-radius: 8px; padding: 6px 15px; font-size: 13px; font-weight: 500;">
                                Dokumentasi
                            </a>
                            <ul class="dropdown-menu border-0 shadow-lg p-3 rounded-4 mt-2" aria-labelledby="navbarDropdown" style="min-width: 260px;">
                                <li>
                                    <a class="dropdown-item d-flex align-items-center gap-3 py-2 rounded-3" href="{{ route('berita.public') }}">
                                        <div class="flex-shrink-0 d-flex align-items-center justify-content-center rounded-3" style="width: 40px; height: 40px; background-color: #f0f5ff; color: #8a1e1e;">
                                            <i class="bi bi-newspaper fs-5"></i>
                                        </div>
                                        <span class="fw-semibold text-dark" style="font-size: 0.95rem;">Berita FAA</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item d-flex align-items-center gap-3 py-2 rounded-3" href="#">
                                        <div class="flex-shrink-0 d-flex align-items-center justify-content-center rounded-3" style="width: 40px; height: 40px; background-color: #f0f5ff; color: #8a1e1e;">
                                            <i class="bi bi-images fs-5"></i>
                                        </div>
                                        <span class="fw-semibold text-dark" style="font-size: 0.95rem;">Album Kegiatan</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item d-flex align-items-center gap-3 py-2 rounded-3" href="#">
                                        <div class="flex-shrink-0 d-flex align-items-center justify-content-center rounded-3" style="width: 40px; height: 40px; background-color: #f0f5ff; color: #8a1e1e;">
                                            <i class="bi bi-bar-chart-line fs-5"></i>
                                        </div>
                                        <span class="fw-semibold text-dark" style="font-size: 0.95rem;">Infografis</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item d-flex align-items-center gap-3 py-2 rounded-3" href="#">
                                        <div class="flex-shrink-0 d-flex align-items-center justify-content-center rounded-3" style="width: 40px; height: 40px; background-color: #f0f5ff; color: #8a1e1e;">
                                            <i class="bi bi-camera-video fs-5"></i>
                                        </div>
                                        <span class="fw-semibold text-dark" style="font-size: 0.95rem;">Video</span>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li><a href="{{ route('produk.makanan') }}" class="active">Produk Makanan</a></li>
                        <li><a href="{{ route('faq.public') }}">FAQ</a></li>
                    </ul>

                    <div class="nav-actions d-flex align-items-center gap-2 gap-lg-3 flex-grow-1 justify-content-lg-end w-100 w-lg-auto">
                        
                        <div class="position-relative flex-grow-1" style="max-width: 380px;">
                            <i class="bi bi-search position-absolute top-50 start-0 translate-middle-y ms-3 text-muted"></i>
                            <input type="text" class="form-control rounded-pill border-0 ps-5 py-2 shadow-sm" placeholder="Cari produk..." style="background-color: #f1f5f9; font-size: 0.9rem;">
                        </div>

                        <a href="#promo" class="text-secondary p-2 d-flex align-items-center justify-content-center rounded-circle hover-bg-light" title="VR 3D Showroom">
                            <i class="bi bi-box-seam fs-5" style="color: #64748b;"></i>
                        </a>

                        <a href="#promo" class="text-secondary p-2 d-flex align-items-center justify-content-center rounded-circle hover-bg-light" title="AI Chatbot">
                            <i class="bi bi-robot fs-5" style="color: #64748b;"></i>
                        </a>

                        <a href="#" class="text-secondary p-2 d-flex align-items-center justify-content-center rounded-circle position-relative hover-bg-light me-1" title="Keranjang">
                            <i class="bi bi-cart3 fs-5" style="color: #334155;"></i>
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-circle bg-danger d-flex align-items-center justify-content-center p-0 shadow" 
                                    id="cartCount" 
                                    style="width: 18px; height: 18px; font-size: 0.65rem; font-family: sans-serif; margin-top: 6px; margin-left: -6px;">
                                3
                            </span>
                        </a>

                        <div class="d-flex align-items-center gap-2 ms-lg-2 flex-shrink-0">
                            @auth
                                <a href="{{ url('/dashboard') }}" class="btn btn-outline-dark fw-semibold px-3 py-2 rounded-3 btn-sm">
                                    Dashboard
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="text-decoration-none fw-semibold px-2 text-secondary hover-dark" style="font-size: 0.95rem;">
                                    Masuk
                                </a>
                                <a href="{{ route('register') }}" class="btn text-white fw-semibold px-3 py-2 btn-sm shadow-sm" style="background-color: #ff2a00; font-size: 0.95rem; border-radius: 10px !important;">
                                    Daftar
                                </a>
                            @endauth
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </nav>

    <!-- =============================================
         HERO
    ============================================= -->
    <section class="product-header">
        <div class="container" data-aos="fade-up">
            <span class="hero-badge">&#x2728; Pilihan Premium</span>
            <h1>Katalog Produk<br>Makanan FAA</h1>
            <p class="lead">Roti Segar &amp; Frozen Food Berkualitas Tinggi di Sungai Liat</p>
        </div>
        <div class="scroll-cue" aria-hidden="true"></div>
    </section>

    <!-- =============================================
         PRODUK SECTION
    ============================================= -->
    <section class="py-5 mt-2">
        <div class="container">

            <!-- HEADING -->
            <div class="text-center mb-4" data-aos="fade-up">
                <p class="section-label">Koleksi Kami</p>
                <h2 class="section-title">Temukan Produk Favorit Anda</h2>
            </div>

            <!-- SEARCH -->
            <div class="search-wrap mb-4" data-aos="fade-up">
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                    <input type="text" id="productSearch" class="form-control search-trigger" placeholder="Cari produk favorit Anda...">
                </div>
                <p class="result-count text-center mt-2" id="resultCount"></p>
            </div>

            <!-- FILTER BUTTONS -->
            <div class="text-center mb-5" data-aos="fade-up">
                <div class="filter-bar">
                    <button class="filtbtn active" data-f="all">&#128247; Semua</button>
                    @foreach($categories as $cat)
                        @php
                            $f = 'other';
                            $catName = strtolower($cat->name);
                            if (stripos($catName, 'roti') !== false || stripos($catName, 'bread') !== false || stripos($catName, 'bakery') !== false) {
                                $f = 'bakery';
                            } elseif (stripos($catName, 'frozen') !== false) {
                                $f = 'frozen';
                            }
                        @endphp
                        <button class="filtbtn" data-f="{{ $f }}">{{ $cat->name }}</button>
                    @endforeach
                </div>
            </div>

            <!-- PRODUCT GRID -->
            <div class="row g-4" id="productList">
                @forelse($products as $product)
                    @php
                        $categoryName = $product->category->name ?? 'Uncategorized';
                        $filterClass  = 'other';
                        $lowerCat     = strtolower($categoryName);
                        if (stripos($lowerCat, 'roti') !== false || stripos($lowerCat, 'bread') !== false || stripos($lowerCat, 'bakery') !== false) {
                            $filterClass = 'bakery';
                        } elseif (stripos($lowerCat, 'frozen') !== false) {
                            $filterClass = 'frozen';
                        }
                        $imgSrc = $product->image
                            ? asset('storage/' . $product->image)
                            : asset('template-sarab/img/menu/1.jpg');
                        $descText = $product->description ?? 'Nikmati kelezatan varian produk terbaik pilihan berkualitas dari FAA Frozen Food & Bakery.';
                    @endphp
                    <div class="col-xl-3 col-md-4 col-sm-6 p-item"
                         data-c="{{ $filterClass }}"
                         data-aos="fade-up"
                         data-aos-delay="{{ ($loop->index % 4) * 60 }}">
                        <div class="card h-100 mcard"
                             data-img="{{ $imgSrc }}"
                             data-title="{{ $product->name }}"
                             data-cat="{{ $categoryName }}"
                             data-price="Rp {{ number_format($product->price, 0, ',', '.') }}"
                             data-desc="{{ $descText }}"
                             data-tags="{{ $product->unit ?? 'pcs' }}">

                            <!-- Image -->
                            <div class="card-img-wrapper">
                                <img src="{{ $imgSrc }}"
                                     class="card-img-top"
                                     alt="{{ $product->name }}"
                                     loading="lazy">
                                <span class="card-ribbon">{{ $categoryName }}</span>
                                <button class="card-wish" title="Tambah ke Wishlist" aria-label="Wishlist">
                                    <i class="far fa-heart"></i>
                                </button>
                            </div>

                            <!-- Body -->
                            <div class="card-body">
                                <h5 class="card-title">{{ $product->name }}</h5>
                                <p class="product-short-desc">{{ $descText }}</p>
                                <div class="card-action-row">
                                    <p class="product-price-display">
                                        Rp {{ number_format($product->price, 0, ',', '.') }}
                                    </p>
                                    <button class="btn-circle-add madd" title="Lihat Detail" aria-label="Lihat Detail">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 empty-state">
                        <i class="fas fa-box-open"></i>
                        <p>Tidak ada produk yang ditemukan.</p>
                    </div>
                @endforelse
            </div><!-- /productList -->

        </div>
    </section>

    <!-- =============================================
         MODAL DETAIL PRODUK
    ============================================= -->
    <div id="menuPop" role="dialog" aria-modal="true" aria-label="Detail Produk">
        <div class="mpbox">
            <button id="mpClose" aria-label="Tutup modal"><i class="fas fa-times"></i></button>

            <div class="mpimg-wrap">
                <img id="mpImg" src="" alt="Foto Produk">
                <div class="mpimg-overlay"></div>
            </div>

            <div class="mpbody">
                <div id="mpCat"></div>
                <h3 id="mpTitle"></h3>
                <div id="mpDesc"></div>
                <div id="mpPrice"></div>
                <div class="mp-meta" id="mpMeta">
                    <i class="fas fa-tag"></i>
                    <span id="mpTags"></span>
                </div>
                <a href="#" id="waOrder" target="_blank" rel="noopener noreferrer">
                    <i class="fab fa-whatsapp"></i> Pesan via WhatsApp
                </a>
            </div>
        </div>
    </div>

    <!-- =============================================
         FOOTER
    ============================================= -->
    <footer>
        <div class="container">
            <div class="row g-5">
                <!-- Brand -->
                <div class="col-sm-6 col-lg-3">
                    <div class="fnm">FAA <span>Frozen Food &amp; Bakery</span></div>
                    <p class="fdesc">FAA Frozen Food &amp; Bakery menyediakan berbagai produk makanan beku dan Roti berkualitas tinggi dengan rasa yang lezat dan konsisten.</p>
                    <div class="fsoc">
                        <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                        <a href="#" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                        <a href="#" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
                        <a href="#" aria-label="TikTok"><i class="fab fa-tiktok"></i></a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div class="col-sm-6 col-lg-2">
                    <div class="ftit">Link Cepat</div>
                    <ul class="flinks ps-0">
                        <li><a href="#hero"><i class="fas fa-chevron-right"></i>Beranda</a></li>
                        <li><a href="#categories"><i class="fas fa-chevron-right"></i>Tentang Kami</a></li>
                        <li><a href="{{ route('berita.public') }}"><i class="fas fa-chevron-right"></i>Berita</a></li>
                        <li><a href="#promo"><i class="fas fa-chevron-right"></i>Flash Sale</a></li>
                        <li><a href="#blog"><i class="fas fa-chevron-right"></i>Blog</a></li>
                        <li><a href="#contact-section"><i class="fas fa-chevron-right"></i>Kontak</a></li>
                    </ul>
                </div>

                <!-- Contact -->
                <div class="col-sm-6 col-lg-4">
                    <div class="ftit">Hubungi Kami</div>
                    <div class="fci">
                        <div class="fciico"><i class="fas fa-map-marker-alt"></i></div>
                        <div class="fciinfo"><strong>Alamat</strong>Kuday, Sungai Liat, Kabupaten Bangka, Kepulauan Bangka Belitung 33211</div>
                    </div>
                    <div class="fci">
                        <div class="fciico"><i class="fas fa-phone-alt"></i></div>
                        <div class="fciinfo"><strong>Telepon</strong>+62 0853-6878-7893</div>
                    </div>
                    <div class="fci">
                        <div class="fciico"><i class="fas fa-envelope"></i></div>
                        <div class="fciinfo"><strong>Email</strong>hello@sarabfood.com</div>
                    </div>
                    <div class="fci">
                        <div class="fciico"><i class="fas fa-clock"></i></div>
                        <div class="fciinfo"><strong>Jam Operasional</strong>Setiap Hari: 06.00 – 18.00</div>
                    </div>
                </div>

                <!-- Map -->
                <div class="col-sm-6 col-lg-3">
                    <div class="ftit">Lokasi</div>
                    <div class="fmap" style="border-radius:10px;overflow:hidden;box-shadow:0 4px 10px rgba(0,0,0,.15);">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3985.449717171717!2d106.1104212!3d-1.8504601!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e22f3e7784d51ad%3A0xf0b32b5d14082039!2sFAA+FROZEN+FOOD!5e0!3m2!1sid!2sid!4v1717424400000!5m2!1sid!2sid"
                            width="100%"
                            height="200"
                            style="border:0;display:block;"
                            allowfullscreen=""
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"
                            title="Lokasi FAA Frozen Food">
                        </iframe>
                    </div>
                </div>
            </div>
        </div>

        <div class="fbot">
            <div class="container">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                    <p>&copy; 2026 <span>FAA Frozen Food &amp; Bakery</span>.<br>
                    Dibuat oleh <a target="_blank" rel="noopener" class="mx-0 fw-bold text-success"
                        href="https://www.instagram.com/juliy_safteri?igsh=eTQwZXE3Y2QxdXFj">Juliarti Safitri</a></p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Back to Top -->
    <button id="btt" onclick="window.scrollTo({top:0,behavior:'smooth'})" aria-label="Kembali ke atas">
        <i class="fas fa-chevron-up"></i>
    </button>

    <!-- =============================================
         SCRIPTS
    ============================================= -->
    <script src="{{ asset('template-sarab/js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('template-sarab/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('template-sarab/js/aos.js') }}"></script>
    <script src="{{ asset('template-sarab/js/main.js') }}"></script>

    <script>
    $(document).ready(function () {

        // ── AOS ──────────────────────────────────────────
        AOS.init({ duration: 600, once: true, offset: 60 });

        // ── BACK TO TOP ──────────────────────────────────
        $(window).on('scroll', function () {
            $('#btt').toggleClass('show', $(this).scrollTop() > 300);
        });

        // ── WISHLIST TOGGLE ──────────────────────────────
        $(document).on('click', '.card-wish', function (e) {
            e.stopPropagation();
            $(this).toggleClass('active');
            var icon = $(this).find('i');
            icon.toggleClass('far fa-heart fas fa-heart');
        });

        // ── RESULT COUNT ─────────────────────────────────
        function updateCount() {
            var visible = $('.p-item:visible').length;
            var total   = $('.p-item').length;
            if (visible === total) {
                $('#resultCount').text('Menampilkan ' + total + ' produk');
            } else {
                $('#resultCount').html('Menampilkan <strong>' + visible + '</strong> dari ' + total + ' produk');
            }
        }

        // ── FILTER + SEARCH ──────────────────────────────
        function filterProducts() {
            var term = $('#productSearch').val().toLowerCase().trim();
            var cat  = $('.filtbtn.active').data('f');

            $('.p-item').each(function () {
                var title = $(this).find('.card-title').text().toLowerCase();
                var desc  = $(this).find('.product-short-desc').text().toLowerCase();
                var itemC = $(this).data('c');

                var matchSearch = !term || title.includes(term) || desc.includes(term);
                var matchCat    = cat === 'all' || itemC === cat;

                $(this).stop(true).toggle(matchSearch && matchCat);
            });

            updateCount();
        }

        // Initial count
        updateCount();

        // Sync dual search inputs
        $(document).on('input', '.search-trigger, #searchInput', function () {
            var val = $(this).val();
            $('.search-trigger, #searchInput').not(this).val(val);
            filterProducts();
        });

        // Filter button click
        $(document).on('click', '.filtbtn', function () {
            $('.filtbtn').removeClass('active');
            $(this).addClass('active');
            filterProducts();
        });

        // ── MODAL OPEN ───────────────────────────────────
        $(document).on('click', '.madd', function () {
            var card = $(this).closest('.mcard');

            $('#mpImg').attr({ src: card.data('img'), alt: card.data('title') });
            $('#mpTitle').text(card.data('title'));
            $('#mpCat').text(card.data('cat'));
            $('#mpPrice').text(card.data('price'));
            $('#mpDesc').text(card.data('desc'));
            $('#mpTags').text('Satuan: ' + card.data('tags'));

            var waText = encodeURIComponent(
                'Halo Toko FAA, saya ingin bertanya tentang produk: ' + card.data('title')
            );
            $('#waOrder').attr('href', 'https://wa.me/6285368787893?text=' + waText);

            $('#menuPop').fadeIn(250);
            $('body').css('overflow', 'hidden');
        });

        // ── MODAL CLOSE ──────────────────────────────────
        function closeModal() {
            $('#menuPop').fadeOut(200);
            $('body').css('overflow', '');
        }

        $('#mpClose').on('click', closeModal);

        $('#menuPop').on('click', function (e) {
            if ($(e.target).is('#menuPop')) closeModal();
        });

        $(document).on('keydown', function (e) {
            if (e.key === 'Escape') closeModal();
        });

    });
    </script>
</body>
</html>