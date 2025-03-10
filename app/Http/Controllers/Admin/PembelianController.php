<?php

namespace App\Http\Controllers\Admin;

use App\Exports\PembeliansExport;
use App\Http\Controllers\Controller;
use App\Models\Pembelian;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class PembelianController extends Controller
{
    public function index()
    {
        $purchases = Pembelian::paginate(10);
        return view("admin.pembelian.index", compact('purchases'));
    }

    public function create()
    {
        return view("admin.pembelian.create", compact('purchases'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'         => 'required|string|max:255',
            'phone_number' => 'required|numeric|digits_between:11,18',
            'points'       => 'required|integer|min:1',
            'quantity'     => 'required|integer|min:1',
            'product_id'   => 'nullable|integer|exists:product,id',
        ]);
        
        $data = Pembelian::create($validated);

        return redirect()->route('admin.pembelian')->with('success', 'Pembelian berhasil disimpan!');
    }

    public function edit($id){
        $purchases = Pembelian::find($id);

        return view('admin.pembelian.edit', compact('purchases'));
    }

    public function update(Request $request, $id){
        $purchases = Pembelian::find($id);

        $validate = $request->validate([
            'name' => 'required|string|max:255',
            'phone_number' => 'required|numeric|min:7',
            'product_id' => 'required|integer',
            'points' => 'required|integer',
            'quantity' => 'required|integer',
            'made_by' => 'required|string',
        ]);

        $purchases->update($validate);

        return redirect()->route('admin.pembelian');
    }

    public function destroy($id){
        $purchases = Pembelian::find($id);

        $purchases->delete();

        return redirect()->route('admin.pembelian');
    }

    public function export()
    {
        return Excel::download(new PembeliansExport, 'pembelian.xlsx');
    }
}