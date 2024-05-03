<?php

namespace App\Http\Controllers;

use App\Models\Meja;
use App\Http\Requests\StoreMejaRequest;
use App\Http\Requests\UpdateMejaRequest;
use Exception;
use PDOException;
use App\Exports\MejaExport;
use App\Imports\MejaImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Termwind\Components\Dd;

class MejaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['meja'] = Meja::get();
        return view('meja.index')->with($data);
    }

    public function exportData()
    {
        // $date = date('Y-m-d');
        return Excel::download(new MejaExport,   '_meja.xlsx');
    }

    public function importData()
    {

        Excel::import(new MejaImport, request()->file('import')); // Replace XLSX with the appropriate reader type
        return redirect('meja')->with('success', 'Import data paket berhasil!');
    }

    public function updateStatus(Request $request)
    {
        $row_num = $request->input('row_num');
        $new_status = $request->input('new_status');

        // Temukan data absensi dengan nomor baris yang sesuai
        $Meja = Meja::find($row_num);

        // Jika data absensi tidak ditemukan, kembalikan respons dengan pesan error
        if (!$Meja) {
            return response()->json(['error' => 'Data Meja tidak ditemukan', 'id' => $row_num], 404);
        }

        // Perbarui status absensi
        $Meja->status = $new_status;
        $Meja->save();

        return response ()->json(['message' => 'Status updated successfully']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMejaRequest $request)
    {
        Meja::create($request->all());
        return redirect('meja')->with('success', 'Data meja berhasil ditambahkan!');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMejaRequest $request, $id)

    {
        $Meja = Meja::find($id)->update($request->all());
        return redirect('meja')->with('success', 'Update data berhasil');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Meja $meja)
    {
        $meja->delete();
        return redirect('meja')->with('success', 'Data meja berhasil dihapus!');
    }
}
