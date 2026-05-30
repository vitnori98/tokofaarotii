@extends('layouts.app')

@section('title', 'Album Kegiatan')
@section('subtitle', 'Daftar dokumentasi kegiatan perusahaan')

@section('content')
<div class="bg-white rounded-xl shadow-sm border p-6">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
        <div>
            <h3 class="text-lg font-bold text-gray-800">Koleksi Album</h3>
            <p class="text-sm text-gray-500">Politeknik Manufaktur Negeri Bangka Belitung</p>
        </div>
        <div class="flex items-center gap-2 w-full sm:w-auto justify-end">
            <div class="inline-flex rounded-md shadow-sm" role="group">
                <button type="button" class="px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-l-lg hover:bg-gray-50">
                    <i class="fas fa-file-excel text-green-600 mr-1"></i> Excel
                </button>
                <button type="button" class="px-3 py-2 text-sm font-medium text-gray-700 bg-white border-t border-b border-r border-gray-300 rounded-r-lg hover:bg-gray-50">
                    <i class="fas fa-file-pdf text-red-600 mr-1"></i> PDF
                </button>
            </div>
            
            <button onclick="toggleModal('modal-tambah')" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition flex items-center shadow-sm">
                <i class="fas fa-plus mr-2"></i> Tambah Album
            </button>
        </div>
    </div>

    {{-- Alert Success --}}
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    {{-- Grid Card Layout --}}
    @if($albums->isEmpty())
        <div class="text-center py-12">
            <i class="fas fa-images text-gray-300 text-6xl mb-4"></i>
            <h3 class="text-xl font-medium text-gray-900 mb-2">Belum ada Album</h3>
            <p class="text-gray-500">Data album akan muncul setelah ditambahkan.</p>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($albums as $index => $album)
                <div class="border rounded-xl overflow-hidden shadow-sm hover:shadow-md transition bg-white flex flex-col justify-between group">
                    
                    <div class="relative overflow-hidden bg-gray-100 aspect-video border-b">
                        <span class="absolute top-2 left-2 bg-black/60 text-white text-xs px-2 py-1 rounded-md z-10 font-mono">
                            #{{ $index + 1 }}
                        </span>

                        @if($album->gambar)
                            <img src="{{ asset('storage/' . $album->gambar) }}" alt="{{ $album->nama_kegiatan }}" class="w-full h-full object-cover group-hover:scale-102 transition-transform duration-300">
                        @else
                            <div class="w-full h-full flex items-center justify-center bg-gray-50">
                                <i class="fas fa-image text-gray-300 text-4xl"></i>
                            </div>
                        @endif
                    </div>
                    
                    <div class="p-4 flex-1 flex flex-col justify-between">
                        <div>
                            <h4 class="font-bold text-gray-800 text-base mb-1 line-clamp-2 capitalize">
                                {{ $album->nama_kegiatan }}
                            </h4>
                            
                            <p class="text-xs text-gray-400 mb-3 flex items-center gap-1">
                                <i class="far fa-calendar-alt"></i>
                                {{ $album->tanggal ? \Carbon\Carbon::parse($album->tanggal)->format('d M Y') : '-' }}
                            </p>

                            @if(isset($album->deskripsi))
                                <p class="text-gray-600 text-sm line-clamp-2 mb-4 bg-gray-50 p-2 rounded-lg border border-gray-100">
                                    {{ $album->deskripsi }}
                                </p>
                            @else
                                <p class="text-gray-400 text-sm italic mb-4">Tidak ada deskripsi kegiatan.</p>
                            @endif
                        </div>

                        <div class="grid grid-cols-2 gap-2 border-t pt-3 mt-auto">
                            <button onclick="editAlbum({{ $album }})" class="w-full bg-amber-500 hover:bg-amber-600 text-white text-xs font-semibold py-2 px-3 rounded-lg transition flex items-center justify-center gap-1.5 shadow-sm">
                                <i class="fas fa-edit"></i> Edit
                            </button>
                            
                            <form action="{{ route('dokumentasi.album.destroy', $album->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kegiatan ini?')" class="w-full">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-full bg-red-500 hover:bg-red-600 text-white text-xs font-semibold py-2 px-3 rounded-lg transition flex items-center justify-center gap-1.5 shadow-sm">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            </form>
                        </div>
                    </div>

                </div>
            @endforeach
        </div>
    @endif
</div>

{{-- Modal Tambah --}}
<div id="modal-tambah" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <form action="{{ route('dokumentasi.album.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <h3 class="text-lg font-bold leading-6 text-gray-900 mb-4">Tambah Album Kegiatan Baru</h3>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Nama Kegiatan</label>
                            <input type="text" name="nama_kegiatan" required class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Tanggal Kegiatan</label>
                            <input type="date" name="tanggal" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Deskripsi</label>
                            <textarea name="deskripsi" rows="3" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"></textarea>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Gambar Cover</label>
                            <input type="file" name="gambar" accept="image/*" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse gap-2">
                    <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 sm:w-auto sm:text-sm">Simpan</button>
                    <button type="button" onclick="toggleModal('modal-tambah')" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 sm:mt-0 sm:w-auto sm:text-sm">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Modal Edit --}}
<div id="modal-edit" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <form id="form-edit" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <h3 class="text-lg font-bold leading-6 text-gray-900 mb-4">Edit Album Kegiatan</h3>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Nama Kegiatan</label>
                            <input type="text" name="nama_kegiatan" id="edit-nama-kegiatan" required class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Tanggal Kegiatan</label>
                            <input type="date" name="tanggal" id="edit-tanggal" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Deskripsi</label>
                            <textarea name="deskripsi" id="edit-deskripsi" rows="3" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"></textarea>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Gambar Cover (Kosongkan jika tidak diubah)</label>
                            <input type="file" name="gambar" accept="image/*" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse gap-2">
                    <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 sm:w-auto sm:text-sm">Update</button>
                    <button type="button" onclick="toggleModal('modal-edit')" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 sm:mt-0 sm:w-auto sm:text-sm">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function toggleModal(id) {
        const modal = document.getElementById(id);
        modal.classList.toggle('hidden');
    }

    function editAlbum(album) {
        document.getElementById('edit-nama-kegiatan').value = album.nama_kegiatan;
        document.getElementById('edit-tanggal').value = album.tanggal || '';
        document.getElementById('edit-deskripsi').value = album.deskripsi || '';
        
        const form = document.getElementById('form-edit');
        form.action = `/dokumentasi/album/${album.id}`;
        
        toggleModal('modal-edit');
    }
</script>
@endsection