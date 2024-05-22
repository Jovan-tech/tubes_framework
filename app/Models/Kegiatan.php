<?php
namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;


class Kegiatan extends Model
{
    use HasFactory;
    protected $table = 'kegiatan';
    // list kolom yang bisa diisi
    protected $fillable = ['jenis_kegiatan','kode_kegiatan','nama_kegiatan','alamat_kegiatan'];

    // query nilai max dari kode kegiatan untuk generate otomatis kode kegiatan
    public function getKodeKegiatan()
    {
        // query kode kegiatan
        $sql = "SELECT IFNULL(MAX(kode_kegiatan), 'KG-000') as kode_kegiatan 
                FROM kegiatan";
        $kodekegiatan = DB::select($sql);

        // cacah hasilnya
        foreach ($kodekegiatan as $kdprsh) {
            $kd = $kdprsh->kode_kegiatan;
        }
        // Mengambil substring tiga digit akhir dari string PR-000
        $noawal = substr($kd,-3);
        $noakhir = $noawal+1; //menambahkan 1, hasilnya adalah integer cth 1
        
        //menyambung dengan string PR-001
        $noakhir = 'KG-'.str_pad($noakhir,3,"0",STR_PAD_LEFT); 

        return $noakhir;

    }
}