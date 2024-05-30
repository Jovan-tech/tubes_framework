<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;


class Pengabdian extends Model
{
    use HasFactory;
    protected $table = 'pengabdian';
    // list kolom yang bisa diisi
    protected $fillable = ['kode_pengabdian', 'internal', 'eksternal'];

    // untuk melihat data pengabdian
    public static function getPengabdian()
    {
        // query ke tabel pengabdian
        $sql = "SELECT * FROM pengabdian";
        $pengabdian = DB::select($sql);
        return $pengabdian;
    }

    // query nilai max dari kode pengabdian untuk generate otomatis kode pengabdian
    public function getKodePengabdian()
    {
        // query kode pengabdian
        $sql = "SELECT IFNULL(MAX(kode_pengabdian), 'PG-000') as kode_pengabdian 
                FROM pengabdian";
        $kodepengabdian = DB::select($sql);

        // cacah hasilnya
        foreach ($kodepengabdian as $kdprsh) {
            $kd = $kdprsh->kode_pengabdian;
        }
        // Mengambil substring tiga digit akhir dari string PR-000
        $noawal = substr($kd, -3);
        $noakhir = $noawal + 1; //menambahkan 1, hasilnya adalah integer cth 1

        //menyambung dengan string PR-001
        $noakhir = 'PG-' . str_pad($noakhir, 3, "0", STR_PAD_LEFT);

        return $noakhir;
    }
}
