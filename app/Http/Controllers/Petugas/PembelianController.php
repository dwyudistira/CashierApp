<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Produk;

class PembelianController extends Controller
{
    public function index(){
        $products = Produk::all();

        return view("petugas.pembelian.index", compact('products'));
    }

    public function create(){
        return view("petugas.pembelian.create");
    }

    public function store(){

    }

    public function detail(){
        return view('petugas.pembelian.detail_pembelian');
    }

    public function exportExcel(){

    }
}
