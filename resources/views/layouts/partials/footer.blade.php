<style>
    footer { background: var(--dark); color: rgba(255,255,255,0.65); margin-top: 80px; }

    .fnm {
        font-family: 'Poppins', sans-serif;
        font-weight: 800;
        font-size: 24px;
        color: white;
        margin-bottom: 15px;
    }

    .fnm span {
        display: block;
        font-size: 10px;
        font-weight: 500;
        color: rgba(255,255,255,0.4);
        letter-spacing: 2px;
        text-transform: uppercase;
    }

    .fdesc { font-size: 14px; line-height: 1.8; color: rgba(255,255,255,0.5); margin-bottom: 25px; }

    .fsoc { display: flex; gap: 10px; }

    .fsoc a {
        width: 38px;
        height: 38px;
        border-radius: 10px;
        border: 1px solid rgba(255,255,255,0.1);
        display: flex;
        align-items: center;
        justify-content: center;
        color: rgba(255,255,255,0.5);
        text-decoration: none;
        transition: all 0.3s;
    }

    .fsoc a:hover {
        background: var(--red);
        border-color: var(--red);
        color: white;
        transform: translateY(-3px);
    }

    .ftit {
        font-family: 'Poppins', sans-serif;
        font-size: 11px;
        font-weight: 800;
        letter-spacing: 3px;
        text-transform: uppercase;
        color: white;
        margin-bottom: 25px;
        padding-bottom: 12px;
        border-bottom: 1px solid rgba(255,255,255,0.08);
    }

    .flinks { list-style: none; padding: 0; }
    .flinks li { margin-bottom: 12px; }
    .flinks a {
        color: rgba(255,255,255,0.5);
        text-decoration: none;
        font-size: 14px;
        display: flex;
        align-items: center;
        gap: 10px;
        transition: all 0.3s;
    }

    .flinks a i { font-size: 10px; color: var(--red); }
    .flinks a:hover { color: white; padding-left: 5px; }

    .fci { display: flex; gap: 15px; margin-bottom: 20px; }

    .fciico {
        width: 40px;
        height: 40px;
        background: rgba(229,9,20,0.1);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--red);
        font-size: 14px;
        flex-shrink: 0;
    }

    .fciinfo strong {
        display: block;
        font-size: 10px;
        font-weight: 700;
        letter-spacing: 2px;
        text-transform: uppercase;
        color: rgba(255,255,255,0.3);
        margin-bottom: 4px;
    }

    .fciinfo span { font-size: 13px; color: rgba(255,255,255,0.6); }

    .fbot { border-top: 1px solid rgba(255,255,255,0.06); padding: 25px 0; }
    .fbot p { font-size: 13px; color: rgba(255,255,255,0.3); margin: 0; }
    .fbot a { color: var(--red); text-decoration: none; font-weight: 600; }

    #btt {
        position: fixed;
        bottom: 30px;
        right: 30px;
        z-index: 9999;
        background-color: #e50914;
        color: #ffffff;
        border: none;
        width: 45px;
        height: 45px;
        border-radius: 10px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
        transition: all 0.3s ease;
        opacity: 0;
        visibility: hidden;
        transform: translateY(20px);
    }

    #btt.show { opacity: 1; visibility: visible; transform: translateY(0); }
    #btt:hover { background-color: #b80710; transform: translateY(-3px); }
</style>

<!-- Footer -->
<footer>
    <div class="container py-5">
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
                <li><a href="{{ route('tentang-kami') }}"><i class="fas fa-chevron-right"></i>Tentang Kami</a></li>
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
            <p>&copy 2026 <span>FAA Frozen Food & Bakery</span>. <br>Dibuat oleh <a target="_blank" class="mx-0 fw-bold" href="https://www.instagram.com/juliy_safteri?igsh=eTQwZXE3Y2QxdXFj">Juliarti Safitri</a></p>
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
<script src="{{ asset('template-sarab/js/main.js') }}"></script>

<script>
    // Back to Top functionality
    const btt = document.getElementById('btt');
    if (btt) {
        window.addEventListener('scroll', () => {
            if (window.scrollY > 300) {
                btt.classList.add('show');
            } else {
                btt.classList.remove('show');
            }
        });
    }

    // AOS Initialization
    if (typeof AOS !== 'undefined') {
        AOS.init({
            duration: 800,
            easing: 'slide',
            once: true
        });
    }
</script>