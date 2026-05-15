<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Product;
use App\Models\Category;
use App\Models\StockEntry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function index()
    {
        return view('reports.index');
    }

    public function sales(Request $request)
    {
        $startDate = $request->get('start_date', Carbon::now()->startOfMonth()->format('Y-m-d'));
        $endDate = $request->get('end_date', Carbon::now()->endOfMonth()->format('Y-m-d'));

        $sales = Sale::with('product')
            ->whereBetween('sale_date', [$startDate, $endDate])
            ->orderBy('sale_date', 'DESC')
            ->get();

        $totalSales = $sales->sum('total_price');
        $totalItems = $sales->sum('quantity_sold');

        return view('reports.sales', compact('sales', 'totalSales', 'totalItems', 'startDate', 'endDate'));
    }

    public function stock()
    {
        $products = Product::with(['stockEntries', 'sales', 'category'])
            ->get()
            ->sortByDesc('total_stok');

        $lowStock = $products->filter(function($product) {
            return $product->total_stok < 10 && $product->total_stok > 0;
        });
        
        $outOfStock = $products->filter(function($product) {
            return $product->total_stok <= 0;
        });

        return view('reports.stock', compact('products', 'lowStock', 'outOfStock'));
    }

    public function export(Request $request)
    {
        $type = $request->get('type', 'sales');
        
        if ($type === 'sales') {
            return $this->exportSales($request);
        } elseif ($type === 'stock') {
            return $this->exportStock($request);
        }
        
        return redirect()->back()->with('error', 'Tipe export tidak valid');
    }

    private function exportSales(Request $request)
    {
        $startDate = $request->get('start_date', Carbon::now()->startOfMonth()->format('Y-m-d'));
        $endDate = $request->get('end_date', Carbon::now()->endOfMonth()->format('Y-m-d'));

        $sales = Sale::with('product')
            ->whereBetween('sale_date', [$startDate, $endDate])
            ->orderBy('sale_date', 'DESC')
            ->get();

        // Implement CSV atau PDF export di sini
        return response()->json([
            'message' => 'Export sales report feature coming soon',
            'data_count' => $sales->count()
        ]);
    }

    private function exportStock(Request $request)
    {
        $products = Product::with(['stockEntries', 'sales'])
            ->get();

        // Implement CSV atau PDF export di sini
        return response()->json([
            'message' => 'Export stock report feature coming soon',
            'data_count' => $products->count()
        ]);
    }
}