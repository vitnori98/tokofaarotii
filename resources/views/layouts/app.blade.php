<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko FAA - Admin Master</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        /* 1. Base Sidebar Style */
        .sidebar {
            width: 280px;
            height: 100vh;
            transition: all 0.3s ease;
            background-color: white;
            border-right: 1px solid #dee2e6;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 30;
        }

        /* 2. Menu Navigasi - Kunci Animasi */
        .sidebar .nav-link {
            transition: all 0.3s ease-in-out !important;
            padding: 0.75rem 1rem;
            border-radius: 0.5rem;
            color: #4b5563 !important; 
            background-color: transparent;
            display: flex;
            align-items: center;
            margin-bottom: 4px;
            text-decoration: none;
            font-weight: 500;
        }

        /* 3. State AKTIF */
        .sidebar .nav-link.active {
            background-color: #eef2ff !important; 
            color: #4f46e5 !important; 
            font-weight: 600;
        }

        .sidebar .nav-link.active i {
            color: #4f46e5 !important;
        }

        /* Efek Hover */
        .sidebar .nav-link:hover:not(.active) {
            background-color: #f9fafb;
            color: #111827 !important;
        }

        /* 4. Responsive & Overlay */
        .main-content {
            transition: margin-left 0.3s ease;
            margin-left: 280px;
        }

        @media (max-width: 1024px) {
            .sidebar { left: -280px; }
            .sidebar.active { left: 0; }
            .main-content { margin-left: 0; }
            .overlay {
                display: none;
                position: fixed;
                top: 0; left: 0; right: 0; bottom: 0;
                background: rgba(0, 0, 0, 0.5);
                z-index: 25;
            }
            .overlay.active { display: block; }
        }

        .sidebar-text { margin-left: 0.75rem; }
    </style>
</head>
<body class="bg-gray-50">
    <div class="overlay" id="overlay"></div>
    
    <!-- Sidebar -->
    <aside class="sidebar shadow-lg">
        <!-- Sidebar Header -->
        <div class="p-6 border-b">
            <div class="flex items-center space-x-3">
                <div class="h-10 w-10 bg-indigo-600 rounded-lg flex items-center justify-center">
                    <i class="fas fa-store text-white"></i>
                </div>
                <div>
                    <h2 class="text-lg font-bold text-gray-900">Toko FAA</h2>
                    <p class="text-xs text-gray-500">Admin Master</p>
                </div>
            </div>
        </div>
        
        <!-- Sidebar Menu -->
        <nav class="p-4 space-y-1">
            <a href="{{ route('dashboard') }}" 
               class="nav-link {{ request()->routeIs('dashboard*') ? 'active' : '' }}">
                <i class="fas fa-home"></i>
                <span class="sidebar-text">Dashboard</span>
            </a>
            
            <a href="{{ route('products.index') }}" 
               class="nav-link {{ request()->routeIs('products.*') ? 'active' : '' }}">
                <i class="fas fa-box"></i>
                <span class="sidebar-text">Produk</span>
            </a>
            
            <a href="{{ route('categories.index') }}" 
               class="nav-link {{ request()->routeIs('categories.*') ? 'active' : '' }}">
                <i class="fas fa-tags"></i>
                <span class="sidebar-text">Kategori</span>
            </a>
            
            <a href="{{ route('stock-entries.index') }}" 
               class="nav-link {{ request()->routeIs('stock-entries.*') ? 'active' : '' }}">
                <i class="fas fa-warehouse"></i>
                <span class="sidebar-text">Stok</span>
            </a>
            
            <a href="{{ route('sales.index') }}" 
               class="nav-link {{ request()->routeIs('sales.*') ? 'active' : '' }}">
                <i class="fas fa-shopping-cart"></i>
                <span class="sidebar-text">Penjualan</span>
            </a>
            
            <a href="{{ route('reports.index') }}" 
               class="nav-link {{ request()->routeIs('reports.*') ? 'active' : '' }}">
                <i class="fas fa-chart-bar"></i>
                <span class="sidebar-text">Laporan</span>
            </a>
            
            <div class="pt-4 border-t mt-4">
                <a href="{{ route('settings.index') }}" 
                   class="nav-link {{ request()->routeIs('settings.*') ? 'active' : '' }}">
                    <i class="fas fa-cog"></i>
                    <span class="sidebar-text">Setting</span>
                </a>
                
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="nav-link text-red-600 w-full border-0 bg-transparent">
                        <i class="fas fa-sign-out-alt"></i>
                        <span class="sidebar-text">Keluar</span>
                    </button>
                </form>
            </div>
        </nav>
        
        <!-- Sidebar Footer -->
        <div class="absolute bottom-0 w-full p-4 border-t bg-gray-50">
            <div class="flex items-center space-x-2 text-sm text-gray-500">
                <i class="fas fa-shield-alt"></i>
                <span class="sidebar-text">vTKFAA</span>
            </div>
        </div>
    </aside>

    <!-- Main Content -->
    <div class="main-content">
        <header class="bg-white shadow-sm border-b sticky top-0 z-20">
            <div class="flex items-center justify-between px-6 py-4">
                <div class="flex items-center space-x-4">
                    <button id="sidebarToggle" class="lg:hidden p-2 rounded-lg text-gray-600 hover:bg-gray-100">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                    <div class="hidden md:block">
                        <h1 class="text-xl font-bold text-gray-900">@yield('title', 'Dashboard')</h1>
                    </div>
                </div>
                
                <div class="flex items-center space-x-4">
                    <span class="hidden md:block text-sm text-gray-600">{{ now()->format('l, d F Y') }}</span>
                    <div class="h-10 w-10 bg-indigo-100 rounded-full flex items-center justify-center text-indigo-600">
                        <i class="fas fa-user"></i>
                    </div>
                </div>
            </div>
        </header>

        <main class="p-6">
            @yield('content')
        </main>
    </div>

    <script>
        const sidebarToggle = document.getElementById('sidebarToggle');
        const sidebar = document.querySelector('.sidebar');
        const overlay = document.getElementById('overlay');
        
        sidebarToggle.addEventListener('click', () => {
            sidebar.classList.toggle('active');
            overlay.classList.toggle('active');
        });
        
        overlay.addEventListener('click', () => {
            sidebar.classList.remove('active');
            overlay.classList.remove('active');
        });
    </script>
    @stack('scripts')
</body>
</html>