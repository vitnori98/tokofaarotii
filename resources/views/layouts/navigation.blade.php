<style>
    /* 1. Base Sidebar Style */
    .sidebar {
        width: 280px;
        height: 100vh;
        transition: all 0.3s ease;
        background-color: white;
        border-right: 1px solid #dee2e6;
        display: flex;
        flex-direction: column;
    }

    /* 2. Style Navigasi & Animasi Perpindahan */
    /* Menggunakan selektor spesifik agar menang dari CSS bawaan */
    .sidebar .nav-pills .nav-link {
        transition: all 0.3s ease-in-out !important; /* Kunci Animasi Halus */
        padding: 0.75rem 1rem;
        border-radius: 0.5rem;
        color: #4b5563 !important; /* Warna text-dark default */
        background-color: transparent !important;
        display: flex;
        align-items: center;
        margin-bottom: 4px;
        text-decoration: none;
        border: 1px solid transparent;
    }

    /* 3. Style SAAT AKTIF (Warna Biru/Ungu) */
    .sidebar .nav-pills .nav-link.active {
        background-color: #f0f3ff !important; /* Latar biru muda */
        color: #4f46e5 !important; /* Teks biru/ungu */
        font-weight: 600 !important;
    }

    /* Warna Icon saat aktif */
    .sidebar .nav-pills .nav-link.active i {
        color: #4f46e5 !important;
    }

    /* Efek Hover */
    .sidebar .nav-pills .nav-link:hover:not(.active) {
        background-color: #f9fafb !important;
        color: #111827 !important;
    }

    /* Fitur Responsive & Collapse */
    .sidebar-collapsed { width: 70px; }
    .sidebar-collapsed .sidebar-text, .sidebar-collapsed h5, .sidebar-collapsed small { display: none; }
    
    @media (max-width: 768px) {
        .sidebar { position: fixed; left: -280px; z-index: 50; }
        .sidebar.active { left: 0; }
    }
</style>

<div class="sidebar bg-white border-end">
    <!-- Header Sidebar (Toko Faa) -->
    <div class="p-4 border-bottom d-flex align-items-center">
        <div class="bg-primary rounded p-2 text-white me-3">
            <i class="fas fa-store"></i>
        </div>
        <div>
            <h5 class="fw-bold mb-0">Toko Faa</h5>
            <small class="text-muted">Admin Panel</small>
        </div>
    </div>

    <!-- Menu Navigasi -->
    <div class="p-3">
        <ul class="nav nav-pills flex-column mb-auto">
            
            <li class="nav-item">
                <a href="{{ route('dashboard') }}" 
                   class="nav-link {{ request()->routeIs('dashboard*') ? 'active' : '' }}">
                    <i class="fas fa-home me-3"></i> 
                    <span class="sidebar-text">Dashboard</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('products.index') }}" 
                   class="nav-link {{ request()->routeIs('products.*') ? 'active' : '' }}">
                    <i class="fas fa-box me-3"></i> 
                    <span class="sidebar-text">Produk</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('categories.index') }}" 
                   class="nav-link {{ request()->routeIs('categories.*') ? 'active' : '' }}">
                    <i class="fas fa-tags me-3"></i> 
                    <span class="sidebar-text">Kategori</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('stock-entries.index') }}" 
                   class="nav-link {{ request()->routeIs('stock-entries.*') ? 'active' : '' }}">
                    <i class="fas fa-warehouse me-3"></i> 
                    <span class="sidebar-text">Stok</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('sales.index') }}" 
                   class="nav-link {{ request()->routeIs('sales.*') ? 'active' : '' }}">
                    <i class="fas fa-shopping-cart me-3"></i> 
                    <span class="sidebar-text">Penjualan</span>
                </a>
            </li>

            <li class="nav-item border-bottom pb-2">
                <a href="{{ route('reports.index') }}" 
                   class="nav-link {{ request()->routeIs('reports.*') ? 'active' : '' }}">
                    <i class="fas fa-chart-line me-3"></i> 
                    <span class="sidebar-text">Laporan</span>
                </a>
            </li>

            <li class="nav-item mt-3">
                <a href="{{ route('settings.index') }}" 
                   class="nav-link {{ request()->routeIs('settings.*') ? 'active' : '' }}">
                    <i class="fas fa-cog me-3"></i> 
                    <span class="sidebar-text">Setting</span>
                </a>
            </li>

            <li class="nav-item">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="nav-link text-danger border-0 bg-transparent w-100">
                        <i class="fas fa-sign-out-alt me-3"></i> 
                        <span class="sidebar-text">Keluar</span>
                    </button>
                </form>
            </li>
        </ul>
    </div>

    <!-- Footer -->
    <div class="mt-auto p-4 border-top">
        <small class="text-muted d-flex align-items-center">
            <i class="fas fa-shield-alt me-2"></i> v1.0.0
        </small>
    </div>
</div>