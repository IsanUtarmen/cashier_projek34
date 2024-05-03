<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'menu';
    protected $fillable = ['jenis_id', 'nama_menu', 'harga', 'image', 'deskripsi'];

    public function jenis()
    {
        return $this->belongsTo(Jenis::class, 'jenis_id', 'id');
    }

    public function stok()
    {
        return $this->belongsTo(Stok::class, 'id', 'menu_id');
    }
    public function detailTransaksis()
{
    return $this->hasMany(DetailTransaksi::class, 'menu_id', 'id');
}
}
