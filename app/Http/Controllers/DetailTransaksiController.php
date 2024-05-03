<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\DetailTransaksi;
use App\Http\Requests\StoreDetailTransaksiRequest;
use App\Http\Requests\UpdateDetailTransaksiRequest;
use Illuminate\Http\Request;
use App\Exports\DetailTransaksiExport;
// use Maatwebsite\Excel\Excel;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Database\QueryException;
use Exception;
use PDOException;
// use App\Http\Controllers\Transaksi;



class DetailTransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $data['transaksi'] = Transaksi::with(['detailTransaksi'])->get();
        return view('laporan.index')->with($data); // Menggunakan $data sebagai parameter
    }



    public function exportData()
    {
        $date = date('Y-m-d');
        return Excel::download(new DetailTransaksiExport, $date . '_laporan.xlsx');
    }

    public function generatePDF()
    {
        // Data untuk ditampilkan dalam PDF
        $data = Transaksi::all();

        // Render view ke HTML
        $pdf = PDF::loadView('laporan/laporan-pdf', ['transaksi'=>$data]);
        $date = date('Y-m-d');
        return $pdf->download($date.'-data-laporan.pdf');
    }



    public function filter(Request $request)
    {
        $tgl_awal = $request->input('tgl_awal');
        $tgl_akhir = $request->input('tgl_akhir');

        $laporan = Transaksi::whereBetween('tanggal', [$tgl_awal, $tgl_akhir])->get();

        return view('laporan.index', [
            'laporan' => $laporan,
            'page' => 'Laporan Penjualan',
            'section' => 'Laporan'
        ]);
    }

    public function histori()
    {
        $data['detail_transaksi'] = DB::table('detail_transaksi')
            ->join('jenis', 'detail_transaksi.jenis_id', '=', 'jenis.id')
            ->select('detail_transaksi.*', 'jenis.nama_jenis') // Menghapus jenis.nama_jenis kedua
            ->get();

        return view('laporan.index')->with($data);
    }


    // public function cariData(Request $request)
    // {
    //     // Validasi data yang diterima dari permintaan
    //     $request->validate([
    //         'tanggalAwal' => 'required|date',
    //         'tanggalAkhir' => 'required|date'
    //     ]);

    //     // Ambil nilai tanggal awal dan tanggal akhir dari permintaan
    //     $tanggalAwal = $request->input('tanggalAwal');
    //     $tanggalAkhir = $request->input('tanggalAkhir');

    //     // Lakukan pencarian data berdasarkan rentang tanggal pada model DetailTransaksi
    //     $data = DetailTransaksi::whereBetween('tanggal', [$tanggalAwal, $tanggalAkhir])->get();

    //     // Kembalikan data ke frontend, misalnya dalam format JSON
    //     return response()->json($data);
    // }

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
    public function store(StoreDetailTransaksiRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(DetailTransaksi $detailTransaksi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DetailTransaksi $detailTransaksi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDetailTransaksiRequest $request, DetailTransaksi $detailTransaksi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DetailTransaksi $detailTransaksi)
    {
        //
    }
}
