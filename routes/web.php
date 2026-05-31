<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\StockEntryController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\DokumentasiController;
use App\Http\Controllers\UserController;


// Home - Redirect ke dashboard jika sudah login, atau ke login jika belum
Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('dashboard');
    }
    return redirect()->route('login');
});

// Dashboard Routes - Require auth dan role (admin_master atau pemilik)
Route::middleware(['auth', 'role:admin_master,pemilik'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/analytics', [DashboardController::class, 'analytics'])->name('dashboard.analytics');
    Route::get('/dashboard/export/monthly-sales', [DashboardController::class, 'exportMonthlySales'])->name('dashboard.export.monthly');
});

// Products Management Routes
Route::prefix('products')->name('products.')->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('index');
    Route::get('/create', [ProductController::class, 'create'])->name('create');
    Route::post('/', [ProductController::class, 'store'])->name('store');
    Route::get('/{product}/edit', [ProductController::class, 'edit'])->name('edit');
    Route::put('/{product}', [ProductController::class, 'update'])->name('update');
    Route::delete('/{product}', [ProductController::class, 'destroy'])->name('destroy');
    Route::get('/{product}', [ProductController::class, 'show'])->name('show');
});

// Categories Routes
Route::prefix('categories')->name('categories.')->group(function () {
    Route::get('/', [CategoryController::class, 'index'])->name('index');
    Route::get('/create', [CategoryController::class, 'create'])->name('create');
    Route::post('/', [CategoryController::class, 'store'])->name('store');
    Route::get('/{category}/edit', [CategoryController::class, 'edit'])->name('edit');
    Route::put('/{category}', [CategoryController::class, 'update'])->name('update');
    Route::delete('/{category}', [CategoryController::class, 'destroy'])->name('destroy');
    Route::get('/{category}', [CategoryController::class, 'show'])->name('show');
});

// SOLUSI: Tambahkan Stock Routes (untuk sidebar)
Route::prefix('stock')->name('stock.')->group(function () {
    Route::get('/', function () {
        // Redirect ke stock-entries atau tampilkan halaman khusus stock
        return redirect()->route('stock-entries.index');
    })->name('index');
});


// Stock Entries Routes
Route::middleware(['web'])->group(function () {
    Route::resource('stock-entries', StockEntryController::class);
});


// Sales Routes
Route::prefix('sales')->name('sales.')->group(function () {
    Route::get('/', [SaleController::class, 'index'])->name('index');
    Route::get('/create', [SaleController::class, 'create'])->name('create');
    Route::post('/', [SaleController::class, 'store'])->name('store');
    Route::get('/{sale}/edit', [SaleController::class, 'edit'])->name('edit');
    Route::put('/{sale}', [SaleController::class, 'update'])->name('update');
    Route::delete('/{sale}', [SaleController::class, 'destroy'])->name('destroy');
    Route::get('/{sale}', [SaleController::class, 'show'])->name('show');
    
    // Route Tambahan untuk Logika Kasir Modern
    Route::post('/pos/store', [SaleController::class, 'storePos'])->name('pos.store');
    Route::post('/{sale}/confirm', [SaleController::class, 'confirm'])->name('confirm');
});

// Reports Routes
Route::prefix('reports')->name('reports.')->group(function () {
    Route::get('/', [ReportController::class, 'index'])->name('index');
    Route::get('/sales', [ReportController::class, 'sales'])->name('sales');
    Route::get('/stock', [ReportController::class, 'stock'])->name('stock');
    Route::get('/export', [ReportController::class, 'export'])->name('export');
});

// Pegawai Routes
Route::resource('pegawai', PegawaiController::class);

// Berita Routes
Route::resource('berita', BeritaController::class);

Route::get('faq/export/excel', [FaqController::class, 'exportExcel'])->name('faq.export.excel');
Route::get('faq/export/pdf',   [FaqController::class, 'exportPdf'])->name('faq.export.pdf');

// FAQ Routes (resource route sudah didefinisikan di bawah agar tidak bentrok dengan export routes)
Route::resource('faq', FaqController::class);


// Dokumentasi Routes
Route::prefix('dokumentasi')->name('dokumentasi.')->group(function () {
    Route::get('/album', [DokumentasiController::class, 'album'])->name('album');
    Route::post('/album', [DokumentasiController::class, 'storeAlbum'])->name('album.store');
    Route::put('/album/{album}', [DokumentasiController::class, 'updateAlbum'])->name('album.update');
    Route::delete('/album/{album}', [DokumentasiController::class, 'destroyAlbum'])->name('album.destroy');
    
    Route::get('/infografis', [DokumentasiController::class, 'infografis'])->name('infografis');
    Route::post('/infografis', [DokumentasiController::class, 'storeInfografis'])->name('infografis.store');
    Route::put('/infografis/{infografis}', [DokumentasiController::class, 'updateInfografis'])->name('infografis.update');
    Route::delete('/infografis/{infografis}', [DokumentasiController::class, 'destroyInfografis'])->name('infografis.destroy');
    
    Route::get('/video', [DokumentasiController::class, 'video'])->name('video');
    Route::post('/video', [DokumentasiController::class, 'storeVideo'])->name('video.store');
    Route::put('/video/{video}', [DokumentasiController::class, 'updateVideo'])->name('video.update');
    Route::delete('/video/{video}', [DokumentasiController::class, 'destroyVideo'])->name('video.destroy');
});


// Profile & Settings Routes
Route::middleware('auth')->group(function () {
    
    // Kelola User Routes - Require auth dan role (admin_master atau pemilik)
    Route::middleware(['role:admin_master,pemilik'])->prefix('kelola-user')->name('kelola-user.')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::post('/', [UserController::class, 'store'])->name('store');
        Route::put('/{user}', [UserController::class, 'update'])->name('update');
        Route::delete('/{user}', [UserController::class, 'destroy'])->name('destroy');
    });

    // Group untuk Settings
    Route::prefix('settings')->name('settings.')->group(function () {
        Route::get('/', function () {
            return view('settings.index');
        })->name('index');

        Route::post('/update', function (Request $request) {
            // Logika simpan setting bisa ditaruh di sini nanti
            return redirect()->back()->with('success', 'Pengaturan berhasil disimpan!');
        })->name('update');
    });

    // Group untuk Profile
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('edit');
        // Mengubah '/' menjadi '/update' untuk menghindari konflik dengan settings
        Route::put('/update', [ProfileController::class, 'update'])->name('update');
    });
    
});


// Authentication Routes
require __DIR__.'/auth.php';