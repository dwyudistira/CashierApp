<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pembelian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PembelianController extends Controller
{
    public function index()
    {
        $data = Pembelian::all();
        return view("admin.pembelian.index", compact('data'));
    }

    public function create()
    {
            // Dummy data jika database belum ada
            $products = [
                ['id' => 1, 'name' => 'Botol Minum', 'stock' => 8961, 'price' => 100000, 'image' => 'https://via.placeholder.com/150'],
                ['id' => 2, 'name' => 'Buku', 'stock' => 0, 'price' => 1000000, 'image' => 'https://via.placeholder.com/150'],
                ['id' => 3, 'name' => 'Gizi Seimbang', 'stock' => 0, 'price' => 30000, 'image' => 'https://via.placeholder.com/150']
            ];    
        return view("admin.pembelian.create", compact('products'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'         => 'required|string|max:255',
            'phone_number' => 'required|numeric|digits_between:11,18',
            'points'       => 'required|integer|min:1',
            'quantity'     => 'required|integer|min:1',
            'product_id'   => 'nullable|integer|exists:products,id',
        ]);
        
        $data = Pembelian::create($validated);

        return redirect()->route('admin.pembelian')->with('success', 'Pembelian berhasil disimpan!');

    }
}