<?php

use App\Http\Controllers\Admin\PembelianController;
use App\Http\Controllers\Admin\ProdukController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'admin'])->group(function () {   
    // dashboard 
    Route::get('/admin/main', [DashboardController::class, "admin"])->name("main");
    
    //pembelian
    Route::get('/pembelian', [PembelianController::class, "index"])->name("admin.pembelian");
    Route::get('/pembelian-create', [PembelianController::class, "create"])->name("admin.pembelian.create");
    Route::post('/pembelian-store', [PembelianController::class, "store"])->name("admin.pembelian.store");
    
    //product
    Route::get('/product', [ProdukController::class, "index"])->name("admin.product");
    Route::get('/product-create', [ProdukController::class, "create"])->name("admin.product.create");
    Route::post('/product-store', [ProdukController::class, "store"])->name("admin.product.store");
    Route::get('/product-edit/{id}', [ProdukController::class, "edit"])->name("admin.product.edit");
    Route::put('/product-update/{id}', [ProdukController::class, "update"])->name("admin.product.update");
    Route::put('/product/updateStock', [ProdukController::class, 'updateStock'])->name('admin.product.updateStock');
    Route::delete('/product-destroy/{id}', [ProdukController::class, "destroy"])->name("admin.product.delete");
    
    //user
});

Route::middleware(['auth', 'petugas'])->group(function () {   
    // dashboard 
    Route::get('/petugas/main', [DashboardController::class, "petugas"])->name("petugas.main");

    //pembelian

    //product

});


require __DIR__.'/auth.php';
