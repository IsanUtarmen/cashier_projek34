<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Models\menu;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class menuImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {

        foreach ($rows as $row) {
            // Assuming your columns in the Excel file have the same names as your database fields
            menu::create([

                'jenis_id' => $row['jenis_id'],
                'nama_menu' => $row['nama_menu'],
                'harga' => $row['harga'],
                'image' => $row['image'],
                'deskripsi' => $row['deskripsi'],


            ]);
        }
    }
    public function headingRow()
    {
        return 3;
    }
}
