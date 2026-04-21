<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Faa - Admin Panel</title>
    
    <!-- CSS & Libraries -->
    <!-- <script src="https://cdn.tailwindcss.com"></script> -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        .sidebar {
            transition: all 0.3s ease;
        }
        .sidebar-collapsed {
            width: 70px;
        }
        .sidebar-collapsed .sidebar-text {
            display: none;
        }
        .main-content {
            transition: margin-left 0.3s ease;
        }
        @media (max-width: 768px) {
            .sidebar {
                position: fixed;
                left: -280px;
                z-index: 50;
            }
            .sidebar.active {
                left: 0;
            }
            .overlay {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: rgba(0, 0, 0, 0.5);
                z-index: 40;
            }
            .overlay.active {
                display: block;
            }
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Overlay for mobile -->
    <div class="overlay" id="overlay"></div>
    
    <!-- Sidebar -->
    <aside class="sidebar fixed top-0 left-0 h-screen bg-white shadow-lg z-30 w-64">
        <!-- Sidebar Header -->
        <div class="p-6 border-b">
            <div class="flex items-center space-x-3">
                <div class="h-10 w-10 bg-indigo-600 rounded-lg flex items-center justify-center">
                    <i class="fas fa-store text-white"></i>
                </div>
                <div>
                    <h2 class="text-lg font-bold text-gray-900">Toko Faa</h2>
                    <p class="text-xs text-gray-500">Admin Panel</p>
                </div>
            </div>
        </div>
        
        <!-- Sidebar Menu -->
        <nav class="p-4 space-y-1">
            <!-- Dashboard -->
            <a href="{{ route('dashboard') }}" 
               class="flex items-center space-x-3 px-4 py-3 rounded-lg bg-indigo-50 text-indigo-700">
                <i class="fas fa-home text-lg"></i>
                <span class="sidebar-text font-medium">Dashboard</span>
            </a>
            
            <!-- Products -->
            <a href="{{ route('products.index') }}" 
               class="flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-700 hover:bg-gray-100">
                <i class="fas fa-box text-lg"></i>
                <span class="sidebar-text">Products</span>
            </a>
            
            <!-- Categories -->
            <a href="{{ route('categories.index') }}" 
               class="flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-700 hover:bg-gray-100">
                <i class="fas fa-tags text-lg"></i>
                <span class="sidebar-text">Categories</span>
            </a>
            
            <!-- Stock -->
            <a href="{{ route('stock-entries.index') }}" 
               class="flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-700 hover:bg-gray-100">
                <i class="fas fa-warehouse text-lg"></i>
                <span class="sidebar-text">Stock</span>
            </a>
            
            <!-- Sales -->
            <a href="{{ route('sales.index') }}" 
               class="flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-700 hover:bg-gray-100">
                <i class="fas fa-shopping-cart text-lg"></i>
                <span class="sidebar-text">Sales</span>
            </a>
            
            <!-- Reports -->
            <a href="{{ route('reports.index') }}" 
               class="flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-700 hover:bg-gray-100">
                <i class="fas fa-chart-bar text-lg"></i>
                <span class="sidebar-text">Reports</span>
            </a>
            
            <!-- Settings -->
            <div class="pt-8 border-t mt-8">
                <a href="{{ route('settings.index') }}" 
                   class="flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-700 hover:bg-gray-100">
                    <i class="fas fa-cog text-lg"></i>
                    <span class="sidebar-text">Settings</span>
                </a>
                
                <!-- Logout -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" 
                            class="flex items-center space-x-3 px-4 py-3 rounded-lg text-red-600 hover:bg-red-50 w-full">
                        <i class="fas fa-sign-out-alt text-lg"></i>
                        <span class="sidebar-text">Logout</span>
                    </button>
                </form>
            </div>
        </nav>
        
        <!-- Sidebar Footer -->
        <div class="absolute bottom-0 w-full p-4 border-t bg-gray-50">
            <div class="flex items-center space-x-2 text-sm text-gray-500">
                <i class="fas fa-shield-alt"></i>
                <span class="sidebar-text">v1.0.0</span>
            </div>
        </div>
    </aside>

    <!-- Main Content -->
    <div class="main-content ml-64">
        <!-- Top Navigation -->
        <header class="bg-white shadow-sm border-b sticky top-0 z-20">
            <div class="flex items-center justify-between px-6 py-4">
                <!-- Left: Menu Toggle & Breadcrumb -->
                <div class="flex items-center space-x-4">
                    <button id="sidebarToggle" 
                            class="lg:hidden p-2 rounded-lg text-gray-600 hover:bg-gray-100">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                    
                    <div class="hidden md:block">
                        <h1 class="text-xl font-bold text-gray-900">@yield('title', 'Dashboard')</h1>
                        <p class="text-sm text-gray-600">@yield('subtitle', 'Overview sistem manajemen inventori')</p>
                    </div>
                </div>
                
                <!-- Right: User & Notifications -->
                <div class="flex items-center space-x-4">
                    <!-- Notifications -->
                    <div class="relative">
                        <button class="p-2 rounded-lg text-gray-600 hover:bg-gray-100 relative">
                            <i class="fas fa-bell text-xl"></i>
                            @if($lowStockCount ?? 0 > 0)
                                <span class="absolute -top-1 -right-1 h-3 w-3 bg-red-500 rounded-full"></span>
                            @endif
                        </button>
                    </div>
                    
                    <!-- Date -->
                    <div class="hidden md:block">
                        <span class="text-sm text-gray-600">{{ now()->format('l, d F Y') }}</span>
                    </div>
                    
                    <!-- User Profile -->
                    <div class="relative group">
                        <button class="flex items-center space-x-3 p-2 rounded-lg hover:bg-gray-100">
                            <div class="h-10 w-10 bg-indigo-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-user text-indigo-600"></i>
                            </div>
                            <div class="hidden md:block text-left">
                                <p class="font-medium text-gray-900">Admin</p>
                                <p class="text-xs text-gray-500">Super Admin</p>
                            </div>
                            <i class="fas fa-chevron-down text-gray-400 hidden md:block"></i>
                        </button>
                        
                        <!-- Dropdown Menu -->
                        <div class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border py-2 hidden group-hover:block">
                            <a href="{{ route('profile.edit') }}" 
                               class="block px-4 py-2 text-gray-700 hover:bg-gray-100">
                                <i class="fas fa-user-edit mr-2"></i>Edit Profile
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" 
                                        class="block w-full text-left px-4 py-2 text-red-600 hover:bg-red-50">
                                    <i class="fas fa-sign-out-alt mr-2"></i>Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Mobile Title -->
            <div class="md:hidden px-6 pb-4">
                <h1 class="text-xl font-bold text-gray-900">@yield('title', 'Dashboard')</h1>
                <p class="text-sm text-gray-600">@yield('subtitle', 'Overview sistem manajemen inventori')</p>
            </div>
        </header>

        <!-- Page Content -->
        <main class="p-6">
            @yield('content')
        </main>
    </div>

    <!-- JavaScript -->
    <script>
        // Sidebar Toggle
        const sidebarToggle = document.getElementById('sidebarToggle');
        const sidebar = document.querySelector('.sidebar');
        const overlay = document.getElementById('overlay');
        const mainContent = document.querySelector('.main-content');
        
        sidebarToggle.addEventListener('click', () => {
            sidebar.classList.toggle('active');
            overlay.classList.toggle('active');
        });
        
        overlay.addEventListener('click', () => {
            sidebar.classList.remove('active');
            overlay.classList.remove('active');
        });
        
        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', (e) => {
            if (window.innerWidth <= 768) {
                if (!sidebar.contains(e.target) && !sidebarToggle.contains(e.target)) {
                    sidebar.classList.remove('active');
                    overlay.classList.remove('active');
                }
            }
        });
        
        // Handle window resize
        window.addEventListener('resize', () => {
            if (window.innerWidth > 768) {
                sidebar.classList.remove('active');
                overlay.classList.remove('active');
            }
        });
    </script>
    
    @stack('scripts')
</body>
</html>