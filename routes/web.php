<?php

use App\http\Controllers\HomeController;
use App\http\Controllers\CategoryController;
use App\http\Controllers\MenuController;
use App\http\Controllers\StokController;
use App\http\Controllers\ProdukController;
use App\http\Controllers\ProdukTitipanController;
use App\http\Controllers\UserController;
use App\http\Controllers\TransaksiController;
use App\http\Controllers\JenisController;
use App\http\Controllers\PelangganController;
use App\http\Controllers\PemesananController;
use App\Http\Controllers\MejaController;
use App\Http\Controllers\TentangController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\DetailTransaksiController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\DataController;
use App\Models\Contact;
use App\Models\DetailTransaksi;
use App\Models\Jenis;
use Illuminate\Database\Query\IndexHint;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpKernel\DataCollector\DataCollector;

//login
Route::get('/login', [UserController::class, 'index'])->name('login');
Route::post('/login/cek', [UserController::class, 'cekLogin'])->name('cekLogin');
Route::get('/logout', [UserController::class, 'logout'])->name('logout');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', [DataController::class, 'index'])->name('dashboard');
    Route::get('/filter-by-date', [DataController::class, 'filterByDate'])->name('filter-by-date');
    Route::get('/pendapatan-per-tanggal', [DataCollector::class])->name('dashboard.index');
    Route::get('/get-chart-data', [DataController::class, 'getDataChart']);
    // Route::get('/chart', [DataController::class, 'index'])->name('chart.index');



    Route::group(['middleware' => ['cekUserLogin:1']], function () {
        Route::resource('/contact', ContactController::class);

        // Export/Import

        //JENIS
        Route::get('export/jenis', [JenisController::class, 'exportData'])->name('export-jenis');
        Route::post('import/jenis', [JenisController::class, 'importData'])->name('import-jenis');
        Route::get('export/jenis/pdf', [JenisController::class, 'generatepdf'])->name('export-jenis-pdf');
        //CATEGORY
        Route::get('export/category', [CategoryController::class, 'exportData'])->name('export-category');
        Route::post('import/category', [CategoryController::class, 'importData'])->name('import-category');
        //TITIPAN
        Route::get('export/titipan', [ProdukTitipanController::class, 'exportData'])->name('export-titipan');
        Route::post('import/titipan', [ProdukTitipanController::class, 'importData'])->name('import-titipan');
        Route::get('/titipan/formulir-impor', [ProdukTitipanController::class, 'tampilkanFormImport'])->name('titipan.formulir-impor');
        //MENU
        Route::get('export/menu', [MenuController::class, 'exportData'])->name('export-menu');
        Route::post('import/menu', [MenuController::class, 'importData'])->name('import-menu');
        Route::get('export/menu/pdf', [MenuController::class, 'generatepdf'])->name('export-menu-pdf');
        //STOK
        Route::get('export/stok', [StokController::class, 'exportData'])->name('export-stok');
        Route::post('import/stok', [StokController::class, 'importData'])->name('import-stok');
        Route::get('export/stok/pdf', [StokController::class, 'generatepdf'])->name('export-stok-pdf');
        //MEJA
        Route::get('export/meja', [MejaController::class, 'exportData'])->name('export-meja');
        Route::post('import/meja', [MejaController::class, 'importData'])->name('import-meja');
        Route::get('export/meja/pdf', [MejaController::class, 'generatepdf'])->name('export-meja-pdf');
        //ABSENSI
        Route::get('export/absensi', [AbsensiController::class, 'exportData'])->name('export-absensi');
        Route::post('import/absensi', [AbsensiController::class, 'importData'])->name('import-absensi');
        Route::get('export/absensi/pdf', [AbsensiController::class, 'generatepdf'])->name('export-absensi-pdf');
        Route::get('unduhabsensi', [AbsensiController::class, 'unduhExport'])->name('unduhabsensi');


        //Admin
        Route::resource('/menu', MenuController::class);
        Route::resource('/stok', StokController::class);
        Route::resource('/category', CategoryController::class);
        Route::resource('/meja', MejaController::class);
        Route::resource('/jenis', JenisController::class);
        Route::get('tentang-aplikasi', [TentangController::class, 'index'])->name('tentang.index');
        Route::resource('produk_titipan', ProdukTitipanController::class);
        Route::resource('contact', ContactController::class);
        Route::resource('absensi', AbsensiController::class);
        Route::post('update-status', [AbsensiController::class, 'updateStatus']);
        Route::post('update-status', [MejaController::class, 'updateStatus']);
        Route::get('/grafik',);

        //Route::resource('/category', CategoryController::class);
    });
    //Kasir
    Route::group(['middleware' => ['cekUserLogin:2']], function () {
        Route::get('export/pelanggan', [PelangganController::class, 'exportData'])->name('export-pelanggan');
        Route::post('import/pelanggan', [PelangganController::class, 'importData'])->name('import-pelanggan');
        Route::get('export/pelanggan/pdf', [PelangganController::class, 'generatepdf'])->name('export-pelanggan-pdf');

        Route::resource('/pelanggan', PelangganController::class);
        Route::resource('/pemesanan', PemesananController::class);
        Route::resource('/transaksi', TransaksiController::class);
        Route::get('nota/{nofaktur}', [TransaksiController::class, 'faktur']);
        //Route::resource('/produk', ProdukController::class);
    });

    Route::group(['middleware' => ['cekUserLogin:3']], function () {
        //LAPORAN
        Route::resource('/laporan', DetailTransaksiController::class);
        Route::get('export/laporan', [LaporanController::class, 'exportData'])->name('export-laporan');
        Route::get('data/laporan', [DetailTransaksiController::class, 'CariData'])->name('data-laporan');
        Route::get('pdflaporan', [DetailTransaksiController::class, 'generatepdf'])->name('pdflaporan');
    });
});
