@extends('layouts.app')

@section('title', 'Data Berita')

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
            <h1 class="text-2xl font-bold text-gray-800">Data Berita</h1>

            <button onclick="openModal()"
                class="px-4 py-2 bg-indigo-600 text-white rounded-lg text-sm shadow hover:bg-indigo-700 transition font-medium">
                Tambah Berita
            </button>
        </div>

        <!-- TABLE -->
        <div class="bg-white rounded-lg shadow border overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-gray-50">
                        <tr class="border-b">
                            <th class="px-4 py-4 text-left font-semibold text-gray-700">NO</th>
                            <th class="px-4 py-4 text-left font-semibold text-gray-700">TANGGAL</th>
                            <th class="px-4 py-4 text-left font-semibold text-gray-700">JUDUL</th>
                            <th class="px-4 py-4 text-center font-semibold text-gray-700">GAMBAR</th>
                            <th class="px-4 py-4 text-left font-semibold text-gray-700">ISI</th>
                            <th class="px-4 py-4 text-center font-semibold text-gray-700">AKSI</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($beritas as $b)
                        <tr class="border-b hover:bg-gray-50 transition">
                            <td class="px-4 py-4 text-gray-700">{{ $loop->iteration }}</td>

                            <td class="px-4 py-4 text-gray-700 whitespace-nowrap">
                                {{ $b->created_at ? $b->created_at->format('d-m-Y') : '-' }}
                            </td>

                            <td class="px-4 py-4">
                                <div class="font-medium text-gray-800 max-w-xs">{{ $b->judul }}</div>
                            </td>

                            <td class="px-4 py-4 text-center">
                                <img src="{{ $b->gambar ? asset('storage/'.$b->gambar) : 'https://via.placeholder.com/80' }}"
                                     alt="Gambar Berita"
                                     class="w-16 h-12 rounded object-cover mx-auto">
                            </td>

                            <td class="px-4 py-4">
                                <div class="text-gray-600 max-w-sm line-clamp-2">
                                    {{ Str::limit(strip_tags($b->isi), 100) }}
                                </div>
                            </td>

                            <td class="px-4 py-4 text-center">
                                <div class="flex justify-center gap-2">

                                    <!-- DETAIL -->
                                    <button onclick='openDetail(@json($b))'
                                        class="px-3 py-1 bg-blue-600 text-white text-xs rounded font-medium hover:bg-blue-700 transition">
                                        Detail
                                    </button>

                                    <!-- EDIT -->
                                    <button onclick='openModal(@json($b))'
                                        class="px-3 py-1 bg-yellow-500 text-white text-xs rounded font-medium hover:bg-yellow-600 transition">
                                        Edit
                                    </button>

                                    <!-- HAPUS -->
                                    <form action="{{ route('berita.destroy', $b->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus?')">
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
                            <td colspan="6" class="text-center py-8 text-gray-400">
                                Data berita kosong
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
<div id="beritaModal"
     class="fixed inset-0 hidden z-50 bg-black/40 overflow-y-auto">

    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white w-full max-w-2xl rounded-lg shadow-lg relative">

            <!-- HEADER -->
            <div class="flex justify-between items-center px-6 py-4 border-b sticky top-0 bg-white rounded-t-lg z-10">
                <h2 id="modalTitle" class="text-lg font-bold text-gray-800">
                    Tambah Berita
                </h2>

                <button onclick="closeModal()" class="text-gray-500 hover:text-gray-700 text-2xl">✕</button>
            </div>

            <!-- FORM -->
            <form id="beritaForm"
                  method="POST"
                  enctype="multipart/form-data"
                  class="p-6 space-y-5">

                @csrf
                <input type="hidden" id="methodField" name="_method">

                <!-- UPLOAD GAMBAR -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-3">Upload Gambar</label>
                    <div class="flex flex-col items-center gap-4">
                        <img id="preview"
                             src="https://via.placeholder.com/150"
                             class="w-32 h-32 rounded-lg object-cover border-2 border-gray-200">

                        <input type="file" 
                               name="gambar" 
                               id="gambar"
                               accept="image/*"
                               onchange="previewImage(this)"
                               class="block w-full text-sm text-gray-500
                                 file:mr-4 file:py-2 file:px-4
                                 file:rounded-lg file:border-0
                                 file:text-sm file:font-semibold
                                 file:bg-blue-50 file:text-blue-700
                                 hover:file:bg-blue-100">
                    </div>
                </div>

                <!-- JUDUL -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Judul</label>
                    <input type="text" 
                           name="judul" 
                           id="judul"
                           placeholder="Judul Berita"
                           required
                           class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>

                <!-- ISI DENGAN TOOLBAR -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Isi Berita</label>
                    
                    <!-- TOOLBAR -->
                    <div class="bg-gray-50 border border-gray-300 rounded-t-lg p-2">
                        <!-- Baris 1: Heading & Basic Format -->
                        <div class="flex flex-wrap gap-1 mb-2 pb-2 border-b border-gray-200">
                            <select id="headingSelect" onchange="formatText('formatBlock', this.value); this.value='p'" class="toolbar-select text-sm border rounded px-2 py-1 bg-white">
                                <option value="p">Paragraph</option>
                                <option value="h1">H1</option>
                                <option value="h2">H2</option>
                                <option value="h3">H3</option>
                                <option value="h4">H4</option>
                            </select>

                            <div class="w-px h-6 bg-gray-300 mx-1"></div>

                            <button type="button" onclick="formatText('bold')" class="toolbar-btn font-bold" title="Bold">B</button>
                            <button type="button" onclick="formatText('italic')" class="toolbar-btn italic" title="Italic">I</button>
                            <button type="button" onclick="formatText('underline')" class="toolbar-btn underline" title="Underline">U</button>
                            <button type="button" onclick="formatText('strikeThrough')" class="toolbar-btn line-through" title="Strike">S</button>
                            
                            <div class="w-px h-6 bg-gray-300 mx-1"></div>

                            <button type="button" onclick="formatText('justifyLeft')" class="toolbar-btn" title="Align Left">⫷</button>
                            <button type="button" onclick="formatText('justifyCenter')" class="toolbar-btn" title="Align Center">⫸⫷</button>
                            <button type="button" onclick="formatText('justifyRight')" class="toolbar-btn" title="Align Right">⫸</button>
                            <button type="button" onclick="formatText('justifyFull')" class="toolbar-btn" title="Justify">≡</button>
                        </div>

                        <!-- Baris 2: List, Media & Tools -->
                        <div class="flex flex-wrap gap-1">
                            <button type="button" onclick="formatText('insertUnorderedList')" class="toolbar-btn" title="Bullet List">• List</button>
                            <button type="button" onclick="formatText('insertOrderedList')" class="toolbar-btn" title="Numbered List">1. List</button>
                            
                            <div class="w-px h-6 bg-gray-300 mx-1"></div>
                            
                            <button type="button" onclick="formatText('indent')" class="toolbar-btn" title="Indent">⇥</button>
                            <button type="button" onclick="formatText('outdent')" class="toolbar-btn" title="Outdent">⇤</button>

                            <div class="w-px h-6 bg-gray-300 mx-1"></div>

                            <button type="button" onclick="insertLink()" class="toolbar-btn text-blue-600" title="Link">🔗</button>
                            <button type="button" onclick="insertImageFromFile()" class="toolbar-btn text-green-600" title="Insert Image from Upload">📷</button>
                            <button type="button" onclick="insertTable()" class="toolbar-btn text-purple-600" title="Insert Table">📊 Table</button>
                            
                            <div class="w-px h-6 bg-gray-300 mx-1"></div>
                            
                            <button type="button" onclick="formatText('undo')" class="toolbar-btn" title="Undo">↶</button>
                            <button type="button" onclick="formatText('redo')" class="toolbar-btn" title="Redo">↷</button>
                        </div>
                    </div>

                    <!-- EDITOR AREA -->
                    <div id="isiEditor" contenteditable="true"
                         class="w-full border border-t-0 border-gray-300 p-4 min-h-[350px] focus:outline-none rounded-b-lg bg-white prose max-w-none"
                         style="line-height: 1.6; font-family: sans-serif;">
                        <p><br></p>
                    </div>

                    <textarea name="isi" id="isi" hidden></textarea>
                    <p class="text-xs text-gray-400 mt-2">* Gunakan toolbar untuk memformat isi berita. Pilih file di "Upload Gambar" lalu klik ikon kamera 📷 untuk menyisipkan ke isi.</p>
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

<!-- MODAL DETAIL -->
<div id="detailModal"
     class="fixed inset-0 hidden z-50 bg-black/40 overflow-y-auto">

    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white w-full max-w-2xl rounded-lg shadow-lg relative">

            <!-- HEADER -->
            <div class="flex justify-between items-center px-6 py-4 border-b sticky top-0 bg-white rounded-t-lg z-10">
                <h2 class="text-lg font-bold text-gray-800">Detail Berita</h2>
                <button onclick="closeDetail()" class="text-gray-500 hover:text-gray-700 text-2xl">✕</button>
            </div>

            <!-- CONTENT -->
            <div class="p-6 space-y-5">
                
                <!-- GAMBAR -->
                <div class="text-center">
                    <img id="detailGambar" src="" alt="Gambar" class="w-full h-64 rounded-lg object-cover mx-auto">
                </div>

                <!-- TANGGAL -->
                <div>
                    <h3 class="text-sm font-semibold text-gray-600 mb-1">Tanggal</h3>
                    <p id="detailTanggal" class="text-gray-800"></p>
                </div>

                <!-- JUDUL -->
                <div>
                    <h3 class="text-sm font-semibold text-gray-600 mb-1">Judul</h3>
                    <h2 id="detailJudul" class="text-xl font-bold text-gray-900"></h2>
                </div>

                <!-- ISI -->
                <div>
                    <h3 class="text-sm font-semibold text-gray-600 mb-2">Isi</h3>
                    <div id="detailIsi" class="text-gray-800 leading-relaxed prose prose-sm max-w-none"></div>
                </div>

                <!-- BUTTON -->
                <div class="flex justify-end gap-3 pt-4 border-t">
                    <button type="button" onclick="closeDetail()"
                            class="px-5 py-2 bg-gray-200 text-gray-700 rounded text-sm font-medium hover:bg-gray-300 transition">
                        Tutup
                    </button>
                </div>

            </div>
        </div>
    </div>
</div>

<style>
.toolbar-btn {
    padding: 0.5rem 0.75rem;
    background: white;
    border: 1px solid #d1d5db;
    border-radius: 0.375rem;
    font-size: 0.875rem;
    cursor: pointer;
    transition: all 0.2s;
    display: flex;
    align-items: center;
    justify-content: center;
    min-width: 2.5rem;
}

.toolbar-btn:hover {
    background-color: #f3f4f6;
    border-color: #9ca3af;
}

.toolbar-btn:active {
    background-color: #e5e7eb;
    border-color: #3b82f6;
}

#isiEditor {
    outline: none;
}

#isiEditor:focus {
    border-color: #3b82f6;
    ring: 2px;
    ring-color: #3b82f6;
}

/* CSS untuk Tabel di dalam Editor & Detail */
#isiEditor table, #detailIsi table {
    border-collapse: collapse;
    width: 100%;
    margin: 15px 0;
    border: 1px solid #ddd;
}

#isiEditor table td, #isiEditor table th, 
#detailIsi table td, #detailIsi table th {
    border: 1px solid #ddd;
    padding: 10px;
    min-width: 30px;
}

#isiEditor h1, #detailIsi h1 { font-size: 2em; font-weight: bold; margin-bottom: 0.5em; }
#isiEditor h2, #detailIsi h2 { font-size: 1.5em; font-weight: bold; margin-bottom: 0.5em; }
#isiEditor h3, #detailIsi h3 { font-size: 1.17em; font-weight: bold; margin-bottom: 0.5em; }
#isiEditor h4, #detailIsi h4 { font-size: 1em; font-weight: bold; margin-bottom: 0.5em; }

#isiEditor ul, #detailIsi ul { list-style-type: disc; margin-left: 1.5em; margin-bottom: 1em; }
#isiEditor ol, #detailIsi ol { list-style-type: decimal; margin-left: 1.5em; margin-bottom: 1em; }

#isiEditor img, #detailIsi img {
    max-width: 100%;
    height: auto;
    border-radius: 0.5rem;
    margin: 10px 0;
}
</style>

@endsection

@push('scripts')
<script>
let currentEditor = null;

function focusEditor() {
    if (currentEditor) {
        currentEditor.focus();
    }
}

function formatText(command, value = null) {
    focusEditor();
    document.execCommand(command, false, value);
    focusEditor();
}

function insertLink() {
    const url = prompt('Masukkan URL:', 'https://');
    if (url && url !== 'https://') {
        focusEditor();
        document.execCommand('createLink', false, url);
    }
}

function insertImageFromFile() {
    const fileInput = document.getElementById('gambar');
    
    if (!fileInput.files || !fileInput.files[0]) {
        alert('⚠️ Pilih file gambar terlebih dahulu pada input "Upload Gambar"!');
        return;
    }
    
    const file = fileInput.files[0];
    const reader = new FileReader();
    
    reader.onload = function(e) {
        focusEditor();
        const imgHtml = `<img src="${e.target.result}" alt="Inserted Image">`;
        document.execCommand('insertHTML', false, imgHtml);
    };
    
    reader.readAsDataURL(file);
}

function insertTable() {
    const rows = prompt("Jumlah Baris:", "3");
    const cols = prompt("Jumlah Kolom:", "3");
    
    if (!rows || !cols) return;
    
    let tableHtml = '<table border="1" style="width:100%; border-collapse:collapse;"><tbody>';
    for (let i = 0; i < parseInt(rows); i++) {
        tableHtml += '<tr>';
        for (let j = 0; j < parseInt(cols); j++) {
            tableHtml += '<td style="border:1px solid #ddd; padding:8px;">&nbsp;</td>';
        }
        tableHtml += '</tr>';
    }
    tableHtml += '</tbody></table><p><br></p>';
    
    focusEditor();
    document.execCommand('insertHTML', false, tableHtml);
}

function openModal(data = null) {
    const modal = document.getElementById('beritaModal');
    const form = document.getElementById('beritaForm');
    const editor = document.getElementById('isiEditor');

    currentEditor = editor;
    modal.classList.remove('hidden');
    document.body.classList.add('overflow-hidden'); // Kunci scroll latar belakang

    // Reset heading select
    const headingSelect = document.getElementById('headingSelect');
    if (headingSelect) headingSelect.value = 'p';

    const baseUrl = "{{ url('berita') }}";

    if (data) {
        document.getElementById('modalTitle').innerText = "Edit Berita";
        form.action = `${baseUrl}/${data.id}`;
        document.getElementById('methodField').value = "PUT";
        document.getElementById('judul').value = data.judul || '';
        editor.innerHTML = data.isi || '<p><br></p>';
        document.getElementById('preview').src = data.gambar ? `{{ asset('storage') }}/${data.gambar}` : `https://via.placeholder.com/150`;
    } else {
        document.getElementById('modalTitle').innerText = "Tambah Berita";
        form.action = baseUrl;
        document.getElementById('methodField').value = ""; // Kosongkan untuk POST murni
        document.getElementById('judul').value = '';
        editor.innerHTML = '<p><br></p>';
        document.getElementById('preview').src = "https://via.placeholder.com/150";
    }

    setTimeout(() => {
        editor.focus();
    }, 100);
}

function closeModal() {
    document.getElementById('beritaModal').classList.add('hidden');
    document.body.classList.remove('overflow-hidden'); // Lepas kunci scroll
    currentEditor = null;
}

function openDetail(data) {
    const modal = document.getElementById('detailModal');
    modal.classList.remove('hidden');
    document.body.classList.add('overflow-hidden'); // Kunci scroll latar belakang
    
    document.getElementById('detailTanggal').innerText = 
        data.created_at ? new Date(data.created_at).toLocaleDateString('id-ID', { year: 'numeric', month: 'long', day: 'numeric' }) : '-';
    
    document.getElementById('detailJudul').innerText = data.judul;
    document.getElementById('detailIsi').innerHTML = data.isi || '';
    
    const storageUrl = "{{ asset('storage') }}";
    document.getElementById('detailGambar').src = 
        data.gambar 
        ? `${storageUrl}/${data.gambar}` 
        : `https://via.placeholder.com/400x300`;
}

function closeDetail() {
    document.getElementById('detailModal').classList.add('hidden');
    document.body.classList.remove('overflow-hidden'); // Lepas kunci scroll
}

function previewImage(input) {
    const preview = document.getElementById('preview');

    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => preview.src = e.target.result;
        reader.readAsDataURL(input.files[0]);
    }
}

// Sync editor content ke textarea sebelum submit
document.getElementById('beritaForm').addEventListener('submit', function(e) {
    const judul = document.getElementById('judul').value.trim();
    const editor = document.getElementById('isiEditor');
    const isiContent = editor.innerHTML;

    if (!judul) {
        e.preventDefault();
        alert('❌ Judul berita tidak boleh kosong!');
        document.getElementById('judul').focus();
        return;
    }

    if (!isiContent.trim() || isiContent === '<br>') {
        e.preventDefault();
        alert('❌ Isi berita tidak boleh kosong!');
        editor.focus();
        return;
    }

    // Sync content ke textarea hidden
    document.getElementById('isi').value = isiContent;
});

// Close modal when clicking outside
document.getElementById('beritaModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeModal();
    }
});

document.getElementById('detailModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeDetail();
    }
});

// Set focus to editor when buttons are clicked
document.querySelectorAll('.toolbar-btn, .toolbar-select').forEach(btn => {
    btn.addEventListener('click', function() {
        if (currentEditor) {
            setTimeout(() => currentEditor.focus(), 50);
        }
    });
});
</script>
@endpush