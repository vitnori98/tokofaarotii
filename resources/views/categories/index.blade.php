@extends('layouts.app')

@section('title', 'Categories')
@section('header', 'Kategori')

@section('content')
<div class="bg-white rounded shadow">
    <div class="p-6 flex justify-between items-center border-b">
        <h2 class="text-xl font-semibold">Kategori</h2>
        <a href="{{ route('categories.create') }}"
           class="bg-indigo-600 text-white px-4 py-2 rounded">
            + Tambah Kategori
        </a>
    </div>

    @if(session('success'))
        <div class="m-4 bg-green-100 text-green-700 px-4 py-2 rounded">
            {{ session('success') }}
        </div>
    @endif

    <table class="w-full">
        <thead class="bg-gray-100">
            <tr>
                <th class="p-3 text-left">No</th>
                <th class="p-3 text-left">Nama Kategori</th>
                <th class="p-3 text-left">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($categories as $index => $category)
            <tr class="border-t">
                <td class="p-3">{{ $categories->firstItem() + $index }}</td>
                <td class="p-3 font-medium">{{ $category->name }}</td>
                <td class="p-3">
                    <a href="{{ route('categories.edit', $category->id) }}"
                       class="text-indigo-600 mr-3">Edit</a>

                    <form action="{{ route('categories.destroy', $category->id) }}"
                          method="POST"
                          class="inline"
                          onsubmit="return confirm('Delete this category?')">
                        @csrf
                        @method('DELETE')
                        <button class="text-red-600">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="3" class="p-4 text-center text-gray-500">
                    No categories found
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="p-4 border-t">
        {{ $categories->links() }}
    </div>
</div>
@endsection