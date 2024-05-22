<?php
namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;


class PIC extends Model
{
    use HasFactory;
    protected $table = 'pic';
    // list kolom yang bisa diisi
    protected $fillable = ['id_pic','nama','jabatan','no'];

    // query nilai max dari id pic untuk generate otomatis id pic
    public function getKodePIC()
    {
        // query id pic
        $sql = "SELECT IFNULL(MAX(id_pic), 'PC-000') as id_pic 
                FROM pic";
        $idpic = DB::select($sql);

        // cacah hasilnya
        foreach ($idpic as $kdprsh) {
            $kd = $kdprsh->id_pic;
        }
        // Mengambil substring tiga digit akhir dari string PR-000
        $noawal = substr($kd,-3);
        $noakhir = $noawal+1; //menambahkan 1, hasilnya adalah integer cth 1
        
        //menyambung dengan string PR-001
        $noakhir = 'PC-'.str_pad($noakhir,3,"0",STR_PAD_LEFT); 

        return $noakhir;

    }
}
