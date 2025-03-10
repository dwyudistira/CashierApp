<?php

namespace App\Http\Controllers;

use App\Models\Pembelian;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function admin(){
        return view('admin.main');
    }
    
    public function petugas(){
        $totalPembelian = Pembelian::whereDate('created_at', today())
            ->sum('quantity');
    
        return view('petugas.main', compact('totalPembelian'));
    }
    

    public function getChartData()
    {
        $bulanIni = Carbon::now()->month;
        $tahunIni = Carbon::now()->year;
        
        $barData = Pembelian::whereMonth('created_at', $bulanIni)
            ->whereYear('created_at', $tahunIni)
            ->selectRaw('DAY(created_at) as day, SUM(quantity) as total')
            ->groupBy('day')
            ->pluck('total', 'day');
    
        $pieData = Pembelian::join('products', 'purchases.product_id', '=', 'products.id')
            ->selectRaw('products.name as product_name, SUM(purchases.quantity) as total')
            ->groupBy('products.name')
            ->get()
            ->map(function ($item) {
                return [
                    'name' => $item->product_name,
                    'value' => (int) $item->total 
                ];
            });
    
        return response()->json([
            'bar' => $barData,
            'pie' => $pieData
        ]);
    }
    
}
