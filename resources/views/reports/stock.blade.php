@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Laporan Stok</h1>

    {{-- Ringkasan --}}
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card shadow-sm border-primary">
                <div class="card-body">
                    <h6 class="text-muted">Total Produk</h6>
                    <h3 class="text-primary">{{ $products->count() }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm border-warning">
                <div class="card-body">
                    <h6 class="text-muted">Stok Menipis (< 10)</h6>
                    <h3 class="text-warning">{{ $lowStock->count() }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm border-danger">
                <div class="card-body">
                    <h6 class="text-muted">Stok Habis</h6>
                    <h3 class="text-danger">{{ $outOfStock->count() }}</h3>
                </div>
            </div>
        </div>
    </div>

    {{-- Tabel Semua Produk --}}
    <div class="card shadow-sm">
        <div class="card-body">
            <h5 class="mb-3">Semua Produk</h5>
            <table class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Produk</th>
                        <th>Kategori</th>
                        <th>Total Masuk</th>
                        <th>Total Terjual</th>
                        <th>Stok Saat Ini</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $index => $product)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->category->name ?? '-' }}</td>
                        <td>{{ $product->stockEntries->sum('quantity') }}</td>
                        <td>{{ $product->sales->sum('quantity_sold') }}</td>
                        <td><strong>{{ $product->current_stock }}</strong></td>
                        <td>
                            @if($product->current_stock <= 0)
                                <span class="badge bg-danger">Habis</span>
                            @elseif($product->current_stock < 10)
                                <span class="badge bg-warning text-dark">Menipis</span>
                            @else
                                <span class="badge bg-success">Aman</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted">Belum ada data produk</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection