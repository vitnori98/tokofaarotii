@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h1 class="mb-4 h3 text-gray-800">Pengaturan</h1>

    {{-- Notifikasi sukses --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-sm border-0">
        <div class="card-body p-4">

            <h5 class="mb-4 text-muted">Pengaturan Umum</h5>

            <form method="POST" action="{{ route('settings.update') }}">
                @csrf

                <div class="mb-3">
                    <label class="form-label" for="store_name">Nama Toko</label>
                    <input type="text" 
                           id="store_name"
                           name="store_name" 
                           class="form-control" 
                           placeholder="Masukkan nama toko"
                           value="{{ old('store_name') }}">
                </div>

                <div class="mb-3">
                    <label class="form-label" for="store_address">Alamat Toko</label>
                    <textarea id="store_address"
                              name="store_address" 
                              class="form-control" 
                              rows="3" 
                              placeholder="Masukkan alamat toko">{{ old('store_address') }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label" for="store_phone">Nomor Telepon</label>
                    <input type="text" 
                           id="store_phone"
                           name="store_phone" 
                           class="form-control" 
                           placeholder="Masukkan nomor telepon"
                           value="{{ old('store_phone') }}">
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary px-4">Simpan Pengaturan</button>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection