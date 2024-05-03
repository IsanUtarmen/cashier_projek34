<?php

namespace App\Imports;

use App\Models\Absensi;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AbsensiImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {

        foreach ($rows as $row) {
            // Assuming your columns in the Excel file have the same names as your database fields
            absensi::create([
                'nama_karyawan' => $row['nama_karyawan'],
                'tanggal_masuk' => $row['tanggal_masuk'],
                'waktu_masuk' => $row['waktu_masuk'],
                'status' => $row['status'],
                'waktu_keluar' => $row['waktu_keluar'],




            ]);
        }
    }
    public function headingRow()
    {
        return 8;
    }
}
