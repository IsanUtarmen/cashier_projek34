<?php

namespace App\Http\Controllers;

use App\Models\produk_titipan;
use App\Http\Requests\Storeproduk_titipanRequest;
use App\Http\Requests\Updateproduk_titipanRequest;
use App\Models\ProdukTitipan;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Database\QueryException;
use PDOException;
use App\Exports\TitipanExport;
use App\Imports\TitipanImport;
use Maatwebsite\Excel\Excel;
// use Illuminate\Support\Facades\Request;
use Illuminate\Http\Request;



class ProdukTitipanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produk_titipan = Produk_Titipan::all();
        return view('titipan.index', compact('produk_titipan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Storeproduk_titipanRequest $request)
    { {
            DB::beginTransaction();
            produk_titipan::create($request->all());
            DB::commit();
            return redirect('produk_titipan')->with('success', 'Data Produk berhasil ditambahkan!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(produk_titipan $produk_titipan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(produk_titipan $produk_titipan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Storeproduk_titipanRequest $request, produk_titipan $produk_titipan)
    {
        DB::beginTransaction();
        $produk_titipan->update($request->all());
        DB::commit();
        return redirect('produk_titipan')->with('success', 'Update data berhasil');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(produk_titipan $produk_titipan)
    {
        $produk_titipan->delete();
        return redirect('produk_titipan')->with('success', 'Data Titipan berhasil dihapus!');
    }

    public function exportData()
    {
        $date = date('Y-m-d');

        // Instantiate Excel class
        $excel = app()->make(Excel::class);

        // Use the instantiated object to call the download method
        return $excel->download(new TitipanExport, $date . '_produk_titipan.xlsx');
    }

    // app/Http/Controllers/ProdukTitipanController.php


    public function importData(Request $request)
    {
        try {
            $file = $request->file('file');

            \Maatwebsite\Excel\Facades\Excel::import(new TitipanImport, $file);

            return redirect('produk_titipan')->with('success', 'Data berhasil diimpor!');
        } catch (\Exception $e) {
            return redirect('produk_titipan')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
