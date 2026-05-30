@extends('layouts.app')

@section('title', 'Video')
@section('subtitle', 'Koleksi video dokumentasi')

@section('content')
<div class="bg-white rounded-xl shadow-sm border p-6">
    <div class="flex justify-between items-center mb-6">
        <h3 class="text-lg font-bold text-gray-800">Video Dokumentasi</h3>
    </div>

    @if($videos->isEmpty())
        <div class="text-center py-12">
            <i class="fas fa-video text-gray-300 text-6xl mb-4"></i>
            <h3 class="text-xl font-medium text-gray-900 mb-2">Belum ada Video</h3>
            <p class="text-gray-500">Data video akan muncul setelah ditambahkan ke database.</p>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            @foreach($videos as $video)
                <div class="border rounded-xl overflow-hidden shadow-sm bg-gray-50">
                    <div class="aspect-video">
                        @php
                            // Sederhana: ubah watch?v= ke embed/ jika dari youtube
                            $embedUrl = str_replace('watch?v=', 'embed/', $video->url);
                        @endphp
                        <iframe class="w-full h-full" src="{{ $embedUrl }}" frameborder="0" allowfullscreen></iframe>
                    </div>
                    <div class="p-4 bg-white">
                        <h4 class="font-bold text-lg text-gray-800 mb-2">{{ $video->judul }}</h4>
                        <p class="text-gray-600 text-sm">{{ $video->deskripsi }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
