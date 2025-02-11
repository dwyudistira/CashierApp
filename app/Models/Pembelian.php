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
    ];

    
    public function Pembelian(){
        return $this->belongsTo(Produk::class, "id" ,"productId");
    }
}
