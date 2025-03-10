<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembelian extends Model
{
    protected $table = 'purchases';

    protected $fillable = [
        'name', 
        'phone_number', 
        'points', 
        'quantity',
        'made_by',
        'product_id', // Tambahkan kolom foreign key ke product
    ];

    // Relasi ke Produk (Setiap pembelian memiliki satu produk)
    public function produk()
    {
        return $this->belongsTo(Produk::class, 'product_id', 'id');
    }
}
