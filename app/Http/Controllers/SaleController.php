<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Product;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sales = Sale::with('product')
            ->latest()
            ->paginate(10);
            
        $totalSales = Sale::sum('total_price');
        $totalItems = Sale::sum('quantity_sold');
        
        return view('sales.index', compact('sales', 'totalSales', 'totalItems'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::all();
        return view('sales.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity_sold' => 'required|integer|min:1',
            'total_price' => 'required|numeric|min:0',
            'customer_name' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
        ]);

        // Cek stok tersedia
        $product = Product::findOrFail($request->product_id);
        
        // Hitung stok tersedia
        $totalStock = $product->stockEntries->sum('quantity');
        $totalSold = $product->sales->sum('quantity_sold');
        $currentStock = $totalStock - $totalSold;
        
        if ($currentStock < $request->quantity_sold) {
            return back()->withErrors([
                'quantity_sold' => 'Stok tidak mencukupi. Stok tersedia: ' . $currentStock
            ]);
        }

        Sale::create([
            'product_id' => $request->product_id,
            'quantity_sold' => $request->quantity_sold,
            'total_price' => $request->total_price,
            'customer_name' => $request->customer_name,
            'notes' => $request->notes,
        ]);

        return redirect()->route('sales.index')
            ->with('success', 'Penjualan berhasil dicatat');
    }

    /**
     * Display the specified resource.
     */
    public function show(Sale $sale)
    {
        return view('sales.show', compact('sale'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sale $sale)
    {
        $products = Product::all();
        return view('sales.edit', compact('sale', 'products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sale $sale)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity_sold' => 'required|integer|min:1',
            'total_price' => 'required|numeric|min:0',
            'customer_name' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
        ]);

        $sale->update($request->all());

        return redirect()->route('sales.index')
            ->with('success', 'Penjualan berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sale $sale)
    {
        $sale->delete();

        return redirect()->route('sales.index')
            ->with('success', 'Penjualan berhasil dihapus');
    }
}