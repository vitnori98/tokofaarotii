@extends('layouts.app')

@section('title', 'Kelola Pegawai')

@section('content')
<div class="min-h-screen bg-gray-100 py-8">
    <div class="max-w-6xl mx-auto px-4">

        <!-- HEADER -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-xl font-bold text-gray-800">Data Pegawai</h1>

            <button onclick="openModal()"
                class="px-4 py-2 bg-indigo-600 text-white rounded-xl text-sm shadow hover:bg-indigo-700 transition">
                Tambah Pegawai
            </button>
        </div>

        <!-- TABLE -->
        <div class="bg-white rounded-xl shadow border overflow-hidden">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 text-gray-500 text-xs">
                    <tr>
                        <th class="px-4 py-3 text-left">No</th>
                        <th class="px-4 py-3 text-left">Nama</th>
                        <th class="px-4 py-3 text-left">Posisi</th>
                        <th class="px-4 py-3 text-center">Foto</th>
                        <th class="px-4 py-3 text-right">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($pegawais as $p)
                    <tr class="border-t">
                        <td class="px-4 py-3">{{ $loop->iteration }}</td>

                        <td class="px-4 py-3 font-medium">
                            {{ $p->nama }}
                        </td>

                        <td class="px-4 py-3">
                            {{ $p->posisi }}
                        </td>

                        <td class="px-4 py-3 text-center">
                            <img src="{{ $p->foto ? asset('storage/'.$p->foto) : 'https://ui-avatars.com/api/?name='.$p->nama }}"
                                 class="w-10 h-10 rounded-lg mx-auto object-cover">
                        </td>

                        <td class="px-4 py-3 text-right">
                            <div class="flex justify-end gap-2">

                                <!-- EDIT -->
                                <button onclick='openModal(@json($p))'
                                    class="px-3 py-1.5 text-xs bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700 transition">
                                    Edit
                                </button>

                                <!-- HAPUS -->
                                <form action="{{ route('pegawai.destroy', $p->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="px-3 py-1 text-xs bg-red-600 text-white rounded hover:bg-red-700">
                                        Hapus
                                    </button>
                                </form>

                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-6 text-gray-400">
                            Data kosong
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</div>

<!-- MODAL -->
<div id="pegawaiModal"
     class="fixed inset-0 hidden z-50 bg-black/40 flex items-center justify-center">

    <div class="bg-white w-full max-w-md rounded-xl shadow-lg">

        <!-- HEADER -->
        <div class="flex justify-between items-center px-5 py-3 border-b">
            <h2 id="modalTitle" class="text-lg font-semibold">
                Tambah Pegawai
            </h2>

            <button onclick="closeModal()">✕</button>
        </div>

        <!-- FORM -->
        <form id="pegawaiForm"
              method="POST"
              enctype="multipart/form-data"
              class="p-5 space-y-4">

            @csrf
            <input type="hidden" id="methodField" name="_method">

            <!-- FOTO -->
            <div class="flex flex-col items-center gap-2">
                <img id="preview"
                     src="https://ui-avatars.com/api/?name=User"
                     class="w-20 h-20 rounded-lg object-cover border">

                <input type="file" name="foto" onchange="previewImage(this)">
            </div>

            <!-- NAMA -->
            <input type="text" name="nama" id="nama"
                   placeholder="Nama"
                   class="w-full border rounded px-3 py-2 text-sm">

            <!-- POSISI -->
            <input type="text" name="posisi" id="posisi"
                   placeholder="Posisi"
                   class="w-full border rounded px-3 py-2 text-sm">

            <!-- BUTTON (TENGAH) -->
            <div class="flex justify-center gap-3 pt-3">

                <button type="button" onclick="closeModal()"
                        class="px-5 py-2 bg-gray-200 text-gray-700 rounded-lg text-sm hover:bg-gray-300 transition">
                    Batal
                </button>

                <button type="submit"
                        class="px-6 py-2 bg-indigo-600 text-white rounded-lg text-sm hover:bg-indigo-700 shadow transition">
                    Simpan
                </button>

            </div>

        </form>

    </div>
</div>
@endsection

@push('scripts')
<script>
function openModal(data = null) {
    const modal = document.getElementById('pegawaiModal');
    const form = document.getElementById('pegawaiForm');

    modal.classList.remove('hidden');

    if (data) {
        document.getElementById('modalTitle').innerText = "Edit Pegawai";

        form.action = `/pegawai/${data.id}`;
        document.getElementById('methodField').value = "PUT";

        document.getElementById('nama').value = data.nama;
        document.getElementById('posisi').value = data.posisi;

        document.getElementById('preview').src =
            data.foto
            ? `/storage/${data.foto}`
            : `https://ui-avatars.com/api/?name=${data.nama}`;

    } else {
        document.getElementById('modalTitle').innerText = "Tambah Pegawai";

        form.action = `/pegawai`;
        document.getElementById('methodField').value = "";

        form.reset();

        document.getElementById('preview').src =
            "https://ui-avatars.com/api/?name=User";
    }
}

function closeModal() {
    document.getElementById('pegawaiModal').classList.add('hidden');
}

function previewImage(input) {
    const preview = document.getElementById('preview');

    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => preview.src = e.target.result;
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endpush