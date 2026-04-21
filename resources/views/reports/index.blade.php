@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Laporan</h1>

    <div class="row mb-4">
        {{-- Total Penjualan --}}
        <div class="col-md-4">
            <div class="card shadow-sm border-success">
                <div class="card-body">
                    <h6 class="text-muted">Total Pendapatan</h6>
                    <h3 class="text-success">Rp {{ number_format($totalSales ?? 0, 0, ',', '.') }}</h3>
                </div>
            </div>
        </div>

        {{-- Total Stok Masuk --}}
        <div class="col-md-4">
            <div class="card shadow-sm border-primary">
                <div class="card-body">
                    <h6 class="text-muted">Total Stok Masuk</h6>
                    <h3 class="text-primary">{{ number_format($totalStockIn ?? 0, 0, ',', '.') }}</h3>
                </div>
            </div>
        </div>

        {{-- Total Stok Keluar --}}
        <div class="col-md-4">
            <div class="card shadow-sm border-danger">
                <div class="card-body">
                    <h6 class="text-muted">Total Stok Keluar</h6>
                    <h3 class="text-danger">{{ number_format($totalStockOut ?? 0, 0, ',', '.') }}</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <p class="text-muted">Laporan lebih detail akan ditampilkan di sini.</p>
        </div>
    </div>
</div>
@endsection