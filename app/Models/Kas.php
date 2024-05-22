<?php
namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;


class Kas extends Model
{
    use HasFactory;
    protected $table = 'kas';
    // list kolom yang bisa diisi
    protected $fillable = ['kode_kas','nama_kas','nominal_kas'];

    // query nilai max dari kode kas untuk generate otomatis kode kas
    public function getKodeKas()
    {
        // query kode kas
        $sql = "SELECT IFNULL(MAX(kode_kas), 'PR-000') as kode_kas 
                FROM kas";
        $kodekas = DB::select($sql);

        // cacah hasilnya
        foreach ($kodekas as $kdprsh) {
            $kd = $kdprsh->kode_kas;
        }
        // Mengambil substring tiga digit akhir dari string PR-000
        $noawal = substr($kd,-3);
        $noakhir = $noawal+1; //menambahkan 1, hasilnya adalah integer cth 1
        
        //menyambung dengan string PR-001
        $noakhir = 'PR-'.str_pad($noakhir,3,"0",STR_PAD_LEFT); 

        return $noakhir;

    }
}
