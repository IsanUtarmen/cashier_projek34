<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use PDOException;
use Illuminate\Database\QueryException;
use Exception;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CategoryExport;
use App\Imports\CategoryImport;
use Barryvdh\DomPDF\Facade\Pdf;

use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $data['category'] = Category::get();
            return view('category.index')->with($data);
        } catch (QueryException | Exception | PDOException $error) {
            $this->failResponse($error->getMessage(), $error->getCode());
        }
    }

    public function generatePDF()
    {
        // Data untuk ditampilkan dalam PDF
        $data = Category::all();

        // Render view ke HTML
        $pdf = PDF::loadView('category/category-pdf', ['category' => $data]);
        $date = date('Y-m-d');
        return $pdf->download($date . '-data-category.pdf');
    }

    public function exportData()
    {
        $date = date('Y-m-d');
        return Excel::download(new CategoryExport, $date . '_category.xlsx');
    }

    public function importData()
    {
        Excel::import(new CategoryImport, request()->file('import')); // Replace XLSX with the appropriate reader type
        return redirect('category')->with('success', 'Import data paket berhasil!');
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
    public function store(StoreCategoryRequest $request)
    {
        Category::create($request->all());

        return redirect('category')->with('success', 'Data produk berhasil di tambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $category->update($request->all());
        return redirect('category')->with('success', 'Update data berhasil');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect('category')->with('success', 'Data category berhasil dihapus!');
    }
}
