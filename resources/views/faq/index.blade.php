@extends('layouts.app')

@section('title', 'Kelola FAQ')

@section('content')
<div class="min-h-screen bg-gray-100 py-8">
    <div class="max-w-7xl mx-auto px-4">

        @if(session('success'))
        <div class="mb-6 p-4 bg-green-500 text-white rounded-lg shadow-sm flex justify-between items-center">
            <span>{{ session('success') }}</span>
            <button onclick="this.parentElement.remove()" class="text-white font-bold">&times;</button>
        </div>
        @endif

        @if($errors->any())
        <div class="mb-6 p-4 bg-red-500 text-white rounded-lg shadow-sm">
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <!-- HEADER -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Daftar FAQ</h1>

            <button onclick="openModal()"
                class="px-4 py-2 bg-indigo-600 text-white rounded-lg text-sm shadow hover:bg-indigo-700 transition font-medium">
                Tambah FAQ
            </button>
        </div>

        <!-- TABLE -->
        <div class="bg-white rounded-lg shadow border overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-gray-50">
                        <tr class="border-b">
                            <th class="px-4 py-4 text-left font-semibold text-gray-700 w-16">NO</th>
                            <th class="px-4 py-4 text-left font-semibold text-gray-700 w-1/3">PERTANYAAN</th>
                            <th class="px-4 py-4 text-left font-semibold text-gray-700">JAWABAN</th>
                            <th class="px-4 py-4 text-center font-semibold text-gray-700 w-32">AKSI</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($faqs as $f)
                        <tr class="border-b hover:bg-gray-50 transition">
                            <td class="px-4 py-4 text-gray-700">{{ $loop->iteration }}</td>

                            <td class="px-4 py-4 font-medium text-gray-800">
                                {{ $f->pertanyaan }}
                            </td>

                            <td class="px-4 py-4 text-gray-600">
                                <div class="line-clamp-3">{{ $f->jawaban }}</div>
                            </td>

                            <td class="px-4 py-4 text-center">
                                <div class="flex justify-center gap-2">
                                    <!-- EDIT -->
                                    <button onclick='openModal(@json($f))'
                                        class="px-3 py-1 bg-yellow-500 text-white text-xs rounded font-medium hover:bg-yellow-600 transition">
                                        Edit
                                    </button>

                                    <!-- HAPUS -->
                                    <form action="{{ route('faq.destroy', $f->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-3 py-1 bg-red-600 text-white text-xs rounded font-medium hover:bg-red-700 transition">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center py-8 text-gray-400">
                                Data FAQ kosong
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

<!-- MODAL TAMBAH/EDIT -->
<div id="faqModal"
     class="fixed inset-0 hidden z-50 bg-black/40 overflow-y-auto">

    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white w-full max-w-lg rounded-lg shadow-lg relative">

            <!-- HEADER -->
            <div class="flex justify-between items-center px-6 py-4 border-b sticky top-0 bg-white rounded-t-lg z-10">
                <h2 id="modalTitle" class="text-lg font-bold text-gray-800">
                    Tambah FAQ
                </h2>

                <button onclick="closeModal()" class="text-gray-500 hover:text-gray-700 text-2xl">✕</button>
            </div>

            <!-- FORM -->
            <form id="faqForm"
                  method="POST"
                  class="p-6 space-y-5">

                @csrf
                <input type="hidden" id="methodField" name="_method">

                <!-- PERTANYAAN -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Pertanyaan</label>
                    <textarea name="pertanyaan" 
                              id="pertanyaan"
                              rows="3"
                              required
                              placeholder="Masukkan pertanyaan..."
                              class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"></textarea>
                </div>

                <!-- JAWABAN -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Jawaban</label>
                    <textarea name="jawaban" 
                              id="jawaban"
                              rows="5"
                              required
                              placeholder="Masukkan jawaban..."
                              class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"></textarea>
                </div>

                <!-- BUTTON -->
                <div class="flex justify-end gap-3 pt-4 border-t">
                    <button type="button" onclick="closeModal()"
                            class="px-5 py-2 bg-gray-200 text-gray-700 rounded text-sm font-medium hover:bg-gray-300 transition">
                        Batal
                    </button>

                    <button type="submit"
                            class="px-6 py-2 bg-blue-600 text-white rounded text-sm font-medium hover:bg-blue-700 transition">
                        Simpan
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
function openModal(data = null) {
    const modal = document.getElementById('faqModal');
    const form = document.getElementById('faqForm');
    const modalTitle = document.getElementById('modalTitle');
    const methodField = document.getElementById('methodField');
    const pertanyaan = document.getElementById('pertanyaan');
    const jawaban = document.getElementById('jawaban');

    modal.classList.remove('hidden');
    document.body.classList.add('overflow-hidden');

    if (data) {
        modalTitle.innerText = "Edit FAQ";
        form.action = `{{ url('faq') }}/${data.id}`;
        methodField.value = "PUT";
        pertanyaan.value = data.pertanyaan;
        jawaban.value = data.jawaban;
    } else {
        modalTitle.innerText = "Tambah FAQ";
        form.action = `{{ route('faq.store') }}`;
        methodField.value = "";
        pertanyaan.value = "";
        jawaban.value = "";
    }
}

function closeModal() {
    document.getElementById('faqModal').classList.add('hidden');
    document.body.classList.remove('overflow-hidden');
}

// Close modal when clicking outside
document.getElementById('faqModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeModal();
    }
});

// ESC key to close
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeModal();
    }
});
</script>
@endpush
