<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemasukan extends Model
{
    use HasFactory;

    protected $table = "pemasukan";

    protected $fillable = [
        'jumlah',
        'tanggal',
        'perincian',
    ];

    public static function getpemasukan()
    {
        // query ke tabel penelitian
        $sql = "SELECT * FROM pemasukan";
        $pemasukan = DB::select($sql);
        return $pemasukan;
    }
}