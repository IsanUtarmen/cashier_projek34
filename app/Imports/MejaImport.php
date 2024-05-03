<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Models\meja;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class mejaImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {

        foreach ($rows as $row) {
            // Assuming your columns in the Excel file have the same names as your database fields
            meja::create([

                'nomor_meja' => $row['nomor_meja'],
                'kapasitas' => $row['kapasitas'],
                'status' => $row['status'],
               


            ]);
        }
    }
    public function headingRow()
    {
        return 3;
    }
}
