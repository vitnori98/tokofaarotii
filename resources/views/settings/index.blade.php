@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Pengaturan</h1>

    {{-- Notifikasi sukses --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">

            <h5 class="mb-3">Pengaturan Umum</h5>

            <form method="POST" action="{{ url('/settings/update') }}">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Nama Toko</label>
                    <input type="text" name="store_name" class="form-control" 
                        placeholder="Masukkan nama toko"
                        value="{{ old('store_name') }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Alamat Toko</label>
                    <textarea name="store_address" class="form-control" rows="3" 
                        placeholder="Masukkan alamat toko">{{ old('store_address') }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Nomor Telepon</label>
                    <input type="text" name="store_phone" class="form-control" 
                        placeholder="Masukkan nomor telepon"
                        value="{{ old('store_phone') }}">
                </div>

                <button type="submit" class="btn btn-primary">Simpan Pengaturan</button>
            </form>

        </div>
    </div>
</div>
@endsection