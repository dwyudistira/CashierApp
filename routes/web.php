<?php

use App\Http\Controllers\Admin\PembelianController;
use App\Http\Controllers\Admin\ProdukController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Petugas\PembelianController as PetugasPembelianController;
use App\Http\Controllers\Petugas\ProdukController as PetugasProdukController;
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
    Route::get('/chart-data', [DashboardController::class, 'getChartData']);
    
    //pembelian
    Route::get('/pembelian', [PembelianController::class, "index"])->name("admin.pembelian");
    Route::get('/pembelian-create', [PembelianController::class, "create"])->name("admin.pembelian.create");
    Route::post('/pembelian-store', [PembelianController::class, "store"])->name("admin.pembelian.store");
    Route::get('/pembelian-edit', [PembelianController::class, "edit"])->name("admin.pembelian.edit");
    Route::put('/pembelian-update', [PembelianController::class, "update"])->name("admin.pembelian.update");
    Route::delete('/pembelian-destroy', [PembelianController::class, "destroy"])->name("admin.pembelian.destroy");
    Route::get('/export-pembelian', [PembelianController::class, 'export'])->name('admin.pembelian.export');
    
    //product
    Route::get('/product', [ProdukController::class, "index"])->name("admin.product");
    Route::get('/product-create', [ProdukController::class, "create"])->name("admin.product.create");
    Route::post('/product-store', [ProdukController::class, "store"])->name("admin.product.store");
    Route::get('/product-edit/{id}', [ProdukController::class, "edit"])->name("admin.product.edit");
    Route::put('/product-update/{id}', [ProdukController::class, "update"])->name("admin.product.update");
    Route::put('/product/updateStock', [ProdukController::class, 'updateStock'])->name('admin.product.updateStock');
    Route::delete('/product-destroy/{id}', [ProdukController::class, "destroy"])->name("admin.product.delete");
    
    //user
    Route::get('/user', [UserController::class, "index"])->name("admin.user");
    Route::get('/user-create', [UserController::class, "create"])->name("admin.user.create");
    Route::post('/user-store', [UserController::class, "store"])->name("admin.user.store");
    Route::get('/user-edit/{id}', [UserController::class, "edit"])->name("admin.user.edit");
    Route::put('/user-update/{id}', [UserController::class, "update"])->name("admin.user.update");
    Route::delete('/user-delete/{id}', [UserController::class, "destroy"])->name("admin.user.destroy");
});

Route::middleware(['auth', 'petugas'])->group(function () {   
    // dashboard 
    Route::get('/petugas/main', [DashboardController::class, "petugas"])->name("petugas.main");
    
    //pembelian
    Route::get('/petugas/pembelian', [PetugasPembelianController::class, "index"])->name("petugas.pembelian");
    Route::get('/petugas/pembelian/create', [PetugasPembelianController::class, "create"])->name("petugas.pembelian.create");
    Route::get('/petugas/pembelian/detail-create', [PetugasPembelianController::class, "detail"])->name("petugas.pembelian.detail");
    Route::get('/petugas/pembelian', [PetugasPembelianController::class, "index"])->name("petugas.pembelian");
    
    //product
    Route::get('/petugas/product', [PetugasProdukController::class, "index"])->name("petugas.product");

});


require __DIR__.'/auth.php';
