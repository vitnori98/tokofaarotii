<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'description', 'sku', 'price', 'unit', 'image', 'category_id'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function stockEntries()
    {
        return $this->hasMany(StockEntry::class);
    }

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }

    /**
     * Menghitung saldo stok asli secara otomatis
     * Logika: Total Barang Masuk - Total Barang Terjual
     */
    public function getTotalStokAttribute()
    {
        // Gunakan logika yang lebih aman agar tidak lambat saat data banyak
        $masuk = $this->stockEntries()->sum('quantity');
        $keluar = $this->sales()->sum('quantity_sold');

        return $masuk - $keluar;
    }
}