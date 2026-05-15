@extends('layouts.app')

@section('title', 'Edit Produk')
@section('subtitle', 'Perbarui data produk di inventori')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="bg-white rounded-xl shadow-sm border">
        <div class="px-6 py-4 border-b">
            <h2 class="text-lg font-semibold text-gray-900">Edit Produk</h2>
            <p class="text-sm text-gray-500">Perbarui informasi produk di bawah ini</p>
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
                            Deskripsi Produk
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
                                    <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
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

                        <!-- Unit -->
                        <div>
                            <label for="unit" class="block text-sm font-medium text-gray-700 mb-2">
                                Satuan *
                            </label>
                            <input type="text"
                                   name="unit"
                                   id="unit"
                                   value="{{ old('unit', $product->unit) }}"
                                   required
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('unit') border-red-500 @enderror"
                                   placeholder="Contoh: pcs, box, kg">
                            @error('unit')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Image -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Gambar Produk
                        </label>

                        {{-- Preview gambar saat ini --}}
                        @if($product->image)
                            <div class="mb-3 flex items-center gap-4 p-3 bg-gray-50 border border-gray-200 rounded-lg">
                                <img src="{{ asset('storage/' . $product->image) }}"
                                     id="current-image"
                                     class="h-16 w-16 object-cover rounded-lg border border-gray-200">
                                <div class="flex-1">
                                    <p class="text-xs font-medium text-gray-600 mb-1">Gambar saat ini</p>
                                    <label class="inline-flex items-center gap-1.5 text-xs text-red-600 cursor-pointer hover:text-red-700">
                                        <input type="checkbox" name="remove_image" value="1"
                                               id="remove-image-checkbox"
                                               class="rounded border-red-300 text-red-500 focus:ring-red-400 w-3.5 h-3.5">
                                        <i class="fas fa-trash-alt"></i> Hapus gambar ini
                                    </label>
                                </div>
                            </div>
                        @endif

                        {{-- Upload area --}}
                        <div class="flex items-center justify-center w-full">
                            <label for="image-upload"
                                   class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 transition-colors">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <i class="fas fa-cloud-upload-alt text-2xl text-gray-400 mb-2"></i>
                                    <p class="text-sm text-gray-500">
                                        <span class="font-semibold">Klik untuk upload</span> atau drag & drop
                                    </p>
                                    <p class="text-xs text-gray-400">PNG, JPG, GIF (Maks 2MB)</p>
                                </div>
                                <input id="image-upload" name="image" type="file" class="hidden" accept="image/*">
                            </label>
                        </div>

                        {{-- Preview gambar baru --}}
                        <div id="image-preview" class="mt-2 hidden">
                            <img class="h-32 w-32 object-cover rounded-lg border border-gray-200" src="" alt="Preview">
                        </div>

                        @error('image')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Buttons -->
                <div class="pt-6 mt-6 border-t">
                    <div class="flex items-center justify-end space-x-3">
                        <a href="{{ route('products.show', $product->id) }}"
                           class="px-6 py-3 border border-gray-300 text-gray-700 font-medium rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                            <i class="fas fa-arrow-left mr-1.5"></i> Batal
                        </a>
                        <button type="submit"
                                class="px-6 py-3 bg-indigo-600 text-white font-medium rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            <i class="fas fa-save mr-1.5"></i> Simpan Perubahan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Preview gambar baru sebelum upload
    document.getElementById('image-upload').addEventListener('change', function (e) {
        const preview = document.getElementById('image-preview');
        const previewImg = preview.querySelector('img');
        const currentImage = document.getElementById('current-image');

        if (this.files && this.files[0]) {
            const reader = new FileReader();
            reader.onload = function (e) {
                previewImg.src = e.target.result;
                preview.classList.remove('hidden');
                // Jika ada gambar lama, redup-kan karena akan diganti
                if (currentImage) currentImage.classList.add('opacity-40');
            };
            reader.readAsDataURL(this.files[0]);
        } else {
            preview.classList.add('hidden');
            if (currentImage) currentImage.classList.remove('opacity-40');
        }
    });

    // Jika checkbox "Hapus gambar" dicentang, redup-kan preview gambar lama
    const removeCheckbox = document.getElementById('remove-image-checkbox');
    const currentImage = document.getElementById('current-image');
    if (removeCheckbox) {
        removeCheckbox.addEventListener('change', function () {
            if (currentImage) {
                currentImage.classList.toggle('opacity-40', this.checked);
            }
        });
    }

    // Auto format price (sama seperti create)
    document.getElementById('price').addEventListener('input', function () {
        let value = this.value.replace(/[^\d]/g, '');
        if (value.length > 0) {
            value = parseInt(value, 10).toLocaleString('id-ID');
            this.dataset.numericValue = value.replace(/\./g, '');
        } else {
            this.dataset.numericValue = '';
        }
        this.value = value;
    });

    // Sebelum submit, kembalikan price ke angka murni
    document.querySelector('form').addEventListener('submit', function () {
        const priceInput = document.getElementById('price');
        if (priceInput.dataset.numericValue) {
            priceInput.value = priceInput.dataset.numericValue;
        }
    });
</script>
@endpush