<?php
namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;


class PenelitianA extends Model
{
    use HasFactory;
    protected $table = 'penelitiana';
    // list kolom yang bisa diisi
    protected $fillable = ['kode_penelitiana','bahan_penelitian','transkrip_pengujian','inventaris'];

    // query nilai max dari kode penelitiana untuk generate otomatis kode penelitiana
    public function getKodePenelitianA()
    {
        // query kode penelitiana
        $sql = "SELECT IFNULL(MAX(kode_penelitiana), 'KA-000') as kode_penelitiana 
                FROM penelitiana";
        $kodepenelitiana = DB::select($sql);

        // cacah hasilnya
        foreach ($kodepenelitiana as $kdprsh) {
            $kd = $kdprsh->kode_penelitiana;
        }
        // Mengambil substring tiga digit akhir dari string PR-000
        $noawal = substr($kd,-3);
        $noakhir = $noawal+1; //menambahkan 1, hasilnya adalah integer cth 1
        
        //menyambung dengan string PR-001
        $noakhir = 'KA-'.str_pad($noakhir,3,"0",STR_PAD_LEFT); 

        return $noakhir;

    }
}
