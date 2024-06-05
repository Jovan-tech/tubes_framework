<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StorePemasukanRequest;
use App\Http\Requests\UpdatePemasukanRequest;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Pemasukan;

class PemasukanController extends Controller
{

    public static function index ()
    {
        //query data
        $pemasukan = Pemasukan::all();
        return view('pemasukan.create',
                    [
                        'pemasukan' => $pemasukan
                    ]
                  );
    }
    public function store(StorePemasukanRequest $request)
    {
        //digunakan untuk validasi kemudian kalau ok tidak ada masalah baru disimpan ke db
        $validated = $request->validate([
            'jumlah' => 'required',
            'tanggal' => 'required',
            'perincian' => 'required',
        ]);

        // masukkan ke db
        Pemasukan::create($request->all());
        
        return redirect()->route('pemasukan.index')->with('success','Data Berhasil di Input');
    }
    public function edit(UpdatePemasukanRequest $request, Pemasukan $pemasukan)
    {
        //digunakan untuk validasi kemudian kalau ok tidak ada masalah baru diupdate ke db
        $validated = $request->validate([
            'jumlah' => 'required',
            'tanggal' => 'required|max:255',
            'perincian' => 'required',
        ]);
    
        $pemasukan->update($validated);
    
        return redirect()->route('pemasukan.index')->with('success','Data Berhasil di Ubah');
    }

}
