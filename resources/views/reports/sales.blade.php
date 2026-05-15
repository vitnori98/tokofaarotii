@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Laporan Penjualan</h1>

    {{-- Filter Tanggal --}}
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <form method="GET" action="{{ url('/reports/sales') }}">
                <div class="row">
                    <div class="col-md-4">
                        <label>Tanggal Mulai</label>
                        <input type="date" name="start_date" class="form-control"
                            value="{{ $startDate instanceof \Carbon\Carbon ? $startDate->format('Y-m-d') : $startDate }}">
                    </div>
                    <div class="col-md-4">
                        <label>Tanggal Akhir</label>
                        <input type="date" name="end_date" class="form-control"
                            value="{{ $endDate instanceof \Carbon\Carbon ? $endDate->format('Y-m-d') : $endDate }}">
                    </div>
                    <div class="col-md-4 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary w-100">Filter</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Ringkasan --}}
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card shadow-sm border-success">
                <div class="card-body">
                    <h6 class="text-muted">Total Pendapatan</h6>
                    <h3 class="text-success">Rp {{ number_format($totalSales, 0, ',', '.') }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow-sm border-primary">
                <div class="card-body">
                    <h6 class="text-muted">Total Item Terjual</h6>
                    <h3 class="text-primary">{{ number_format($totalItems, 0, ',', '.') }}</h3>
                </div>
            </div>
        </div>
    </div>

    {{-- Tabel --}}
    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Produk</th>
                        <th>Qty Terjual</th>
                        <th>Total Harga</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($sales as $index => $sale)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $sale->product->name ?? '-' }}</td>
                        <td>{{ $sale->quantity_sold }}</td>
                        <td>Rp {{ number_format($sale->total_price, 0, ',', '.') }}</td>
                        <td>{{ \Carbon\Carbon::parse($sale->sale_date)->format('d/m/Y') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted">Belum ada data penjualan</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection