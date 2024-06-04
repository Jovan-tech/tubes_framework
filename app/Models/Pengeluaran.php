<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengeluaran extends Model
{
    use HasFactory;

    protected $table = "pengeluaran";

    protected $fillable = [
        'jumlah',
        'tanggal',
        'perincian',
    ];

    public static function getpengeluaran()
    {
        // query ke tabel penelitian
        $sql = "SELECT * FROM pengeluaran";
        $pengeluaran = DB::select($sql);
        return $pengeluaran;
    }
}