<?php

use App\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SlotController;
use App\Http\Controllers\PICController;
use Illuminate\Support\Facades\Storage;

// Route Customer
Route::get('/', [CustomerController::class, 'index'])->name('landing.page');
Route::get('/paket', [CustomerController::class, 'paket'])->name('customer.paket');
Route::get('/booking/{id_paket}', [CustomerController::class, 'showBookingForm'])->name('customer.booking');
Route::post('/booking/submit', [CustomerController::class, 'submitBooking'])->name('customer.booking.submit');
// Route untuk receipt
Route::get('/receipt/{id}', [CustomerController::class, 'showReceipt'])->name('customer.receipt');
// Tambahkan route untuk cek tiket
Route::get('/cek-tiket', [CustomerController::class, 'showCekTiket'])->name('customer.cektiket');
Route::post('/cek-tiket', [CustomerController::class, 'prosesCekTiket'])->name('customer.cektiket.proses');


// Auth Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin Routes
Route::middleware(['admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // Routes untuk kelola paket
    Route::get('/admin/kelola-paket', [AdminController::class, 'kelolaPaket'])->name('admin.kelola.paket');
    Route::post('/admin/paket/simpan', [AdminController::class, 'simpanPaket'])->name('admin.paket.simpan');
    Route::post('/admin/paket/{id}/update', [AdminController::class, 'updatePaket'])->name('admin.paket.update');
    Route::delete('/admin/paket/{id}/hapus', [AdminController::class, 'hapusPaket'])->name('admin.paket.hapus');
    Route::get('/admin/paket/{id}/get', [AdminController::class, 'getPaket'])->name('admin.paket.get');

    // Routes untuk kelola addons
    Route::get('/admin/kelola-addons', [AdminController::class, 'kelolaAddons'])->name('admin.kelola.addons');
    Route::post('/admin/addons/simpan', [AdminController::class, 'simpanAddon'])->name('admin.addon.simpan');
    Route::post('/admin/addons/{id}/update', [AdminController::class, 'updateAddon'])->name('admin.addon.update');
    Route::delete('/admin/addons/{id}/hapus', [AdminController::class, 'hapusAddon'])->name('admin.addon.hapus');
    Route::get('/admin/addons/{id}/get', [AdminController::class, 'getAddon'])->name('admin.addon.get');

    // Routes untuk kelola pesanan
    Route::get('/admin/kelola-pesanan', [AdminController::class, 'kelolaPesanan'])->name('admin.kelola.pesanan');
    Route::get('/admin/pesanan/{id}/detail', [AdminController::class, 'getDetailPesanan'])->name('admin.pesanan.detail');
    Route::patch('/admin/pesanan/{id}/update-status', [AdminController::class, 'updateStatusPesanan'])->name('admin.pesanan.update-status');

    // Routes untuk kelola libur
    Route::get('/admin/kelola-libur', [AdminController::class, 'kelolaLibur'])->name('admin.kelola.libur');
    Route::post('/admin/libur/simpan', [AdminController::class, 'simpanLibur'])->name('admin.libur.simpan');
    Route::post('/admin/libur/{id}/update', [AdminController::class, 'updateLibur'])->name('admin.libur.update');
    Route::delete('/admin/libur/{id}/hapus', [AdminController::class, 'hapusLibur'])->name('admin.libur.hapus');
    Route::get('/admin/libur/{id}/get', [AdminController::class, 'getLibur'])->name('admin.libur.get');
});

// PIC Routes
Route::middleware(['pic'])->group(function () {
    Route::get('/pic/dashboard', [PICController::class, 'dashboard'])->name('pic.dashboard');
    // Route PIC lainnya akan ditambahkan di sini
});


// Debug routes
Route::get('/debug/storage-test', function () {
    $results = [];

    // Test paths
    $results['storage_path'] = storage_path('app/public/paket_images');
    $results['public_path'] = public_path('storage/paket_images');

    // Test directory existence and permissions
    $results['storage_dir_exists'] = is_dir($results['storage_path']);
    $results['public_dir_exists'] = is_dir($results['public_path']);
    $results['storage_dir_writable'] = is_writable($results['storage_path']);
    $results['public_dir_writable'] = is_writable($results['public_path']);

    // Test creating a file
    $testFile = 'test_' . time() . '.txt';
    $testContent = 'Hello World ' . date('Y-m-d H:i:s');

    try {
        // Try storage
        $storageTest = Storage::disk('public')->put('paket_images/' . $testFile, $testContent);
        $results['storage_write_test'] = $storageTest;
        $results['storage_file_exists'] = Storage::disk('public')->exists('paket_images/' . $testFile);

        // Try direct file_put_contents
        $directTest = file_put_contents($results['public_path'] . '/' . $testFile, $testContent);
        $results['direct_write_test'] = ($directTest !== false);
        $results['direct_file_exists'] = file_exists($results['public_path'] . '/' . $testFile);
    } catch (\Exception $e) {
        $results['error'] = $e->getMessage();
    }

    // List files in directories
    if ($results['storage_dir_exists']) {
        $results['storage_files'] = scandir($results['storage_path']);
    }
    if ($results['public_dir_exists']) {
        $results['public_files'] = scandir($results['public_path']);
    }

    return response()->json($results);
});

// Route untuk testimoni customer
Route::post('/testimonial/store', [CustomerController::class, 'storeTestimonial'])->name('testimonial.store');

// Route untuk testimoni admin
Route::middleware(['admin'])->group(function () {
    // ... route admin lainnya ...
    Route::get('/admin/kelola-testimoni', [AdminController::class, 'kelolaTestimoni'])->name('admin.kelola.testimoni');
    Route::delete('/admin/testimoni/{id}/hapus', [AdminController::class, 'hapusTestimoni'])->name('admin.testimoni.hapus');
});
