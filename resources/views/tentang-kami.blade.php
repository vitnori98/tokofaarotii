<!DOCTYPE html>
<html lang="id">
<head>
    <style>
        /* Efek Ngambang / Glowing pada Logo Bulat */
        .logo-floating-wrapper {
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            filter: drop-shadow(0 0 12px rgba(255, 69, 0, 0.6)); 
            animation: floatingEffect 3s ease-in-out infinite;
        }

        @keyframes floatingEffect {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-4px); }
            100% { transform: translateY(0px); }
        }

        /* Hero Section Styling */
        .about-hero {
            position: relative;
            background: url('{{ asset('template-sarab/img/banner-toko-faa.png') }}') no-repeat center center / cover;
            padding: 150px 0 100px;
            color: #ffffff;
            text-align: center;
        }

        .about-hero::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            z-index: 1;
        }

        .about-hero .container {
            position: relative;
            z-index: 2;
        }

        .about-hero h1 {
            font-family: 'Playfair Display', serif;
            font-size: clamp(2.5rem, 6vw, 4rem);
            font-weight: 900;
            text-shadow: 2px 2px 10px rgba(0,0,0,0.5);
            margin-bottom: 15px;
        }

        .about-hero p {
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

        .history-img {
            border-radius: 20px;
            box-shadow: 0 15px 40px rgba(0,0,0,0.15);
            width: 100%;
            transition: transform 0.3s;
        }

        .history-img:hover {
            transform: scale(1.02);
        }

        /* Vision & Mission Cards */
        .vm-card {
            background: #fff;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            height: 100%;
            border: 1px solid #f1f1f1;
            transition: all 0.3s;
        }

        .vm-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(229, 9, 20, 0.1);
            border-color: #e50914;
        }

        .vm-icon {
            width: 60px;
            height: 60px;
            background: rgba(229, 9, 20, 0.1);
            color: #e50914;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            border-radius: 15px;
            margin-bottom: 25px;
        }

        /* Employee/Team Cards */
        .team-card {
            background: #fff;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 25px rgba(0,0,0,0.08);
            transition: all 0.3s;
            margin-bottom: 30px;
        }

        .team-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(0,0,0,0.15);
        }

        .team-img-wrapper {
            height: 300px;
            overflow: hidden;
        }

        .team-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s;
        }

        .team-card:hover .team-img {
            transform: scale(1.1);
        }

        .team-info {
            padding: 25px;
            text-align: center;
        }

        .team-info h5 {
            font-weight: 700;
            color: #333;
            margin-bottom: 5px;
        }

        .team-info p {
            color: #e50914;
            font-size: 0.9rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 0;
        }
    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tentang Kami - FAA Frozen Food & Bakery</title>
    
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
    <div class="about-hero">
        <div class="container" data-aos="fade-up">
            <h1>Tentang Kami</h1>
            <p>Mengenal lebih dekat FAA Frozen Food & Bakery, penyedia hidangan lezat dan berkualitas untuk keluarga Anda.</p>
        </div>
    </div>

    <!-- Sejarah Section -->
    <section class="history-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0" data-aos="fade-right">
                    <img src="{{ asset('template-sarab/img/about1.jpg') }}" alt="Sejarah FAA" class="history-img">
                </div>
                <div class="col-lg-6 ps-lg-5" data-aos="fade-left">
                    <h2 class="section-title">Sejarah Kami</h2>
                    <p class="lead text-danger fw-bold">Berawal dari cinta untuk hidangan berkualitas.</p>
                    <p>FAA Frozen Food & Bakery didirikan dengan misi sederhana: menyajikan kelezatan yang konsisten dan praktis bagi setiap keluarga. Berawal dari usaha rumahan di Sungai Liat, kami tumbuh dengan dedikasi pada bahan-bahan pilihan dan proses pembuatan yang higienis.</p>
                    <p>Seiring berjalannya waktu, kami terus berinovasi dalam menghadirkan berbagai varian roti segar yang dipanggang setiap hari serta produk frozen food yang telah menjadi favorit masyarakat sekitar. Kepercayaan pelanggan adalah motivasi terbesar kami untuk terus memberikan yang terbaik.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Visi Misi Section -->
    <section class="vm-section bg-light">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
                <h2 class="section-title">Visi & Misi</h2>
                <p class="text-muted">Komitmen kami dalam melayani Anda.</p>
            </div>
            <div class="row g-4">
                <div class="col-md-6" data-aos="zoom-in" data-aos-delay="100">
                    <div class="vm-card">
                        <div class="vm-icon">
                            <i class="bi bi-eye"></i>
                        </div>
                        <h3>Visi</h3>
                        <p>Menjadi pilihan utama masyarakat dalam memenuhi kebutuhan produk bakery dan frozen food yang lezat, sehat, dan berkualitas tinggi dengan standar internasional.</p>
                    </div>
                </div>
                <div class="col-md-6" data-aos="zoom-in" data-aos-delay="200">
                    <div class="vm-card">
                        <div class="vm-icon">
                            <i class="bi bi-bullseye"></i>
                        </div>
                        <h3>Misi</h3>
                        <ul class="list-unstyled">
                            <li class="mb-2"><i class="bi bi-check-circle-fill text-danger me-2"></i> Menggunakan bahan baku premium dan segar.</li>
                            <li class="mb-2"><i class="bi bi-check-circle-fill text-danger me-2"></i> Menjaga konsistensi rasa dan kualitas produk.</li>
                            <li class="mb-2"><i class="bi bi-check-circle-fill text-danger me-2"></i> Memberikan pelayanan yang ramah dan profesional.</li>
                            <li class="mb-2"><i class="bi bi-check-circle-fill text-danger me-2"></i> Terus berinovasi mengikuti selera pelanggan.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Tim Section -->
    <section class="team-section">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
                <h2 class="section-title">Tim Kami</h2>
                <p class="text-muted">Orang-orang di balik kelezatan FAA Frozen Food & Bakery.</p>
            </div>
            <div class="row">
                @forelse($pegawais as $pegawai)
                <div class="col-sm-6 col-lg-3" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}">
                    <div class="team-card">
                        <div class="team-img-wrapper">
                            @if($pegawai->foto)
                                <img src="{{ asset('storage/' . $pegawai->foto) }}" alt="{{ $pegawai->nama }}" class="team-img">
                            @else
                                <img src="{{ asset('template-sarab/img/chefs/1.jpg') }}" alt="Default" class="team-img">
                            @endif
                        </div>
                        <div class="team-info">
                            <h5>{{ $pegawai->nama }}</h5>
                            <p>{{ $pegawai->posisi }}</p>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12 text-center">
                    <p class="text-muted">Data pegawai belum tersedia.</p>
                </div>
                @endforelse
            </div>
        </div>
    </section>

    @include('layouts.partials.footer')

</body>
</html>