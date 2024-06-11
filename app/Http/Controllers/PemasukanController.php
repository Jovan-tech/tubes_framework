<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StorePemasukanRequest;
use App\Http\Requests\UpdatePemasukanRequest;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Pemasukan;
use App\Models\Kegiatan;

class PemasukanController extends Controller
{

    public static function index (Request $request)
    {
        
        $tanggalmulai = $request->query('tanggal_mulai');
        $tanggalselesai = $request->query('tanggal_selesai');

        $pemasukan = Pemasukan::when($tanggalmulai, function ($query) use ($tanggalmulai) {
            return $query->where('tanggal', '>=', $tanggalmulai);
        })->when($tanggalselesai, function ($query) use ($tanggalselesai) {
            return $query->where('tanggal', '<=', $tanggalselesai);
        })->get();

        $data = collect();
        
        foreach ($pemasukan as $p) {
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
    
        return view('pemasukan.create',
                    [
                        'pemasukan' => $data,
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

    public function create()
{    
    $kegiatan = Kegiatan::all();
    return view('pemasukan.tambah', ['kegiatan' => $kegiatan]);
}

    public function edit(UpdatePemasukanRequest $request, Pemasukan $pemasukan, $id)
    {
        //digunakan untuk validasi kemudian kalau ok tidak ada masalah baru diupdate ke db
        $validated = $request->validate([
            'jumlah' => 'required',
            'tanggal' => 'required|max:255',
            'perincian' => 'required',
        ]);
    
        $pemasukan = Pemasukan::all();

        return view('pemasukan.edit',
        [
            'pemasukan' => $pemasukan
        ]
        );
    }
    public function destroy($id)
    {
        //hapus dari database
        $pemasukan = Pemasukan::findOrFail($id);
        $pemasukan->delete();

        return redirect()->route('pemasukan.index')->with('success','Data Berhasil di Hapus');
    }
}
