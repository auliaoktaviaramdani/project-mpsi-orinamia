<?php

use App\Http\Controllers\AkunController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BahanBakuController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\SupplierController;
use Illuminate\Support\Facades\Route;

// ------------------------------------------------------------------
// Halaman Utama / Landing Page Perusahaan (PT Cahaya Binar Berlian - Orinamia)
// ------------------------------------------------------------------
Route::get('/', fn () => view('welcome'))->name('home');

// ------------------------------------------------------------------
// Autentikasi (Tanpa middleware auth)
// ------------------------------------------------------------------
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ------------------------------------------------------------------
// Area yang membutuhkan login (admin & owner)
// ------------------------------------------------------------------
Route::middleware('auth')->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // ---------------------------------------------------------------
    // Penjualan: index & show bisa dibaca semua user, aksi admin only
    // ---------------------------------------------------------------
    Route::get('/penjualan', [PenjualanController::class, 'index'])->name('penjualan.index');

    Route::middleware('role:admin')->group(function () {
        Route::get('/penjualan/create', [PenjualanController::class, 'create'])->name('penjualan.create');
        Route::post('/penjualan', [PenjualanController::class, 'store'])->name('penjualan.store');
        Route::patch('/penjualan/{penjualan}/terkirim', [PenjualanController::class, 'tandaiTerkirim'])->name('penjualan.terkirim');

        // Pembayaran invoice
        Route::post('/invoice/{invoice}/bayar', [PembayaranController::class, 'store'])->name('pembayaran.store');
    });

    Route::get('/penjualan/{penjualan}', [PenjualanController::class, 'show'])->name('penjualan.show');

    // Invoice cetak (semua user bisa cetak)
    Route::get('/invoice/{invoice}/cetak', [InvoiceController::class, 'cetak'])->name('invoice.cetak');

    // ---------------------------------------------------------------
    // Pembelian: index & show bisa dibaca semua, create admin only
    // ---------------------------------------------------------------
    Route::get('/pembelian', [PembelianController::class, 'index'])->name('pembelian.index');

    Route::middleware('role:admin')->group(function () {
        Route::get('/pembelian/create', [PembelianController::class, 'create'])->name('pembelian.create');
        Route::post('/pembelian', [PembelianController::class, 'store'])->name('pembelian.store');
    });

    Route::get('/pembelian/{pembelian}', [PembelianController::class, 'show'])->name('pembelian.show');
    Route::get('/pembelian/{pembelian}/cetak', [PembelianController::class, 'cetak'])->name('pembelian.cetak');

    // ---------------------------------------------------------------
    // Laporan: semua user
    // ---------------------------------------------------------------
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::get('/laporan/cetak', [LaporanController::class, 'show'])->name('laporan.show');

    // ---------------------------------------------------------------
    // Data Master: admin only
    // ---------------------------------------------------------------
    Route::middleware('role:admin')->group(function () {

        // Pelanggan
        Route::get('/master/pelanggan', [PelangganController::class, 'index'])->name('master.pelanggan.index');
        Route::get('/master/pelanggan/create', [PelangganController::class, 'create'])->name('master.pelanggan.create');
        Route::post('/master/pelanggan', [PelangganController::class, 'store'])->name('master.pelanggan.store');
        Route::get('/master/pelanggan/{pelanggan}/edit', [PelangganController::class, 'edit'])->name('master.pelanggan.edit');
        Route::put('/master/pelanggan/{pelanggan}', [PelangganController::class, 'update'])->name('master.pelanggan.update');
        Route::delete('/master/pelanggan/{pelanggan}', [PelangganController::class, 'destroy'])->name('master.pelanggan.destroy');
        Route::post('/master/pelanggan/quick', [PelangganController::class, 'quickStore'])->name('master.pelanggan.quick');

        // Supplier
        Route::get('/master/supplier', [SupplierController::class, 'index'])->name('master.supplier.index');
        Route::get('/master/supplier/create', [SupplierController::class, 'create'])->name('master.supplier.create');
        Route::post('/master/supplier', [SupplierController::class, 'store'])->name('master.supplier.store');
        Route::get('/master/supplier/{supplier}/edit', [SupplierController::class, 'edit'])->name('master.supplier.edit');
        Route::put('/master/supplier/{supplier}', [SupplierController::class, 'update'])->name('master.supplier.update');
        Route::delete('/master/supplier/{supplier}', [SupplierController::class, 'destroy'])->name('master.supplier.destroy');
        Route::post('/master/supplier/quick', [SupplierController::class, 'quickStore'])->name('master.supplier.quick');

        // Bahan Baku
        Route::get('/master/bahan', [BahanBakuController::class, 'index'])->name('master.bahan.index');
        Route::get('/master/bahan/create', [BahanBakuController::class, 'create'])->name('master.bahan.create');
        Route::post('/master/bahan', [BahanBakuController::class, 'store'])->name('master.bahan.store');
        Route::get('/master/bahan/{bahanBaku}/edit', [BahanBakuController::class, 'edit'])->name('master.bahan.edit');
        Route::put('/master/bahan/{bahanBaku}', [BahanBakuController::class, 'update'])->name('master.bahan.update');
        Route::delete('/master/bahan/{bahanBaku}', [BahanBakuController::class, 'destroy'])->name('master.bahan.destroy');

        // Manajemen Akun
        Route::get('/akun', [AkunController::class, 'index'])->name('akun.index');
        Route::get('/akun/create', [AkunController::class, 'create'])->name('akun.create');
        Route::post('/akun', [AkunController::class, 'store'])->name('akun.store');
        Route::get('/akun/{akun}/edit', [AkunController::class, 'edit'])->name('akun.edit');
        Route::put('/akun/{akun}', [AkunController::class, 'update'])->name('akun.update');
        Route::delete('/akun/{akun}', [AkunController::class, 'destroy'])->name('akun.destroy');
    });
});
