<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pembelian;
use Illuminate\Http\Request;
use Illuminate\Support\Js;

class PembelianController extends Controller
{
    public function index(){
        return view("admin.pembelian.index");
    }

    public function create(){
        return view("admin.pembelian.create");
    }

    public function store(Request $request){
        $validated = $request->validate([
            'name'      => 'required|string|max:25',
            'no_telp'   => 'required|integer|min:11|max:18',
            'point'     => 'required|integer',
            'quantity'  => 'required|integer',
        ]);

        $data = Pembelian::create($validated);

        return response()->json([
            'status' => 'Succsess',
            'message' => 'data anda berhasil di buat',
            'data' => $data, 
        ]);
    }
}

