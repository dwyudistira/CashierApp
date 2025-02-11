<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function admin(){
        return view('admin.main');
    }
    
    public function petugas(){
        return view('petugas.main');
    }
}
