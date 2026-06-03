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
            <a class="navbar-brand d-flex align-items-center fw-bold fs-3 logo-faa-container" href="#">
                <!-- Logo dengan efek ngambang/glowing -->
                <div class="logo-floating-wrapper me-2">
                    <img src="{{ asset('template-sarab/img/logoFAA.png') }}" alt="Logo Toko FAA" style="height: 55px; width: auto;">
                </div>
                
                <!-- Teks FAA Kombinasi Merah & Biru -->
                <span class="text-faa">
                    <span class="text-red">F</span><span class="text-blue">AA</span>
                </span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navmenu">
               <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navmenu">
               <ul class="navbar-nav ms-auto align-items-center">
                  <li class="nav-item"><a class="nav-link active" href="#">Beranda</a></li>
                  <li class="nav-item"><a class="nav-link" href="#categories">Tentang Kami</a></li>
                  <li class="nav-item"><a class="nav-link" href="#menu">Berita</a></li>
                  <li class="nav-item"><a class="nav-link" href="#promo">Dokumentasi</a></li>
                  <li class="nav-item"><a class="nav-link" href="#promo">Produk Makanan</a></li>
                  <li class="nav-item"><a class="nav-link" href="#promo">VR 3D Showroom</a></li>
                  <li class="nav-item"><a class="nav-link" href="#promo">FAQ</a></li>
                  <li class="nav-item">
                     <button id="navSearchBtn" class="btn btn-link text-dark nav-link"><i class="fas fa-search"></i></button>
                  </li>
                  <li class="nav-item">
                     <a href="#" class="nav-link position-relative">
                        <i class="fas fa-shopping-cart"></i>
                        <span id="cartCount" class="badge rounded-pill bg-danger position-absolute top-0 start-100 translate-middle" style="font-size: 0.7rem;">0</span>
                     </a>
                  </li>
               </ul>
            </div>
         </div>
      </header>

      <!-- Hero / Video Banner Section -->
      <section id="hero" class="hero-section text-center py-5 bg-light position-relative" style="background: url('{{ asset('template-sarab/img/banner-img.jpg') }}') no-repeat center center/cover;">
         <div class="position-absolute top-0 start-0 w-100 h-100 bg-dark opacity-50"></div>
         <div class="container position-relative text-white py-5" data-aos="fade-up">
            <h1 class="display-4 fw-bold">Kehangatan Roti Segar Setiap Hari</h1>
            <p class="lead">Menyediakan berbagai macam pilihan Roti Premium dan Frozen Food berkualitas tinggi.</p>
            <a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ" class="btn btn-danger btn-lg rounded-circle magnific_popup popup-youtube shadow mt-3">
               <i class="fas fa-play pt-1"></i>
            </a>
            <div class="mt-2"><small>Tonton Video Kami</small></div>
         </div>
      </section>

      <!-- Categories Section -->
      <section id="categories" class="py-5">
         <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
               <h2 class="fw-bold">Kategori Pilihan</h2>
               <p class="text-muted">Pilih kategori produk favorit Anda</p>
            </div>
            <div class="row g-4 justify-content-center">
               <div class="col-6 col-md-3" data-aos="fade-up" data-aos-delay="100">
                  <div class="card text-center h-100 shadow-sm border-0 catcard" data-filter="bread" style="cursor: pointer;">
                     <div class="card-body">
                        <img class="catimg img-fluid mb-3 rounded" src="{{ asset('template-sarab/img/category/1.jpg') }}" alt="Roti"/>
                        <h5>Roti Segar</h5>
                     </div>
                  </div>
               </div>
               <div class="col-6 col-md-3" data-aos="fade-up" data-aos-delay="200">
                  <div class="card text-center h-100 shadow-sm border-0 catcard" data-filter="frozen" style="cursor: pointer;">
                     <div class="card-body">
                        <img class="catimg img-fluid mb-3 rounded" src="{{ asset('template-sarab/img/category/2.jpg') }}" alt="Frozen Food"/>
                        <h5>Frozen Food</h5>
                     </div>
                  </div>
               </div>
               <div class="col-6 col-md-3" data-aos="fade-up" data-aos-delay="300">
                  <div class="card text-center h-100 shadow-sm border-0 catcard" data-filter="pastry" style="cursor: pointer;">
                     <div class="card-body">
                        <img class="catimg img-fluid mb-3 rounded" src="{{ asset('template-sarab/img/category/3.jpg') }}" alt="Pastry"/>
                        <h5>Pastry & Croissant</h5>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>

      <!-- Promo Section with Countdown -->
      <section id="promo" class="py-5 bg-warning text-dark text-center">
         <div class="container" data-aos="zoom-in">
            <h2 class="fw-bold mb-3">Flash Sale Spesial Hari Ini!</h2>
            <p class="lead">Dapatkan diskon hingga 50% untuk produk Frozen Food pilihan sebelum waktu habis.</p>
            <div class="d-flex justify-content-center gap-3 my-4 fs-3 fw-bold">
               <div class="bg-white px-3 py-2 rounded shadow-sm"><span id="cdH">08</span><small class="d-block fs-6 fw-normal">Jam</small></div>
               <div class="bg-white px-3 py-2 rounded shadow-sm"><span id="cdM">45</span><small class="d-block fs-6 fw-normal">Menit</small></div>
               <div class="bg-white px-3 py-2 rounded shadow-sm"><span id="cdS">30</span><small class="d-block fs-6 fw-normal">Detik</small></div>
            </div>
         </div>
      </section>

      <!-- Menu Section with Filters -->
      <section id="menu" class="py-5">
         <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
               <h2 class="fw-bold">Daftar Menu Kami</h2>
               <div class="d-flex justify-content-center gap-2 mt-3 flex-wrap">
                  <button class="btn btn-outline-success filtbtn active" data-f="all">Semua</button>
                  <button class="btn btn-outline-success filtbtn" data-f="bread">Roti</button>
                  <button class="btn btn-outline-success filtbtn" data-f="frozen">Frozen Food</button>
                  <button class="btn btn-outline-success filtbtn" data-f="pastry">Pastry</button>
               </div>
            </div>

            <div class="row g-4">
               <!-- Product 1 -->
               <div class="col-md-4 mwrap" data-c="bread" data-aos="fade-up" data-aos-delay="100">
                  <div class="card h-100 shadow-sm border-0 mcard" 
                       data-img="{{ asset('template-sarab/img/menu/1.jpg') }}" 
                       data-title="Roti Tawar Gandum" 
                       data-cat="Roti" 
                       data-price="Rp 18.000" 
                       data-old="Rp 22.000"
                       data-rating="4.8" 
                       data-reviews="120" 
                       data-cal="250" 
                       data-time="15" 
                       data-desc="Roti tawar gandum sehat yang kaya serat, dipanggang segar setiap pagi tanpa bahan pengawet buatan." 
                       data-tags="Sehat, Serat Tinggi, Fresh">
                     <img src="{{ asset('template-sarab/img/menu/1.jpg') }}" class="card-img-top" alt="Roti Tawar Gandum">
                     <div class="card-body">
                        <span class="badge bg-success mb-2">Roti</span>
                        <h5 class="card-title fw-bold">Roti Tawar Gandum</h5>
                        <p class="text-muted text-truncate">Roti tawar gandum sehat kaya serat dipanggang segar.</p>
                        <div class="d-flex justify-content-between align-items-center mt-3">
                           <span class="fw-bold text-success">Rp 18.000</span>
                           <button class="btn btn-success btn-sm madd"><i class="fas fa-plus me-1"></i> Detail</button>
                        </div>
                     </div>
                  </div>
               </div>

               <!-- Product 2 -->
               <div class="col-md-4 mwrap" data-c="frozen" data-aos="fade-up" data-aos-delay="200">
                  <div class="card h-100 shadow-sm border-0 mcard" 
                       data-img="{{ asset('template-sarab/img/menu/2.jpg') }}" 
                       data-title="Premium Beef Patty" 
                       data-cat="Frozen Food" 
                       data-price="Rp 45.000" 
                       data-old=""
                       data-rating="4.9" 
                       data-reviews="85" 
                       data-cal="320" 
                       data-time="10" 
                       data-desc="Daging sapi burger premium isi 5 pcs siap saji. Sangat juicy dan tebal." 
                       data-tags="Daging Sapi, Praktis, Isi 5">
                     <img src="{{ asset('template-sarab/img/menu/2.jpg') }}" class="card-img-top" alt="Premium Beef Patty">
                     <div class="card-body">
                        <span class="badge bg-danger mb-2">Frozen Food</span>
                        <h5 class="card-title fw-bold">Premium Beef Patty</h5>
                        <p class="text-muted text-truncate">Daging burger sapi premium isi 5 pcs siap saji.</p>
                        <div class="d-flex justify-content-between align-items-center mt-3">
                           <span class="fw-bold text-success">Rp 45.000</span>
                           <button class="btn btn-success btn-sm madd"><i class="fas fa-plus me-1"></i> Detail</button>
                        </div>
                     </div>
                  </div>
               </div>

               <!-- Product 3 -->
               <div class="col-md-4 mwrap" data-c="pastry" data-aos="fade-up" data-aos-delay="300">
                  <div class="card h-100 shadow-sm border-0 mcard" 
                       data-img="{{ asset('template-sarab/img/menu/3.jpg') }}" 
                       data-title="Butter Croissant" 
                       data-cat="Pastry" 
                       data-price="Rp 15.000" 
                       data-old="Rp 18.000"
                       data-rating="4.7" 
                       data-reviews="95" 
                       data-cal="280" 
                       data-time="12" 
                       data-desc="Croissant mentega ala Prancis yang renyah di luar dan sangat lembut di bagian dalam." 
                       data-tags="Premium Butter, Renyah, Prancis">
                     <img src="{{ asset('template-sarab/img/menu/3.jpg') }}" class="card-img-top" alt="Butter Croissant">
                     <div class="card-body">
                        <span class="badge bg-warning text-dark mb-2">Pastry</span>
                        <h5 class="card-title fw-bold">Butter Croissant</h5>
                        <p class="text-muted text-truncate">Croissant mentega ala Prancis yang renyah dan lembut.</p>
                        <div class="d-flex justify-content-between align-items-center mt-3">
                           <span class="fw-bold text-success">Rp 15.000</span>
                           <button class="btn btn-success btn-sm madd"><i class="fas fa-plus me-1"></i> Detail</button>
                        </div>
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