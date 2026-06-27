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
        /* Menggunakan drop-shadow biru halus */
        filter: drop-shadow(0 0 12px rgba(0, 74, 173, 0.6)); 
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
        color: #004aad;
    }

    .text-faa .text-red {
        color: #004aad; 
    }

    #btt {
    position: fixed;       /* Membuat tombol tetap melayang di layar */
    bottom: 30px;          /* Jarak dari bawah layar */
    right: 30px;           /* Jarak dari kanan layar */
    z-index: 9999;         /* Memastikan tombol berada di lapisan paling atas, tidak tertutup footer */
    
    /* Styling agar mirip dengan gambar (biru, rounded, dan rapi) */
    background-color: #004aad; /* Ganti ke biru */
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
      background-color: #003580;
      transform: translateY(-3px); /* Efek tombol sedikit naik saat di-hover */
   }

    /* Accordion FAQ Styling agar selaras dengan tema biru */
    #faq .accordion-button:not(.collapsed) {
        background-color: #004aad;
        color: white;
    }
    #faq .accordion-button:focus {
        box-shadow: 0 0 0 0.25rem rgba(0, 74, 173, 0.25);
        border-color: #004aad;
    }
    #faq .accordion-button::after {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23212529'%3e%3cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e");
    }
    #faq .accordion-button:not(.collapsed)::after {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23ffffff'%3e%3cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e");
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
       color: #ffffff !important; /* Paksa ke putih */
       font-weight: 800; /* Tebalkan */
       margin-bottom: 20px;
       text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
   }

   .slider_item-detail p {
       font-size: 1.2rem;
       color: #ffffff !important; /* Paksa ke putih, menimpa text-muted */
       font-weight: 500;
       margin-bottom: 30px;
       max-width: 600px;
       text-shadow: 1px 1px 2px rgba(0,0,0,0.5);
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
       background-color: rgba(0, 74, 173, 0.8) !important; /* Branded blue with transparency */
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
       background-color: rgba(0, 53, 128, 1) !important;
       opacity: 1 !important;
       transform: translateY(-50%) scale(1.1) !important;
   }

   .carousel-indicators [data-bs-target] {
       width: 12px;
       height: 12px;
       border-radius: 50%;
       background-color: #f97316;
       margin: 0 5px;
   }
   /* Memastikan wrapper utama carousel relatif */
#carouselExampleControls {
    position: relative;
}

/* Keunggulan Section 3D Effect */
.keunggulan-card {
    background: #ffffff;
    border-radius: 20px;
    box-shadow: 8px 8px 20px rgba(0, 0, 0, 0.05), -8px -8px 20px rgba(255, 255, 255, 0.8);
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    border: 1px solid rgba(0, 0, 0, 0.02);
    position: relative;
    overflow: hidden;
}

.keunggulan-card:hover {
    transform: translateY(-15px);
    box-shadow: 0 25px 50px rgba(0, 74, 173, 0.1);
    background: linear-gradient(145deg, #ffffff, #f0f9ff);
}

.keunggulan-card::after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 4px;
    background: #f97316;
    transform: scaleX(0);
    transition: transform 0.4s ease;
    transform-origin: left;
}

.keunggulan-card:hover::after {
    transform: scaleX(1);
}

/* Hover Lift Effect for Categories & Quick Access */
.hover-lift {
    transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1) !important;
}

.hover-lift:hover {
    transform: translateY(-12px) scale(1.02);
    box-shadow: 0 30px 60px rgba(0, 0, 0, 0.15) !important;
    z-index: 10;
}

/* News Card Enhancement */
.news-card {
    transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
}

.news-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.12) !important;
}

.news-card .img-container {
    overflow: hidden;
    border-radius: 12px 12px 0 0;
}

.news-card:hover img {
    transform: scale(1.1);
}

.news-card img {
    transition: transform 0.6s cubic-bezier(0.165, 0.84, 0.44, 1);
}

.blur-effect {
    backdrop-filter: blur(8px);
    -webkit-backdrop-filter: blur(8px);
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

      @include('layouts.partials.navbar')

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
                                 <a href="{{ route('produk.makanan') }}" class="btn btn-warning text-uppercase rounded-pill me-3 px-4 py-2 text-white fw-bold" style="background-color: #f97316; border: none;">
                                 Pesan Sekarang
                                 </a>
                                 <a href="#contact-section" class="btn btn-outline-primary text-uppercase rounded-pill px-4 py-2 fw-bold" style="color: #004aad; border-color: #004aad;">
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
                                 <a href="{{ route('produk.makanan') }}" class="btn btn-warning text-uppercase rounded-pill me-3 px-4 py-2 text-white fw-bold" style="background-color: #f97316; border: none;">
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
                                 <a href="{{ route('produk.makanan') }}" class="btn btn-warning text-uppercase rounded-pill me-3 px-4 py-2 text-white fw-bold" style="background-color: #f97316; border: none;">
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
                  <div class="keunggulan-card p-4 h-100">
                     <div class="mb-3 fs-1" style="color: #004aad;">
                        <i class="fas fa-bread-slice"></i>
                     </div>
                     <h4 class="fw-bold h5" style="color: #004aad;">Dipanggang Segar Setiap Hari</h4>
                     <p class="text-muted">Roti kami dipanggang setiap pagi untuk menjamin kelembutan dan kesegaran rasa di setiap gigitan.</p>
                  </div>
               </div>
               <!-- Keunggulan 2 -->
               <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                  <div class="keunggulan-card p-4 h-100">
                     <div class="mb-3 fs-1" style="color: #f97316;">
                        <i class="fas fa-certificate"></i>
                     </div>
                     <h4 class="fw-bold h5" style="color: #004aad;">100% Halal & Higienis</h4>
                     <p class="text-muted">Proses produksi kami mengikuti standar kebersihan yang ketat dan menggunakan bahan-bahan pilihan yang 100% halal.</p>
                  </div>
               </div>
               <!-- Keunggulan 3 -->
               <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                  <div class="keunggulan-card p-4 h-100">
                     <div class="mb-3 fs-1" style="color: #004aad;">
                        <i class="fas fa-boxes"></i>
                     </div>
                     <h4 class="fw-bold h5" style="color: #004aad;">Produk Premium Lengkap</h4>
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
            <span class="text-primary fw-bold text-uppercase small d-block mb-1" style="letter-spacing: 1px;">Kategori Produk</span>
            <h2 class="fw-bold m-0" style="color: #0f172a;">Temukan Semua yang Anda Butuhkan</h2>
         </div>
         <div>
            <a href="#" class="text-decoration-none fw-semibold d-flex align-items-center" style="color: #f97316;">
               Lihat Semua Produk <i class="bi bi-arrow-right ms-2"></i>
            </a>
         </div>
      </div>

      <div class="row g-4 mb-4">
         
         <div class="col-12 col-md-6" data-aos="fade-up" data-aos-delay="100">
            <div class="card border-0 rounded-4 overflow-hidden position-relative text-white shadow-sm hover-lift" style="height: 280px; cursor: pointer;">
               <img class="w-100 h-100" src="{{ asset('template-sarab/img/category/frozen.jpg') }}" alt="Frozen Food" style="object-fit: cover;">
               <div class="position-absolute top-0 start-0 w-100 h-100 d-flex flex-column justify-content-end p-4" style="background: linear-gradient(to top, rgba(0, 74, 173, 0.85), rgba(0, 74, 173, 0.1));">
                  <span class="badge bg-white bg-opacity-25 blur-effect text-white rounded-pill px-3 py-2 mb-2 align-self-start small">
                     <i class="bi bi-snowflake me-1"></i> 50+ produk
                  </span>
                  <h3 class="fw-bold m-0 mb-1">Frozen Food</h3>
                  <p class="text-white-50 m-0 small">Nugget, dimsum, sosis, & aneka beku siap masak</p>
               </div>
            </div>
         </div>

         <div class="col-12 col-md-6" data-aos="fade-up" data-aos-delay="200">
            <div class="card border-0 rounded-4 overflow-hidden position-relative text-white shadow-sm hover-lift" style="height: 280px; cursor: pointer;">
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
            <div class="card border-0 rounded-4 p-4 h-100 d-flex flex-column justify-content-between shadow-sm hover-lift" style="background-color: #f0f9ff; min-height: 160px; cursor: pointer;">
               <div>
                  <div class="rounded-3 d-flex align-items-center justify-content-center mb-3" style="width: 40px; height: 40px; background-color: #e0f2fe; color: #004aad;">
                     <i class="bi bi-cake2"></i>
                  </div>
                  <h5 class="fw-bold mb-1" style="color: #0c4a6e;">Kue & Dessert</h5>
                  <p class="text-muted small m-0">Kue ulang tahun, tart, brownies</p>
               </div>
               <span class="fw-bold small mt-3" style="color: #004aad;">20+ produk</span>
            </div>
         </div>

         <div class="col-12 col-sm-6 col-md-3" data-aos="fade-up" data-aos-delay="400">
            <div class="card border-0 rounded-4 p-4 h-100 d-flex flex-column justify-content-between shadow-sm hover-lift" style="background-color: #f0fdf4; min-height: 160px; cursor: pointer;">
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
            <div class="card border-0 rounded-4 p-4 h-100 d-flex flex-column justify-content-between shadow-sm hover-lift" style="background-color: #f0f9ff; min-height: 160px; cursor: pointer;">
               <div>
                  <div class="rounded-3 d-flex align-items-center justify-content-center mb-3" style="width: 40px; height: 40px; background-color: #e0f2fe; color: #004aad;">
                     <i class="bi bi-cone-striped"></i>
                  </div>
                  <h5 class="fw-bold mb-1" style="color: #0c4a6e;">Ice Cream</h5>
                  <p class="text-muted small m-0">Es krim, gelato, dan sorbet premium</p>
               </div>
               <span class="fw-bold small mt-3" style="color: #004aad;">25+ produk</span>
            </div>
         </div>

         <div class="col-12 col-sm-6 col-md-3" data-aos="fade-up" data-aos-delay="600">
            <div class="card border-0 rounded-4 p-4 h-100 d-flex flex-column justify-content-between shadow-sm hover-lift" style="background-color: #fffaf0; min-height: 160px; cursor: pointer;">
               <div>
                  <div class="rounded-3 d-flex align-items-center justify-content-center mb-3" style="width: 40px; height: 40px; background-color: #fff4e0; color: #f97316;">
                     <i class="bi bi-sandwich"></i>
                  </div>
                  <h5 class="fw-bold mb-1" style="color: #7c2d12;">Snack & Sandwich</h5>
                  <p class="text-muted small m-0">Camilan dan sandwich untuk bekal</p>
               </div>
               <span class="fw-bold small mt-3" style="color: #f97316;">18+ produk</span>
            </div>
         </div>

      </div>
   </div>
</section>

<!-- Quick Access Section ke vr dan chatbot -->
<section id="quick-access" class="pb-5 bg-white">
   <div class="container">
      
      <div class="mb-4" data-aos="fade-up">
         <span class="text-primary fw-bold text-uppercase small d-block mb-1" style="letter-spacing: 1px;">Akses Cepat</span>
         <h2 class="fw-bold m-0" style="color: #0f172a;">Pengalaman Belanja Lebih Modern</h2>
      </div>

      <div class="row g-4 mb-4">
         
         <div class="col-12 col-md-6" data-aos="fade-up" data-aos-delay="100">
            <div class="card border-0 rounded-4 p-4 position-relative overflow-hidden text-white h-100 shadow-sm hover-lift" 
                 style="background: linear-gradient(135deg, #004aad 0%, #003580 100%); min-height: 240px;">
               
               <div class="position-absolute end-0 top-50 translate-middle-y opacity-10" 
                    style="width: 180px; height: 180px; border-radius: 50%; background: #ffffff; border: 20px solid #ffffff; margin-right: -40px;"></div>
               
               <div class="position-relative z-1 d-flex flex-column justify-content-between h-100">
                  <div>
                     <div class="rounded-3 d-flex align-items-center justify-content-center mb-3" 
                          style="width: 45px; height: 45px; background-color: rgba(255,255,255,0.1); border: 1px solid rgba(255,255,255,0.2);">
                        <i class="bi bi-box-seam fs-5 text-white"></i>
                     </div>
                     <h3 class="fw-bold mb-2 fs-4">VR 3D Showroom</h3>
                     <p class="text-white-50 small mb-4" style="max-width: 85%;">Jelajahi toko kami secara virtual. Lihat produk dari segala sudut sebelum membeli.</p>
                  </div>
                  <a href="#" class="btn rounded-pill px-4 py-2 align-self-start btn-sm fw-semibold d-flex align-items-center text-white" 
                     style="background-color: #f97316; border: none;">
                     Masuk Showroom <i class="bi bi-arrow-right ms-2"></i>
                  </a>
               </div>
            </div>
         </div>

         <div class="col-12 col-md-6" data-aos="fade-up" data-aos-delay="200">
            <div class="card border-0 rounded-4 p-4 position-relative overflow-hidden text-white h-100 shadow-sm hover-lift" 
                 style="background: linear-gradient(135deg, #f97316 0%, #ea580c 100%); min-height: 240px;">
               
               <div class="position-absolute end-0 top-50 translate-middle-y opacity-10" 
                    style="width: 180px; height: 180px; border-radius: 50%; background: #ffffff; margin-right: -30px;"></div>
               
               <div class="position-relative z-1 d-flex flex-column justify-content-between h-100">
                  <div>
                     <div class="rounded-3 d-flex align-items-center justify-content-center mb-3" 
                          style="width: 45px; height: 45px; background-color: rgba(255,255,255,0.1); border: 1px solid rgba(255,255,255,0.2);">
                        <i class="bi bi-robot fs-5 text-white"></i>
                     </div>
                     <div class="d-flex align-items-center mb-2">
                        <h3 class="fw-bold m-0 fs-4 me-2">AI Chatbot</h3>
                        <span class="badge rounded-pill text-white font-monospace opacity-75 small" 
                              style="background-color: #f97316; border: 1px solid #fbbf24; font-size: 0.65rem;">
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
            <div class="card border rounded-4 p-4 shadow-sm bg-white hover-lift">
               <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
                  
                  <div class="d-flex align-items-center">
                     <div class="rounded-3 d-flex align-items-center justify-content-center me-3 flex-shrink-0" title="Butuh Bantuan"
                          style="width: 48px; height: 48px; background-color: #fff7ed; color: #f97316; border: 1px solid #fed7aa;">
                        <i class="bi bi-headset fs-4"></i>
                     </div>
                     <div>
                        <h5 class="fw-bold mb-1" style="color: #1e293b; font-size: 1rem;">Butuh Bantuan?</h5>
                        <p class="text-muted small m-0">Tim kami siap membantu Senin–Sabtu, pukul 08.00–20.00 WIB</p>
                     </div>
                  </div>

                  <div class="d-flex align-items-center gap-2 flex-wrap">
                     <a href="https://wa.me/yournumber" class="btn btn-warning fw-bold px-4 py-2 rounded-3 d-flex align-items-center" 
                        style="background-color: #f97316; border: none; font-size: 0.9rem; color: white;">
                        WhatsApp
                     </a>
                     <a href="#" class="btn btn-outline-primary fw-semibold px-4 py-2 rounded-3" 
                        style="color: #004aad; border-color: #004aad; font-size: 0.9rem;">
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
         
         <button class="mpaddcart" id="mpAddCart" style="background-color: #004aad;">
            <i class="fas fa-shopping-cart"></i> Add to Cart
         </button>
      </div>
   </div>
</div>

<section id="blog" class="py-5" style="background-color: #fffaf0;">
   <div class="container">
      
      <div class="text-center mb-5" data-aos="fade-up">
         <span class="d-block text-primary fw-semibold text-capitalize mb-2" style="font-family: 'Playfair Display', serif; font-style: italic; font-size: 1.15rem;">Berita & Pembaruan</span>
         <h2 class="fw-bold position-relative d-inline-block pb-3" style="color: #0f172a; font-size: 2.25rem;">
            Berita <span class="text-primary">Terbaru</span> Dari FAA
            <span class="position-absolute start-50 translate-middle-x bottom-0 rounded" style="width: 50px; height: 4px; background: linear-gradient(to right, #004aad, #f97316);"></span>
         </h2>
      </div>

      <div class="row g-4 justify-content-center">
         @forelse($beritas as $index => $berita)
         <div class="col-12 col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="{{ $index * 80 }}">
            <div class="card border-0 rounded-4 overflow-hidden shadow-sm h-100 bg-white news-card">
               
               <div class="position-relative overflow-hidden img-container" style="height: 220px;">
                  @if($berita->gambar)
                     <img class="w-100 h-100" src="{{ asset('storage/' . $berita->gambar) }}" alt="{{ $berita->judul }}" style="object-fit: cover; object-position: center;"/>
                  @else
                     <img class="w-100 h-100" src="{{ asset('template-sarab/img/blog/' . ($index + 1) . '.jpg') }}" alt="Default" style="object-fit: cover; object-position: center;"/>
                  @endif
                  
                  @php
                     $date = \Carbon\Carbon::parse($berita->created_at);
                  @endphp
                  
                  <div class="position-absolute top-0 start-0 m-3 bg-primary text-white rounded-3 d-flex flex-column align-items-center justify-content-center shadow" style="width: 45px; height: 48px; line-height: 1.1; background-color: #004aad !important;">
                     <span class="fw-bold fs-5">{{ $date->translatedFormat('d') }}</span>
                     <span class="text-uppercase fw-semibold" style="font-size: 0.65rem; letter-spacing: 0.5px;">{{ $date->translatedFormat('M') }}</span>
                  </div>
               </div>

               <div class="card-body p-4 d-flex flex-column justify-content-between">
                  <div>
                     <span class="text-primary text-uppercase fw-bold d-block mb-2" style="font-size: 0.75rem; letter-spacing: 0.5px; color: #004aad !important;">
                        {{ $berita->kategori ?? 'Berita' }}
                     </span>
                     
                     <h5 class="fw-bold mb-3" style="font-size: 1.15rem; line-height: 1.4;">
                        <a href="{{ route('berita.show', $berita->id) }}" class="text-decoration-none text-dark hover-opacity" style="color: #1e293b;">
                           {{ $berita->judul }}
                        </a>
                     </h5>
                     
                     <div class="text-muted small d-flex align-items-center mb-4">
                        <i class="far fa-calendar-alt me-2 text-primary"></i>
                        <span>{{ $date->translatedFormat('d M Y') }}</span>
                     </div>
                  </div>

                  <a href="{{ route('berita.show', $berita->id) }}" class="text-primary fw-bold text-decoration-none small d-inline-flex align-items-center mt-auto" style="letter-spacing: 0.2px; color: #004aad !important;">
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
         <a href="{{ route('berita.public') }}" class="btn fw-semibold px-4 py-25 rounded-3 d-inline-flex align-items-center shadow-sm text-white" style="background-color: #004aad; border: none; font-size: 0.95rem; padding-top: 10px; padding-bottom: 10px;">
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
                  <div class="ctdark" style="background: #004aad;">
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
                        <a href="#"><i class="fab fa-tiktok"></i></a>
                        <a href="#"><i class="fab fa-youtube"></i></a>
                     </div>
                  </div>
               </div>
               <div class="col-lg-8" data-aos="fade-left">
                  <div class="fcard">
                     <div class="row g-3">
                        <div class="col-sm-6"><label class="flbl">Nama Anda *</label><input type="text" class="fctrl" placeholder="Tulis nama Anda di sini..."/></div>
                        <div class="col-sm-6"><label class="flbl">Nomor Telepon</label><input type="tel" class="fctrl" placeholder="nomor telepon Anda..."/></div>
                        <div class="col-12"><label class="flbl">Pesan *</label><textarea class="fctrl" rows="5" placeholder="Tulis pesan Anda di sini..."></textarea></div>
                        <div class="col-12"><button class="btn-orange" id="ctcBtn" style="background-color: #f97316; color: white; border: none; padding: 12px 25px; border-radius: 10px; font-weight: 700;"><i class="fas fa-paper-plane"></i> Kirim Pesan</button></div>
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

      @include('layouts.partials.footer')

      <!-- Hidden Placeholders for Compatibility with main.js -->
      <div style="display:none;">
         <button id="resBtn"></button>
         <div id="resOk"></div >
         <button id="nlBtn"></button>
         <input id="nlEmail">
      </div>

      <!-- Custom Main Script -->
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

      @include('chatbot') </body>
</html>