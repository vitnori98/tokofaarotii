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
       background: rgba(255, 255, 255, 0.6); /* Overlay agar teks mudah dibaca */
       z-index: 1;
   }

   .slider_item-container {
       position: relative;
       z-index: 2;
       width: 100%;
   }

   .slider_item-detail h1 {
       font-size: 3.5rem;
       color: #333;
       margin-bottom: 20px;
   }

   .slider_item-detail p {
       font-size: 1.1rem;
       color: #666;
       margin-bottom: 30px;
       max-width: 500px;
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

      <!-- Header / Navigation -->
      <header id="nav" class="navbar navbar-expand-lg navbar-light bg-light sticky-top shadow-sm">
         <div class="container">
             <!-- BRAND LOGO DAN NAMA TOKO -->
            <a class="navbar-brand d-flex align-items-center fw-bold fs-3 logo-faa-container" href="{{ route('welcome') }}">
                <!-- Logo dengan efek ngambang/glowing -->
                <div class="logo-floating-wrapper me-2">
                    <img src="{{ asset('template-sarab/img/logo-toko-faa.png') }}" alt="Logo Toko FAA" style="height: 55px; width: auto;">
                </div>
                
                <!-- Teks FAA -->
                <span class="text-faa">
                    <span class="text-red">FAA</span>
                </span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navmenu">
               <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navmenu">
               <ul class="navbar-nav ms-auto align-items-center">
                  <li class="nav-item"><a class="nav-link active" href="{{ route('welcome') }}">Beranda</a></li>
                  <li class="nav-item"><a class="nav-link" href="#categories">Tentang Kami</a></li>
                  <li class="nav-item"><a class="nav-link" href="#menu">Berita</a></li>
                  <li class="nav-item"><a class="nav-link" href="#promo">Dokumentasi</a></li>
                  <li class="nav-item"><a class="nav-link" href="{{ route('produk.makanan') }}">Produk Makanan</a></li>
                  <li class="nav-item"><a class="nav-link" href="#promo">VR 3D Showroom</a></li>
                  <li class="nav-item"><a class="nav-link" href="{{ route('faq.public') }}">FAQ</a></li>
                  <li class="nav-item">
                     <button id="navSearchBtn" class="btn btn-link text-dark nav-link"><i class="fas fa-search"></i></button>
                  </li>
                  <li class="nav-item">
                     <a href="#" class="nav-link position-relative me-lg-2">
                        <i class="fas fa-shopping-cart"></i>
                        <span id="cartCount" class="badge rounded-pill bg-danger position-absolute top-0 start-100 translate-middle" style="font-size: 0.7rem;">0</span>
                     </a>
                  </li>
                  <li class="nav-item ms-lg-2">
                     @auth
                        <a href="{{ url('/dashboard') }}" class="btn btn-outline-danger btn-sm rounded-pill px-3 shadow-sm">
                           <i class="fas fa-th-large me-1"></i> Dashboard
                        </a>
                     @else
                        <a href="{{ route('login') }}" class="btn btn-danger btn-sm rounded-pill px-3 shadow-sm">
                           <i class="fas fa-sign-in-alt me-1"></i> Masuk
                        </a>
                     @endauth
                  </li>
               </ul>
            </div>
         </div>
      </header>

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
               <div class="slider_item-box" style="background-image: url('{{ asset('template-sarab/img/banner-toko-faa.png') }}');">
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
               <div class="slider_item-box" style="background-image: url('{{ asset('template-sarab/img/banner-toko-faa.png') }}');">
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
               <div class="slider_item-box" style="background-image: url('{{ asset('template-sarab/img/banner-toko-faa.png') }}');">
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

      <!-- Categories Section -->
      <section id="categories" class="py-5 bg-light"> <!-- Tambahkan bg-light opsional untuk kontras -->
         <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
                  <h2 class="fw-bold text-uppercase" style="letter-spacing: 1px;">Kategori Pilihan</h2>
                  <p class="text-muted fs-5">Pilih kategori produk favorit Anda untuk melihat lebih banyak</p>
            </div>
            <div class="row g-4 justify-content-center">

                  <!-- Kategori 1: Roti Segar -->
                  <div class="col-12 col-sm-6 col-lg-3" data-aos="fade-up" data-aos-delay="100">
                     <div class="card text-start shadow-sm border-0 catcard active" data-filter="bread" style="cursor: pointer;">
                        <div class="catimg-container">
                              <!-- Pastikan gambar memiliki rasio yang baik, misalnya 16:9 -->
                              <img class="catimg img-fluid" src="{{ asset('template-sarab/img/category/1.jpg') }}" alt="Roti Segar"/>
                        </div>
                        <div class="card-body catcard-body">
                              <h5>Roti Segar</h5>
                        </div>
                     </div>
                  </div>

                  <!-- Kategori 2: Frozen Food -->
                  <div class="col-12 col-sm-6 col-lg-3" data-aos="fade-up" data-aos-delay="200">
                     <div class="card text-start shadow-sm border-0 catcard" data-filter="frozen" style="cursor: pointer;">
                        <div class="catimg-container">
                              <img class="catimg img-fluid" src="{{ asset('template-sarab/img/category/2.jpg') }}" alt="Frozen Food"/>
                        </div>
                        <div class="card-body catcard-body">
                              <h5>Frozen Food</h5>
                        </div>
                     </div>
                  </div>

                  <!-- Kategori 3: Kue & Pastry (Ditambahkan untuk keseimbangan, seperti pada gambar) -->
                  <div class="col-12 col-sm-6 col-lg-3" data-aos="fade-up" data-aos-delay="300">
                     <div class="card text-start shadow-sm border-0 catcard" data-filter="pastry" style="cursor: pointer;">
                        <div class="catimg-container">
                              <!-- Ganti asset dengan gambar kue yang sesuai -->
                              <img class="catimg img-fluid" src="{{ asset('template-sarab/img/category/3.jpg') }}" alt="Kue & Pastry"/>
                        </div>
                        <div class="card-body catcard-body">
                              <h5>Kue & Pastry</h5>
                        </div>
                     </div>
                  </div>

                  <!-- Kategori 4: Produk Olahan Daging (Ditambahkan untuk keseimbangan) -->
                  <div class="col-12 col-sm-6 col-lg-3" data-aos="fade-up" data-aos-delay="400">
                     <div class="card text-start shadow-sm border-0 catcard" data-filter="processed_meat" style="cursor: pointer;">
                        <div class="catimg-container">
                              <!-- Ganti asset dengan gambar produk olahan daging yang sesuai -->
                              <img class="catimg img-fluid" src="{{ asset('template-sarab/img/category/4.jpg') }}" alt="Produk Olahan Daging"/>
                        </div>
                        <div class="card-body catcard-body">
                              <h5>Produk Olahan Daging</h5>
                        </div>
                     </div>
                  </div>

            </div>
         </div>
      </section>

      <!-- Dynamic Product Detail Modal Popup -->
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

      <!-- BLOG -->
      <section id="blog">
         <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
               <span class="slbl">Berita &amp; Pembaruan</span>
               <h2 class="stitle">Posting <span>Produk</span> Terbaru Kami</h2>
               <div class="sline"></div>
            </div>
            <div class="row g-4">
               <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="0">
                  <div class="blcard">
                     <div class="blimg">
                        <img src="{{ asset('template-sarab/img/blog/1.jpg') }}" alt=""/>
                        <div class="bldatebdg"><span class="bd">14</span><span class="bm">Mar</span></div>
                     </div>
                     <div class="blbody">
                        <div class="bltag">Food &amp; Health</div>
                        <div class="bltit"><a href="#">Healthy Fast Food: A Myth or Beautiful Reality</a></div>
                        <div class="blmeta"><span><i class="fas fa-user"></i>James Writer</span><span><i class="fas fa-comment"></i>24 Comments</span></div>
                        <a href="#" class="blmore">Read More <i class="fas fa-arrow-right"></i></a>
                     </div>
                  </div>
               </div>
               <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="80">
                  <div class="blcard">
                     <div class="blimg">
                        <img src="{{ asset('template-sarab/img/blog/2.jpg') }}" alt=""/>
                        <div class="bldatebdg"><span class="bd">28</span><span class="bm">Feb</span></div>
                     </div>
                     <div class="blbody">
                        <div class="bltag">Food Science</div>
                        <div class="bltit"><a href="#">Is Fast Food Getting Healthier? Here's What We Found</a></div>
                        <div class="blmeta"><span><i class="fas fa-user"></i>Sarah Grain</span><span><i class="fas fa-comment"></i>18 Comments</span></div>
                        <a href="#" class="blmore">Read More <i class="fas fa-arrow-right"></i></a>
                     </div>
                  </div>
               </div>
               <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="160">
                  <div class="blcard">
                     <div class="blimg">
                        <img src="{{ asset('template-sarab/img/blog/3.jpg') }}" alt=""/>
                        <div class="bldatebdg"><span class="bd">05</span><span class="bm">Jan</span></div>
                     </div>
                     <div class="blbody">
                        <div class="bltag">Recipes</div>
                        <div class="bltit"><a href="#">Innovative Hot Chickpeas Flake Crackin' Recipe at Home</a></div>
                        <div class="blmeta"><span><i class="fas fa-user"></i>Chef Marcus</span><span><i class="fas fa-comment"></i>32 Comments</span></div>
                        <a href="#" class="blmore">Read More <i class="fas fa-arrow-right"></i></a>
                     </div>
                  </div>
               </div>
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
                     <li><a href="#menu"><i class="fas fa-chevron-right"></i>Berita</a></li>
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