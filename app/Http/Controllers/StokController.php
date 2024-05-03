<?php

namespace App\Http\Controllers;

use App\Models\Stok;
use App\Models\Menu;
use App\Http\Requests\StoreStokRequest;
use App\Http\Requests\UpdateStokRequest;
use Illuminate\Database\QueryException;
use Exception;
use PDOException;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\StokExport;
use App\Imports\StokImport;
use Barryvdh\DomPDF\Facade\Pdf;

use Illuminate\Support\Facades\DB;


class StokController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $data['menu'] = Menu::get();
            $data['stok'] = Stok::with(['menu'])->get();
            return view('stok.index')->with($data);
        } catch (QueryException | Exception | PDOException $error) {
            $this->failResponse($error->getMessage(), $error->getCode());
        }
    }
    public function exportData()
    {
        $date = date('Y-m-d');
        return Excel::download(new StokExport, $date . '_stok.xlsx');
    }

    public function importData()
    {
        Excel::import(new StokImport, request()->file('import')); // Replace XLSX with the appropriate reader type
        return redirect('stok')->with('success', 'Import data paket berhasil!');
    }

    public function generatePDF()
    {
        // Data untuk ditampilkan dalam PDF
        $data = Stok::all();

        // Render view ke HTML
        $pdf = PDF::loadView('stok/stok-pdf', ['stok' => $data]);
        $date = date('Y-m-d');
        return $pdf->download($date . '-data-stok.pdf');
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
    public function store(StoreStokRequest $request)
    { {
            $stok = Stok::where('menu_id', $request->menu_id)->get()->first();
            if (!$stok) {
                Stok::create($request->all());
                return redirect('stok')->with('success', 'Data Stok berhasil di tambahkan!');
            }

            return redirect('stok')->with('success', 'Data Stok berhasil di tambahkan!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Stok $stok)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Stok $stok)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStokRequest $request, string $id)
    {
        $stok = Stok::find($id)->update($request->all());
        return redirect('stok')->with('success', 'Update data berhasil');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Stok::find($id)->delete();
        return redirect('stok')->with('success', 'Data Stok berhasil dihapus!');
    }
}
