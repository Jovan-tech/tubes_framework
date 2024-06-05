<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StorePengeluaranRequest;
use App\Http\Requests\UpdatePengeluaranRequest;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Pengeluaran;

class PengeluaranController extends Controller
{

    public static function index ()
    {
        //query data
        $pengeluaran = Pengeluaran::all();
        return view('pengeluaran.create',
                    [
                        'pengeluaran' => $pengeluaran
                    ]
                  );
    }
    public function store(StorePengeluaranRequest $request)
    {
        //digunakan untuk validasi kemudian kalau ok tidak ada masalah baru disimpan ke db
        $validated = $request->validate([
            'jumlah' => 'required',
            'tanggal' => 'required',
            'perincian' => 'required',
        ]);

        // masukkan ke db
        Pengeluaran::create($request->all());
        
        return redirect()->route('pengeluaran.index')->with('success','Data Berhasil di Input');
    }
    public function edit(UpdatePengeluaranRequest $request, Pengeluaran $pengeluaran)
    {
        //digunakan untuk validasi kemudian kalau ok tidak ada masalah baru diupdate ke db
        $validated = $request->validate([
            'jumlah' => 'required',
            'tanggal' => 'required|max:255',
            'perincian' => 'required',
        ]);
    
        $pengeluaran->update($validated);
    
        return redirect()->route('pengeluaran.index')->with('success','Data Berhasil di Ubah');
    }
    public static function show(){
        
    }

}
