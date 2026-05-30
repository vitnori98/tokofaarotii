<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Album;
use App\Models\Infografis;
use App\Models\Video;

class DokumentasiController extends Controller
{
    public function album()
    {
        $albums = Album::latest()->get();
        return view('dokumentasi.album', compact('albums'));
    }

    public function storeAlbum(Request $request)
    {
        $data = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'tanggal' => 'nullable|date',
        ]);

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('album', 'public');
        }

        Album::create($data);

        return back()->with('success', 'Album berhasil ditambahkan!');
    }

    public function updateAlbum(Request $request, Album $album)
    {
        $data = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'tanggal' => 'nullable|date',
        ]);

        if ($request->hasFile('gambar')) {
            // Logic for deleting old image could be added here
            $data['gambar'] = $request->file('gambar')->store('album', 'public');
        }

        $album->update($data);

        return back()->with('success', 'Album berhasil diperbarui!');
    }

    public function destroyAlbum(Album $album)
    {
        $album->delete();
        return back()->with('success', 'Album berhasil dihapus!');
    }

    public function infografis()
    {
        $infografis = Infografis::latest()->get();
        return view('dokumentasi.infografis', compact('infografis'));
    }

    public function video()
    {
        $videos = Video::latest()->get();
        return view('dokumentasi.video', compact('videos'));
    }

    // CRUD methods could be added here later if needed
}
