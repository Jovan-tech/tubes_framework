<?php
namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;


class Pengeluaran extends Model
{
    use HasFactory;
    protected $table = 'pengeluaran';
    // list kolom yang bisa diisi
    protected $fillable = ['kode_akun','nama_akun','header_akun'];

    // query nilai max dari kode pengeluaran untuk generate otomatis kode pengeluaran
    public function getKodePengeluaran()
    {
        // query kode pengeluaran
        $sql = "SELECT IFNULL(MAX(kode_akun), 'PN-000') as kode_akun
                FROM pengeluaran";
        $kodeakun = DB::select($sql);

        // cacah hasilnya
        foreach ($kodeakun as $kdprsh) {
            $kd = $kdprsh->kode_akun;
        }
        // Mengambil substring tiga digit akhir dari string PR-000
        $noawal = substr($kd,-3);
        $noakhir = $noawal+1; //menambahkan 1, hasilnya adalah integer cth 1
        
        //menyambung dengan string PR-001
        $noakhir = 'PN-'.str_pad($noakhir,3,"0",STR_PAD_LEFT); 

        return $noakhir;

    }
}
