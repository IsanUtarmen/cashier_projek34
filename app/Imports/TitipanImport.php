<?php

namespace App\Imports;

use App\Models\produk_titipan;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class TitipanImport implements ToCollection, WithHeadingRow
{
    /**
     * @param Collection $rows
     */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            // Assuming your columns in the Excel file have the same names as your database fields
            produk_titipan::create([
                'nama_produk' => $row['nama_produk'],
                'nama_suplier' => $row['nama_suplier'],
                'harga_beli' => $row['harga_beli'],
                'harga_jual' => $row['harga_jual'],
                'stock' => $row['stock'],
                'keterangan' => $row['keterangan'],
            ]);
        }
    }
    public function headingRow()
    {
        return 6    ;
    }
}
