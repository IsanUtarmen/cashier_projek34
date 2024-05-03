<?php

namespace App\Imports;

use App\Http\Controllers\LaporanController;
use App\Models\Detail_transaksi;
use Maatwebsite\Excel\Concerns\ToModel;

class DetailTransaksiImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new LaporanController([
            //
        ]);
    }
}
