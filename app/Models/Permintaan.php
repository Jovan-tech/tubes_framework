<?php
namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;


class Permintaan extends Model
{
    use HasFactory;
    protected $table = 'permintaan';
    // list kolom yang bisa diisi
    protected $fillable = ['kode_permintaan','nama_permintaan','nama_pengajuan','tgl_bayar','tipe_pengajuan','note','jumlah_pengajuan'];

    // query nilai max dari kode permintaan untuk generate otomatis kode permintaan
    public function getKodePermintaan()
    {
        // query kode permintaan
        $sql = "SELECT IFNULL(MAX(kode_permintaan), 'KP-000') as kode_permintaan 
                FROM permintaan";
        $kodepermintaan = DB::select($sql);

        // cacah hasilnya
        foreach ($kodepermintaan as $kdprsh) {
            $kd = $kdprsh->kode_permintaan;
        }
        // Mengambil substring tiga digit akhir dari string PR-000
        $noawal = substr($kd,-3);
        $noakhir = $noawal+1; //menambahkan 1, hasilnya adalah integer cth 1
        
        //menyambung dengan string PR-001
        $noakhir = 'KP-'.str_pad($noakhir,3,"0",STR_PAD_LEFT); 

        return $noakhir;

    }
}
