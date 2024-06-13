<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StorePengeluaranRequest;
use App\Http\Requests\UpdatePengeluaranRequest;
use Illuminate\Support\Facades\DB;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Pengeluaran;
use App\Models\Barang;

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
                'jumlah' => $p->jumlah,                
                'total' => 0,
            ]);
        }

        $data = $data->sortBy('tanggal');

        $total = 0;
        $data = $data->map(function ($item) use (&$total) {
            $total += $item['jumlah'];
            $item['total'] = $total;
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
        $request->validate([
            'nama_barang' => 'required',
            
            'harga' => 'required',
            'tanggal' => 'required|date',
            'deskripsi' => 'required',
            'stok' => 'required',
        ]);

        // Handle file upload
       
        

        // Use a transaction to ensure both inserts succeed or fail together
        DB::transaction(function () use ($request) {
            // Insert into barang table
            Barang::create([
                'nama_barang' => $request->nama_barang,                
                'harga' => $request->harga,
                'stok' => $request->stok,
                'deskripsi' => $request->deskripsi,
                'tanggal' => $request->tanggal,
            ]);

            // Insert into pengeluaran table
            Pengeluaran::create([
                'harga' => $request->harga,
                'tanggal' => $request->tanggal,
                'deskripsi' => $request->deskripsi,
            ]);
        });

        return redirect()->route('pengeluaran.index')->with('success', 'Data Berhasil di Input');
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
