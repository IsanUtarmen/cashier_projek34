<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Models\category;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class categoryImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {

        foreach ($rows as $row) {
            // Assuming your columns in the Excel file have the same names as your database fields
            category::create([

                'nama_category' => $row['nama_category'],
            ]);
        }
    }
    public function headingRow()
    {
        return 3;
    }
}
