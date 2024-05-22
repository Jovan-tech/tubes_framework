<?php
 
namespace App\Http\Controllers;
 
use App\Http\Controllers\Controller;
use App\Models\Coa;
use App\Models\Penjualan;

use PDF; //untuk cetak pdf

// untuk string padding
use Illuminate\Support\Str;
 
class Contoh1Controller extends Controller
{
    public function show()
    {
        return "Halo, ini adalah contoh kontroller sederhana tanpa view";
    }

    // coba tes dom
    public function contohdom(){
        return view('contohdom');
    }

    // coba tes ajax
    public function contohajax(){
        return view('contohajax');
    }

    // tes hasil query
    public function teshasil($id){
        $coa = Coa::where('id', $id)
                    ->select('nama_akun')
                    ->first();
        echo $coa->nama_akun;

        echo Penjualan::tes();
    }

    // tes helper custom
    public function teshelpercustom(){
        $angka = 76132404;
        echo rupiah($angka);
    }

    //tes cetak pdf
    public function tescetakpdf(){
        $coa = Coa::all();
        $pdf = PDF::loadview('coa_pdf',['coa'=>$coa]);
        return $pdf->download('laporan-coa-pdf.pdf');
    }

    // tes helper bawaan str padding
    public function teshelperlaravel(){
        $padded = Str::padLeft('James', 10, '-=');
        //$padded = 'F-' .Str::padLeft('1', 3, '0');
        // hasilnya 001 ('1', 3, '0') kalau di tambah 'F-' hasilnya F-001
        echo $padded;

        //$string = Str::of('0812345678910')->mask('*',-3);
        //echo $string;
    }

}