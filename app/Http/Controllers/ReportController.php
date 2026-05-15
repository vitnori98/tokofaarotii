<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\StockEntry;
use App\Models\Product;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        // 1. Menghitung Total Pendapatan dari semua transaksi yang selesai
        $totalSales = Sale::sum('total_price');

        // 2. Menghitung Total Stok Masuk (dari tabel stock_entries)
        $totalStockIn = StockEntry::sum('quantity');

        // 3. Menghitung Total Stok Keluar (dari tabel sales)
        $totalStockOut = Sale::sum('quantity_sold');

        // Kirim data ke view reports/index.blade.php
        return view('reports.index', compact('totalSales', 'totalStockIn', 'totalStockOut'));
    }

    public function stockReport()
    {
        $products = Product::with(['category', 'stockEntries', 'sales'])->get();
        
        // Filter produk untuk ringkasan di atas
        $lowStock = $products->filter(function($p) {
            return $p->total_stok < 10 && $p->total_stok > 0;
        });
        
        $outOfStock = $products->filter(function($p) {
            return $p->total_stok <= 0;
        });

        return view('reports.stock', compact('products', 'lowStock', 'outOfStock'));
    }
}