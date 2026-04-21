@extends('layouts.app')

@section('title', 'Add Category')
@section('header', 'Tambah Kategori')

@section('content')
<div class="bg-white p-6 rounded shadow max-w-md">
    <form method="POST" action="{{ route('categories.store') }}">
        @csrf

        <div class="mb-4">
            <label class="block mb-1 font-medium">Nama Kategori</label>
            <input type="text" name="name"
                   class="w-full border rounded px-3 py-2"
                   placeholder="Frozen / Bakery"
                   required>
            @error('name')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex justify-end">
            <a href="{{ route('categories.index') }}" class="mr-3">Cancel</a>
            <button class="bg-indigo-600 text-white px-4 py-2 rounded">
                Save
            </button>
        </div>
    </form>
</div>
@endsection