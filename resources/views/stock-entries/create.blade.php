@extends('layouts.app')

@section('title', 'Tambah Stok')
@section('header', 'Tambah Stok')

@section('content')
<div class="bg-white rounded-lg shadow p-6 max-w-xl">

    <form action="{{ route('stock-entries.web.store') }}" method="POST">
        @csrf

        <!-- PRODUK -->
        <div class="mb-4">
            <label class="block mb-1 font-medium">Produk</label>
            <select name="product_id"
                    class="w-full border rounded px-3 py-2" required>
                <option value="">-- Pilih Produk --</option>
                @foreach($products as $product)
                    <option value="{{ $product->id }}">
                        {{ $product->name }}
                    </option>
                @endforeach
            </select>
            @error('product_id')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <!-- JUMLAH -->
        <div class="mb-4">
            <label class="block mb-1 font-medium">Jumlah Stok</label>
            <input type="number"
                   name="quantity"
                   min="1"
                   class="w-full border rounded px-3 py-2"
                   required>
            @error('quantity')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <!-- TANGGAL -->
        <div class="mb-4">
            <label class="block mb-1 font-medium">Tanggal Masuk</label>
            <input type="date"
                   name="entry_date"
                   value="{{ date('Y-m-d') }}"
                   class="w-full border rounded px-3 py-2"
                   required>
            @error('entry_date')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <!-- BUTTON -->
        <div class="flex justify-end gap-2">
            <a href="{{ route('stock-entries.web.index') }}"
               class="px-4 py-2 border rounded">
                Batal
            </a>
            <button class="bg-indigo-600 text-white px-4 py-2 rounded">
                Simpan
            </button>
        </div>
    </form>

</div>
@endsection
