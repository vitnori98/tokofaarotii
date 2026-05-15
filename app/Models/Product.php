<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'description', 'sku', 'price', 'unit', 'image', 'category_id'];
   // protected $fillable = ['category_id', 'sku', 'name', 'description', 'price', 'image', 'unit'];

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
     * Menghitung saldo stok asli dari selisih Masuk - Keluar
     */
    public function getTotalStokAttribute()
    {
        $masuk = $this->relationLoaded('stockEntries') 
            ? $this->stockEntries->sum('quantity') 
            : $this->stockEntries()->sum('quantity');
            
        $keluar = $this->relationLoaded('sales') 
            ? $this->sales->sum('quantity_sold') 
            : $this->sales()->sum('quantity_sold');

        return $masuk - $keluar;
    }

}
