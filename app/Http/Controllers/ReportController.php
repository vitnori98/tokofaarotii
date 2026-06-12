<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\StockEntry;
use App\Models\Product;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $startDate = $request->start_date ? \Carbon\Carbon::parse($request->start_date) : now()->startOfMonth();
        $endDate = $request->end_date ? \Carbon\Carbon::parse($request->end_date) : now()->endOfMonth();
        $groupBy = $request->get('group_by', 'day');
        $categoryId = $request->get('category_id');

        // 1. Overview Stats (Filtered by Date & Category)
        $salesQuery = Sale::whereBetween('sale_date', [$startDate->format('Y-m-d'), $endDate->format('Y-m-d')]);
        if ($categoryId) {
            $salesQuery->whereHas('product', function($q) use ($categoryId) {
                $q->where('category_id', $categoryId);
            });
        }
        
        $totalSales = $salesQuery->sum('total_price');
        $totalItemsSold = $salesQuery->sum('quantity_sold');
        
        $stockQuery = StockEntry::whereBetween('created_at', [$startDate->startOfDay(), $endDate->endOfDay()]);
        if ($categoryId) {
            $stockQuery->whereHas('product', function($q) use ($categoryId) {
                $q->where('category_id', $categoryId);
            });
        }
        $totalStockIn = $stockQuery->sum('quantity');

        // 2. Sales Data for Chart & Table
        $salesData = $salesQuery->with(['product.category'])->latest('sale_date')->get();
        $chartData = $this->getChartData($startDate, $endDate, $groupBy, $categoryId);

        // 3. Stock Data
        $productQuery = Product::with(['category', 'stockEntries', 'sales']);
        if ($categoryId) {
            $productQuery->where('category_id', $categoryId);
        }
        $products = $productQuery->get();

        $lowStockCount = $products->filter(fn($p) => $p->total_stok < 10 && $p->total_stok > 0)->count();
        $outOfStockCount = $products->filter(fn($p) => $p->total_stok <= 0)->count();

        $categories = \App\Models\Category::all();

        return view('reports.index', compact(
            'totalSales', 'totalItemsSold', 'totalStockIn', 
            'salesData', 'chartData', 'products',
            'lowStockCount', 'outOfStockCount',
            'startDate', 'endDate', 'groupBy', 'categories', 'categoryId'
        ));
    }

    private function getChartData($startDate, $endDate, $groupBy, $categoryId)
    {
        $query = Sale::select(
            \DB::raw('SUM(total_price) as total_revenue'),
            \DB::raw('SUM(quantity_sold) as total_qty')
        )
        ->whereBetween('sale_date', [$startDate->format('Y-m-d'), $endDate->format('Y-m-d')]);

        if ($categoryId) {
            $query->whereHas('product', function($q) use ($categoryId) {
                $q->where('category_id', $categoryId);
            });
        }

        if ($groupBy == 'day') {
            $query->addSelect(\DB::raw("DATE_FORMAT(sale_date, '%d %b %Y') as label"))
                  ->groupBy(\DB::raw('DATE(sale_date)'), 'label')
                  ->orderBy(\DB::raw('DATE(sale_date)'), 'ASC');
        } elseif ($groupBy == 'week') {
            $query->addSelect(\DB::raw("CONCAT('Minggu ', WEEK(sale_date), ', ', YEAR(sale_date)) as label"))
                  ->groupBy(\DB::raw('YEARWEEK(sale_date)'), 'label')
                  ->orderBy(\DB::raw('YEARWEEK(sale_date)'), 'ASC');
        } elseif ($groupBy == 'month') {
            $query->addSelect(\DB::raw("DATE_FORMAT(sale_date, '%b %Y') as label"))
                  ->groupBy(\DB::raw("DATE_FORMAT(sale_date, '%Y-%m')"), 'label')
                  ->orderBy(\DB::raw("DATE_FORMAT(sale_date, '%Y-%m')"), 'ASC');
        } elseif ($groupBy == 'year') {
            $query->addSelect(\DB::raw("YEAR(sale_date) as label"))
                  ->groupBy('label')
                  ->orderBy('label', 'ASC');
        }

        $results = $query->get();

        return [
            'labels' => $results->pluck('label'),
            'revenue' => $results->pluck('total_revenue'),
            'qty' => $results->pluck('total_qty'),
        ];
    }

    public function export()
    {
        // Basic implementation for now, or just redirect back
        return redirect()->back()->with('error', 'Fitur ekspor akan segera hadir!');
    }
}
