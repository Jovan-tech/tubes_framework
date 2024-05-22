<?php
namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;


class Mitra extends Model
{
    use HasFactory;
    protected $table = 'mitra';
    // list kolom yang bisa diisi
    protected $fillable = ['kode_mitra','nama','alamat','email','jenis_bisnis'];

    // query nilai max dari kode mitra untuk generate otomatis kode mitra
    public function getKodeMitra()
    {
        // query kode mitra
        $sql = "SELECT IFNULL(MAX(kode_mitra), 'MT-000') as kode_mitra 
                FROM mitra";
        $kodemitra = DB::select($sql);

        // cacah hasilnya
        foreach ($kodemitra as $kdprsh) {
            $kd = $kdprsh->kode_mitra;
        }
        // Mengambil substring tiga digit akhir dari string PR-000
        $noawal = substr($kd,-3);
        $noakhir = $noawal+1; //menambahkan 1, hasilnya adalah integer cth 1
        
        //menyambung dengan string PR-001
        $noakhir = 'MT-'.str_pad($noakhir,3,"0",STR_PAD_LEFT); 

        return $noakhir;

    }
}
