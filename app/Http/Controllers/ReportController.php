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
        // Overview Stats
        $totalSales = Sale::sum('total_price');
        $totalItemsSold = Sale::sum('quantity_sold');
        $totalStockIn = StockEntry::sum('quantity');
        
        // Top Selling Products
        $topProducts = Product::withSum('sales as total_sold', 'quantity_sold')
            ->orderBy('total_sold', 'desc')
            ->take(5)
            ->get();

        // Revenue by Category
        $categoryRevenue = \DB::table('sales')
            ->join('products', 'sales.product_id', '=', 'products.id')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->select('categories.name', \DB::raw('SUM(sales.total_price) as revenue'))
            ->groupBy('categories.name')
            ->orderBy('revenue', 'desc')
            ->get();

        // Stock Alerts
        $lowStockCount = Product::get()->filter(function($p) {
            return $p->total_stok < 10 && $p->total_stok > 0;
        })->count();

        $outOfStockCount = Product::get()->filter(function($p) {
            return $p->total_stok <= 0;
        })->count();

        return view('reports.index', compact(
            'totalSales', 'totalItemsSold', 'totalStockIn', 
            'topProducts', 'categoryRevenue', 'lowStockCount', 'outOfStockCount'
        ));
    }

    public function sales(Request $request)
    {
        $startDate = $request->start_date ? \Carbon\Carbon::parse($request->start_date) : now()->startOfMonth();
        $endDate = $request->end_date ? \Carbon\Carbon::parse($request->end_date) : now()->endOfMonth();

        $sales = Sale::with('product')
            ->whereBetween('created_at', [$startDate->startOfDay(), $endDate->endOfDay()])
            ->latest()
            ->get();

        $totalSales = $sales->sum('total_price');
        $totalItems = $sales->sum('quantity_sold');

        return view('reports.sales', compact('sales', 'totalSales', 'totalItems', 'startDate', 'endDate'));
    }

    public function stock()
    {
        $products = Product::with(['category', 'stockEntries', 'sales'])->get();
        
        $lowStock = $products->filter(function($p) {
            return $p->total_stok < 10 && $p->total_stok > 0;
        });
        
        $outOfStock = $products->filter(function($p) {
            return $p->total_stok <= 0;
        });

        return view('reports.stock', compact('products', 'lowStock', 'outOfStock'));
    }

    public function export()
    {
        // Basic implementation for now, or just redirect back
        return redirect()->back()->with('error', 'Fitur ekspor akan segera hadir!');
    }
}