<?php

namespace App\Imports;

use App\Models\jenis;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class jenisImport implements ToModel, WithHeadingRow
{
    public function headingRow(){
        return 3;
    }
    public function model(array $rows)
    {
        return new jenis([ 
            'nama_jenis' => $rows['nama_jenis'],
        ]);
    }
}
