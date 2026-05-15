@extends('layouts.app')

@section('title', 'Tambah Stok')

@section('content')
<div class="bg-white rounded-lg shadow p-6 max-w-xl">

    {{-- Perbaikan: Nama route diubah dari 'stock-entries.web.store' menjadi 'stock-entries.store' --}}
    <form action="{{ route('stock-entries.store') }}" method="POST">
        @csrf

        <!-- PRODUK -->
        <div class="mb-4">
            <label class="block mb-1 font-medium">Produk</label>
            <select name="product_id"
                    class="w-full border rounded px-3 py-2 focus:ring focus:ring-indigo-200" required>
                <option value="">-- Pilih Produk --</option>
                @foreach($products as $product)
                    <option value="{{ $product->id }}" {{ old('product_id') == $product->id ? 'selected' : '' }}>
                        {{ $product->name }}
                    </option>
                @endforeach
            </select>
            @error('product_id')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- JUMLAH -->
        <div class="mb-4">
            <label class="block mb-1 font-medium">Jumlah Stok</label>
            <input type="number"
                   name="quantity"
                   min="1"
                   value="{{ old('quantity') }}"
                   class="w-full border rounded px-3 py-2 focus:ring focus:ring-indigo-200"
                   required>
            @error('quantity')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- TANGGAL -->
        <div class="mb-4">
            <label class="block mb-1 font-medium">Tanggal Masuk</label>
            <input type="date"
                   name="entry_date"
                   value="{{ old('entry_date', date('Y-m-d')) }}"
                   class="w-full border rounded px-3 py-2 focus:ring focus:ring-indigo-200"
                   required>
            @error('entry_date')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- BUTTON -->
        <div class="flex justify-end gap-2">
            {{-- Perbaikan: Nama route diubah dari 'stock-entries.web.index' menjadi 'stock-entries.index' --}}
            <a href="{{ route('stock-entries.index') }}"
               class="px-4 py-2 border rounded hover:bg-gray-50 transition">
                Batal
            </a>
            <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 transition">
                Simpan
            </button>
        </div>
    </form>

</div>
@endsection