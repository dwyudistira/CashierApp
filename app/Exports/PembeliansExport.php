<?php

namespace App\Exports;

use App\Models\Pembelian;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PembeliansExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Pembelian::all();
    }

    public function headings(): array
    {
        return ['Nama Pelanggan', 'No HP', 'Point Pelanggan','Produk'];
    }

    public function map($pembelian): array
    {
        return[
            $pembelian->name,
            $pembelian->phone_number,
            $pembelian->points,
            $pembelian->product_id,
        ];
    }
}
