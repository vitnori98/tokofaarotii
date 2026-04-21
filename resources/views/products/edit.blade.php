@extends('layouts.app')

@section('title', 'Edit Produk')
@section('subtitle', 'Edit data produk')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="bg-white rounded-xl shadow-sm border">
        <div class="px-6 py-4 border-b">
            <h2 class="text-lg font-semibold text-gray-900">Edit Produk</h2>
            <p class="text-sm text-gray-500">Perbarui informasi produk</p>
        </div>
        
        <div class="p-6">
            <form method="POST" action="{{ route('products.update', $product->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="space-y-6">
                    <!-- Product Name -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                            Nama Produk *
                        </label>
                        <input type="text" 
                               name="name" 
                               id="name"
                               value="{{ old('name', $product->name) }}"
                               required
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('name') border-red-500 @enderror"
                               placeholder="Masukkan nama produk">
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Description -->
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                            Deskripsi
                        </label>
                        <textarea name="description" 
                                  id="description"
                                  rows="3"
                                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('description') border-red-500 @enderror"
                                  placeholder="Masukkan deskripsi produk">{{ old('description', $product->description) }}</textarea>
                        @error('description')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Category -->
                        <div>
                            <label for="category_id" class="block text-sm font-medium text-gray-700 mb-2">
                                Kategori *
                            </label>
                            <select name="category_id" 
                                    id="category_id"
                                    required
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('category_id') border-red-500 @enderror">
                                <option value="">Pilih Kategori</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ (old('category_id', $product->category_id) == $category->id) ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <!-- Price -->
                        <div>
                            <label for="price" class="block text-sm font-medium text-gray-700 mb-2">
                                Harga *
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <span class="text-gray-500">Rp</span>
                                </div>
                                <input type="number" 
                                       name="price" 
                                       id="price"
                                       value="{{ old('price', $product->price) }}"
                                       required
                                       min="0"
                                       step="100"
                                       class="pl-12 w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('price') border-red-500 @enderror"
                                       placeholder="0">
                            </div>
                            @error('price')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- SKU -->
                        <div>
                            <label for="sku" class="block text-sm font-medium text-gray-700 mb-2">
                                SKU (Kode Produk)
                            </label>
                            <input type="text" 
                                   name="sku" 
                                   id="sku"
                                   value="{{ old('sku', $product->sku) }}"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('sku') border-red-500 @enderror"
                                   placeholder="SKU-001">
                            @error('sku')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <!-- Image -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Gambar Produk
                            </label>
                            
                            <!-- Current Image -->
                            @if($product->image)
                            <div class="mb-4">
                                <p class="text-sm text-gray-500 mb-2">Gambar saat ini:</p>
                                <div class="flex items-center space-x-4">
                                    <img src="{{ asset('storage/'.$product->image) }}" 
                                         class="h-24 w-24 object-cover rounded-lg border">
                                    <div>
                                        <label class="inline-flex items-center">
                                            <input type="checkbox" name="remove_image" value="1" class="rounded border-gray-300">
                                            <span class="ml-2 text-sm text-gray-600">Hapus gambar</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            @endif
                            
                            <!-- New Image Upload -->
                            <div class="flex items-center justify-center w-full">
                                <label for="image" class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100">
                                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                        <i class="fas fa-cloud-upload-alt text-2xl text-gray-400 mb-2"></i>
                                        <p class="text-sm text-gray-500">
                                            <span class="font-semibold">Klik untuk upload gambar baru</span>
                                        </p>
                                        <p class="text-xs text-gray-500">PNG, JPG, GIF (Max 2MB)</p>
                                    </div>
                                    <input id="image" name="image" type="file" class="hidden" accept="image/*">
                                </label>
                            </div>
                            <div id="image-preview" class="mt-2 hidden">
                                <p class="text-sm text-gray-500 mb-2">Preview gambar baru:</p>
                                <img class="h-24 w-24 object-cover rounded-lg border" src="" alt="Preview">
                            </div>
                            @error('image')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    
                    <!-- Stock Info -->
                    <div class="bg-gray-50 rounded-lg p-4">
                        <h3 class="text-sm font-medium text-gray-700 mb-3">Informasi Stok</h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <p class="text-xs text-gray-500">Total Stok Masuk</p>
                                <p class="text-lg font-semibold text-gray-900">
                                    {{ $product->stockEntries->sum('quantity') }}
                                </p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500">Total Terjual</p>
                                <p class="text-lg font-semibold text-gray-900">
                                    {{ $product->sales->sum('quantity_sold') }}
                                </p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500">Stok Saat Ini</p>
                                @php
                                    $currentStock = $product->stockEntries->sum('quantity') - $product->sales->sum('quantity_sold');
                                @endphp
                                <p class="text-lg font-semibold {{ $currentStock <= 0 ? 'text-red-600' : ($currentStock < 10 ? 'text-yellow-600' : 'text-green-600') }}">
                                    {{ $currentStock }}
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Buttons -->
                    <div class="pt-6 border-t">
                        <div class="flex items-center justify-end space-x-4">
                            <a href="{{ route('products.index') }}"
                               class="px-6 py-3 border border-gray-300 text-gray-700 font-medium rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                                Batal
                            </a>
                            <button type="submit"
                                    class="px-6 py-3 bg-indigo-600 text-white font-medium rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Perbarui Produk
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
// Image preview
document.getElementById('image').addEventListener('change', function(e) {
    const preview = document.getElementById('image-preview');
    const previewImg = preview.querySelector('img');
    
    if (this.files && this.files[0]) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
            previewImg.src = e.target.result;
            preview.classList.remove('hidden');
        }
        
        reader.readAsDataURL(this.files[0]);
    } else {
        preview.classList.add('hidden');
    }
});

// Auto format price
document.getElementById('price').addEventListener('input', function(e) {
    // Remove non-numeric characters
    let value = this.value.replace(/[^\d]/g, '');
    
    // Format with thousand separators
    if (value.length > 0) {
        value = parseInt(value, 10).toLocaleString('id-ID');
        // Store the numeric value in a data attribute
        this.dataset.numericValue = value.replace(/\./g, '');
    } else {
        this.dataset.numericValue = '';
    }
    
    // Update display
    this.value = value;
});

// Before form submit, convert formatted price back to number
document.querySelector('form').addEventListener('submit', function(e) {
    const priceInput = document.getElementById('price');
    if (priceInput.dataset.numericValue) {
        priceInput.value = priceInput.dataset.numericValue;
    }
});
</script>
@endpush