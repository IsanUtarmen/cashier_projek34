<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Jenis;
use App\Http\Requests\StoreMenuRequest;
use App\Http\Requests\UpdateMenuRequest;
use Illuminate\Database\QueryException;
use Exception;
use PDOException;
use App\Exports\MenuExport;
use App\Imports\MenuImport;
use Dompdf\Dompdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Maatwebsite\Excel\Facades\Excel;


class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $data['menu'] = Menu::with(['jenis'])->get();
            $data['jenis'] = Jenis::get(); // Perbaikan penulisan 'jenis'
            return view('menu.index')->with($data);
        } catch (QueryException | Exception | PDOException $error) {
            $this->failResponse($error->getMessage(), $error->getCode());
        }
    }

    public function exportData()
    {
        // $date = date('Y-m-d');
        return Excel::download(new MenuExport,   '_menu.xlsx');
    }

    public function importData()
    {
        Excel::import(new MenuImport, request()->file('import')); // Replace XLSX with the appropriate reader type
        return redirect('menu')->with('success', 'Import data paket berhasil!');
    }

    public function generatepdf()
    {
        // Get data
        $menu = Menu::all();

        // Loop through menu items and encode images to base64
        foreach ($menu as $p) { 
            $imagePath = public_path('images/' . $p->image);
            $imageData = base64_encode(file_get_contents($imagePath));
            $p->imageData = $imageData;
        }

        // Generate PDF
        $dompdf = new Dompdf();
        $html = View::make('menu.menu-pdf', compact('menu'))->render();
        $dompdf->loadHtml($html);
        $dompdf->render();

        // Return the PDF as a download
        return $dompdf->stream('menu.pdf');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMenuRequest $request)
    {



        $request->validate([
            'image' => 'required|image|mimes:png,jpg,jpeg,svg|max:2048',

        ]);

        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('images'), $imageName);

        $data = $request->all();
        $data['image'] = $imageName;

        Menu::create($data);

        return redirect('menu')->with('success', 'Data menu berhasil ditambahkan!');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMenuRequest $request, string $id)
    {
        $menu = Menu::find($id);

        $request->validate([
            'image' => 'required|image|mimes:png,jpg,jpeg,svg|max:2048',
        ]);

        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('images'), $imageName);

        $data = $request->all();
        $data['image'] = $imageName;

        $menu->update($data);

        return redirect('menu')->with('success', 'Update data berhasil');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Menu::find($id)->delete();
        return redirect('menu')->with('success', 'Data Menu berhasil dihapus!');
    }


}
