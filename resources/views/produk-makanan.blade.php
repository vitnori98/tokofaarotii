<!DOCTYPE html>
<html lang="id">
<head>
    <style>
        /* Hero Section Styling */
        .product-hero {
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
            background: url('{{ asset('template-sarab/img/banner-toko-faa.png') }}') no-repeat center center / cover;
            will-change: transform;
        }

        .hero-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(0, 74, 173, 0.85) 0%, rgba(15, 15, 15, 0.75) 60%, rgba(3, 105, 161, 0.6) 100%);
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

        .product-hero h1 {
            font-family: 'Playfair Display', serif;
            font-size: clamp(40px, 7vw, 78px);
            font-weight: 900;
            color: #ffffff;
            line-height: 1;
            letter-spacing: -2px;
            margin-bottom: 22px;
        }

        .product-hero p {
            font-size: 1.1rem;
            max-width: 700px;
            margin: 0 auto;
            color: #ffffff !important;
            opacity: 0.9;
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
            margin-top: 20px;
        }

        .hero-breadcrumb a { color: #ffffff; text-decoration: none; transition: color 0.2s; opacity: 0.8; }
        .hero-breadcrumb a:hover { opacity: 1; }
        .hero-breadcrumb .crumb-active { color: #f59e0b; }
        .hero-breadcrumb .sep { color: rgba(255,255,255,0.25); }

        .hero-wave {
            position: absolute;
            bottom: -1px;
            left: 0;
            right: 0;
        }

        /* Category Section Styling */
        .category-section {
            padding: 60px 0;
        }

        .category-section:nth-child(even) {
            background-color: #f8f9fa;
        }

        .section-header {
            margin-bottom: 40px;
            text-align: center;
        }

        .section-title {
            font-family: 'Playfair Display', serif;
            font-weight: 800;
            font-size: 2.5rem;
            color: #333;
            margin-bottom: 15px;
            position: relative;
            display: inline-block;
        }

        .section-title::after {
            content: "";
            position: absolute;
            bottom: -8px;
            left: 50%;
            transform: translateX(-50%);
            width: 50px;
            height: 3px;
            background: #f97316;
            border-radius: 2px;
        }

        /* Product Card Styling */
        .product-card {
            background: #fff;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            transition: all 0.3s;
            height: 100%;
            border: 1px solid #f1f1f1;
            display: flex;
            flex-direction: column;
        }

        .product-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(229, 9, 20, 0.12);
            border-color: rgba(229, 9, 20, 0.2);
        }

        .product-img-wrapper {
            position: relative;
            height: 220px;
            overflow: hidden;
            background: #f8f8f8;
        }

        .product-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s;
        }

        .product-card:hover .product-img {
            transform: scale(1.1);
        }

        .product-badge {
            position: absolute;
            top: 15px;
            left: 15px;
            background: rgba(255, 255, 255, 0.9);
            color: #e50914;
            padding: 4px 12px;
            border-radius: 50px;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            z-index: 2;
        }

        .product-info {
            padding: 20px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        .product-info h5 {
            font-weight: 700;
            color: #333;
            margin-bottom: 8px;
            font-size: 1.1rem;
            transition: color 0.3s;
        }

        .product-card:hover .product-info h5 {
            color: #e50914;
        }

        .product-desc {
            color: #777;
            font-size: 0.85rem;
            line-height: 1.5;
            margin-bottom: 15px;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .product-footer {
            margin-top: auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding-top: 15px;
            border-top: 1px solid #f5f5f5;
        }

        .product-price {
            font-weight: 800;
            color: #e50914;
            font-size: 1.2rem;
            margin-bottom: 0;
        }

        .btn-view-detail {
            width: 35px;
            height: 35px;
            background: #333;
            color: #fff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s;
            text-decoration: none;
        }

        .btn-cart-add {
            width: 35px;
            height: 35px;
            background: #f97316;
            color: #fff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s;
            text-decoration: none;
        }

        .btn-cart-add:hover {
            background: #ea580c;
            transform: scale(1.1);
        }

        /* Modal Customization */
        .modal-header {
            border-bottom: none;
            padding-bottom: 0;
        }
        .modal-footer {
            border-top: none;
        }
        .modal-product-img {
            border-radius: 15px;
            width: 100%;
            height: 300px;
            object-fit: cover;
            margin-bottom: 20px;
        }

        #waOrderBtn {
            background: #25D366;
            color: #fff;
            border: none;
            padding: 12px 25px;
            border-radius: 50px;
            font-weight: 600;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            transition: all 0.3s;
        }

        #waOrderBtn:hover {
            background: #128C7E;
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(37, 211, 102, 0.3);
        }

        .empty-state {
            padding: 40px;
            text-align: center;
            background: #fff;
            border-radius: 20px;
            border: 2px dashed #ddd;
        }
    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Produk Makanan - FAA Frozen Food & Bakery</title>
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700;900&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet"/>
    
    <!-- CSS Assets -->
    <link href="{{ asset('template-sarab/css/bootstrap.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('template-sarab/css/aos.css') }}" rel="stylesheet"/>
    <link href="{{ asset('template-sarab/css/all.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('template-sarab/css/style.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>

    @include('layouts.partials.navbar')

    <!-- Hero Section -->
    <section class="product-hero">
        <div class="hero-bg"></div>
        <div class="hero-overlay"></div>
        <div class="hero-grid"></div>

        <div class="hero-content" data-aos="fade-up">
            <h1>Katalog Produk</h1>
            <p>Pilihan hidangan Frozen Food praktis dan Roti segar berkualitas tinggi untuk keceriaan meja makan Anda.</p>
            <nav class="hero-breadcrumb">
                <a href="{{ route('welcome') }}">Beranda</a>
                <span class="sep">/</span>
                <span class="crumb-active">Produk</span>
            </nav>
        </div>

        <svg class="hero-wave" viewBox="0 0 1440 60" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
            <path d="M0 60 L0 30 Q360 0 720 30 Q1080 60 1440 30 L1440 60 Z" fill="#ffffff"/>
        </svg>
    </section>

    <!-- Dynamic Category Sections -->
    <div id="product-catalog">
        @forelse($categories as $category)
            @if($category->products->count() > 0)
                <section class="category-section">
                    <div class="container">
                        <div class="section-header" data-aos="fade-up">
                            <h2 class="section-title">{{ $category->name }}</h2>
                        </div>
                        
                        <div class="row g-4">
                            @foreach($category->products as $product)
                                <div class="col-sm-6 col-lg-3" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 50 }}">
                                    <div class="product-card">
                                        <div class="product-img-wrapper">
                                            @if($product->image)
                                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="product-img">
                                            @else
                                                <img src="{{ asset('template-sarab/img/menu/1.jpg') }}" alt="Default" class="product-img">
                                            @endif
                                            <span class="product-badge">{{ $category->name }}</span>
                                        </div>
                                        <div class="product-info">
                                            <h5>{{ $product->name }}</h5>
                                            <p class="product-desc">{{ $product->description ?? 'Produk pilihan terbaik dari FAA Frozen Food & Bakery.' }}</p>
                                            <div class="product-footer">
                                                <p class="product-price">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                                                <div class="d-flex gap-2">
                                                    <a href="#" class="btn-cart-add add-to-cart" data-id="{{ $product->id }}" title="Tambah ke Keranjang">
                                                        <i class="bi bi-cart-plus"></i>
                                                    </a>
                                                    <a href="#" class="btn-view-detail open-modal" 
                                                       data-bs-toggle="modal" 
                                                       data-bs-target="#productModal"
                                                       data-name="{{ $product->name }}"
                                                       data-price="Rp {{ number_format($product->price, 0, ',', '.') }}"
                                                       data-desc="{{ $product->description }}"
                                                       data-img="{{ $product->image ? asset('storage/' . $product->image) : asset('template-sarab/img/menu/1.jpg') }}"
                                                       data-unit="{{ $product->unit }}">
                                                        <i class="bi bi-plus-lg"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </section>
            @endif
        @empty
            <section class="category-section">
                <div class="container text-center py-5">
                    <div class="empty-state">
                        <i class="bi bi-box-seam text-muted mb-3" style="font-size: 3rem;"></i>
                        <p class="text-muted">Belum ada produk yang tersedia saat ini.</p>
                    </div>
                </div>
            </section>
        @endforelse
    </div>

    <!-- Product Modal -->
    <div class="modal fade" id="productModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border-radius: 25px; overflow: hidden;">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <img id="modalImg" src="" alt="" class="modal-product-img">
                    <h3 id="modalName" class="fw-bold mb-2"></h3>
                    <p id="modalPrice" class="text-primary fs-4 fw-bold mb-3" style="color: #004aad !important;"></p>
                    <p id="modalDesc" class="text-muted mb-4"></p>
                    <div class="mb-4">
                        <span class="badge bg-light text-dark p-2 px-3 border" style="border-radius: 10px;">
                            <i class="bi bi-tag-fill text-warning me-2" style="color: #f97316 !important;"></i> Satuan: <span id="modalUnit"></span>
                        </span>
                    </div>
                    <a href="#" id="waOrderBtn" target="_blank">
                        <i class="bi bi-whatsapp"></i> Pesan Sekarang
                    </a>
                </div>
            </div>
        </div>
    </div>

    @include('layouts.partials.footer')

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Cart Logic
            $('.add-to-cart').on('click', function(e) {
                e.preventDefault();
                
                @guest
                    Swal.fire({
                        title: 'Silakan Login',
                        text: 'Anda harus login terlebih dahulu untuk menggunakan keranjang belanja.',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Login Sekarang',
                        cancelButtonText: 'Nanti Saja'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = "{{ route('login') }}";
                        }
                    });
                @else
                    const id = $(this).data('id');
                    $.ajax({
                        url: `/cart/add/${id}`,
                        method: 'POST',
                        data: { _token: '{{ csrf_token() }}' },
                        success: function(response) {
                            $('#cartCount').text(response.cart_count);
                            Swal.fire({
                                title: 'Berhasil!',
                                text: response.message,
                                icon: 'success',
                                timer: 2000,
                                showConfirmButton: false
                            });
                        }
                    });
                @endguest
            });

            const modal = document.getElementById('productModal');
            modal.addEventListener('show.bs.modal', function (event) {
                const button = event.relatedTarget;
                const name = button.getAttribute('data-name');
                const price = button.getAttribute('data-price');
                const desc = button.getAttribute('data-desc');
                const img = button.getAttribute('data-img');
                const unit = button.getAttribute('data-unit');

                document.getElementById('modalName').textContent = name;
                document.getElementById('modalPrice').textContent = price;
                document.getElementById('modalDesc').textContent = desc || 'Produk pilihan terbaik dari FAA Frozen Food & Bakery.';
                document.getElementById('modalImg').src = img;
                document.getElementById('modalUnit').textContent = unit;

                const waMessage = encodeURIComponent(`Halo Toko FAA, saya ingin memesan produk: ${name} (${price})`);
                document.getElementById('waOrderBtn').href = `https://wa.me/6285368787893?text=${waMessage}`;
            });
        });
    </script>

</body>
</html>