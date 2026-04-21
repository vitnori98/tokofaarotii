<?php

namespace App\Http\Controllers;

use App\Models\StockEntry;
use App\Models\Product;
use Illuminate\Http\Request;

class StockEntryController extends Controller
{
    public function index()
    {
        $query = StockEntry::with('product');
        
        // Filter by product
        if (request('product_id')) {
            $query->where('product_id', request('product_id'));
        }

        // Filter by type
        if (request('type')) {
            $query->where('type', request('type'));
        }
        
        // Filter by date
        if (request('start_date')) {
            $query->whereDate('created_at', '>=', request('start_date'));
        }
        
        $stockEntries = $query->latest()->paginate(10);
        $products = Product::orderBy('name')->get();
        
        $totalIn = StockEntry::where('type', 'in')->sum('quantity');
        $totalOut = StockEntry::where('type', 'out')->sum('quantity');
        $totalTransactions = StockEntry::count();
        
        return view('stock-entries.index', compact(
            'stockEntries', 
            'products',
            'totalIn',
            'totalOut',
            'totalTransactions'
        ));
    }

    public function create()
    {
        $products = Product::orderBy('name')->get();
        return view('stock-entries.create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'type'       => 'required|in:in,out',
            'quantity'   => 'required|integer|min:1',
            'entry_date' => 'required|date',
            'supplier'   => 'nullable|string|max:255',
            'notes'      => 'nullable|string',
        ]);

        StockEntry::create($request->all());

        return redirect()->route('stock-entries.index')
            ->with('success', 'Stok berhasil ditambahkan');
    }

    public function show(StockEntry $stockEntry)
    {
        $stockEntry->load('product');
        return view('stock-entries.show', compact('stockEntry'));
    }

    public function edit(StockEntry $stockEntry)
    {
        $products = Product::orderBy('name')->get();
        return view('stock-entries.edit', compact('stockEntry', 'products'));
    }

    public function update(Request $request, StockEntry $stockEntry)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'type'       => 'required|in:in,out',
            'quantity'   => 'required|integer|min:1',
            'entry_date' => 'required|date',
            'supplier'   => 'nullable|string|max:255',
            'notes'      => 'nullable|string',
        ]);

        $stockEntry->update($request->all());

        return redirect()->route('stock-entries.index')
            ->with('success', 'Stok berhasil diperbarui');
    }

    public function destroy(StockEntry $stockEntry)
    {
        $stockEntry->delete();

        return redirect()->route('stock-entries.index')
            ->with('success', 'Stok berhasil dihapus');
    }
}