<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembelian extends Model
{
    protected $table = 'pembelian';

    protected $fillable = [
        'name',
        'no_telp',
        'point',
        'quantity',
    ];
    
    public function Pembelian(){
        return $this->belongsTo(Produk::class, "id" ,"productId");
    }
}
