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
            'source' => 'required|in:online,offline', // Tambahkan validasi source
        ]);

        $product = Product::findOrFail($request->product_id);
        
        // Logika Hitung Stok tetap sama
        $totalStock = $product->stockEntries->sum('quantity');
        $totalSold = $product->sales->where('status', 'completed')->sum('quantity_sold'); // Hanya hitung yang sudah lunas/selesai
        $currentStock = $totalStock - $totalSold;
        
        if ($currentStock < $request->quantity_sold) {
            return back()->withErrors(['quantity_sold' => 'Stok tidak mencukupi. Tersedia: ' . $currentStock]);
        }

        Sale::create([
            'product_id' => $request->product_id,
            'quantity_sold' => $request->quantity_sold,
            'total_price' => $request->total_price,
            'customer_name' => $request->customer_name ?? 'Umum',
            'source' => $request->source,
            'status' => ($request->source == 'offline') ? 'completed' : 'pending', // Logika pembeda status
            'notes' => $request->notes,
        ]);

        return redirect()->route('sales.index')->with('success', 'Penjualan berhasil dicatat');
    }

        /**
        * Logika khusus untuk menyimpan penjualan dari POS (Kasir Modern)
        */  
    public function storePos(Request $request)
    {
        if (!$request->items || count($request->items) == 0) {
            return response()->json(['success' => false, 'message' => 'Keranjang kosong']);
        }

        try {
            $transactionId = 'TRX-' . time(); // Buat ID unik sementara untuk struk

            foreach ($request->items as $item) {
                \App\Models\Sale::create([
                    'product_id'    => $item['id'],
                    'quantity_sold' => $item['qty'],
                    'total_price'   => $item['price'] * $item['qty'],
                    'customer_name' => $request->customer_name ?? 'Umum',
                    'source'        => 'offline',
                    'status'        => 'completed',
                    'transaction_group' => $transactionId // Tambahkan kolom ini jika ada untuk mengelompokkan struk
                ]);
            }

            return response()->json([
                'success' => true, 
                'transaction_id' => $transactionId,
                'customer' => $request->customer_name ?? 'Umum',
                'time' => date('d M Y H:i')
            ]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
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

    /**
     * Confirm a pending sale.
     */
    public function confirm(Sale $sale)
    {
        $sale->update(['status' => 'completed']);

        return redirect()->route('sales.index')
            ->with('success', 'Penjualan berhasil dikonfirmasi');
    }
}