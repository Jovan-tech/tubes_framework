<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengeluaran extends Model
{    

    use HasFactory;

    protected $table = 'pengeluaran';

    protected $fillable = [
        'harga',
        'tanggal',
        'deskripsi',
    ];

    public static function getpengeluaran()
    {
        // query ke tabel penelitian
        $sql = "SELECT * FROM barang";
        $pengeluaran = DB::select($sql);
        return $pengeluaran;
    }
}