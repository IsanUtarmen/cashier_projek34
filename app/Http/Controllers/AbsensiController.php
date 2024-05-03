<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Http\Requests\StoreAbsensiRequest;
use App\Http\Requests\UpdateAbsensiRequest;
use PDOException;
use Illuminate\Database\QueryException;
use Exception;
use App\Exports\AbsensiExport;
use App\Imports\AbsensiImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\FormatAbsensiExport;


class AbsensiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    try {
        $data['absensi'] = Absensi::get();
        return view('absensi.index')->with($data);
    } catch (QueryException | Exception | PDOException $error) {
        $this->failResponse($error->getMessage(), $error->getCode());
    }
}

public function generatePDF()
    {
        // Data untuk ditampilkan dalam PDF
        $data = Absensi::all();

        // Render view ke HTML
        $pdf = PDF::loadView('absensi/absensi-pdf', ['absensi' => $data]);
        $date = date('Y-m-d');
        return $pdf->download($date . '-data-absensi.pdf');
    }
public function exportData()
{
    // $date = date('Y-m-d');
    return Excel::download(new AbsensiExport,   'Absensi.xlsx');
}

public function importData()
    {

        Excel::import(new AbsensiImport, request()->file('import')); // Replace XLSX with the appropriate reader type
        return redirect('absensi')->with('success', 'Import data absen berhasil!');
    }

    public function unduhExport()
    {
        $date = date('Y-m-d');
        return Excel::download(new FormatAbsensiExport, $date . '_formatAbsensi.xlsx');
        // return (new UnduhExport())->dow('nama-file.xlsx');
    }


    public function store(StoreAbsensiRequest $request)
    {
        Absensi::create($request->all());

        return redirect('absensi')->with('success', 'Data produk berhasil di tambahkan!');

    }

    /**
     * Display the specified resource.
     */
    public function show(Absensi $absensi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Absensi $absensi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateStatus(Request $request)
    {
        $row_num = $request->input('row_num');
        $new_status = $request->input('new_status');

        // Temukan data absensi dengan nomor baris yang sesuai
        $absen = Absensi::find($row_num);

        // Jika data absensi tidak ditemukan, kembalikan respons dengan pesan error
        if (!$absen) {
            return response()->json(['error' => 'Data absensi tidak ditemukan', 'id' => $row_num], 404);
        }

        // Perbarui status absensi
        $absen->status = $new_status;
        $absen->save();

        return response ()->json(['message' => 'Status updated successfully']);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Absensi $absensi)
    {
        $absensi->delete();
        return redirect('absensi')->with('success', 'Data absensi berhasil dihapus!');
    }
}
