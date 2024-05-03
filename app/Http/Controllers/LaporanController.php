<?php

namespace App\Http\Controllers;

use App\Models\laporan;
use App\Http\Requests\StorelaporanRequest;
use App\Http\Requests\UpdatelaporanRequest;
use App\Models\DetailTransaksi;
use App\Exports\DetailTransaksiExport;
// use Maatwebsite\Excel\Excel;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

use Maatwebsite\Excel\Facades\Excel as FacadesExcel;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['title'] ='Detail Transaksi';
        $data['detail_transaksi'] = DetailTransaksi::all();
        return view('laporan.index')->with($data);
    }

    public function exportData(){
        $date = date('Y-m-d');
        return Excel::download(new DetailTransaksiExport, $date.'_laporan.xlsx');
    }

        public function generatePDF()
    {
    // Data untuk ditampilkan dalam PDF
        $data = DetailTransaksi::all();

        // // Render view ke HTML
        // $pdf = PDF::loadView('laporan/laporan-pdf', ['laporan'=>$data]);
        // $date = date('Y-m-d');
        // return $pdf->download($date.'-data-laporan.pdf');
    }

    public function cariData(Request $request)
{
    // Validasi data yang diterima dari permintaan
    $request->validate([
        'tanggalAwal' => 'required|date',
        'tanggalAkhir' => 'required|date'
    ]);

    // Ambil nilai tanggal awal dan tanggal akhir dari permintaan
    $tanggalAwal = $request->input('tanggalAwal');
    $tanggalAkhir = $request->input('tanggalAkhir');

    // Lakukan pencarian data berdasarkan rentang tanggal pada model DetailTransaksi
    $data = DetailTransaksi::whereBetween('tanggal', [$tanggalAwal, $tanggalAkhir])->get();

    // Kembalikan data ke frontend, misalnya dalam format JSON
    return response()->json($data);
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorelaporanRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(laporan $laporan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(laporan $laporan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatelaporanRequest $request, laporan $laporan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(laporan $laporan)
    {
        //
    }
}
