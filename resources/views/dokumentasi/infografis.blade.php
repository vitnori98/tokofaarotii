@extends('layouts.app')

@section('title', 'Infografis')
@section('subtitle', 'Kumpulan infografis informasi perusahaan')

@section('content')
<div class="bg-white rounded-xl shadow-sm border p-6">
    <div class="flex justify-between items-center mb-6">
        <h3 class="text-lg font-bold text-gray-800">Daftar Infografis</h3>
    </div>

    @if($infografis->isEmpty())
        <div class="text-center py-12">
            <i class="fas fa-chart-pie text-gray-300 text-6xl mb-4"></i>
            <h3 class="text-xl font-medium text-gray-900 mb-2">Belum ada Infografis</h3>
            <p class="text-gray-500">Data infografis akan muncul setelah ditambahkan ke database.</p>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($infografis as $info)
                <div class="border rounded-lg overflow-hidden group">
                    <div class="relative overflow-hidden">
                        <img src="{{ asset('storage/' . $info->gambar) }}" alt="{{ $info->judul }}" class="w-full h-64 object-cover group-hover:scale-105 transition duration-300">
                        <div class="absolute inset-0 bg-black bg-opacity-40 opacity-0 group-hover:opacity-100 transition flex items-center justify-center">
                            <a href="{{ asset('storage/' . $info->gambar) }}" target="_blank" class="bg-white text-gray-800 px-4 py-2 rounded-full text-sm font-bold">
                                <i class="fas fa-search-plus mr-1"></i> Lihat Full
                            </a>
                        </div>
                    </div>
                    <div class="p-3">
                        <h4 class="font-bold text-gray-800 text-sm mb-1">{{ $info->judul }}</h4>
                        <p class="text-gray-500 text-xs">{{ $info->deskripsi }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
