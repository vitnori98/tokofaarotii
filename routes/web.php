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


// Authentication Routes
require __DIR__.'/auth.php';

use App\Models\Product;
use App\Models\Category;
use App\Models\Berita;
use App\Models\Faq;

// PUBLIC ROUTES (Bisa diakses tanpa login)
Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard');
    }
    $products = Product::with('category')->latest()->get();
    $faqs = Faq::latest()->get();
    $beritas = Berita::latest()->take(3)->get();
    return view('welcome', compact('products', 'faqs', 'beritas'));
})->name('welcome');

Route::get('/produk-makanan', [ProductController::class, 'produkMakanan'])->name('produk.makanan');
Route::get('/faq-pertanyaan', [FaqController::class, 'publicIndex'])->name('faq.public');
Route::get('/berita/public', function () {
    $beritas = Berita::latest()->get();
    return view('view-berita', compact('beritas'));
})->name('berita.public');
Route::get('/berita/{berita}', [BeritaController::class, 'show'])->name('berita.show');
Route::post('/cart/add/{id}', [App\Http\Controllers\CartController::class, 'addToCart'])->name('cart.add');


// PROTECTED ROUTES (Harus Login DAN ber-role 'admin_master' atau 'pemilik')
Route::middleware(['auth', 'role:admin_master,pemilik'])->group(function () {

    // Dashboard Routes
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/analytics', [DashboardController::class, 'analytics'])->name('dashboard.analytics');
    Route::get('/dashboard/export/monthly-sales', [DashboardController::class, 'exportMonthlySales'])->name('dashboard.export.monthly');

    // Kelola User Routes
    Route::prefix('kelola-user')->name('kelola-user.')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::post('/', [UserController::class, 'store'])->name('store');
        Route::put('/{user}', [UserController::class, 'update'])->name('update');
        Route::delete('/{user}', [UserController::class, 'destroy'])->name('destroy');
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

    // Stock Routes
    Route::prefix('stock')->name('stock.')->group(function () {
        Route::get('/', function () {
            return redirect()->route('stock-entries.index');
        })->name('index');
    });
    Route::resource('stock-entries', StockEntryController::class);

    // Sales Routes
    Route::prefix('sales')->name('sales.')->group(function () {
        Route::get('/', [SaleController::class, 'index'])->name('index');
        Route::get('/create', [SaleController::class, 'create'])->name('create');
        Route::post('/', [SaleController::class, 'store'])->name('store');
        Route::get('/{sale}/edit', [SaleController::class, 'edit'])->name('edit');
        Route::put('/{sale}', [SaleController::class, 'update'])->name('update');
        Route::delete('/{sale}', [SaleController::class, 'destroy'])->name('destroy');
        Route::get('/{sale}', [SaleController::class, 'show'])->name('show');
        Route::post('/pos/store', [SaleController::class, 'storePos'])->name('pos.store');
        Route::post('/{sale}/confirm', [SaleController::class, 'confirm'])->name('confirm');
    });

    // Reports Routes
    Route::prefix('reports')->name('reports.')->group(function () {
        Route::get('/', [ReportController::class, 'index'])->name('index');
        Route::get('/sales', function() { return redirect()->route('reports.index'); })->name('sales');
        Route::get('/stock', function() { return redirect()->route('reports.index'); })->name('stock');
        Route::get('/export', [ReportController::class, 'export'])->name('export');
    });

    // Resource Masing-masing Menu
    Route::resource('pegawai', PegawaiController::class);
    Route::resource('berita', BeritaController::class);
    
    // FAQ Routes
    Route::get('faq/export/excel', [FaqController::class, 'exportExcel'])->name('faq.export.excel');
    Route::get('faq/export/pdf',   [FaqController::class, 'exportPdf'])->name('faq.export.pdf');
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

    // Settings Group
    Route::prefix('settings')->name('settings.')->group(function () {
        Route::get('/', function () {
            return view('settings.index');
        })->name('index');
        Route::post('/update', function (Request $request) {
            return redirect()->back()->with('success', 'Pengaturan berhasil disimpan!');
        })->name('update');
    });

    // Profile Group
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('edit');
        Route::put('/update', [ProfileController::class, 'update'])->name('update');
    });
    
});