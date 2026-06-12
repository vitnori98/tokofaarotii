<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Juliarti Safitri">
    <meta name="description" content="Portal Berita - Toko FAA Frozen Food & Bakery">
    <title>Portal Berita - FAA Frozen Food & Bakery</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;0,900;1,700&family=Poppins:wght@300;400;500;600;700;800;900&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <link href="{{ asset('template-sarab/css/all.min.css') }}" rel="stylesheet">

    <style>
        :root {
            --red: #e50914;
            --red-dark: #b80710;
            --teal: #0d9488;
            --teal-light: #14b8a6;
            --gold: #f59e0b;
            --dark: #0f0f0f;
            --gray: #6b7280;
            --light: #f8f8f6;
            --white: #ffffff;
            --border: #e5e7eb;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--light);
            color: var(--dark);
            overflow-x: hidden;
        }

        /* ==============================
           NAVBAR
        ============================== */
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
            display: flex;
            align-items: center;
            justify-content: center;
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

        /* Mobile Toggle */
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
            background: linear-gradient(135deg, rgba(229,9,20,0.82) 0%, rgba(15,15,15,0.72) 55%, rgba(13,148,136,0.58) 100%);
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
            background: var(--gold);
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
            color: var(--gold);
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
            color: rgba(255,255,255,0.6);
        }

        .hero-breadcrumb a { color: rgba(255,255,255,0.6); text-decoration: none; transition: color 0.2s; }
        .hero-breadcrumb a:hover { color: white; }
        .hero-breadcrumb .crumb-active { color: var(--gold); }
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
            color: var(--red);
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
            background: var(--red);
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

        .section-title span { color: var(--teal); }
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
            box-shadow: 0 8px 32px rgba(0,0,0,0.1);
            border: 1px solid rgba(229,9,20,0.1);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            display: flex;
            flex-direction: column;
        }

        .card-featured:hover {
            transform: translateY(-12px);
            box-shadow: 0 24px 64px rgba(229,9,20,0.18);
            border-color: transparent;
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
            transition: transform 0.8s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .card-featured:hover .card-featured-img img { transform: scale(1.08); }

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
            color: var(--teal);
            background: rgba(13,148,136,0.08);
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
            transition: color 0.2s;
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
            transition: all 0.25s;
            box-shadow: 0 6px 20px rgba(229,9,20,0.28);
        }

        .btn-read:hover {
            background: var(--red-dark);
            transform: translateX(4px);
            box-shadow: 0 8px 24px rgba(229,9,20,0.38);
            color: white;
        }

        /* Side Stack */
        .side-stack {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .card-side {
            background: white;
            border-radius: 18px;
            padding: 24px;
            border: 1px solid rgba(229,9,20,0.08);
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .card-side:hover {
            border-color: var(--red);
            box-shadow: 0 12px 40px rgba(229,9,20,0.16);
            transform: translateY(-6px);
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
            color: var(--teal);
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

        .card-side:hover h4 { color: var(--teal); }

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
            color: var(--teal);
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
            box-shadow: 0 8px 28px rgba(229,9,20,0.28);
        }

        .card-side-promo i { font-size: 30px; opacity: 0.6; margin-bottom: 10px; }

        .card-side-promo h4 {
            font-family: 'Poppins', sans-serif;
            font-size: 12px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 6px;
            color: white;
        }

        .card-side-promo p { font-size: 11px; opacity: 0.75; color: white; }

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
            transition: all 0.2s;
            color: var(--gray);
        }

        .filter-tab.active, .filter-tab:hover {
            background: var(--red);
            border-color: var(--red);
            color: white;
        }

        .news-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }

        .card-news {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            border: 1px solid rgba(229,9,20,0.08);
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            display: flex;
            flex-direction: column;
        }

        .card-news:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 60px rgba(229,9,20,0.15);
            border-color: transparent;
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
            transition: transform 0.8s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .card-news:hover .card-news-img img { transform: scale(1.1); }

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
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
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
            transition: color 0.2s;
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
            color: var(--teal);
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
            color: var(--teal);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 6px;
            transition: gap 0.2s;
        }

        .card-news:hover .btn-detail { gap: 10px; }
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
           FOOTER
        ============================== */
        footer { background: var(--dark); color: rgba(255,255,255,0.65); margin-top: 80px; }

        .footer-top {
            max-width: 1280px;
            margin: 0 auto;
            padding: 64px 24px;
            display: grid;
            grid-template-columns: 1.8fr 1fr 1.5fr 1.4fr;
            gap: 48px;
        }

        .footer-brand-row {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 14px;
        }

        .footer-logo-img { height: 40px; width: auto; }

        .footer-brand-name {
            font-family: 'Poppins', sans-serif;
            font-weight: 800;
            font-size: 17px;
            color: white;
            line-height: 1.1;
        }

        .footer-brand-name span {
            display: block;
            font-size: 9px;
            font-weight: 500;
            color: rgba(255,255,255,0.4);
            letter-spacing: 1.5px;
            text-transform: uppercase;
        }

        .footer-desc { font-size: 13px; line-height: 1.8; color: rgba(255,255,255,0.48); margin-bottom: 18px; }

        .footer-socials { display: flex; gap: 8px; }

        .footer-social-btn {
            width: 36px;
            height: 36px;
            border-radius: 9px;
            border: 1px solid rgba(255,255,255,0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            color: rgba(255,255,255,0.45);
            text-decoration: none;
            font-size: 13px;
            transition: all 0.2s;
        }

        .footer-social-btn:hover {
            background: var(--red);
            border-color: var(--red);
            color: white;
            transform: translateY(-2px);
        }

        .footer-heading {
            font-family: 'Poppins', sans-serif;
            font-size: 10px;
            font-weight: 800;
            letter-spacing: 3px;
            text-transform: uppercase;
            color: white;
            margin-bottom: 18px;
            padding-bottom: 10px;
            border-bottom: 1px solid rgba(255,255,255,0.07);
        }

        .footer-links { list-style: none; display: flex; flex-direction: column; gap: 10px; }

        .footer-links a {
            color: rgba(255,255,255,0.48);
            text-decoration: none;
            font-size: 13px;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.2s;
        }

        .footer-links a i { font-size: 8px; color: var(--red); }
        .footer-links a:hover { color: white; padding-left: 4px; }

        .footer-contact-item { display: flex; gap: 12px; margin-bottom: 13px; }

        .contact-icon {
            width: 34px;
            height: 34px;
            background: rgba(229,9,20,0.14);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--red);
            font-size: 12px;
            flex-shrink: 0;
        }

        .contact-info strong {
            display: block;
            font-size: 9px;
            font-weight: 700;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            color: rgba(255,255,255,0.3);
            margin-bottom: 2px;
        }

        .contact-info span { font-size: 12px; color: rgba(255,255,255,0.6); }

        .footer-map iframe {
            width: 100%;
            height: 155px;
            border: none;
            border-radius: 12px;
            display: block;
        }

        .footer-bottom { border-top: 1px solid rgba(255,255,255,0.06); padding: 20px 24px; }

        .footer-bottom-inner {
            max-width: 1280px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 10px;
        }

        .footer-bottom p { font-size: 12px; color: rgba(255,255,255,0.28); }
        .footer-bottom a { color: var(--teal-light); text-decoration: none; font-weight: 600; }

        /* Back to Top */
        #btt {
            position: fixed;
            bottom: 28px;
            right: 28px;
            z-index: 9999;
            width: 44px;
            height: 44px;
            background: var(--red);
            color: white;
            border: none;
            border-radius: 12px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            box-shadow: 0 6px 20px rgba(229,9,20,0.38);
            transition: all 0.3s;
            opacity: 0;
            visibility: hidden;
            transform: translateY(16px);
        }

        #btt.show { opacity: 1; visibility: visible; transform: translateY(0); }
        #btt:hover { background: var(--red-dark); transform: translateY(-3px); }

        /* ==============================
           RESPONSIVE
        ============================== */
        @media (max-width: 1100px) {
            .featured-grid { grid-template-columns: 1fr; }
            .side-stack { flex-direction: row; }
            .news-grid { grid-template-columns: repeat(2, 1fr); }
            .footer-top { grid-template-columns: 1fr 1fr; gap: 36px; }
        }

        @media (max-width: 900px) {
            .nav-links { display: none; }
            .navbar-toggler { display: flex; }
        }

        @media (max-width: 768px) {
            .hero { height: 300px; }
            .news-grid { grid-template-columns: 1fr; }
            .side-stack { flex-direction: column; }
            .footer-top { grid-template-columns: 1fr; gap: 30px; }
            .all-news-header { flex-direction: column; align-items: flex-start; }
            .featured-grid { grid-template-columns: 1fr; }
        }
    </style>
    <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="author" content="Sarab">
      <meta name="description" content="Sarab - Fast Food & Restaurant HTML Template">
      <title>TOKOFAAROTII - Bakery & Frozen Food</title>
      
      <!-- Fonts -->
      <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700;900&family=Poppins:wght@300;400;500;600;700&family=Dancing+Script:wght@700&display=swap" rel="stylesheet"/>
      
      <!-- CSS Assets -->
      <link href="{{ asset('template-sarab/css/bootstrap.min.css') }}" rel="stylesheet"/>
      <link href="{{ asset('template-sarab/css/aos.css') }}" rel="stylesheet"/>
      <link href="{{ asset('template-sarab/css/swiper-bundle.min.css') }}" rel="stylesheet"/>
      <link href="{{ asset('template-sarab/css/all.min.css') }}" rel="stylesheet"/>
      <link href="{{ asset('template-sarab/css/magnific-popup.css') }}" rel="stylesheet"/>
      <link href="{{ asset('template-sarab/css/style.css') }}" rel="stylesheet" />
</head>
<body>

<!-- ===========================
     NAVBAR
============================ -->
<nav class="navbar">
    <div class="navbar-inner">
        <a class="navbar-brand" href="{{ route('welcome') }}">
            <img src="{{ asset('template-sarab/img/logo-toko-faa.png') }}" alt="Logo FAA" class="brand-logo-img">
            <div>
                <div class="brand-text">FAA</div>
                <span class="brand-sub">Frozen Food & Bakery</span>
            </div>
        </a>

        <ul class="nav-links">
            <li><a href="{{ route('welcome') }}">Beranda</a></li>
            <li><a href="{{ url('/#categories') }}">Tentang Kami</a></li>
            <li><a href="{{ route('berita.public') }}" class="active">Berita</a></li>
            <li><a href="{{ url('/#promo') }}">Dokumentasi</a></li>
            <li><a href="{{ route('produk.makanan') }}">Produk Makanan</a></li>
            <li><a href="#promo">VR 3D Showroom</a></li>
            <li><a href="{{ route('faq.public') }}">FAQ</a></li>
        </ul>

        <div class="nav-actions">
            <button class="btn-nav-icon" id="navSearchBtn" title="Cari">
                <i class="fas fa-search"></i>
            </button>
            <a href="#" class="btn-nav-icon" title="Keranjang">
                <i class="fas fa-shopping-cart"></i>
                <span class="cart-badge" id="cartCount">0</span>
            </a>
            @auth
                <a href="{{ url('/dashboard') }}" class="btn-dashboard">
                    <i class="fas fa-th-large"></i> Dashboard
                </a>
            @else
                <a href="{{ route('login') }}" class="btn-login">
                    <i class="fas fa-sign-in-alt"></i> Masuk
                </a>
            @endauth
            <button class="navbar-toggler" id="navToggle">
                <span></span><span></span><span></span>
            </button>
        </div>
    </div>
</nav>

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

<!-- ===========================
     FOOTER
============================ -->
<!-- Footer -->
      <footer>
         <div class="container">
            <div class="row g-5">
               <!-- Kolom 1: Logo & Deskripsi -->
               <div class="col-sm-6 col-lg-3">
                  <div class="fnm">FAA <span>Frozen Food & Bakery</span></div>
                  <p class="fdesc">FAA Frozen Food & Bakery menyediakan berbagai produk makanan beku dan Roti berkualitas tinggi dengan rasa yang lezat dan konsisten.</p>
                  <div class="fsoc">
                     <a href="#"><i class="fab fa-facebook-f"></i></a>
                     <a href="#"><i class="fab fa-instagram"></i></a>
                     <a href="#"><i class="fab fa-twitter"></i></a>
                     <a href="#"><i class="fab fa-youtube"></i></a>
                     <a href="#"><i class="fab fa-tiktok"></i></a>
                  </div>
               </div>
               
               <!-- Kolom 2: Link Cepat-->
               <div class="col-sm-6 col-lg-2">
                  <div class="ftit">Link Cepat</div>
                  <ul class="flinks ps-0">
                     <li><a href="{{ route('welcome') }}"><i class="fas fa-chevron-right"></i>Beranda</a></li>
                     <li><a href="{{ url('/#categories') }}"><i class="fas fa-chevron-right"></i>Tentang Kami</a></li>
                     <li><a href="{{ route('berita.public') }}"><i class="fas fa-chevron-right"></i>Berita</a></li>
                     <li><a href="{{ route('produk.makanan') }}"><i class="fas fa-chevron-right"></i>Produk</a></li>
                     <li><a href="{{ route('faq.public') }}"><i class="fas fa-chevron-right"></i>FAQ</a></li>
                  </ul>
               </div>
               
               <!-- Kolom 3: Hubungi Kami-->
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
                     <div class="fciinfo"><strong>Jam Operasional</strong>Setiap Hari: 06.00 - 18.00</div>
                  </div>
               </div>

               <!-- Kolom 4: Lokasi / Google Maps Toko FAA Frozen Food & Bakery -->
               <div class="col-sm-6 col-lg-3">
                  <div class="ftit">Lokasi</div>
                  <div class="fmap" style="border-radius: 10px; overflow: hidden; box-shadow: 0 4px 10px rgba(0,0,0,0.15);">
                     <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3985.449717171717!2d106.1104212!3d-1.8504601!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e22f3e7784d51ad%3A0xf0b32b5d14082039!2sFAA+FROZEN+FOOD!5e0!3m2!1sid!2sid!4v1717424400000!5m2!1sid!2sid" 
                        width="100%" 
                        height="200" 
                        style="border:0; display:block;" 
                        allowfullscreen="" 
                        loading="lazy" 
                        referrerpolicy="no-referrer-when-downgrade">
                     </iframe>
                  </div>
               </div>
            </div>
         </div>
         
         <div class="fbot">
            <div class="container">
               <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                  <p>&copy 2026 <span>FAA Frozen Food & Bakery</span>. <br>Dibuat oleh <a target="_blank" class="mx-0 fw-bold text-success" href="https://www.instagram.com/juliy_safteri?igsh=eTQwZXE3Y2QxdXFj">Juliarti Safitri</a></p>
               </div>
            </div>
         </div>
      </footer>

<!-- Back to Top Button -->
<button id="btt" onclick="window.scrollTo({top:0, behavior:'smooth'})">
    <i class="fas fa-chevron-up"></i>
</button>

<!-- JS -->
<script src="{{ asset('template-sarab/js/jquery-3.7.1.min.js') }}"></script>
<script src="{{ asset('template-sarab/js/bootstrap.bundle.min.js') }}"></script>

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

    // ── Back to Top ────────────────────────────────
    const btt = document.getElementById('btt');
    window.addEventListener('scroll', () => {
        btt.classList.toggle('show', window.scrollY > 300);
    });

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

</body>
</html>