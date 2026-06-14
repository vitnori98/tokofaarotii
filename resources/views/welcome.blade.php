<!DOCTYPE html>
<html lang="en">
   <head>
    <style>
        /* Efek Ngambang / Glowing pada Logo Bulat */
    .logo-floating-wrapper {
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%; /* Memastikan efek shadow berbentuk bulat sempurna */
        /* Menggunakan drop-shadow merah/oranye halus biar mirip contoh */
        filter: drop-shadow(0 0 12px rgba(255, 69, 0, 0.6)); 
        animation: floatingEffect 3s ease-in-out infinite; /* Opsional: animasi naik turun halus */
    }

    /* Animasi naik turun manja (opsional, hapus baris animation di atas kalau mau statis) */
    @keyframes floatingEffect {
        0% { transform: translateY(0px); }
        50% { transform: translateY(-4px); }
        100% { transform: translateY(0px); }
    }

    /* Pengaturan Warna Teks FAA */
    .text-faa {
        font-family: 'Poppins', sans-serif; 
        letter-spacing: 1px;
        color: #dc3545;
    }

    .text-faa .text-red {
        color: #dc3545; 
    }

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

    .navbar {
        background: var(--white);
        border-bottom: 2px solid var(--red);
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        z-index: 1030;
        box-shadow: 0 2px 20px rgba(229,9,20,0.08);
        transition: all 0.3s ease;
    }

    body {
        padding-top: 85px;
    }

    html {
        scroll-padding-top: 95px;
    }

    @media (max-width: 991.98px) {
        body {
            padding-top: 75px;
        }
        .navbar-collapse {
            background: white;
            padding: 1rem;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            margin-top: 10px;
            max-height: 80vh;
            overflow-y: auto;
        }
        .nav-actions {
            flex-wrap: wrap;
            justify-content: flex-start !important;
        }
        .nav-actions .flex-grow-1 {
            width: 100%;
            max-width: 100% !important;
            order: -1;
            margin-bottom: 1rem;
        }
    }

    @media (min-width: 992px) and (max-width: 1250px) {
        .nav-links {
            gap: 10px !important;
        }
        .nav-links a {
            padding: 8px 8px !important;
            font-size: 11px !important;
        }
        .nav-actions .flex-grow-1 {
            max-width: 200px !important;
        }
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
        font-weight: 800;
        font-size: 20px; /* Sedikit dikecilkan agar proporsional */
        color: var(--red);
        letter-spacing: -0.2px;
        line-height: 1;
    }

    .brand-sub {
        display: block;
        font-size: 8px; /* Lebih kecil */
        font-weight: 600;
        color: var(--gray);
        letter-spacing: 1.5px;
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
        font-size: 13px; /* Disesuaikan agar mudah dibaca tapi tetap elegan */
        font-weight: 500;
        color: #334155;
        padding: 8px 15px;
        border-radius: 8px;
        transition: all 0.2s;
        white-space: nowrap;
        font-family: 'Poppins', sans-serif; /* Pastikan font Poppins */
    }

    .nav-links a:hover { background: rgba(229,9,20,0.05); color: var(--red); }
    .nav-links a.active { color: var(--red); font-weight: 600; }

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

    #btt {
    position: fixed;       /* Membuat tombol tetap melayang di layar */
    bottom: 30px;          /* Jarak dari bawah layar */
    right: 30px;           /* Jarak dari kanan layar */
    z-index: 9999;         /* Memastikan tombol berada di lapisan paling atas, tidak tertutup footer */
    
    /* Styling agar mirip dengan gambar (merah, rounded, dan rapi) */
    background-color: #e50914; /* Ganti kode hex ini sesuai warna merah Sarab kamu */
    color: #ffffff;        /* Warna icon panah putih */
    border: none;
    width: 45px;
    height: 45px;
    border-radius: 10px;   /* Membuat sudut tombol melengkung (rounded) */
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
    transition: all 0.3s ease;

    /* Hidden by default */
    opacity: 0;
    visibility: hidden;
    transform: translateY(20px);
   }

   /* Muncul saat di-scroll */
   #btt.show {
      opacity: 1;
      visibility: visible;
      transform: translateY(0);
   }

   /* Efek sedikit menggelap saat diarahkan kursor (hover) */
   #btt:hover {
      background-color: #b80710;
      transform: translateY(-3px); /* Efek tombol sedikit naik saat di-hover */
   }

    /* Accordion FAQ Styling agar selaras dengan tema merah */
    #faq .accordion-button:not(.collapsed) {
        background-color: #dc3545;
        color: white;
    }
    #faq .accordion-button:focus {
        box-shadow: 0 0 0 0.25rem rgba(220, 53, 69, 0.25);
        border-color: #dc3545;
    }
    #faq .accordion-button::after {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23212529'%3e%3cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e");
    }
    #faq .accordion-button:not(.collapsed)::after {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23ffffff'%3e%3cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e");
    }

    /* Custom CSS untuk Tampilan Kategori Modern */

   /* Reset gaya kartu default */
   .catcard {
      transition: all 0.3s ease;
      border-radius: 12px !important; /* Sudut lebih melengkung */
      overflow: hidden; /* Pastikan gambar tidak keluar dari kartu */
   }

   /* Hover Effect: Skala dan Bayangan Lebih Dalam */
   .catcard:hover {
      transform: translateY(-8px); /* Sedikit naik */
      box-shadow: 0 10px 20px rgba(0,0,0,0.15) !important;
   }

   /* Penempatan Gambar dan Konten */
   .catimg-container {
      width: 100%;
      position: relative;
      padding-top: 60%; /* Aspect Ratio 16:9 yang bersih */
   }

   .catimg {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      object-fit: cover; /* Pastikan gambar memenuhi area dengan benar */
      border-radius: 0 !important; /* Hapus radius gambar asli */
   }

   .catcard-body {
      padding: 1.5rem; /* Padding yang lebih baik */
      border-top: 1px solid #eee; /* Garis pemisah halus */
   }

   /* Tipografi */
   .catcard h5 {
      font-size: 1.25rem;
      font-weight: 600;
      margin-bottom: 0; /* Hapus margin default */
      transition: color 0.3s ease;
   }

   /* Hover Effect: Warna Teks Berubah (misalnya, warna utama site Anda) */
   .catcard:hover h5 {
      color: #cc6c28; /* Ganti dengan warna utama Anda, misal deep burnt orange */
   }

   /* Custom Slider Section Styles */
   .slider_section {
       padding: 0;
       background-color: #f9f9f9;
       overflow: hidden;
   }

   .slider_item-box {
       width: 100%;
       min-height: 500px;
       display: flex;
       align-items: center;
       background-size: cover;
       background-position: center;
       position: relative;
   }

   .slider_item-box::before {
       content: "";
       position: absolute;
       top: 0;
       left: 0;
       width: 100%;
       height: 100%;
       background: rgba(0, 0, 0, 0.5); /* Gelapkan banner agar teks putih terlihat jelas */
       z-index: 1;
   }

   .slider_item-container {
       position: relative;
       z-index: 2;
       width: 100%;
   }

   .slider_item-detail h1 {
       font-size: 3.5rem;
       color: #ffffff; /* Ubah ke putih */
       font-weight: 800; /* Tebalkan */
       margin-bottom: 20px;
       text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
   }

   .slider_item-detail p {
       font-size: 1.2rem;
       color: #ffffff; /* Ubah ke putih */
       font-weight: 500;
       margin-bottom: 30px;
       max-width: 600px;
       text-shadow: 1px 1px 2px rgba(0,0,0,0.3);
   }

   .slider_img-box img {
       max-width: 100%;
       height: auto;
       border-radius: 20px;
       box-shadow: 0 10px 30px rgba(0,0,0,0.1);
   }

   /* Custom Navigation Buttons */
   .custom-carousel-btn {
       width: 50px !important;
       height: 50px !important;
       background-color: rgba(220, 53, 69, 0.8) !important; /* Branded red with transparency */
       border-radius: 50% !important;
       top: 50% !important;
       bottom: auto !important;
       transform: translateY(-50%) !important;
       opacity: 0.7 !important;
       transition: all 0.3s ease !important;
       z-index: 5 !important;
       border: none !important;
   }

   .carousel-control-prev.custom-carousel-btn {
       left: 20px !important;
   }

   .carousel-control-next.custom-carousel-btn {
       right: 20px !important;
   }

   .custom-carousel-btn:hover {
       background-color: rgba(176, 42, 55, 1) !important;
       opacity: 1 !important;
       transform: translateY(-50%) scale(1.1) !important;
   }

   .carousel-indicators [data-bs-target] {
       width: 12px;
       height: 12px;
       border-radius: 50%;
       background-color: #dc3545;
       margin: 0 5px;
   }
   /* Memastikan wrapper utama carousel relatif */
#carouselExampleControls {
    position: relative;
}
   </style>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="author" content="Sarab">
      <meta name="description" content="Sarab - Fast Food & Restaurant HTML Template">
      <title>FAA - Frozen Food & Bakery</title>
      
      <!-- Fonts -->
      <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700;900&family=Poppins:wght@300;400;500;600;700&family=Dancing+Script:wght@700&display=swap" rel="stylesheet"/>
      
      <!-- CSS Assets -->
      <link href="{{ asset('template-sarab/css/bootstrap.min.css') }}" rel="stylesheet"/>
      <link href="{{ asset('template-sarab/css/aos.css') }}" rel="stylesheet"/>
      <link href="{{ asset('template-sarab/css/swiper-bundle.min.css') }}" rel="stylesheet"/>
      <link href="{{ asset('template-sarab/css/all.min.css') }}" rel="stylesheet"/>
      <link href="{{ asset('template-sarab/css/magnific-popup.css') }}" rel="stylesheet"/>
      <link href="{{ asset('template-sarab/css/style.css') }}" rel="stylesheet" />
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
   </head>
   <body>

      <!-- Search Overlay -->
      <div id="searchOv">
         <button id="searchClose" class="sovclose"><i class="fas fa-times"></i></button>
         <div class="sovbox">
            <h4>Apa yang Anda dambakan hari ini?</h4>
            <div class="sovinput">
               <input type="text" id="searchInput" placeholder="Cari roti, frozen food, pastry...">
               <button><i class="fas fa-search"></i></button>
            </div>
            <div class="sovcats">
               <div class="sovcat active" data-cat="all">
                  <img src="{{ asset('template-sarab/img/category/1.jpg') }}" alt="Semua"> <span>Semua Item</span>
               </div>
               <div class="sovcat" data-cat="bread">
                  <img src="{{ asset('template-sarab/img/category/1.jpg') }}" alt="Roti"> <span>Bakery</span>
               </div>
               <div class="sovcat" data-cat="frozen">
                  <img src="{{ asset('template-sarab/img/category/2.jpg') }}" alt="Frozen"> <span>Frozen Food</span>
               </div>
               <div class="sovcat" data-cat="pastry">
                  <img src="{{ asset('template-sarab/img/category/3.jpg') }}" alt="Pastry"> <span>Tentang Kami</span>
               </div>
            </div>
            <div class="sovtrend">
               <p>🔥 Pencarian yang Sedang Tren</p>
               <span class="ttag">Roti O Coklat</span>
               <span class="ttag">Bakso Ayam</span>
               <span class="ttag">Visi & Misi Toko FAA</span>
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
               <li><a href="{{ route('welcome') }}" class="active">Beranda</a></li>
               <li><a href="#categories">Tentang Kami</a></li>
               
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

               <li><a href="{{ route('produk.makanan') }}">Produk Makanan</a></li>
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

      <!-- slider section -->
       <section class="slider_section position-relative">
         <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
            <!-- Indicators -->
            <div class="carousel-indicators">
               <button type="button" data-bs-target="#carouselExampleControls" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
               <button type="button" data-bs-target="#carouselExampleControls" data-bs-slide-to="1" aria-label="Slide 2"></button>
               <button type="button" data-bs-target="#carouselExampleControls" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>

            <div class="carousel-inner">
               
               <div class="carousel-item active">
               <div class="slider_item-box" style="background-image: url('{{ asset('template-sarab/img/banner-faa-new.jpeg') }}');">
                  <div class="slider_item-container">
                     <div class="container">
                     <div class="row align-items-center">
                        <div class="col-md-6">
                           <div class="slider_item-detail">
                           <div>
                              <h1 class="fw-bold mb-3">
                                 Welcome to <br />
                                 FAA Frozen Food & Bakery
                              </h1>
                              <p class="text-muted mb-4">
                                 Nikmati kelezatan roti segar dan berbagai pilihan makanan beku berkualitas tinggi setiap hari. Kami menyajikan produk terbaik untuk keluarga Anda.
                              </p>
                              <div class="d-flex">
                                 <a href="{{ route('produk.makanan') }}" class="btn btn-danger text-uppercase rounded-pill me-3 px-4 py-2">
                                 Pesan Sekarang
                                 </a>
                                 <a href="#contact-section" class="btn btn-outline-dark text-uppercase rounded-pill px-4 py-2">
                                 Hubungi Kami
                                 </a>
                              </div>
                           </div>
                           </div>
                        </div>
                        <div class="col-md-6 mt-4 mt-md-0">
                           <div class="slider_img-box text-center">
                              <a href="{{ route('produk.makanan') }}">
                                 <img src="{{ asset('template-sarab/img/logo-toko-faa.png') }}" alt="Logo FAA" class="img-fluid" style="max-height: 350px;" />
                              </a>
                           </div>
                        </div>
                     </div>
                     </div>
                  </div>
               </div>
               </div>

               <div class="carousel-item">
               <div class="slider_item-box" style="background-image: url('{{ asset('template-sarab/img/banner-faa-new.jpeg') }}');">
                  <div class="slider_item-container">
                     <div class="container">
                     <div class="row align-items-center">
                        <div class="col-md-6">
                           <div class="slider_item-detail">
                           <div>
                              <h1 class="fw-bold mb-3">
                                 Roti Segar <br />
                                 Setiap Hari
                              </h1>
                              <p class="text-muted mb-4">
                                 Dipanggang dengan cinta dan bahan-bahan premium untuk memastikan kelembutan dan rasa yang tak terlupakan di setiap gigitan.
                              </p>
                              <div class="d-flex">
                                 <a href="{{ route('produk.makanan') }}" class="btn btn-danger text-uppercase rounded-pill me-3 px-4 py-2">
                                 Lihat Menu
                                 </a>
                                 <a href="#contact-section" class="btn btn-outline-dark text-uppercase rounded-pill px-4 py-2">
                                 Hubungi Kami
                                 </a>
                              </div>
                           </div>
                           </div>
                        </div>
                        <div class="col-md-6 mt-4 mt-md-0">
                           <div class="slider_img-box text-center">
                              <a href="{{ route('produk.makanan') }}">
                                 <img src="{{ asset('template-sarab/img/roti-banner.jpg') }}" alt="Roti Segar" class="img-fluid" style="max-height: 350px; border-radius: 20px;" />
                              </a>
                           </div>
                        </div>
                     </div>
                     </div>
                  </div>
               </div>
               </div>

               <div class="carousel-item">
               <div class="slider_item-box" style="background-image: url('{{ asset('template-sarab/img/banner-faa-new.jpeg') }}');">
                  <div class="slider_item-container">
                     <div class="container">
                     <div class="row align-items-center">
                        <div class="col-md-6">
                           <div class="slider_item-detail">
                           <div>
                              <h1 class="fw-bold mb-3">
                                 Frozen Food <br />
                                 Kualitas Premium
                              </h1>
                              <p class="text-muted mb-4">
                                 Solusi praktis dan lezat untuk hidangan keluarga Anda. Tersedia berbagai pilihan mulai dari daging olahan hingga camilan lezat.
                              </p>
                              <div class="d-flex">
                                 <a href="{{ route('produk.makanan') }}" class="btn btn-danger text-uppercase rounded-pill me-3 px-4 py-2">
                                 Belanja Sekarang
                                 </a>
                                 <a href="#contact-section" class="btn btn-outline-dark text-uppercase rounded-pill px-4 py-2">
                                 Hubungi Kami
                                 </a>
                              </div>
                           </div>
                           </div>
                        </div>
                        <div class="col-md-6 mt-4 mt-md-0">
                           <div class="slider_img-box text-center">
                              <a href="{{ route('produk.makanan') }}">
                                 <img src="{{ asset('template-sarab/img/frozen-banner.jpg') }}" alt="Frozen Food" class="img-fluid" style="max-height: 350px; border-radius: 20px;" />
                              </a>
                           </div>
                        </div>
                     </div>
                     </div>
                  </div>
               </div>
               </div>

            </div>

            <!-- Navigation Controls -->
            <button class="carousel-control-prev custom-carousel-btn" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
               <span class="carousel-control-prev-icon" aria-hidden="true"></span>
               <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next custom-carousel-btn" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
               <span class="carousel-control-next-icon" aria-hidden="true"></span>
               <span class="visually-hidden">Next</span>
            </button>
         </div>
       </section>
      <!-- end slider section -->

      <!-- Keunggulan Toko Section -->
      <section id="keunggulan" class="py-5 bg-white">
         <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
               <span class="slbl">Mengapa Memilih Kami</span>
               <h2 class="stitle">Keunggulan <span>Toko FAA</span></h2>
               <div class="sline"></div>
            </div>
            <div class="row g-4 text-center">
               <!-- Keunggulan 1 -->
               <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                  <div class="p-4 h-100">
                     <div class="mb-3 text-danger fs-1">
                        <i class="fas fa-bread-slice"></i>
                     </div>
                     <h4 class="fw-bold h5">Dipanggang Segar Setiap Hari</h4>
                     <p class="text-muted">Roti kami dipanggang setiap pagi untuk menjamin kelembutan dan kesegaran rasa di setiap gigitan.</p>
                  </div>
               </div>
               <!-- Keunggulan 2 -->
               <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                  <div class="p-4 h-100">
                     <div class="mb-3 text-danger fs-1">
                        <i class="fas fa-certificate"></i>
                     </div>
                     <h4 class="fw-bold h5">100% Halal & Higienis</h4>
                     <p class="text-muted">Proses produksi kami mengikuti standar kebersihan yang ketat dan menggunakan bahan-bahan pilihan yang 100% halal.</p>
                  </div>
               </div>
               <!-- Keunggulan 3 -->
               <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                  <div class="p-4 h-100">
                     <div class="mb-3 text-danger fs-1">
                        <i class="fas fa-boxes"></i>
                     </div>
                     <h4 class="fw-bold h5">Produk Premium Lengkap</h4>
                     <p class="text-muted">Tersedia banyak pilihan Frozen Food & Roti Premium untuk melengkapi kebutuhan kuliner keluarga Anda.</p>
                  </div>
               </div>
            </div>
         </div>
      </section>

      <!-- Kategori Produk Section -->
      <section id="categories" class="py-5 bg-white">
   <div class="container">
      
      <div class="d-flex justify-content-between align-items-end mb-4" data-aos="fade-up">
         <div>
            <span class="text-danger fw-bold text-uppercase small d-block mb-1" style="letter-spacing: 1px;">Kategori Produk</span>
            <h2 class="fw-bold m-0" style="color: #0f172a;">Temukan Semua yang Anda Butuhkan</h2>
         </div>
         <div>
            <a href="#" class="text-decoration-none fw-semibold d-flex align-items-center" style="color: #0284c7;">
               Lihat Semua Produk <i class="bi bi-arrow-right ms-2"></i>
            </a>
         </div>
      </div>

      <div class="row g-4 mb-4">
         
         <div class="col-12 col-md-6" data-aos="fade-up" data-aos-delay="100">
            <div class="card border-0 rounded-4 overflow-hidden position-relative text-white shadow-sm" style="height: 280px; cursor: pointer;">
               <img class="w-100 h-100" src="{{ asset('template-sarab/img/category/frozen.jpg') }}" alt="Frozen Food" style="object-fit: cover;">
               <div class="position-absolute top-0 start-0 w-100 h-100 d-flex flex-column justify-content-end p-4" style="background: linear-gradient(to top, rgba(15,23,42,0.85), rgba(15,23,42,0.1));">
                  <span class="badge bg-white bg-opacity-25 blur-effect text-white rounded-pill px-3 py-2 mb-2 align-self-start small">
                     <i class="bi bi-snowflake me-1"></i> 50+ produk
                  </span>
                  <h3 class="fw-bold m-0 mb-1">Frozen Food</h3>
                  <p class="text-white-50 m-0 small">Nugget, dimsum, sosis, & aneka beku siap masak</p>
               </div>
            </div>
         </div>

         <div class="col-12 col-md-6" data-aos="fade-up" data-aos-delay="200">
            <div class="card border-0 rounded-4 overflow-hidden position-relative text-white shadow-sm" style="height: 280px; cursor: pointer;">
               <img class="w-100 h-100" src="{{ asset('template-sarab/img/category/bakery.jpg') }}" alt="Bakery" style="object-fit: cover;">
               <div class="position-absolute top-0 start-0 w-100 h-100 d-flex flex-column justify-content-end p-4" style="background: linear-gradient(to top, rgba(194,65,12,0.85), rgba(194,65,12,0.1));">
                  <span class="badge bg-white bg-opacity-25 blur-effect text-white rounded-pill px-3 py-2 mb-2 align-self-start small">
                     <i class="bi bi-egg-fried me-1"></i> 30+ produk
                  </span>
                  <h3 class="fw-bold m-0 mb-1">Bakery</h3>
                  <p class="text-white-50 m-0 small">Roti, kue, pastri segar dipanggang setiap hari</p>
               </div>
            </div>
         </div>

      </div>

      <div class="row g-4">

         <div class="col-12 col-sm-6 col-md-3" data-aos="fade-up" data-aos-delay="300">
            <div class="card border-0 rounded-4 p-4 h-100 d-flex flex-column justify-content-between shadow-sm" style="background-color: #f5f3ff; min-height: 160px; cursor: pointer;">
               <div>
                  <div class="rounded-3 d-flex align-items-center justify-content-center mb-3" style="width: 40px; height: 40px; background-color: #ddd6fe; color: #6d28d9;">
                     <i class="bi bi-cake2"></i>
                  </div>
                  <h5 class="fw-bold mb-1" style="color: #1e1b4b;">Kue & Dessert</h5>
                  <p class="text-muted small m-0">Kue ulang tahun, tart, brownies</p>
               </div>
               <span class="fw-bold small mt-3" style="color: #6d28d9;">20+ produk</span>
            </div>
         </div>

         <div class="col-12 col-sm-6 col-md-3" data-aos="fade-up" data-aos-delay="400">
            <div class="card border-0 rounded-4 p-4 h-100 d-flex flex-column justify-content-between shadow-sm" style="background-color: #f0fdf4; min-height: 160px; cursor: pointer;">
               <div>
                  <div class="rounded-3 d-flex align-items-center justify-content-center mb-3" style="width: 40px; height: 40px; background-color: #dcfce7; color: #15803d;">
                     <i class="bi bi-bowl-straw"></i>
                  </div>
                  <h5 class="fw-bold mb-1" style="color: #14532d;">Healthy Bowl</h5>
                  <p class="text-muted small m-0">Salad, wrap, dan pilihan sehat</p>
               </div>
               <span class="fw-bold small mt-3" style="color: #15803d;">15+ produk</span>
            </div>
         </div>

         <div class="col-12 col-sm-6 col-md-3" data-aos="fade-up" data-aos-delay="500">
            <div class="card border-0 rounded-4 p-4 h-100 d-flex flex-column justify-content-between shadow-sm" style="background-color: #fff1f2; min-height: 160px; cursor: pointer;">
               <div>
                  <div class="rounded-3 d-flex align-items-center justify-content-center mb-3" style="width: 40px; height: 40px; background-color: #ffe4e6; color: #be123c;">
                     <i class="bi bi-cone-striped"></i>
                  </div>
                  <h5 class="fw-bold mb-1" style="color: #4c0519;">Ice Cream</h5>
                  <p class="text-muted small m-0">Es krim, gelato, dan sorbet premium</p>
               </div>
               <span class="fw-bold small mt-3" style="color: #be123c;">25+ produk</span>
            </div>
         </div>

         <div class="col-12 col-sm-6 col-md-3" data-aos="fade-up" data-aos-delay="600">
            <div class="card border-0 rounded-4 p-4 h-100 d-flex flex-column justify-content-between shadow-sm" style="background-color: #fefce8; min-height: 160px; cursor: pointer;">
               <div>
                  <div class="rounded-3 d-flex align-items-center justify-content-center mb-3" style="width: 40px; height: 40px; background-color: #fef08a; color: #a16207;">
                     <i class="bi bi-sandwich"></i>
                  </div>
                  <h5 class="fw-bold mb-1" style="color: #422006;">Snack & Sandwich</h5>
                  <p class="text-muted small m-0">Camilan dan sandwich untuk bekal</p>
               </div>
               <span class="fw-bold small mt-3" style="color: #a16207;">18+ produk</span>
            </div>
         </div>

      </div>
   </div>
</section>

<!-- Quick Access Section ke vr dan chatbot -->
<section id="quick-access" class="pb-5 bg-white">
   <div class="container">
      
      <div class="mb-4" data-aos="fade-up">
         <span class="text-danger fw-bold text-uppercase small d-block mb-1" style="letter-spacing: 1px;">Akses Cepat</span>
         <h2 class="fw-bold m-0" style="color: #0f172a;">Pengalaman Belanja Lebih Modern</h2>
      </div>

      <div class="row g-4 mb-4">
         
         <div class="col-12 col-md-6" data-aos="fade-up" data-aos-delay="100">
            <div class="card border-0 rounded-4 p-4 position-relative overflow-hidden text-white h-100 shadow-sm" 
                 style="background: linear-gradient(135deg, #024873 0%, #012340 100%); min-height: 240px;">
               
               <div class="position-absolute end-0 top-50 translate-middle-y opacity-10" 
                    style="width: 180px; height: 180px; border-radius: 50%; background: #ffffff; border: 20px solid #ffffff; margin-right: -40px;"></div>
               
               <div class="position-relative z-1 d-flex flex-column justify-content-between h-100">
                  <div>
                     <div class="rounded-3 d-flex align-items-center justify-content-center mb-3" 
                          style="width: 45px; height: 45px; background-color: rgba(255,255,255,0.1); border: 1px solid rgba(255,255,255,0.2);">
                        <i class="bi bi-box-seam fs-5 text-info"></i>
                     </div>
                     <h3 class="fw-bold mb-2 fs-4">VR 3D Showroom</h3>
                     <p class="text-white-50 small mb-4" style="max-width: 85%;">Jelajahi toko kami secara virtual. Lihat produk dari segala sudut sebelum membeli.</p>
                  </div>
                  <a href="#" class="btn btn-info text-white rounded-pill px-4 py-2 align-self-start btn-sm fw-semibold d-flex align-items-center" 
                     style="background-color: #0084b4; border: none;">
                     Masuk Showroom <i class="bi bi-arrow-right ms-2"></i>
                  </a>
               </div>
            </div>
         </div>

         <div class="col-12 col-md-6" data-aos="fade-up" data-aos-delay="200">
            <div class="card border-0 rounded-4 p-4 position-relative overflow-hidden text-white h-100 shadow-sm" 
                 style="background: linear-gradient(135deg, #3b0764 0%, #1e0236 100%); min-height: 240px;">
               
               <div class="position-absolute end-0 top-50 translate-middle-y opacity-10" 
                    style="width: 180px; height: 180px; border-radius: 50%; background: #ffffff; margin-right: -30px;"></div>
               
               <div class="position-relative z-1 d-flex flex-column justify-content-between h-100">
                  <div>
                     <div class="rounded-3 d-flex align-items-center justify-content-center mb-3" 
                          style="width: 45px; height: 45px; background-color: rgba(255,255,255,0.1); border: 1px solid rgba(255,255,255,0.2);">
                        <i class="bi bi-robot fs-5 text-mediumpurple" style="color: #c084fc;"></i>
                     </div>
                     <div class="d-flex align-items-center mb-2">
                        <h3 class="fw-bold m-0 fs-4 me-2">AI Chatbot</h3>
                        <span class="badge rounded-pill text-white font-monospace opacity-75 small" 
                              style="background-color: #6b21a8; border: 1px solid #a855f7; font-size: 0.65rem;">
                           <i class="bi bi-sparkles me-1"></i>Beta
                        </span>
                     </div>
                     <p class="text-white-50 small mb-4" style="max-width: 85%;">Tanya rekomendasi produk, cek ketersediaan stok, atau dapatkan resep masak langsung via chat.</p>
                  </div>
                  <a href="#" class="btn rounded-pill px-4 py-2 align-self-start btn-sm fw-semibold d-flex align-items-center text-white" 
                     style="background-color: rgba(255,255,255,0.1); border: 1px solid rgba(255,255,255,0.25);">
                     Mulai Chat <i class="bi bi-arrow-right ms-2"></i>
                  </a>
               </div>
            </div>
         </div>

      </div>

      <div class="row" data-aos="fade-up" data-aos-delay="300">
         <div class="col-12">
            <div class="card border rounded-4 p-4 shadow-sm bg-white">
               <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
                  
                  <div class="d-flex align-items-center">
                     <div class="rounded-3 d-flex align-items-center justify-content-center me-3 flex-shrink-0" 
                          style="width: 48px; height: 48px; background-color: #f1f5f9; color: #475569; border: 1px solid #e2e8f0;">
                        <i class="bi bi-headset fs-4"></i>
                     </div>
                     <div>
                        <h5 class="fw-bold mb-1" style="color: #1e293b; font-size: 1rem;">Butuh Bantuan?</h5>
                        <p class="text-muted small m-0">Tim kami siap membantu Senin–Sabtu, pukul 08.00–20.00 WIB</p>
                     </div>
                  </div>

                  <div class="d-flex align-items-center gap-2 flex-wrap">
                     <a href="https://wa.me/yournumber" class="btn btn-success fw-bold px-4 py-2 rounded-3 d-flex align-items-center" 
                        style="background-color: #00e676; border: none; font-size: 0.9rem;">
                        WhatsApp
                     </a>
                     <a href="#" class="btn btn-outline-secondary text-dark fw-semibold px-4 py-2 rounded-3" 
                        style="border-color: #cbd5e1; font-size: 0.9rem;">
                        Hubungi Kami
                     </a>
                  </div>

               </div>
            </div>
         </div>
      </div>

   </div>
</section>

<!-- Berita & Pembaruan Section -->
      <div id="menuPop">
   <div class="mpbox">
      <button id="mpClose" class="mpclose"><i class="fas fa-times"></i></button>
      <div class="mpimg">
         <img id="mpImg" src="" alt="" />
      </div>
      <div class="mpbody">
         <div id="mpCat"></div>
         <h3 id="mpTitle"></h3>
         <div id="mpStars"></div>
         <div id="mpDesc"></div>
         <div id="mpPrice"></div>
         <div class="mpmeta" id="mpMeta"></div>
         <div class="mptags" id="mpTags"></div>
         
         <div class="mpqty">
            <button class="mpqbtn" id="mpMinus">-</button>
            <div class="mpqnum" id="mpQnum">1</div>
            <button class="mpqbtn" id="mpPlus">+</button>
         </div>
         
         <button class="mpaddcart" id="mpAddCart">
            <i class="fas fa-shopping-cart"></i> Add to Cart
         </button>
      </div>
   </div>
</div>

<section id="blog" class="py-5" style="background-color: #faf6f0;">
   <div class="container">
      
      <div class="text-center mb-5" data-aos="fade-up">
         <span class="d-block text-danger fw-semibold text-capitalize mb-2" style="font-family: 'Playfair Display', serif; font-style: italic; font-size: 1.15rem;">Berita & Pembaruan</span>
         <h2 class="fw-bold position-relative d-inline-block pb-3" style="color: #0f172a; font-size: 2.25rem;">
            Berita <span class="text-danger">Terbaru</span> Dari FAA
            <span class="position-absolute start-50 translate-middle-x bottom-0 rounded" style="width: 50px; height: 4px; background: linear-gradient(to right, #f97316, #ef4444);"></span>
         </h2>
      </div>

      <div class="row g-4 justify-content-center">
         @forelse($beritas as $index => $berita)
         <div class="col-12 col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="{{ $index * 80 }}">
            <div class="card border-0 rounded-4 overflow-hidden shadow-sm h-100 bg-white" style="transition: transform 0.2s ease;">
               
               <div class="position-relative overflow-hidden" style="height: 220px;">
                  @if($berita->gambar)
                     <img class="w-100 h-100" src="{{ asset('storage/' . $berita->gambar) }}" alt="{{ $berita->judul }}" style="object-fit: cover; object-position: center;"/>
                  @else
                     <img class="w-100 h-100" src="{{ asset('template-sarab/img/blog/' . ($index + 1) . '.jpg') }}" alt="Default" style="object-fit: cover; object-position: center;"/>
                  @endif
                  
                  @php
                     $date = \Carbon\Carbon::parse($berita->created_at);
                  @endphp
                  
                  <div class="position-absolute top-0 start-0 m-3 bg-danger text-white rounded-3 d-flex flex-column align-items-center justify-content-center shadow" style="width: 45px; height: 48px; line-height: 1.1;">
                     <span class="fw-bold fs-5">{{ $date->translatedFormat('d') }}</span>
                     <span class="text-uppercase fw-semibold" style="font-size: 0.65rem; letter-spacing: 0.5px;">{{ $date->translatedFormat('M') }}</span>
                  </div>
               </div>

               <div class="card-body p-4 d-flex flex-column justify-content-between">
                  <div>
                     <span class="text-danger text-uppercase fw-bold d-block mb-2" style="font-size: 0.75rem; letter-spacing: 0.5px;">
                        {{ $berita->kategori ?? 'Berita' }}
                     </span>
                     
                     <h5 class="fw-bold mb-3" style="font-size: 1.15rem; line-height: 1.4;">
                        <a href="{{ route('berita.show', $berita->id) }}" class="text-decoration-none text-dark hover-opacity" style="color: #1e293b;">
                           {{ $berita->judul }}
                        </a>
                     </h5>
                     
                     <div class="text-muted small d-flex align-items-center mb-4">
                        <i class="far fa-calendar-alt me-2 text-danger"></i>
                        <span>{{ $date->translatedFormat('d M Y') }}</span>
                     </div>
                  </div>

                  <a href="{{ route('berita.show', $berita->id) }}" class="text-danger fw-bold text-decoration-none small d-inline-flex align-items-center mt-auto" style="letter-spacing: 0.2px;">
                     Baca Selengkapnya <i class="fas fa-arrow-right ms-2" style="font-size: 0.8rem;"></i>
                  </a>
               </div>

            </div>
         </div>
         @empty
         <div class="col-12 text-center py-5">
            <p class="text-muted fs-5">Belum ada berita tersedia.</p>
         </div>
         @endforelse
      </div>

      <div class="text-center mt-5" data-aos="fade-up">
         <a href="{{ route('berita.public') }}" class="btn btn-primary fw-semibold px-4 py-25 rounded-3 d-inline-flex align-items-center shadow-sm" style="background-color: #0066ff; border: none; font-size: 0.95rem; padding-top: 10px; padding-bottom: 10px;">
            Lihat Semua Berita <i class="fas fa-arrow-right ms-2"></i>
         </a>
      </div>

   </div>
</section>

      <!-- Contact Section -->
      <section id="contact-section">
         <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
               <span class="slbl">Hubungi Kami</span>
               <h2 class="stitle">Hubungi <span>Kami</span></h2>
               <div class="sline"></div>
               <p class="sdesc mx-auto" style="max-width:480px;">Punya pertanyaan, atau umpan balik? Kami ingin mendengar dari Anda.</p>
            </div>
            <div class="row g-4">
               <div class="col-lg-4" data-aos="fade-right">
                  <div class="ctdark">
                     <h4>Mari Kita Bicara</h4>
                     <p class="ctsub">Kami biasanya merespons dalam waktu 2 jam selama jam kerja.</p>
                     <div class="ctitem">
                        <div class="cticon"><i class="fas fa-map-marker-alt"></i></div>
                        <div class="ctinfo"><strong>Alamat</strong><span>Kuday, Sungai Liat, Kabupaten Bangka, <br/>Kepulauan Bangka Belitung 33211</span></div>
                     </div>
                     <div class="ctitem">
                        <div class="cticon"><i class="fas fa-phone-alt"></i></div>
                        <div class="ctinfo"><strong>Telepon</strong><span>+62 0853-6878-7893</span></div>
                     </div>
                     <div class="ctitem">
                        <div class="cticon"><i class="fas fa-envelope"></i></div>
                        <div class="ctinfo"><strong>Email</strong><span>hello@sarabfood.com</span></div>
                     </div>
                     <div class="ctitem">
                        <div class="cticon"><i class="fas fa-clock"></i></div>
                        <div class="ctinfo"><strong>Jam Operasional</strong><span>Setiap Hari: 06.00 - 18.00</span></div>
                     </div>
                     <div class="ctsocrow">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-youtube"></i></a>
                     </div>
                  </div>
               </div>
               <div class="col-lg-8" data-aos="fade-left">
                  <div class="fcard">
                     <div class="row g-3">
                        <div class="col-sm-6"><label class="flbl">Nama Anda *</label><input type="text" class="fctrl" placeholder="Tulis nama Anda di sini..."/></div>
                        <div class="col-sm-6"><label class="flbl">Alamat Email *</label><input type="email" class="fctrl" placeholder="email Anda..."/></div>
                        <div class="col-sm-6"><label class="flbl">Nomor Telepon</label><input type="tel" class="fctrl" placeholder="nomor telepon Anda..."/></div>
                        <div class="col-sm-6">
                           <label class="flbl">Pertanyaan Umum *</label>
                           <select class="fctrl">
                              <option>Tentang Toko FAA</option>
                              <option>Frozen Food &amp; Bakery</option>
                              <option>Umpan Balik</option>
                              <option>Berita</option>
                              <option>VR 3D Showroom</option>
                              <option>FAQ</option>
                           </select>
                        </div>
                        <div class="col-12"><label class="flbl">Pesan *</label><textarea class="fctrl" rows="5" placeholder="Tulis pesan Anda di sini..."></textarea></div>
                        <div class="col-12"><button class="btn-red" id="ctcBtn"><i class="fas fa-paper-plane"></i>Kirim Pesan</button></div>
                     </div>
                     <div class="sucmsg" id="ctcOk">
                        <i class="fas fa-check-circle"></i>
                        <p>Pesan berhasil dikirim!</p>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>

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
                     <li><a href="#hero"><i class="fas fa-chevron-right"></i>Beranda</a></li>
                     <li><a href="#categories"><i class="fas fa-chevron-right"></i>Tentang Kami</a></li>
                     <li><a href="{{ route('berita.public') }}"><i class="fas fa-chevron-right"></i>Berita</a></li>
                     <li><a href="#promo"><i class="fas fa-chevron-right"></i>Flash Sale</a></li>
                     <li><a href="#blog"><i class="fas fa-chevron-right"></i>Blog</a></li>
                     <li><a href="#contact-section"><i class="fas fa-chevron-right"></i>Kontak</a></li>
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

      <!-- Scroll To Top Button -->
      <button id="btt" onclick="window.scrollTo({top:0,behavior:'smooth'})">
         <i class="fas fa-chevron-up"></i>
      </button>

      <!-- JavaScript Libraries -->
      <script src="{{ asset('template-sarab/js/jquery-3.7.1.min.js') }}"></script>
      <script src="{{ asset('template-sarab/js/bootstrap.bundle.min.js') }}"></script>
      <script src="{{ asset('template-sarab/js/jquery.magnific-popup.min.js') }}"></script>
      <script src="{{ asset('template-sarab/js/aos.js') }}"></script>
      <script src="{{ asset('template-sarab/js/swiper-bundle.min.js') }}"></script>

      <!-- Hidden Placeholders for Compatibility with main.js -->
      <div style="display:none;">
         <button id="resBtn"></button>
         <div id="resOk"></div >
         <button id="nlBtn"></button>
         <input id="nlEmail">
      </div>

      <!-- Custom Main Script -->
      <script src="{{ asset('template-sarab/js/main.js') }}"></script>

      <script>
         // Live Search Product
         document.getElementById('searchInput').addEventListener('input', function() {
            let query = this.value.toLowerCase();
            let items = document.querySelectorAll('.mwrap');
            
            items.forEach(item => {
               let title = item.querySelector('.card-title').textContent.toLowerCase();
               let desc = item.querySelector('.text-muted').textContent.toLowerCase();
               
               if (title.includes(query) || desc.includes(query)) {
                  item.classList.remove('gone');
                  item.style.display = 'block';
               } else {
                  item.classList.add('gone');
                  item.style.display = 'none';
               }
            });
         });
      </script>
   </body>
</html>