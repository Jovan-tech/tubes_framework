<?php
namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;


class PenelitianB extends Model
{
    use HasFactory;
    protected $table = 'penelitianb';
    // list kolom yang bisa diisi
    protected $fillable = ['kode_penelitianb','bahan_penelitian','transkrip_pengujian','inventaris'];

    // query nilai max dari kode penelitianb untuk generate otomatis kode penelitianb
    public function getKodePenelitianB()
    {
        // query kode penelitianb
        $sql = "SELECT IFNULL(MAX(kode_penelitianb), 'KB-000') as kode_penelitianb 
                FROM penelitianb";
        $kodepenelitianb = DB::select($sql);

        // cacah hasilnya
        foreach ($kodepenelitianb as $kdprsh) {
            $kd = $kdprsh->kode_penelitianb;
        }
        // Mengambil substring tiga digit akhir dari string PR-000
        $noawal = substr($kd,-3);
        $noakhir = $noawal+1; //menambahkan 1, hasilnya adalah integer cth 1
        
        //menyambung dengan string PR-001
        $noakhir = 'KB-'.str_pad($noakhir,3,"0",STR_PAD_LEFT); 

        return $noakhir;

    }
}
