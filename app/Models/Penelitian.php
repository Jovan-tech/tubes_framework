<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;


class Penelitian extends Model
{
    use HasFactory;
    protected $table = 'penelitian';
    // list kolom yang bisa diisi
    protected $fillable = ['kode_penelitian', 'internal', 'eksternal', 'lainnya'];


    // untuk melihat data penelitian
    public static function getPenelitian()
    {
        // query ke tabel penelitian
        $sql = "SELECT * FROM penelitian";
        $penelitian = DB::select($sql);
        return $penelitian;
    }

    // query nilai max dari kode penelitian untuk generate otomatis kode penelitian
    public function getKodePenelitian()
    {
        // query kode penelitian
        $sql = "SELECT IFNULL(MAX(kode_penelitian), 'PN-000') as kode_penelitian 
                FROM penelitian";
        $kodepenelitian = DB::select($sql);

        // cacah hasilnya
        foreach ($kodepenelitian as $kdprsh) {
            $kd = $kdprsh->kode_penelitian;
        }
        // Mengambil substring tiga digit akhir dari string PR-000
        $noawal = substr($kd, -3);
        $noakhir = $noawal + 1; //menambahkan 1, hasilnya adalah integer cth 1

        //menyambung dengan string PR-001
        $noakhir = 'PN-' . str_pad($noakhir, 3, "0", STR_PAD_LEFT);

        return $noakhir;
    }
}