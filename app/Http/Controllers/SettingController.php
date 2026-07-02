<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    /**
     * Menampilkan halaman pengaturan toko
     */
    public function index()
    {
        // Mengambil data baris pertama dari tabel settings
        $settings = DB::table('settings')->first();

        return view('settings.index', compact('settings'));
    }

    /**
     * Memproses penyimpanan / update data pengaturan toko
     */
    public function update(Request $request)
    {
        // 1. Validasi Input Form
        $request->validate([
            'store_name' => 'required|string|max:255',
            'store_whatsapp' => 'nullable|string|max:20',
            'store_email' => 'nullable|email|max:255',
            'store_address' => 'nullable|string',
            'store_tagline' => 'nullable|string|max:255',
            'store_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'footer_text' => 'nullable|string|max:255',
            'maintenance_mode' => 'required|in:0,1',
        ]);

        // 2. Ambil data lama jika sudah pernah ada
        $currentSetting = DB::table('settings')->first();
        
        $data = [
            'store_name' => $request->store_name,
            'store_whatsapp' => $request->store_whatsapp,
            'store_email' => $request->store_email,
            'store_address' => $request->store_address,
            'store_tagline' => $request->store_tagline,
            'footer_text' => $request->footer_text,
            'maintenance_mode' => $request->maintenance_mode,
            'updated_at' => now(),
        ];

        // 3. Logika Upload Gambar Logo Toko
        if ($request->hasFile('store_logo')) {
            // Hapus logo lama jika ada untuk menghemat penyimpanan server
            if ($currentSetting && $currentSetting->store_logo) {
                Storage::disk('public')->delete($currentSetting->store_logo);
            }
            
            // Simpan logo baru ke dalam folder 'storage/app/public/logos'
            $data['store_logo'] = $request->file('store_logo')->store('logos', 'public');
        }

        // 4. Proses Simpan (Jika kosong maka Insert, jika sudah ada maka Update)
        if ($currentSetting) {
            DB::table('settings')->where('id', $currentSetting->id)->update($data);
        } else {
            $data['created_at'] = now();
            DB::table('settings')->insert($data);
        }

        return redirect()->back()->with('success', 'Pengaturan sistem berhasil diperbarui!');
    }
}