<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'barang';
    protected $fillable = [
        'nama_barang',
        'harga',
        'stok',
        'deskripsi',
        'tanggal',
    ];

    public static function getTransaksi()
    {
        $sql = "SELECT * FROM barang";
        $barang = DB::select($sql);
        return $barang;
    }
}

