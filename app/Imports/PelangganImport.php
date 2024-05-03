<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Models\pelanggan;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class pelangganImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {

        foreach ($rows as $row) {
            // Assuming your columns in the Excel file have the same names as your database fields
            pelanggan::create([
                'no' => $row['no'],
                'nama_pelanggan' => $row['nama_pelanggan'],
                'email' => $row['email'],
                'no_telp' => $row['no_telp'],
                'alamat' => $row['alamat'],
            ]);
        }
    }
    public function headingRow()
    {
        return 3;
    }
}
