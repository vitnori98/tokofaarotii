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
        $startDate = $request->get('start_date', Carbon::now()->startOfMonth());
        $endDate = $request->get('end_date', Carbon::now()->endOfMonth());

        $sales = Sale::with('product')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->orderBy('created_at', 'DESC')
            ->get();

        $totalSales = $sales->sum('total_price');
        $totalItems = $sales->sum('quantity_sold');

        return view('reports.sales', compact('sales', 'totalSales', 'totalItems', 'startDate', 'endDate'));
    }

    public function stock()
    {
        $products = Product::with(['stockEntries', 'sales', 'category'])
            ->get()
            ->map(function ($product) {
                $totalStock = $product->stockEntries->sum('quantity');
                $totalSold = $product->sales->sum('quantity_sold');
                $product->current_stock = $totalStock - $totalSold;
                return $product;
            })
            ->sortByDesc('current_stock');

        $lowStock = $products->where('current_stock', '<', 10)->where('current_stock', '>', 0);
        $outOfStock = $products->where('current_stock', '<=', 0);

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
        $startDate = $request->get('start_date', Carbon::now()->startOfMonth());
        $endDate = $request->get('end_date', Carbon::now()->endOfMonth());

        $sales = Sale::with('product')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->orderBy('created_at', 'DESC')
            ->get();

        // Implement CSV atau PDF export di sini
        return response()->json([
            'message' => 'Export sales report feature coming soon'
        ]);
    }

    private function exportStock(Request $request)
    {
        $products = Product::with(['stockEntries', 'sales'])
            ->get()
            ->map(function ($product) {
                $totalStock = $product->stockEntries->sum('quantity');
                $totalSold = $product->sales->sum('quantity_sold');
                $product->current_stock = $totalStock - $totalSold;
                return $product;
            });

        // Implement CSV atau PDF export di sini
        return response()->json([
            'message' => 'Export stock report feature coming soon'
        ]);
    }
}