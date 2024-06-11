<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StorePengeluaranRequest;
use App\Http\Requests\UpdatePengeluaranRequest;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Pengeluaran;

class PengeluaranController extends Controller
{

    public static function index (Request $request)
    {
        
        $tanggalmulai = $request->query('tanggal_mulai');
        $tanggalselesai = $request->query('tanggal_selesai');

        $pengeluaran = Pengeluaran::when($tanggalmulai, function ($query) use ($tanggalmulai) {
            return $query->where('tanggal', '>=', $tanggalmulai);
        })->when($tanggalselesai, function ($query) use ($tanggalselesai) {
            return $query->where('tanggal', '<=', $tanggalselesai);
        })->get();

        $data = collect();
        
        foreach ($pengeluaran as $p) {
            $data->push([
                'id' => $p ->id,
                'input_data' => $p->created_at,
                'tanggal' => $p->tanggal,
                'perincian' => $p->perincian,
                'pengeluaran' => $p->jumlah,                
                'jumlah' => 0,
            ]);
        }

        $data = $data->sortBy('tanggal');

        $jumlah = 0;
        $data = $data->map(function ($item) use (&$jumlah) {
            $jumlah += $item['pengeluaran'];
            $item['jumlah'] = $jumlah;
            return $item;
        });
    
        return view('pengeluaran.create',
                    [
                        'pengeluaran' => $data,
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
