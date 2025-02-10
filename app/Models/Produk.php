<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    //
    protected $table = "produk";

    protected $fillable =[
        'name',
        'price',
        'stock',
        'image',
    ];

    public function Pembelian(){
        return $this->hasMany(Produk::class, "id" ,"productId");
    }
}
