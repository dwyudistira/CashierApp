<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $table = "products";

    protected $fillable = [
        'name',
        'price',
        'stock',
        'image',
    ];

    // Relasi ke Pembelian (Satu produk bisa memiliki banyak pembelian)
    public function pembelians()
    {
        return $this->hasMany(Pembelian::class, 'product_id', 'id');
    }
}

